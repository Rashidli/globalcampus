<?php

namespace App\Models;

use App\Enums\UserType;
use App\Http\Services\ActivityLogger;
use App\Models\Settings\Country;
use App\Models\Settings\Currency;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\Profession;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\UniversityList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public static function booted(): void
    {
        static::created(function ($program): void {
            ActivityLogger::log(
                eventType: 'store',
                loggable: $program,
                student_id: $program->user_id,
                customDescription: 'yeni proqram əlavə olundu.'
            );
        });

        static::updated(function ($program): void {
            $oldData     = $program->getOriginal();
            $newData     = $program->getAttributes();
            $changedData = array_diff_assoc($newData, $oldData);
            unset($changedData['updated_at']);

            ActivityLogger::log(
                eventType: 'update',
                loggable: $program,
                student_id: $program->user_id,
                oldData: $oldData,
                newData: $newData,
                changedData: $changedData,
                customDescription: 'proqram məlumatlarında dəyişiklik olundu.'
            );
        });

        static::deleted(function ($program): void {
            ActivityLogger::log(
                eventType: 'destroy',
                loggable: $program,
                student_id: $program->user_id,
                customDescription: 'proqram silindi.'
            );
        });
    }

    public function education_level(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    public function university_list(): BelongsTo
    {
        return $this->belongsTo(UniversityList::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function program_status(): BelongsTo
    {
        return $this->belongsTo(ProgramStatus::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByUser($query, $user)
    {
        if ($user->type === UserType::AGENT->value) {
            $query->whereHas('user', fn ($q) => $q->where('agent_id', $user->id));
        }

        return $query;
    }

    public function scopeFilterByName($query, $name)
    {
        return $query->whereHas('user', fn ($q) => $q->where('name', 'like', "%{$name}%"));
    }

    public function scopeFilterBySurname($query, $surname)
    {
        return $query->whereHas('user', fn ($q) => $q->where('surname', 'like', "%{$surname}%"));
    }

    public function scopeFilterByAgentIds($query, $agentIds)
    {
        return $query->whereHas('user', fn ($q) => $q->whereIn('agent_id', $agentIds));
    }

    public function scopeFilterByUniversity($query, $universityIds)
    {
        return $query->whereIn('university_list_id', $universityIds);
    }

    public function scopeFilterByPeriod($query, $periodId)
    {
        return $query->where('period_id', $periodId);
    }

    public function scopeFilterByEducationLevel($query, $educationLevelId)
    {
        return $query->where('education_level_id', $educationLevelId);
    }

    public function scopeFilterByCountry($query, $countryIds)
    {
        return $query->whereIn('country_id', $countryIds);
    }

    public function scopeFilterByProgramStatus($query, $statusIds)
    {
        return $query->whereIn('program_status_id', $statusIds);
    }

    public function scopeFilterByProfession($query, $professionIds)
    {
        return $query->whereHas('tariff', fn ($q) => $q->whereIn('profession_id', $professionIds));
    }
}
