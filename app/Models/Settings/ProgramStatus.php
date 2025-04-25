<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramStatus extends Model
{
    use SoftDeletes;
    protected $guarded = [];
}
