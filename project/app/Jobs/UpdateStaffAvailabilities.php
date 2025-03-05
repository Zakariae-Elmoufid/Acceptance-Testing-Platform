<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateStaffAvailabilities implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = Carbon::now()->addDays(1);

        $events = DB::table('events')
          ->select('staff_id', 'date_start', 'date_end')
          ->whereDate('date_start', $today->toDateString()) 
          ->get();

        foreach ($events as $event) {
            $staffId = $event->staff_id;
            $eventStart = Carbon::parse($event->date_start);
            $eventEnd = Carbon::parse($event->date_end);

            $availability = DB::table('staff_availabilities')
            ->where('staff_id', $staffId)
            ->whereDate('start_time', $today->toDateString())
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
                    DB::table('staff_availabilities')
                        ->where('id', $availability->id)
                        ->delete();
                } else {
                    if ($availability->start_time < $eventStart) {
                        DB::table('staff_availabilities')
                            ->where('id', $availability->id)
                            ->update([
                                'end_time' => $eventStart
                            ]);
                    }
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

        $testPresenials = DB::table('presential_test')
        ->select('staff_id', 'date_start', 'date_end')
        ->whereDate('date_start', $today->toDateString()) 
        ->get();

        foreach($testPresenials as $testPresenial){
           $staff_id = $testPresenial->staff_id;

           $eventStart = Carbon::parse($testPresenial->date_start);
           $eventEnd = Carbon::parse($testPresenial->date_end);

           $availability = DB::table('staff_availabilities')
           ->where('staff_id', $staffId)
           ->whereDate('start_time', $today->toDateString())
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
                DB::table('staff_availabilities')
                    ->where('id', $availability->id)
                    ->delete();
            } else {
                    DB::table('staff_availabilities')
                        ->where('id', $availability->id)
                        ->update([
                            'end_time' => $eventStart
                        ]);
                }
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
}
