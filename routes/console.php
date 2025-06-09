<?php

use App\Models\DefaultUrl;
use App\Models\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;


Schedule::call(function () {
    DB::table('urls')->truncate();

    foreach (DefaultUrl::all() as $defaultUrl) {
        $prefixedDefaultUrl = Url::ensureHttpsPrefix($defaultUrl->default_url);

        Url::create([
            'original_url' => $prefixedDefaultUrl,
            'short_code' => Url::generateShortCode(),
            'visit_count' => random_int(30, 50),
        ]);
    }
})->name("Reset urls")->daily();
