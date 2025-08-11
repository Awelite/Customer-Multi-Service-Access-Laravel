<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id', // ✅ FIXED
        'service_id',
        'location',
        'description',
        'preferred_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /*public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }*/

    public function assignedStaff()
    {
       return $this->belongsTo(User::class, 'provider_id');
    }

    protected static function boot()
   {
    parent::boot();

    static::creating(function ($request) {
        $request->reference_number = 'SR-' . strtoupper(uniqid());
    });
   }
        
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    


}


