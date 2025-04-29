<?php

namespace App\Models;

use App\Models\Settings\UniversityList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contract extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_identity_number',
        'relative_mobile',
        'whatsapp_number',
        'address',
        'education_level',
        'service',
        'service_price',
        'initial_payment',
        'remaining_amount',
        'university_list_id',
        'majors',
        'country',
        'verification_code',
    ];

    protected $casts = [
        'majors' => 'array',
    ];

    public function student() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function university() : BelongsTo
    {
        return $this->belongsTo(UniversityList::class);
    }

}
