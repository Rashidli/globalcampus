<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function education_level() : BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
