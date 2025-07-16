<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCase extends Model
{
    protected $fillable = [
        'name',
        'sub_name',
        'url',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function casePhotos(): HasMany
    {
        return $this->hasMany(CasePhoto::class);
    }
} 