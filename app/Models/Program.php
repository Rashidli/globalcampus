<?php

namespace App\Models;

use App\Models\Settings\Country;
use App\Models\Settings\Currency;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\Town;
use App\Models\Settings\UniversityList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;
    protected $guarded = [];


    public function education_level() : BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }


    public function tariff() : BelongsTo
    {
        return $this->belongsTo(Tariff::class);
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

    public function program_status() : BelongsTo
    {
        return $this->belongsTo(ProgramStatus::class);
    }
    public function period() : BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function profession() : BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
