<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
    ];

public function serviceRequests()
{
    return $this->hasMany(\App\Models\ServiceRequest::class);
}



}
