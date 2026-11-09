# AGENTS.md - Production Deployment Rules

## Purpose
This repository is deployed to an on-premises Proxmox environment through Coolify. Treat production as a controlled environment. Source changes may be automated; infrastructure and destructive production changes require explicit human approval.

## Mandatory Codex guardrails for Inventra

These instructions apply to Inventra even when GitHub branch protection is unavailable.
They are agent instructions, not server-enforced protection and cannot stop human or other-client pushes.

- Before edits or Git writes, inspect repository root, current branch, working tree,
  remote destination and intended PR base. Preserve unrelated user changes; stage explicit paths.
- Work only on feature/* based on develop, or continue an existing open feature PR.
  Never commit/push directly to main or develop. Do not create/update those remote refs
  through APIs as a workaround. The completed initial develop bootstrap is not a recurring exception.
- Never force-push (including --force-with-lease), rewrite published history, delete main/develop,
  use reset --hard/clean to discard work, or delete remote branches as unsolicited cleanup.
- A request to fix, commit, push, prepare deployment or follow the manual is not permission
  to merge, enable auto-merge, approve one's own PR, deploy, or bypass checks.
- Before any merge, require an explicit user instruction naming that PR. Verify its current
  head SHA, base/head branches, reviewed diff, absence of unresolved review concerns, and
  successful validate/lint checks on the current revision. Pending, missing, cancelled,
  skipped or failed checks are not success. If the revision changes, recheck before merging.
- Feature PRs target develop. A release PR targets main from develop and additionally
  requires documented staging/UAT results tied to the tested SHA, data isolation, reviewed
  migration/backup/rollback plans and explicit release approval. CI success alone is not UAT.
- Never disable lint/tests/security checks, mark failures successful, or weaken auth/TLS,
  repository visibility, access controls or these guardrails to get a change through.
- Do not enable production Auto Deploy while required branch protection/approval is unavailable.
  Codex does not deploy directly, SSH to production, or edit source on the VM.
- Do not read, print, copy or change production secrets; do not change infrastructure,
  DNS/firewall/Proxmox, backup policy, production data/volumes or destructive migrations.
  Use HUMAN ACTION REQUIRED with the eight-part Change Plan for those actions.
- If evidence or authorization for a consequential step is missing, stop that step, explain
  the exact missing requirement, and continue independent safe repository work. Do not
  invent test results, approval, production readiness or enforced branch protection.
- Finish by reporting commit/PR, checks actually run, pending checks and human actions.
  Removing or relaxing these rules requires a separate explicit user request and visible review.

## Infrastructure baseline
- Hypervisor: Proxmox VE (on-premises office)
- Deployment VM: Ubuntu Server LTS
- Platform: Coolify with integrated Traefik proxy
- Public ingress: one public IPv4, TCP 80/443 only
- Routing: hostname/subdomain -> Coolify proxy -> application container
- Production secrets: stored outside Git, normally in Coolify environment variables/secrets
- Databases: private network only; do not publish PostgreSQL/Redis ports to the internet

## Mandatory behavior for Codex
1. Inspect the repository before choosing a build/deployment strategy. Do not infer the stack from the repository name.
2. Prefer reproducible container deployment. Add or maintain a Dockerfile when appropriate.
3. The application must listen on `0.0.0.0` and a documented internal port.
4. Configuration must come from environment variables. Maintain `.env.example` with names only, never real secrets.
5. Never commit passwords, tokens, private keys, database credentials, SMTP credentials, or production connection strings.
6. Provide a lightweight health endpoint (`/health` or equivalent) that does not expose sensitive information.
7. Log to stdout/stderr. Do not require interactive terminal input at runtime.
8. Persistent application data must use an explicit volume or approved external storage; do not rely on the ephemeral container filesystem.
9. Do not publish container ports to the host unless there is a documented non-HTTP requirement. Normal web traffic must go through the Coolify proxy.
10. Database services must stay private. Never add `ports: - "5432:5432"` or equivalent for production without explicit approval.
11. Keep staging and production configuration/data separate.
12. Every production change must be traceable to a Git commit.

## Production changes that require human approval
Do not execute or silently automate any of the following:
- Proxmox host configuration changes
- Firewall/router/NAT changes
- Public DNS changes
- Opening a new public port
- Direct modification of production secrets
- Database deletion, volume deletion, or data reset
- Destructive/irreversible database migration
- Commands that intentionally cause production downtime
- Changes to backup/retention policy
- Disabling authentication, TLS, security checks, or access controls to make a deployment pass

When one of these is required, produce a **Change Plan** instead of executing it. The plan must contain:
1. objective;
2. exact infrastructure change;
3. network/port impact;
4. data and downtime risk;
5. backup prerequisite;
6. implementation steps;
7. verification steps;
8. rollback procedure.

## Deployment contract
Before considering a project deployable, verify:
- build succeeds;
- runtime command is deterministic;
- internal listen port is documented;
- app listens on `0.0.0.0`;
- `.env.example` is current;
- no secrets are present in source changes;
- health endpoint works;
- migrations are reviewed;
- persistent paths are declared;
- logs do not print secrets;
- README documents local run and production container run.

## Branch workflow
Default recommendation:
- feature branch -> pull request -> tests/review
- `develop` -> staging (if configured)
- `main` -> production

Do not bypass review for infrastructure-sensitive changes.

## Docker/Compose rules
- Prefer multi-stage builds where useful.
- Use pinned major/runtime versions rather than floating `latest` for critical components.
- Run as non-root where practical.
- Use `.dockerignore`.
- Do not bake `.env` or secrets into images.
- In Compose, use internal service names for dependencies.
- Use `expose`/internal networking for web/database dependencies unless a host port is genuinely required.
- Add healthchecks where they improve safe startup/deployment.

## Database migration rules
- Prefer backward-compatible, additive migrations.
- Separate schema migration from destructive cleanup.
- For destructive changes, stop and request approval with backup/rollback plan.
- Never assume a database rollback is possible unless a tested down migration or restore procedure exists.

## Rollback rules
For a failed release:
1. preserve logs/evidence;
2. identify last healthy commit/image;
3. redeploy the last healthy version;
4. verify health/auth/core transaction;
5. do not delete old volumes/images needed for recovery;
6. do not improvise a database rollback.

## Security rules
- Proxmox management (8006) is never a public application endpoint.
- Coolify direct management ports are not application endpoints.
- Web applications use HTTPS through the Coolify proxy.
- Never expose PostgreSQL, Redis, or admin/debug ports publicly by default.
- Do not put real production secrets in prompts, examples, logs, screenshots, or generated documentation.

## Required output for deployment-related Codex tasks
For a deployment task, return/update:
1. detected stack;
2. expected internal port;
3. build strategy;
4. files changed;
5. environment variable names required;
6. migration impact;
7. persistent storage requirements;
8. health check path;
9. Coolify configuration notes;
10. verification checklist;
11. rollback notes.

If anything requires infrastructure access or approval, clearly mark it as **HUMAN ACTION REQUIRED** and do not fabricate credentials, IPs, domains, or secrets.
