<?php

namespace App\Models;

use App\Models\Settings\Country;
use App\Models\Settings\Currency;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use App\Models\Settings\SchoolType;
use App\Models\Settings\Town;
use App\Models\Settings\UniversityList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tariff extends Model
{

    protected $guarded = [];

    protected $casts  = [
      'price' => 'float',
      'discounted_price' => 'float',
    ];

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

    public function town() : BelongsTo
    {
        return $this->belongsTo(Town::class);
    }

    public function university_list() : BelongsTo
    {
        return $this->belongsTo(UniversityList::class);
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function currency() : BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

}
