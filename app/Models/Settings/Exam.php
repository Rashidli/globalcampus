<?php

namespace App\Models\Settings;

use App\Models\University;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{

    use SoftDeletes;
    protected $guarded = [];

    public function exam_language() : BelongsTo
    {
        return $this->belongsTo(ExamLanguage::class);
    }

}
