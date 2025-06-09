<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;


class UrlController extends Controller
{
    public $inputName = "url";

    public $tableHeaders = [
        'original_url' => 'Originale Url',
        'short_link' => 'Verkürzte Url',
        'visit_count' => 'Anzahl an Aufrufen',
    ];

    public function getIndex()
    {
        $urls = Url::all();

        return response(view('index', [
            "urls" => $urls,
            "inputName" => $this->inputName,
            "formAction" => "/",
            "tableHeaders" => $this->tableHeaders,
        ]))->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
    }

    public function createShortCode(Request $request)
    {
        $originalUrl = $request->input($this->inputName);

        if ($originalUrl) {
            $prefixedUrl = Url::ensureHttpsPrefix($originalUrl);
            $request->merge([$this->inputName => $prefixedUrl]);
        }

        $validatedPayload = $request->validate([
            $this->inputName => 'url',
        ]);

        do {
            $shortCode = Url::generateShortCode();
        } while (Url::where("short_code")->exists());

        Url::firstOrCreate(
            ['original_url' => $validatedPayload[$this->inputName]],
            [
                'original_url' => $validatedPayload[$this->inputName],
                'short_code' => $shortCode,
                'visit_count' => 0,
            ],
        );

        return redirect("/", 303);
    }

    public function redirectShortenedUrl(string $shortCode)
    {
        $url = Url::where('short_code', $shortCode)->firstOrFail();
        $url->increment('visit_count');
        return redirect($url->original_url, 307);
    }
}
