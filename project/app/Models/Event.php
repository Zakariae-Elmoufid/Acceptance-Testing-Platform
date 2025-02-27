<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'staff_id',
        'date_start',
        'date_end',
        'phone',
        'description',
        'title',
    ];
}
