<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'sort',
        'is_active',
    ];

    protected $casts = [
        'sort' => 'integer',
        'is_active' => 'boolean',
    ];
}
