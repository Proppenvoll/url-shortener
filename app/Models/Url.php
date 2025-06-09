<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    public static function generateShortCode()
    {
        return Str::random(6);
    }

    public static function ensureHttpsPrefix(string $text)
    {
        return preg_match("/^https?:\/\//", $text) ? $text : 'https://' . $text;
    }

    protected $primaryKey = 'url_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'original_url',
        'short_code',
        'visit_count',
    ];

    protected function shortCodeUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => url($this->short_code),
        );
    }
}
