<?php

namespace App\Models;

use App\Models\Settings\Country;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use App\Models\Settings\UniversityList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{

    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function university_list() : BelongsTo
    {
        return $this->belongsTo(UniversityList::class);
    }

    public function country() : BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function profession() : BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function education_level() : BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

}
