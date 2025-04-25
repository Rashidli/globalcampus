<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamLanguage extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function exams() : HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
