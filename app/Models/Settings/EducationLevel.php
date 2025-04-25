<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EducationLevel extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    public function school_types() : HasMany
    {
        return $this->hasMany(SchoolType::class);
    }

    public function setting_documents() : HasMany
    {
        return $this->hasMany(SettingDocument::class);
    }

}
