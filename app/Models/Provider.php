<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'gender',
        'experience',
        'message',
        'phone',
        'photo_path',
        'proof_document_path',
        'full_address',
        'postal_address',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
