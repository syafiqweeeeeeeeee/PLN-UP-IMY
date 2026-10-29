const BASE = 'http://127.0.0.1:8000';
const EMAIL = process.env.ADMIN_EMAIL || 'admin@example.com';
const PASSWORD = process.env.ADMIN_PASSWORD || 'password123';
const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));

async function main() {
  const targets = await (await fetch('http://127.0.0.1:9222/json/list')).json();
  const page = targets.find(target => target.type === 'page');
  if (!page) throw new Error('Chrome has no page target.');

  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise((resolve, reject) => { ws.onopen = resolve; ws.onerror = reject; });
  let nextId = 0;
  const pending = new Map();
  const errors = [];
  ws.onmessage = event => {
    const message = JSON.parse(event.data);
    if (message.id && pending.has(message.id)) {
      const resolve = pending.get(message.id);
      pending.delete(message.id);
      resolve(message);
    } else if (message.method === 'Runtime.exceptionThrown') {
      errors.push(message.params.exceptionDetails.exception?.description || message.params.exceptionDetails.text);
    } else if (message.method === 'Runtime.consoleAPICalled' && message.params.type === 'error') {
      errors.push(message.params.args.map(arg => arg.value ?? arg.description ?? '').join(' '));
    }
  };
  const send = (method, params = {}) => new Promise(resolve => {
    const id = ++nextId;
    pending.set(id, resolve);
    ws.send(JSON.stringify({ id, method, params }));
  });
  const evaluate = async expression => {
    const response = await send('Runtime.evaluate', { expression, returnByValue: true, awaitPromise: true });
    if (response.result?.exceptionDetails) {
      throw new Error(response.result.exceptionDetails.exception?.description || response.result.exceptionDetails.text);
    }
    return response.result?.result?.value;
  };
  const check = (name, pass, detail = '') => {
    console.log(`${pass ? 'PASS' : 'FAIL'} | ${name}${detail ? ` | ${detail}` : ''}`);
    if (!pass) process.exitCode = 1;
  };

  await send('Page.enable');
  await send('Runtime.enable');
  await send('Network.enable');
  await send('Network.setCacheDisabled', { cacheDisabled: true });
  await send('Page.navigate', { url: `${BASE}/admin/login` });
  await sleep(1200);
  await evaluate(`(function(){
    const email = document.getElementById('email') || document.querySelector('input[type=email]');
    const password = document.querySelector('input[type=password]');
    if (!email || !password) return 'no-login-form';
    email.value = ${JSON.stringify(EMAIL)};
    password.value = ${JSON.stringify(PASSWORD)};
    email.closest('form').submit();
    return 'submitted';
  })()`);
  await sleep(1800);
  await send('Page.navigate', { url: `${BASE}/admin/users/create` });
  await sleep(2200);

  const create = JSON.parse(await evaluate(`JSON.stringify((function(){
    const bidang = document.getElementById('bidang_id');
    const roles = document.getElementById('role_id');
    const script = Array.from(document.scripts).map(node => node.textContent).find(text => text.includes('const MASTER_JABATANS')) || '';
    const match = script.match(/const MASTER_JABATANS = (\\[.*?\\]);/s);
    return {
      url: location.pathname,
      form: !!document.getElementById('userForm'),
      bidangCount: bidang ? Array.from(bidang.options).filter(option => option.value !== '').length : 0,
      jabatanJsonCount: match ? JSON.parse(match[1]).length : -1,
      bidangVisible: !!bidang && getComputedStyle(bidang.closest('#masterBidangWrapper')).display !== 'none',
      roleOptions: roles ? Array.from(roles.options).map(option => ({ value: option.value, text: option.textContent.trim() })) : []
    };
  })())`));
  check('Tambah Pengguna termuat beserta data bidang dan jabatan', create.url === '/admin/users/create' && create.form && create.bidangCount > 0 && create.jabatanJsonCount > 0, JSON.stringify(create));

  const roleKaryawan = create.roleOptions.find(option => option.text === 'Karyawan');
  if (!roleKaryawan) throw new Error('Role Karyawan option not found.');
  const selected = JSON.parse(await evaluate(`(function(){
    const role = document.getElementById('role_id');
    role.value = ${JSON.stringify(roleKaryawan.value)};
    role.dispatchEvent(new Event('change', { bubbles: true }));

    const bidang = document.getElementById('bidang_id');
    const bidangCount = Array.from(bidang.options).filter(option => option.value !== '').length;
    bidang.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
    const bidangItems = Array.from(document.querySelectorAll('.pln-dd-panel .pln-dd-item'));
    if (!bidangItems.length) return JSON.stringify({ bidangCount, bidangDropdownItems: 0 });
    const selectedBidang = bidangItems[0].textContent.trim();
    bidangItems[0].click();

    const jabatan = document.getElementById('jabatan_id');
    const jabatanCount = Array.from(jabatan.options).filter(option => option.value !== '').length;
    jabatan.dispatchEvent(new MouseEvent('mousedown', { bubbles: true, cancelable: true }));
    const jabatanItems = Array.from(document.querySelectorAll('.pln-dd-panel .pln-dd-item'));
    return JSON.stringify({
      bidangCount,
      bidangDropdownItems: bidangItems.length,
      selectedBidang,
      jabatanCount,
      jabatanDropdownItems: jabatanItems.length,
      firstJabatan: jabatanItems[0]?.textContent.trim() || ''
    });
  })()`));
  check('Dropdown Bidang membuka pilihan dan seleksi memfilter Jabatan', selected.bidangCount > 0 && selected.bidangDropdownItems > 0 && selected.jabatanCount > 0 && selected.jabatanDropdownItems === selected.jabatanCount, JSON.stringify(selected));
  check('Tidak ada error JavaScript', errors.length === 0, errors.slice(0, 5).join(' || '));

  ws.close();
  if (process.exitCode) process.exit(process.exitCode);
}

main().catch(error => { console.error('FATAL', error); process.exit(1); });
