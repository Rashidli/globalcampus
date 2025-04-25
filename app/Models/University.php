<?php

namespace App\Models;

use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use App\Models\Settings\SchoolType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class University extends Model
{

    protected $guarded = [];

    public function school_type() : BelongsTo
    {
        return $this->belongsTo(SchoolType::class);
    }

    public function education_level() : BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function education_language() : BelongsTo
    {
        return $this->belongsTo(EducationLanguage::class);
    }

    public function profession() : BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

}
