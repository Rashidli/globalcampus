<?php

namespace App\Models\Settings;

use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolType extends Model
{

    use SoftDeletes;
    protected $guarded = [];


    public function education_level() : BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function universities() : HasMany
    {
        return $this->hasMany(University::class);
    }





}
