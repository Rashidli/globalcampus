<?php

namespace App\Models\Settings;

use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStatus extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'program_program_status')
            ->withPivot('file_path', 'note')
            ->withTimestamps();
    }
}
