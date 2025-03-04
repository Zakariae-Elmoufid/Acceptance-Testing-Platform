<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    
    protected $fillable = [
        'user_id',
        'photo_profile'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function StaffAvailabilities()
    {
        return $this->hasMany(Staff::class);
    }
    
}
