<?php

declare(strict_types=1);

it('asserts that true is true', function () {
    expect(true)->toBeTrue();
});

it('can perform basic arithmetic', function () {
    expect(1 + 1)->toBe(2);
});
