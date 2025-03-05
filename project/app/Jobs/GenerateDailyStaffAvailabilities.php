<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GenerateDailyStaffAvailabilities implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $staffMembers = DB::table('staff')->pluck('id'); 
        $today = Carbon::now()->addDays(1); 

        if (in_array($today->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
            return;
        }

        foreach ($staffMembers as $staffId) {
            DB::table('staff_availabilities')->insert([
                [
                    'staff_id' => $staffId,
                    'start_time' => $today->copy()->setHour(9)->setMinute(0)->setSecond(0),
                    'end_time' => $today->copy()->setHour(12)->setMinute(0)->setSecond(0),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'staff_id' => $staffId,
                    'start_time' => $today->copy()->setHour(14)->setMinute(0)->setSecond(0),
                    'end_time' => $today->copy()->setHour(17)->setMinute(0)->setSecond(0),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
