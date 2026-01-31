<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it('returns a successful response for the homepage', function () {
    get('/')->assertOk();
});

it('can access the filament admin login page', function () {
    get('/admin/login')->assertOk();
});
