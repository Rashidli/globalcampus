<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityEducationLevel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function university_school_types(): HasMany
    {
        return $this->hasMany(UniversitySchoolType::class);
    }
}
