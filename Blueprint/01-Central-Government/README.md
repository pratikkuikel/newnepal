# 🏛️ Central Government

The apex layer of the New Nepal system. This module handles:

## Scope

- **National Budget Allocation**: Distribution of funds across ministries and state governments
- **Ministry Portfolios**: Each ministry's tracked expenditure and project allocations
- **National Policy Engine**: Digital representation of national policies affecting fund flows
- **Inter-Ministry Fund Transfers**: Tracking movement of funds between ministries

## Key Entities

| Entity | Description |
|--------|-------------|
| `Ministry` | Central government ministry with budget allocation |
| `FiscalYear` | Budget year boundaries and allocations |
| `NationalProject` | Large-scale national infrastructure projects |
| `FundRelease` | Tracked release of funds to lower tiers |

## Data Flow

```
National Treasury → Ministry → State/Province → Municipality → Citizen
```

## Status

🔴 **Not Started** - Awaiting initial schema design and requirements gathering.
