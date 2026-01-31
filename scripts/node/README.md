# Node.js Scripts

Scripts in this directory are **executed by Laravel**, not run independently.

> ⚠️ **Use sparingly.** Only when Node is genuinely the best tool (e.g., specific npm packages with no PHP/Python alternative).

## Guidelines

1. **Receive input via command-line arguments**
2. **Return JSON to stdout** - Laravel captures this
3. **Never access database directly** - Laravel handles all data
4. **Be stateless** - pure functions, no side effects

## Example Script

```javascript
#!/usr/bin/env node
/**
 * Example Node utility - called by Laravel
 */
const args = process.argv.slice(2);
const inputArg = args.find(a => a.startsWith('--data='));
const data = inputArg ? inputArg.split('=')[1] : null;

const result = {
    processed: true,
    input: data,
    timestamp: new Date().toISOString()
};

console.log(JSON.stringify(result));
process.exit(0);
```

## How Laravel Calls This

```php
use Illuminate\Support\Facades\Process;

$result = Process::run([
    'node',
    base_path('scripts/node/utility.js'),
    '--data=' . $inputData,
]);

$data = json_decode($result->output(), true);
```

## Dependencies

If your script needs npm packages, add them to `package.json` in this directory (separate from root).
