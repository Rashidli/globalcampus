<?php

namespace App\Http\Services;

use App\Models\StudentLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(
        string $eventType,
        $loggable,
        $student_id,
        ?array $oldData = null,
        ?array $newData = null,
        ?array $changedData = null,
        ?string $customDescription = null,
    ): StudentLog {
        return StudentLog::create([
            'event_type'    => $eventType,
            'loggable_type' => get_class($loggable),
            'loggable_id'   => $loggable->id,
            'user_id'       => Auth::id(),
            'student_id'    => $student_id,
            'old_data'      => $oldData,
            'new_data'      => $newData,
            'changed_data'  => $changedData,
            'description'   => $customDescription,
        ]);
    }
}
