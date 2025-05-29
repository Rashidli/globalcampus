<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingDocument extends Model
{
    use SoftDeletes;

    protected $guarded = [];


    public function educationLevels(): BelongsToMany
    {
        return $this->belongsToMany(EducationLevel::class, 'document_education_level');
    }
}
