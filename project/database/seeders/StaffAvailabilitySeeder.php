<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class StaffAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $staffIds = Staff::pluck('id')->toArray();
        
          if (empty($staffIds)) {
              $this->command->info('Aucun membre du staff trouvé. Exécutez d\'abord le StaffSeeder.');
              return;
          }
          
          $availabilityData = [];
          
          $today = Carbon::now();
          
          for ($week = 0; $week < 4; $week++) {
              $monday = $today->copy()->startOfWeek()->addWeeks($week);
              
              foreach ($staffIds as $staffId) {
                  for ($day = 0; $day < 5; $day++) { // Lundi à vendredi
                      $currentDate = $monday->copy()->addDays($day);
                      
                      $availabilityData[] = [
                          'staff_id' => $staffId,
                          'start_time' => $currentDate->copy()->setTime(9, 0, 0),
                          'end_time' => $currentDate->copy()->setTime(12, 0, 0),
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ];
                      
                      $availabilityData[] = [
                          'staff_id' => $staffId,
                          'start_time' => $currentDate->copy()->setTime(14, 0, 0),
                          'end_time' => $currentDate->copy()->setTime(17, 0, 0),
                          'created_at' => Carbon::now(),
                          'updated_at' => Carbon::now(),
                      ];
                  }
              }
          }
          
          DB::table('staff_availabilities')->insert($availabilityData);
          
          $this->command->info(count($availabilityData) . ' disponibilités ont été créées avec succès.');
    }
}
