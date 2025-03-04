<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffAvailabilities extends Model
{
    protected $fillable = [
        'staff_id',
        'start_time',
        'end_time',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
