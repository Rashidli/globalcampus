<?php

namespace App\Models\Settings;

use App\Models\Tariff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniversityList extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function tariffs() : HasMany
    {
        return $this->hasMany(Tariff::class);
    }
}
