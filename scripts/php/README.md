# PHP Scripts

Standalone PHP utilities that can be called via `php artisan` or `Process::run()`.

## Guidelines

1. **Prefer Artisan Commands** - For anything that needs Laravel context, create a command in `app/Console/Commands/`
2. **Pure PHP only** - Scripts here should not require Laravel bootstrap
3. **Return JSON to stdout** when called externally

## When to Use This Directory

- Data transformation utilities
- File processing scripts
- CLI tools that don't need Eloquent

## When to Use Artisan Commands Instead

- Anything needing database access
- Jobs that should be queued
- Scheduled tasks

```php
// Better: app/Console/Commands/ProcessDataCommand.php
class ProcessDataCommand extends Command
{
    protected $signature = 'data:process {file}';
    
    public function handle()
    {
        // Has full Laravel access
    }
}
```
