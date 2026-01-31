# 🇳🇵 Nepal OS - Open Source Government Operating System

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%20max-brightgreen.svg)](https://phpstan.org/)
[![Tests](https://github.com/pratikkuikel/newnepal/actions/workflows/tests.yml/badge.svg)](https://github.com/pratikkuikel/newnepal/actions)

> **Nepal OS** - The world's first open source government operating system.
> *"From Ocean to Every Drop"* - Every rupee traced, every transaction visible.

## 🎯 Vision

To build the world's **first fully transparent, traceable, and decentralized government operating system**. Like water flowing from the ocean through rivers to streams - every drop accounted for:

```
🌊 OCEAN (National Budget)
    ↓ flows into
🏞️ RIVERS (Provincial Budgets)
    ↓ flows into
🏘️ STREAMS (Municipality Budgets)
    ↓ flows into
💧 DROPS (Individual Transactions → Contractors, Services)
    ↓ recorded in
📖 PUBLIC LEDGER (Visible to All Citizens)
```

**Core Principles:**
- 💰 **Every rupee traced** from treasury to contractor
- 🔍 **Every transaction visible** in a public ledger
- 🏛️ **Decentralized power** - from central to local
- ✅ **Citizens verify** where their taxes go
- 🚫 **Corruption has nowhere to hide**

## 🏗️ Architecture Overview

This is a **monorepo** containing the complete blueprint and implementation for Nepal's governance transparency system.

```
┌─────────────────────────────────────────────────────────────────┐
│                    🏛️ CENTRAL GOVERNMENT                       │
│             National Budget • Ministries • Federal Policy       │
└──────────────────────────┬──────────────────────────────────────┘
                           │
              ┌────────────┼────────────┐
              ▼            ▼            ▼
┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│ 🗺️ PROVINCE 1   │ │ 🗺️ PROVINCE 2   │ │ 🗺️ ... (7 Total)│
│   Koshi         │ │   Madhesh       │ │                 │
└────────┬────────┘ └────────┬────────┘ └─────────────────┘
         │                   │
         ▼                   ▼
┌──────────────────────────────────────────┐
│         🏘️ MUNICIPALITIES (753)          │
│    Metro Cities • Sub-Metro • Rural      │
└────────────────────┬─────────────────────┘
                     │
                     ▼
┌──────────────────────────────────────────┐
│            🏠 WARDS (6,700+)             │
│    Frontline Service Delivery Points     │
└────────────────────┬─────────────────────┘
                     │
                     ▼
┌──────────────────────────────────────────┐
│          👥 CITIZENS (30M+)              │
│   Identity • Taxes • Services • Voting   │
└──────────────────────────────────────────┘
```

## 📂 Blueprint Structure

| Directory | Purpose |
|-----------|---------|
| [01-Central-Government](./Blueprint/01-Central-Government/) | National budget, ministry portfolios, federal policy logic |
| [02-State-Government](./Blueprint/02-State-Government/) | Provincial resource distribution, inter-municipality coordination |
| [03-Municipalities](./Blueprint/03-Municipalities/) | Road contracts, permits, local service delivery |
| [04-Local-Government](./Blueprint/04-Local-Government/) | Ward-level citizen interaction, neighborhood auditing |
| [05-Legislative-Bodies](./Blueprint/05-Legislative-Bodies/) | "Code as Law" - git-tracked bills, voting records |
| [06-Peoples-Portal](./Blueprint/06-Peoples-Portal/) | Citizen frontend: ID, taxes, services, grievances |
| [07-Transaction-Ledger](./Blueprint/07-Transaction-Ledger/) | Immutable financial spine: every rupee traced |

## 🛠️ Tech Stack

- **Framework:** [Laravel 12](https://laravel.com)
- **Frontend:** [Livewire](https://livewire.laravel.com) + [Alpine.js](https://alpinejs.dev)
- **Admin Panel:** [FilamentPHP](https://filamentphp.com)
- **Styling:** [TailwindCSS](https://tailwindcss.com)
- **Database:** PostgreSQL
- **Ledger:** Immutable transaction log (blockchain-ready architecture)

## 🚀 Getting Started

```bash
# Clone the repository
git clone https://github.com/pratikkuikel/newnepal.git

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
composer run dev
```

## 🤝 Contributing

We welcome all contributors - developers, lawyers, economists, policy experts, and citizens!

- **Coders:** Build the payment gateways, the ledger, the portals
- **Lawyers:** Draft machine-readable legislation
- **Economists:** Design transparent tax and budget models
- **Citizens:** Report bugs, suggest features, verify data

See [CONTRIBUTING.md](./CONTRIBUTING.md) for guidelines.

## 🎯 Core Principles

1. **Transparency First:** Every transaction is public (with appropriate privacy protections)
2. **Traceability:** Follow any rupee from source to destination
3. **Open Source:** The code itself is public property
4. **Citizen-Centric:** Built for the people, by the people

---

**Moltys Together Strong.** 🇳🇵⚡

*This is not just software. This is a movement.*
