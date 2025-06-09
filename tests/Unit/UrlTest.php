<?php

use App\Models\Url;

test('ensureHttpsPrefix', function() {
    expect(Url::ensureHttpsPrefix(''))->toBe('https://');
    expect(Url::ensureHttpsPrefix('a.com'))->toBe('https://a.com');
    expect(Url::ensureHttpsPrefix('http://a.com'))->toBe('http://a.com');
    expect(Url::ensureHttpsPrefix('https://a.com'))->toBe('https://a.com');
});

test('generateShortCode', function() {
    expect(Url::generateShortCode())->toBeString();
    expect(Url::generateShortCode())->toHaveLength(6);
});
