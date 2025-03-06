<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Eloquent\Model;

class PresentialTest extends Model
{    
    protected $table  = 'presential_test'; 
    protected $fillable = [
    'type',
    'candidat_id',
    'staff_id',
    'date_start',
    'date_end',
     'location'
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($test) {
            self::updateStaffAvailability($test->staff_id, $test->date_start, $test->date_end);
        });
    }

    public static function updateStaffAvailability($staffId, $dateStart, $dateEnd)
    {
        $eventStart = Carbon::parse($dateStart);
        $eventEnd = Carbon::parse($dateEnd);

        // Check if staff is available during this time
        $availability = DB::table('staff_availabilities')
            ->where('staff_id', $staffId)
            ->whereDate('start_time', $eventStart->toDateString())
            ->where(function ($query) use ($eventStart, $eventEnd) {
                $query->whereBetween('start_time', [$eventStart, $eventEnd])
                    ->orWhereBetween('end_time', [$eventStart, $eventEnd])
                    ->orWhere(function ($q) use ($eventStart, $eventEnd) {
                        $q->where('start_time', '<', $eventStart)
                            ->where('end_time', '>', $eventEnd);
                    });
            })
            ->first();

        if ($availability) {
            if ($availability->start_time >= $eventStart && $availability->end_time <= $eventEnd) {
                // Remove availability completely
                DB::table('staff_availabilities')->where('id', $availability->id)->delete();
            } else {
                // Adjust the availability slot
                DB::table('staff_availabilities')
                    ->where('id', $availability->id)
                    ->update(['end_time' => $eventStart]);

                if ($availability->end_time > $eventEnd) {
                    DB::table('staff_availabilities')->insert([
                        'staff_id' => $staffId,
                        'start_time' => $eventEnd,
                        'end_time' => $availability->end_time,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

}
