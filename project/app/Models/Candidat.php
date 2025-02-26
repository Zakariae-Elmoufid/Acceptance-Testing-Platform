<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = [
        'user_id',
        'birth_date',
        'phone',
        'address',
        'document',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
