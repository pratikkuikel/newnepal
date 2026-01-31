<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it('returns a successful response for the homepage', function (): void {
    get('/')->assertOk();
});

it('can access the filament admin login page', function (): void {
    get('/admin/login')->assertOk();
});
