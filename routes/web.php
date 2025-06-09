<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::controller(UrlController::class)->group(function () {
    Route::get("/", "getIndex");
    Route::post("/", 'createShortCode');
    Route::get("/{shortCode}", "redirectShortenedUrl");
});
