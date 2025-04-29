<?php

namespace App\Models;

use App\Http\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'agent_id',
        'user_id',
        'phone',
        'type',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function students(): HasMany
    {
        return $this->hasMany(User::class, 'agent_id');
    }

    public function costs(): HasMany
    {
        return $this->hasMany(Cost::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('price');
    }

    public function agent_info(): HasOne
    {
        return $this->hasOne(AgentInfo::class);
    }

    public function student_info(): HasOne
    {
        return $this->hasOne(StudentInfo::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(Language::class);
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(StudentLog::class, 'student_id');
    }
}
