<?php

declare(strict_types=1);

it('asserts that true is true', function (): void {
    expect(true)->toBeTrue();
});

it('can perform basic arithmetic', function (): void {
    expect(1 + 1)->toBe(2);
});
