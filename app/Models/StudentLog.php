<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StudentLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'old_data'     => 'array',
        'new_data'     => 'array',
        'changed_data' => 'array',
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
