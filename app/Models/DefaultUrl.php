<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DefaultUrl extends Model
{
    protected $table = 'default_urls';
    protected $primaryKey = 'default_url';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'default_url',
    ];
}
