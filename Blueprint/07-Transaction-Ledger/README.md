# 🌊 The Money Flow (Transaction Ledger)

**"Ocean -> River -> Filtration -> People's Mouth"**

## Core Concept
This module is the backbone of the New Nepal project. It ensures that every transaction is:
1.  **Traceable:** We can see the origin (National Treasury) and the destination (Vendor/Citizen).
2.  **Immutable:** Once spent, the record cannot be altered.
3.  **Public:** Available for citizen audit in real-time.

## Technical Requirements
- **Ledger Type:** Hybrid (Public Read / Permissioned Write for Gov, with Citizen Witness Nodes).
- **Smart Contracts:** Automated release of funds upon verification (e.g., "Road 50% complete" -> "Payment released").
- **Integration:** Must hook into Banks, Wallets (eSewa/Khalti), and Central Treasury.

## To-Do
- [ ] Define data schema for a "Public Rupee".
- [ ] Design the "Filtration" logic (Fraud detection).
