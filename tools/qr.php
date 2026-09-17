<?php

/**
 * QR generator mandiri untuk QR PLN Mobile (tanpa dependensi eksternal).
 * Versi 4 (33x33), ECC M, mode byte, mask terbaik via penalty rules.
 * Penempatan modul mengikuti spesifikasi QR (pola data zig-zag standar,
 * format info BCH(15,5) dua salinan, alignment v4).
 *
 * Self-check: dekode balik codewords dari matriks final (round-trip).
 *
 * Usage: php tools/qr.php [output.png] [payload]
 */

$OUT = $argv[1] ?? 'public/assets/halaman_utama/qr-pln-mobile.png';
$PAY = $argv[2] ?? 'https://play.google.com/store/apps/details?id=com.icon.pln123';

// ---------- GF(256), polinomial primitif 0x11d ----------
$GF  = array_fill(0, 256, 0);
$GFL = array_fill(0, 256, 0);
$x = 1;
for ($i = 0; $i < 255; $i++) {
    $GFL[$x] = $i;
    $GF[$i]  = $x;
    $x <<= 1;
    if ($x & 0x100) $x ^= 0x11d;
}
$gm = fn ($a, $b) => ($a === 0 || $b === 0) ? 0 : $GF[($GFL[$a] + $GFL[$b]) % 255];

// ---------- Reed-Solomon ----------
function rsGen(int $n) {
    global $GF, $gm;
    $g = [1];
    for ($i = 0; $i < $n; $i++) {
        $ng = array_fill(0, count($g) + 1, 0);
        foreach ($g as $j => $c) {
            $ng[$j] ^= $c;
            if ($c !== 0) $ng[$j + 1] ^= $gm($c, $GF[$i]);
        }
        $g = $ng;
    }
    return $g;
}
function rsRem(array $data, int $count): array {
    global $gm;
    $g = rsGen($count);
    $rem = array_fill(0, $count, 0);
    foreach ($data as $b) {
        $f = $b ^ array_shift($rem);
        $rem[] = 0;
        if ($f !== 0) foreach ($g as $i => $c) {
            if ($i > 0) $rem[$i - 1] ^= $gm($c, $f);
        }
    }
    return $rem;
}

// ---------- Konstanta QR versi 4, ECC M ----------
// v4 = 807 modul mentah -> 100 codewords total; M: 2 blok x (32 data, 18 ecc)
$S      = 33;   // 4*4 + 17
$DATA_M = 64;   // total data codewords (2 blok x 32)
$BLOCK_LEN   = 32;   // data codewords per blok
$ECC_PER_BLK = 18;   // ecc codewords per blok
$PAYLOAD_CAP = 62;

if (strlen($PAY) > $PAYLOAD_CAP) {
    fwrite(STDERR, "Payload terlalu panjang untuk QR v4-M ({$PAYLOAD_CAP} byte max)\n");
    exit(1);
}

// ---------- Bitstream: mode byte ----------
$data = array_values(unpack('C*', $PAY));
$bits = '0100';
$bits .= str_pad(decbin(count($data)), 8, '0', STR_PAD_LEFT);
foreach ($data as $ch) $bits .= str_pad(decbin($ch), 8, '0', STR_PAD_LEFT);
$bits .= str_repeat('0', min(4, $DATA_M * 8 - strlen($bits)));
while (strlen($bits) % 8) $bits .= '0';
$CW = [];
foreach (str_split($bits, 8) as $byte) $CW[] = bindec($byte);
$padSeq = [236, 17];
while (count($CW) < $DATA_M) $CW[] = $padSeq[count($CW) % 2];

// ---------- ECC + interleave (2 blok @ (32 data, 18 ecc)) ----------
$blocks = array_chunk($CW, $BLOCK_LEN);
$ecs    = array_map(fn ($blk) => rsRem($blk, $ECC_PER_BLK), $blocks);
$finalCw = [];
for ($i = 0; $i < $BLOCK_LEN; $i++) foreach ($blocks as $blk) $finalCw[] = $blk[$i];
for ($i = 0; $i < $ECC_PER_BLK; $i++) foreach ($ecs as $ec) $finalCw[] = $ec[$i];

// ---------- Matriks ----------
$M = array_fill(0, $S, array_fill(0, $S, null));
$fn = function (int $r, int $c, ?bool $v) use (&$M, $S) {
    if ($r >= 0 && $c >= 0 && $r < $S && $c < $S) $M[$r][$c] = $v;
};

// Finder + separator (3 lingkaran konsentris)
$finder = function (int $r0, int $c0) use ($fn) {
    for ($r = -1; $r <= 7; $r++) for ($c = -1; $c <= 7; $c++) {
        if ($r === -1 || $r === 7 || $c === -1 || $c === 7) { $fn($r0 + $r, $c0 + $c, false); continue; }
        $ring = max(abs($r - 3), abs($c - 3));
        $fn($r0 + $r, $c0 + $c, $ring === 3 || $ring === 1);
    }
};
$finder(0, 0); $finder(0, $S - 7); $finder($S - 7, 0);

// Timing
for ($i = 8; $i < $S - 8; $i++) { $fn(6, $i, $i % 2 === 0); $fn($i, 6, $i % 2 === 0); }

// Alignment (v4: hanya (26,26); sisanya overlap finder)
for ($r = -2; $r <= 2; $r++) for ($c = -2; $c <= 2; $c++) {
    $ring = max(abs($r), abs($c));
    $fn(26 + $r, 26 + $c, $ring !== 2 && $ring !== 1);
}

// Reservasi format info (standard layout, dua salinan) — cell = false dulu
$fn(5, 8, false); $fn(4, 8, false); $fn(3, 8, false); $fn(2, 8, false); $fn(1, 8, false); $fn(0, 8, false);
$fn(7, 8, false); $fn(8, 8, false); $fn(8, 7, false);
$fn(8, 5, false); $fn(8, 4, false); $fn(8, 3, false); $fn(8, 2, false); $fn(8, 1, false); $fn(8, 0, false);
for ($i = 0; $i < 8; $i++)  $fn(8, $S - 1 - $i, false);   // row 8, cols 32..25
for ($i = 8; $i < 15; $i++) $fn($S - 15 + $i, 8, false);  // col 8, rows 26..32

// Dark module
$fn($S - 8, 8, true);

// ---------- Urutan cell data (zig-zag standar, dari kanan-bawah) ----------
$INTER = [];
for ($right = $S - 1; $right >= 1; $right -= 2) {
    if ($right === 6) $right = 5;
    $upward = ((($right + 1) & 2) === 0);
    for ($vert = 0; $vert < $S; $vert++) {
        for ($j = 0; $j < 2; $j++) {
            $c = $right - $j;
            $r = $upward ? $S - 1 - $vert : $vert;
            if ($M[$r][$c] === null) $INTER[] = [$r, $c];
        }
    }
}

// ---------- Mask formulas (r = row, c = col) sesuai spesifikasi ----------
$MASKS = [
    fn ($r, $c) => ($r + $c) % 2 === 0,
    fn ($r, $c) => $r % 2 === 0,
    fn ($r, $c) => $c % 3 === 0,
    fn ($r, $c) => ($r + $c) % 3 === 0,
    fn ($r, $c) => (intdiv($r, 2) + intdiv($c, 3)) % 2 === 0,
    fn ($r, $c) => (($r * $c) % 2 + ($r * $c) % 3) === 0,
    fn ($r, $c) => ((($r * $c) % 2 + ($r * $c) % 3) % 2) === 0,
    fn ($r, $c) => ((($r + $c) % 2 + ($r * $c) % 3) % 2) === 0,
];

function penalty(array $m): int {
    $S = count($m); $p = 0;
    // Rule 1: run >= 5
    foreach ([false, true] as $vert) {
        for ($i = 0; $i < $S; $i++) {
            $run = 1; $pv = null;
            for ($j = 0; $j < $S; $j++) {
                $v = $vert ? $m[$j][$i] : $m[$i][$j];
                if ($v === $pv) { $run++; if ($run === 5) $p += 3; elseif ($run > 5) $p++; }
                else { $pv = $v; $run = 1; }
            }
        }
    }
    // Rule 2: blok 2x2 seragam
    for ($r = 0; $r < $S - 1; $r++) for ($c = 0; $c < $S - 1; $c++) {
        if ($m[$r][$c] === $m[$r][$c + 1] && $m[$r][$c] === $m[$r + 1][$c] && $m[$r][$c] === $m[$r + 1][$c + 1]) $p += 3;
    }
    // Rule 4: rasio gelap
    $dark = 0;
    foreach ($m as $row) foreach ($row as $v) if ($v) $dark++;
    $p += (int) (abs($dark * 100 - $S * $S * 50) / ($S * $S) / 5) * 10;
    return $p;
}

// ---------- Pilih mask terbaik ----------
$best = null; $bestMask = 0; $bestPenalty = PHP_INT_MAX;
for ($maskid = 0; $maskid < 8; $maskid++) {
    $M2 = $M;
    $bitIndex = 0;
    foreach ($INTER as [$r, $c]) {
        $byte = $finalCw[(int) ($bitIndex / 8)] ?? 0;
        $v = ((($byte >> (7 - $bitIndex % 8)) & 1) === 1);
        $M2[$r][$c] = $v !== $MASKS[$maskid]($r, $c);
        $bitIndex++;
    }
    $p = penalty($M2);
    if ($p < $bestPenalty) { $bestPenalty = $p; $best = $M2; $bestMask = $maskid; }
}
$M = $best;

// ---------- Format info: BCH(15,5), ECC M = formatBits 00 ----------
$fmtData = (0 << 3) | $bestMask;   // ECC M -> formatBits 0
$r = $fmtData << 10;
for ($i = 4; $i >= 0; $i--) if (($r >> (10 + $i)) & 1) $r ^= 0x537 << $i;
$fmtBits = (($fmtData << 10) | $r) ^ 0x5412;
$bitAt = fn (int $i): bool => (($fmtBits >> $i) & 1) === 1;

// Salinan 1
for ($i = 0; $i <= 5; $i++) $M[$i][8] = $bitAt($i);   // col 8, rows 0..5
$M[7][8] = $bitAt(6);
$M[8][8] = $bitAt(7);
$M[8][7] = $bitAt(8);
for ($i = 9; $i < 15; $i++) $M[8][14 - $i] = $bitAt($i);   // row 8, cols 5..0
// Salinan 2
for ($i = 0; $i < 8; $i++)  $M[8][$S - 1 - $i] = $bitAt($i);   // row 8, cols 32..25
for ($i = 8; $i < 15; $i++) $M[$S - 15 + $i][8] = $bitAt($i);  // col 8, rows 26..32
// Dark module sudah terisi true

// ---------- Self-check: dekode balik codewords dari matriks final ----------
$fb = '';
foreach ($INTER as [$r, $c]) {
    $raw = $M[$r][$c] !== $MASKS[$bestMask]($r, $c);
    $fb .= $raw ? '1' : '0';
}
$bytes = [];
foreach (str_split($fb, 8) as $by) $bytes[] = bindec($by);

// De-interleave balik sesuai struktur blok: final = blk0[0], blk1[0], blk0[1], blk1[1], ...
$dData = []; $dEc = [[], []];
for ($i = 0; $i < $BLOCK_LEN; $i++) {
    $dData[$i]            = $bytes[$i * 2];
    $dData[$BLOCK_LEN + $i] = $bytes[$i * 2 + 1];
}
for ($i = 0; $i < $ECC_PER_BLK; $i++) {
    $dEc[0][$i] = $bytes[$BLOCK_LEN * 2 + $i * 2];
    $dEc[1][$i] = $bytes[$BLOCK_LEN * 2 + $i * 2 + 1];
}
// Perbaiki urutan kunci hasil insert tak-berurutan agar array_slice benar
ksort($dData); ksort($dEc[0]); ksort($dEc[1]);

// Verifikasi Reed-Solomon: ECC hasil bacaan harus cocok dengan perhitungan ulang
$check0 = rsRem(array_slice($dData, 0, $BLOCK_LEN), $ECC_PER_BLK);
$check1 = rsRem(array_slice($dData, $BLOCK_LEN, $BLOCK_LEN), $ECC_PER_BLK);
if ($check0 !== $dEc[0] || $check1 !== $dEc[1]) {
    // Debug: bandingkan de-interleave dengan blok asli
    for ($k = 0; $k < $BLOCK_LEN; $k++) {
        if ($dData[$k] !== $blocks[0][$k])        { fwrite(STDERR, "DEBUG: dData[$k]=" . $dData[$k] . " != b0=$blocks[0][$k]\n"); break; }
        if ($dData[$BLOCK_LEN + $k] !== $blocks[1][$k]) { fwrite(STDERR, "DEBUG: dData[" . ($BLOCK_LEN + $k) . "] != b1\n"); break; }
    }
    for ($k = 0; $k < $ECC_PER_BLK; $k++) {
        if ($dEc[0][$k] !== $ecs[0][$k]) { fwrite(STDERR, "DEBUG: dEc0[$k]=" . $dEc[0][$k] . " != e0=" . $ecs[0][$k] . "\n"); break; }
        if ($dEc[1][$k] !== $ecs[1][$k]) { fwrite(STDERR, "DEBUG: dEc1[$k] != e1\n"); break; }
    }
    fwrite(STDERR, "DEBUG: RS blok0 " . ($check0 === $dEc[0] ? 'OK' : 'BEDA') . ", blok1 " . ($check1 === $dEc[1] ? 'OK' : 'BEDA') . "\n");
    fwrite(STDERR, 'dData[0..3]=' . json_encode(array_slice($dData, 0, 4)) . ' blocks0[0..3]=' . json_encode(array_slice($blocks[0], 0, 4)) . "\n");
    fwrite(STDERR, 'dEc0[0..3]=' . json_encode(array_slice($dEc[0], 0, 4)) . ' ecs0[0..3]=' . json_encode(array_slice($ecs[0], 0, 4)) . "\n");
    fwrite(STDERR, 'check0[0..3]=' . json_encode(array_slice($check0, 0, 4)) . ' recompute=' . json_encode(array_slice(rsRem(array_slice($dData, 0, $BLOCK_LEN), $ECC_PER_BLK), 0, 4)) . "\n");
    fwrite(STDERR, 'CW[0..3]=' . json_encode(array_slice($CW, 0, 4)) . "\n");
    // Debug: cari bit pertama di stream linear yang berbeda dari yang ditulis
    $expBits = '';
    foreach ($finalCw as $by) $expBits .= str_pad(decbin($by), 8, '0', STR_PAD_LEFT);
    for ($i = 0; $i < 800; $i++) {
        if ($expBits[$i] !== $fb[$i]) {
            [$dr, $dc] = $INTER[$i];
            fwrite(STDERR, "DEBUG: bit #$i beda di cell (r=$dr, c=$dc), exp={$expBits[$i]} got={$fb[$i]}\n");
            break;
        }
    }
    fwrite(STDERR, "SELF-CHECK GAGAL: Reed-Solomon tidak cocok\n");
    exit(1);
}

// Decode payload dari data codewords (bit 12 = header mode+count)
$dBits = '';
foreach ($dData as $by) $dBits .= str_pad(decbin($by), 8, '0', STR_PAD_LEFT);
$cnt = bindec(substr($dBits, 4, 8));
$decoded = pack('C*', ...array_map('bindec', str_split(substr($dBits, 12, $cnt * 8), 8)));
if ($cnt !== strlen($PAY) || $decoded !== $PAY) {
    fwrite(STDERR, "SELF-CHECK GAGAL: payload tidak cocok (cnt=$cnt)\n");
    exit(1);
}

// ---------- Render PNG (skala 10px, quiet zone 4) ----------
$SCALE = 10; $P = 4;
$W = ($S + 2 * $P) * $SCALE;
$grid = str_repeat("\xFF", $W * $W * 3);
$dot = function (int $r, int $c, bool $dark) use (&$grid, $W, $P, $SCALE) {
    $x0 = ($P + $c) * $SCALE; $y0 = ($P + $r) * $SCALE;
    $col = $dark ? "\x00\x00\x00" : "\xFF\xFF\xFF";
    $rowPx = str_repeat($col, $SCALE);
    for ($y = $y0; $y < $y0 + $SCALE; $y++) {
        $grid = substr($grid, 0, ($y * $W + $x0) * 3) . $rowPx . substr($grid, ($y * $W + $x0 + $SCALE) * 3);
    }
};
foreach ($M as $r => $row) foreach ($row as $c => $v) $dot($r, $c, $v === true);

$chunk = function (string $type, string $d) {
    $c = $type . $d;
    return pack('N', strlen($d)) . $c . pack('N', crc32($c));
};
$raw = '';
for ($y = 0; $y < $W; $y++) $raw .= "\x00" . substr($grid, $y * $W * 3, $W * 3);
$png = "\x89PNG\r\n\x1a\n";
$png .= $chunk('IHDR', pack('N2C5', $W, $W, 8, 2, 0, 0, 0));
$png .= $chunk('IDAT', gzcompress($raw, 9));
$png .= $chunk('IEND', '');

file_put_contents($OUT, $png);
echo "OK: {$OUT} (" . strlen($png) . " bytes, {$W}x{$W}px, mask={$bestMask}, penalty={$bestPenalty}, self-check " . strlen($decoded) . " byte OK)\n";
