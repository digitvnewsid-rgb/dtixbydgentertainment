# AGENTS.md

Guidance for AI agents working in this repository.

## Project status

This repository is currently **greenfield**: it contains only `README.md` (project name: **dtixbydgentertainment**). There is no application source, dependency manifest, Docker/Compose config, or test suite yet. The GitHub description notes it was created with Cursor AI and is intended as an entertainment/ticketing product (`dtix` + `entertainment`), but that stack is not implemented in the tree.

When application code lands, re-read root manifests (`package.json`, `pnpm-lock.yaml`, `docker-compose.yml`, `.env.example`, etc.) and update the sections below.

## Cursor Cloud specific instructions

### Services

| Service | Status | Notes |
|---------|--------|--------|
| Web app / API | Not present | Nothing to start until code exists |
| Database / Redis | Not present | No `.env.example` or compose file yet |

### Toolchain on the Cloud VM

The VM already provides a usable baseline without repo-specific install steps:

- **Node.js** v22 (via environment)
- **npm** and **pnpm**
- **Python** 3.12
- **git**

Docker is **not** installed in this Cloud Agent VM by default. If the project later adds `docker-compose.yml`, either document host-only setup for humans or extend the environment Dockerfile (if the repo uses `.cursor/environment.json` with a Dockerfile).

### Lint / test / run

There are **no** lint, test, or dev scripts until manifests are added. Do not fail setup when those commands are missing; instead discover scripts from `package.json` / `Makefile` once they exist.

Typical commands after a Node app is scaffolded (examples only):

- Install: `npm install` or `pnpm install` (match the lockfile present)
- Dev: `npm run dev` or `pnpm dev`
- Lint: `npm run lint`
- Test: `npm test`

### Update script behavior

The VM startup update script is intentionally minimal and **conditional**: it installs dependencies only when the corresponding manifest exists (`package.json`, `pnpm-lock.yaml`, `requirements.txt`, etc.). No services are started during update.

### Gotchas

- Pushing only `README.md` means cloud agents cannot run an end-to-end product demo until application code is committed.
- Prefer the lockfile’s package manager (`package-lock.json` → npm, `pnpm-lock.yaml` → pnpm, `yarn.lock` → yarn).
