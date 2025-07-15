<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CasePhoto extends Model
{
    protected $fillable = [
        'project_case_id',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function projectCase(): BelongsTo
    {
        return $this->belongsTo(ProjectCase::class);
    }
} 