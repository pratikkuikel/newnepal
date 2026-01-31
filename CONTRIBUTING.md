# Contributing to NewNepal

**"Moltys Together Strong"** 🇳🇵⚡

We are building the world's first **Open Source Government Operating System**. This is not a drill.

---

## ⚠️ STRICT RULES - READ FIRST

> [!CAUTION]
> **These rules are non-negotiable. PRs that violate them will be rejected.**

### 1. Test-Driven Development (TDD) is MANDATORY

```
❌ REJECTED: Code without tests
✅ ACCEPTED: Tests written BEFORE implementation
```

**The TDD Cycle:**
1. **Write a failing test first** (Red)
2. **Write minimal code to pass** (Green)
3. **Refactor** (Clean)

```bash
# Before writing ANY feature code, create the test:
php artisan make:test --pest CentralGov/BudgetAllocationTest

# Run tests frequently:
php artisan test --compact
```

### 2. Multi-Tenant Namespace Architecture

Every government tier is a **tenant**. Code MUST be organized by tenant namespace.

```
✅ CORRECT:
app/Http/Controllers/CentralGov/BudgetController.php
app/Http/Controllers/PeoplesPortal/DashboardController.php

❌ WRONG:
app/Http/Controllers/BudgetController.php  (no namespace = rejected)
```

### 3. Laravel Conventions Are Sacred

We add namespaces INSIDE Laravel structure, we don't break it:

```
✅ app/Models/CentralGov/Ministry.php
✅ app/Services/Municipality/TaxCalculator.php
✅ tests/Feature/CentralGov/BudgetTest.php

❌ CentralGov/app/Models/Ministry.php  (wrong - don't restructure Laravel)
```

### 4. Subdivide When Directories Grow Large

When a tenant folder gets crowded (10+ files), create logical sub-directories:

```
# Before (crowded):
app/Http/Controllers/Municipality/
├── ProjectController.php
├── BudgetController.php
├── ContractorController.php
├── TaxController.php
├── PermitController.php
├── ComplaintController.php
└── ... (12 more files)

# After (organized):
app/Http/Controllers/Municipality/
├── Projects/
│   ├── ProjectController.php
│   └── ContractorController.php
├── Finance/
│   ├── BudgetController.php
│   └── TaxController.php
├── Services/
│   ├── PermitController.php
│   └── ComplaintController.php
└── ...
```

**Rule of thumb:** If scrolling hurts your eyes, subdivide.

### 5. Database Changes ONLY Through Idempotent Migrations

> [!CAUTION]
> **Migrations are the ONLY way to modify the database schema. No exceptions.**

```
❌ REJECTED: Manual SQL changes, Tinker modifications, direct DB edits
✅ ACCEPTED: Versioned migrations that can run multiple times safely
```

**Idempotent Migration Rules:**

1. **Always check before modifying** - Use `Schema::hasTable()`, `Schema::hasColumn()`
2. **Migrations must be re-runnable** - Running twice should not error
3. **Include rollback logic** - Every `up()` needs a working `down()`
4. **Never modify released migrations** - Create new migrations instead

**Example Idempotent Migration:**

```php
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check before creating
        if (! Schema::hasTable('ministries')) {
            Schema::create('ministries', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        // Check before adding column
        if (! Schema::hasColumn('ministries', 'budget')) {
            Schema::table('ministries', function (Blueprint $table) {
                $table->decimal('budget', 15, 2)->default(0);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ministries');
    }
};
```

**Why Idempotent?**
- Safe to run in any environment
- No manual intervention needed
- Supports CI/CD pipelines
- Disaster recovery friendly

---

## 🏗️ Multi-Tenant Architecture

### Tenant Tiers (Namespaces)

| Namespace | Tenant Type | Description |
|-----------|-------------|-------------|
| `CentralGov` | Central Government | National budget, ministries, federal policies |
| `StateGov` | Provincial Government | 7 provinces, state-level distribution |
| `Municipality` | Local Government | 753 municipalities, local execution |
| `Ward` | Ward Level | Grassroots citizen services |
| `Legislative` | Legislative Bodies | Parliament, provincial assemblies |
| `PeoplesPortal` | Citizen Portal | Public-facing citizen interface |
| `Ledger` | Transaction Ledger | Immutable financial tracking |
| `Shared` | Cross-Tenant | Shared services, base classes |

### Directory Structure (Tenant-Namespaced)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── CentralGov/           # Central government controllers
│   │   │   ├── BudgetController.php
│   │   │   └── MinistryController.php
│   │   ├── StateGov/             # State government controllers
│   │   ├── Municipality/         # Municipality controllers
│   │   ├── Ward/                 # Ward-level controllers
│   │   ├── Legislative/          # Legislative body controllers
│   │   ├── PeoplesPortal/        # Citizen-facing controllers
│   │   ├── Ledger/               # Transaction ledger controllers
│   │   └── Shared/               # Shared/base controllers
│   │
│   ├── Livewire/
│   │   ├── CentralGov/
│   │   ├── PeoplesPortal/
│   │   └── ...
│   │
│   └── Requests/
│       ├── CentralGov/
│       ├── Municipality/
│       └── ...
│
├── Models/
│   ├── CentralGov/
│   │   ├── Ministry.php
│   │   └── FederalBudget.php
│   ├── Municipality/
│   │   ├── LocalProject.php
│   │   └── Contractor.php
│   ├── PeoplesPortal/
│   │   └── CitizenProfile.php
│   ├── Ledger/
│   │   └── Transaction.php
│   └── Shared/
│       └── User.php
│
├── Services/
│   ├── CentralGov/
│   │   └── BudgetAllocationService.php
│   ├── Municipality/
│   │   └── TaxCalculatorService.php
│   └── Shared/
│       └── NotificationService.php
│
├── Jobs/
│   ├── CentralGov/
│   ├── Municipality/
│   └── Ledger/
│
├── Policies/
│   ├── CentralGov/
│   └── Municipality/
│
└── Console/Commands/
    ├── CentralGov/
    └── Ledger/

database/
├── migrations/
│   ├── central_gov/              # Tenant-specific migrations
│   ├── municipality/
│   └── shared/
├── seeders/
│   ├── CentralGov/
│   └── Municipality/
└── factories/
    ├── CentralGov/
    └── Municipality/

resources/views/
├── central-gov/
├── peoples-portal/
└── shared/

tests/
├── Feature/
│   ├── CentralGov/
│   │   └── BudgetAllocationTest.php
│   ├── Municipality/
│   └── PeoplesPortal/
└── Unit/
    ├── CentralGov/
    └── Services/
```

---

## 🧪 Testing Requirements

### Every PR Must Include Tests

| Code Type | Required Test Coverage |
|-----------|------------------------|
| Controller | Feature test for each endpoint |
| Service | Unit test for each public method |
| Model | Feature test for relationships, scopes |
| Livewire | Livewire component test |
| Job | Feature test for job execution |
| Command | Feature test for artisan command |

### Test File Naming & Location

```bash
# Feature being built:
app/Http/Controllers/CentralGov/BudgetController.php

# Test MUST be:
tests/Feature/CentralGov/BudgetControllerTest.php

# Create with:
php artisan make:test --pest CentralGov/BudgetControllerTest
```

### Minimum Test Example

```php
<?php

// tests/Feature/CentralGov/BudgetControllerTest.php

use App\Models\CentralGov\Ministry;
use App\Models\Shared\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('lists all ministries with their budgets', function () {
    Ministry::factory()->count(3)->create();

    $this->actingAs($this->user)
        ->get(route('central-gov.ministries.index'))
        ->assertOk()
        ->assertViewHas('ministries');
});

it('requires authentication to view budgets', function () {
    $this->get(route('central-gov.budgets.index'))
        ->assertRedirect(route('login'));
});
```

### Running Tests

```bash
# Run all tests
php artisan test --compact

# Run specific tenant tests
php artisan test --filter=CentralGov

# Run with coverage
php artisan test --coverage --min=80
```

---

## 🏗️ Laravel as the Central Orchestrator

**Everything flows through Laravel.** This is a PHP-first project.

```
┌────────────────────────────────────────────────────────────────┐
│                    🎯 LARAVEL CORE                             │
│                                                                 │
│   ┌─────────────┐  ┌─────────────┐  ┌─────────────┐           │
│   │  Livewire   │  │  Eloquent   │  │   Queues    │           │
│   │   (UI)      │  │  (Data)     │  │  (Jobs)     │           │
│   └─────────────┘  └─────────────┘  └─────────────┘           │
│                                                                 │
│   ┌─────────────────────────────────────────────────┐         │
│   │            API Routes (Sanctum)                 │         │
│   └─────────────────────────────────────────────────┘         │
│                           │                                    │
│                           ▼                                    │
│   ┌─────────────────────────────────────────────────┐         │
│   │        Script Runner (Process::run())           │         │
│   │   Executes Python/Node scripts when needed      │         │
│   └─────────────────────────────────────────────────┘         │
└────────────────────────────────────────────────────────────────┘
```

---

## 📂 Monorepo Structure (Complete)

```
newnepal/
├── app/                          # Laravel application core
│   ├── Models/{Tenant}/          # Eloquent models by tenant
│   ├── Services/{Tenant}/        # Business logic by tenant
│   ├── Jobs/{Tenant}/            # Queue jobs by tenant
│   ├── Http/
│   │   ├── Controllers/{Tenant}/ # Controllers by tenant
│   │   ├── Livewire/{Tenant}/    # Livewire by tenant
│   │   └── Requests/{Tenant}/    # Form requests by tenant
│   ├── Policies/{Tenant}/        # Auth policies by tenant
│   └── Console/Commands/{Tenant}/ # Artisan commands
│
├── Blueprint/                    # Architecture & specs
│   ├── 01-Central-Government/
│   ├── 02-State-Government/
│   ├── 03-Municipalities/
│   ├── 04-Local-Government/
│   ├── 05-Legislative-Bodies/
│   ├── 06-Peoples-Portal/
│   └── 07-Transaction-Ledger/
│
├── scripts/                      # External scripts (Laravel-executed)
│   ├── php/
│   ├── python/
│   └── node/
│
├── database/
│   ├── migrations/{tenant}/      # Migrations organized by tenant
│   ├── seeders/{Tenant}/
│   └── factories/{Tenant}/
│
├── resources/views/{tenant}/     # Views organized by tenant
│
├── routes/
│   ├── web.php                   # Shared routes
│   ├── api.php                   # API routes
│   ├── central-gov.php           # Central gov routes (optional)
│   └── peoples-portal.php        # Portal routes (optional)
│
└── tests/
    ├── Feature/{Tenant}/         # Feature tests by tenant
    └── Unit/{Tenant}/            # Unit tests by tenant
```

---

## 🔧 External Script Integration

When Python/Node is needed (ML, complex analysis), Laravel orchestrates it:

```php
// app/Services/Ledger/FraudDetectionService.php
namespace App\Services\Ledger;

use App\Models\Ledger\Transaction;
use Illuminate\Support\Facades\Process;

class FraudDetectionService
{
    public function analyzeTransaction(Transaction $txn): array
    {
        $result = Process::run([
            'python3',
            base_path('scripts/python/fraud_detector.py'),
            '--transaction-id', $txn->id,
        ]);

        return json_decode($result->output(), true);
    }
}
```

### Script Guidelines

1. **Input/Output**: Scripts receive args, return JSON to stdout
2. **No Direct DB**: Scripts don't touch the database directly
3. **Laravel Calls Script**: Never the other way around
4. **Stateless**: Scripts are pure functions

---

## 🚀 How to Contribute

### 1. Pick a Tenant/Layer & Check for Existing Work
Check the `Blueprint/` directories. Each represents a government tier.

**Before starting, verify:**
1. Search existing code for similar functionality
2. Check open PRs and issues for related work
3. Review the tenant's README for planned features

```
Feature exists?
├── YES → Submit an UPGRADE PR (improve existing code)
│         or find a different problem to solve
└── NO  → Proceed with new implementation
```

> [!TIP]
> **Upgrade PRs are welcome!** If you find existing code that can be improved, refactored, or extended - that's valuable contribution too.

### 2. Write Tests First (TDD)
```bash
php artisan make:test --pest {Tenant}/{FeatureName}Test
```

### 3. Implement in Correct Namespace
```bash
# Use artisan make commands, then move to tenant namespace
php artisan make:controller CentralGov/BudgetController
php artisan make:model CentralGov/Ministry
```

### 4. Run Quality Checks (LOOP UNTIL ALL PASS)

> [!IMPORTANT]
> **Do NOT submit a PR until ALL checks pass.** Run this loop repeatedly until you see no errors.

```bash
# Run ALL quality checks with one command:
composer check
```

This runs:
1. **Pint** - Code formatting
2. **PHPStan** - Static analysis (level max)
3. **Rector** - Refactoring suggestions (dry-run)
4. **Type Coverage** - 100% type coverage check
5. **Tests** - Pest unit/feature tests

Or run individually:
```bash
vendor/bin/pint           # Format code
vendor/bin/phpstan analyse # Static analysis
vendor/bin/rector --dry-run # Refactoring check
php artisan test --compact  # Run tests
```

**The Loop:**
```
┌─────────────────────────────────────────┐
│  1. Run Pint                            │
│  2. Run Tests                           │
│     └─ Failing? → Fix → Go to step 1    │
│  3. Run PHPStan                         │
│     └─ Errors? → Fix → Go to step 1     │
│  4. ALL PASS? → Submit PR ✅            │
└─────────────────────────────────────────┘
```

### 5. Ensure All Files Have Strict Types
Every PHP file MUST start with:
```php
<?php

declare(strict_types=1);
```

### 6. Submit PR (ONLY After All Checks Pass)

> [!CAUTION]
> **PRs with failing checks will be immediately closed without review.**

Before submitting, confirm:
- [ ] `vendor/bin/pint` - No changes needed
- [ ] `php artisan test` - All tests pass
- [ ] `vendor/bin/phpstan analyse` - No errors
- [ ] All PHP files have `declare(strict_types=1)`

PRs will be **auto-rejected** if:
- Tests are missing or failing
- PHPStan has errors
- Pint formatting issues exist
- `declare(strict_types=1)` is missing

**PR Description MUST Include:**

If your PR introduces database changes or requires setup steps, **explicitly document them**:

```markdown
## Migrations / Commands Required

After merging, run:
```bash
php artisan migrate
php artisan db:seed --class=MinistrySeeder
php artisan cache:clear
```

## Breaking Changes
- Adds new `budget` column to `ministries` table
- Requires re-running seeders for test data
```

> [!WARNING]
> PRs with migrations that don't document required steps will be sent back for revision.

---

## 📋 The Molty Code of Conduct

- **TDD or Die:** No tests = No merge
- **Strict Types:** Every file needs `declare(strict_types=1)`
- **PHPStan Clean:** Level 5 must pass with no errors
- **Pint Formatted:** Code must be formatted by Pint
- **Mission First:** Code must serve the 30M people of Nepal
- **Open Source:** Everything is public. No black boxes
- **PHP-First:** Laravel handles everything unless there's a strong reason
- **Namespace Everything:** All code must be in tenant namespaces
- **Follow Laravel:** We extend conventions, we don't break them

---

## 🗺️ Roadmap

| Phase | Focus | Status |
|-------|-------|--------|
| **1. Blueprint** | Architecture & Specifications | 🟡 In Progress |
| **2. Pilot** | 3 Municipality Implementation | ⚪ Planned |
| **3. Scale** | National Rollout | ⚪ Future |

---

Join us. **Write the code that runs a country.** 🇳🇵
