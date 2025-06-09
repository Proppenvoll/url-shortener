<?php

use App\Models\Url;

test('serves root', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('redirects after short code generation', function () {
    $response = $this->post('/', [
        'url' => 'a.com',
    ]);
    $response->assertStatus(303);
});

test('redirects a shortened url', function () {
    $url = Url::create([
        'original_url' => 'https://a.com',
        'short_code' => 'abcdef',
        'visit_count' => 0,
    ]);

    $response = $this->get("/{$url->short_code}");
    $response->assertStatus(307);
    $response->assertRedirect($url->original_url);
});
