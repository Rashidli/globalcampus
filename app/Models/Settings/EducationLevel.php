<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mpdf\Tag\B;

class EducationLevel extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function school_types(): HasMany
    {
        return $this->hasMany(SchoolType::class);
    }

    public function settingDocuments(): BelongsToMany
    {
        return $this->belongsToMany(SettingDocument::class, 'document_education_level');
    }
}
