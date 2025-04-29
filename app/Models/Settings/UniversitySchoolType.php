<?php

namespace App\Models\Settings;

use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversitySchoolType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function university_education_level(): BelongsTo
    {
        return $this->belongsTo(UniversityEducationLevel::class);
    }

    public function universities(): HasMany
    {
        return $this->hasMany(University::class);
    }
}
