# Python Scripts

Scripts in this directory are **executed by Laravel**, not run independently.

## Guidelines

1. **Receive input via command-line arguments**
2. **Return JSON to stdout** - Laravel captures this
3. **Never access database directly** - Laravel handles all data
4. **Be stateless** - pure functions, no side effects

## Example Script

```python
#!/usr/bin/env python3
"""
Fraud detection analyzer - called by Laravel FraudDetectionService
"""
import argparse
import json
import sys

def analyze(transaction_id: str) -> dict:
    # Your ML/analysis logic here
    return {
        "transaction_id": transaction_id,
        "fraud_score": 0.15,
        "flags": []
    }

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument("--transaction-id", required=True)
    args = parser.parse_args()
    
    result = analyze(args.transaction_id)
    print(json.dumps(result))
    sys.exit(0)
```

## How Laravel Calls This

```php
use Illuminate\Support\Facades\Process;

$result = Process::run([
    'python3',
    base_path('scripts/python/fraud_detector.py'),
    '--transaction-id', $transactionId,
]);

$data = json_decode($result->output(), true);
```

## Dependencies

If your script needs Python packages, add them to `requirements.txt` in this directory.
