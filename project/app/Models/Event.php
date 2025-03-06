<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'staff_id',
        'date_start',
        'date_end',
        'title',
        'description',
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($event) {
            PresentialTest::updateStaffAvailability($event->staff_id, $event->date_start, $event->date_end);
        });
    }
}
