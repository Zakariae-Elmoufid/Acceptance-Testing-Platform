<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Historical;
use App\Models\Candidat;
use App\Models\PresentialTest;
use Carbon\Carbon;
use App\Models\StaffAvailabilities;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\TestGroup;

class StaffPresentialTestController extends Controller
{


    public function checkCandidateReadiness()
    {
        $readyCandidates = Candidat::where('status', 'pre_selected')
            ->count();

        if ($readyCandidates >= 4) {
            $this->scheduleTestsForReadyCandidates();
        }

        return $readyCandidates;
    }

    public function scheduleTestsForReadyCandidates(){

        $afterDate = Carbon::now();
        $candidates = Candidat::where('status', 'pre_selected')
        ->take(4)
        ->get();

            $results['technique'] =   $this->assignIndividualTechnicalTest($candidates, $afterDate);

            $date_end  =  $results['technique'][0]->date_end;

            $results['cme'] = $this->assignCmeTest($candidates,$date_end);
             
            $cme_date_end = $results['cme'][0]->date_end;

            $results['administrativ'] = $this->assignAdministrativTest($candidates,$cme_date_end);
        

        
        


        $historical = DB::table('historicals')
        ->join('candidats', 'candidats.id', '=', 'historicals.candidat_id')
        ->join('users', 'users.id', '=', 'candidats.user_id')
        ->join('answers', 'answers.id', '=', 'historicals.answer_id')
        ->select(
            'users.name as name', 
            DB::raw('SUM(answers.is_correct) as total')
        )
        ->where('candidats.id', $candidatId) 
        ->groupBy('users.name')
        ->get();
        
        return view('candidat.result', compact('historical'));

    }


    

    private function findNextAvailableSlot($type, Carbon $afterDate, $duration) {
        return StaffAvailabilities::select(
            'staff.id as staff_id', 
            'staff_availabilities.start_time', 
            'staff_availabilities.end_time'
        )
        ->join('staff', 'staff.id', '=', 'staff_availabilities.staff_id')
        ->where('staff.type', $type)
        ->where('start_time', '>', $afterDate)
        ->whereRaw("DAYOFWEEK(start_time) NOT IN (1, 7)")
        ->where(function ($query) {
            $query->whereRaw('HOUR(start_time) BETWEEN 9 AND 11')
                ->orWhereRaw('HOUR(start_time) BETWEEN 14 AND 16');
        })
        ->whereRaw("TIMESTAMPDIFF(MINUTE, start_time, end_time) >= ?", [$duration])
        ->groupByRaw("staff.id, staff_availabilities.start_time, staff_availabilities.end_time") 
        ->havingRaw("COUNT(staff.id) >= 4") 
        ->orderBy('start_time', 'asc')
        ->limit(4)
        ->get();
    }   

    private function findAdmineAvailableSlot($type,  $duration,$date_end){
           return StaffAvailabilities::select(
            'staff.id as staff_id', 
            'staff_availabilities.start_time', 
            'staff_availabilities.end_time'
        )
           ->join('staff', 'staff.id', '=', 'staff_availabilities.staff_id')
           ->where('staff.type', $type)
           ->where('start_time', '>', $date_end)
           ->whereRaw("DAYOFWEEK(start_time) NOT IN (1, 7)")
           ->whereRaw("TIMESTAMPDIFF(MINUTE, start_time, end_time) >= ?", [$duration * 4])
           ->first();

    }

    private function findACmeAvailableSlot($type,  $duration,$date_end){
        return StaffAvailabilities::select(
            'staff.id as staff_id', 
            'staff_availabilities.start_time', 
            'staff_availabilities.end_time'
        )
        ->join('staff', 'staff.id', '=', 'staff_availabilities.staff_id')
        ->where('staff.type', $type)
        ->where('start_time', '>', $date_end)
        ->whereRaw("DAYOFWEEK(start_time) NOT IN (1, 7)")
        ->whereRaw("TIMESTAMPDIFF(MINUTE, start_time, end_time) >= ?", [$duration])
        ->first();
    }


    

        
        
public function assignIndividualTechnicalTest($candidates, $afterDate){

    $testDuration = 20;

     
    $coaches = $this->findNextAvailableSlot('coach', $afterDate, $testDuration);
    
    if (!$coaches) {
        return null; 
    }

    
    foreach ($candidates as $index => $candidat){
        $coache = $coaches[$index];
        
        $startTime = Carbon::parse($coache[$index]['start_time']); 
        $endTime = $startTime->copy()->addMinutes($testDuration);


        $test = PresentialTest::create([
                    'type' => 'coach',
                    'staff_id' => $coache['staff_id'],
                    'candidat_id' => $candidat->id,
                    'date_start' => $startTime,
                    'date_end' => $endTime,
                    'location' => 'sall meeting'.$index 
                    ]);

                    Event::create([
                                'staff_id' => $coache['staff_id'],
                                'date_start'  => $startTime,
                                'date_end' => $endTime,
                                'title'  => 'Technical test'.$index,
                                'description' => 'Technical test to evaluate the candidate  logical skills',
                            ]);

        $technicalTests[] = $test;


    }
    return $technicalTests;

}

public function assignCmeTest($candidates, $date_end){
   
    $testDuration = 20;
    
        $cme = $this->findACmeAvailableSlot('cme',  $testDuration,$date_end);     
        foreach ($candidates as  $candidat){
            
            $startTime = Carbon::parse($cme['start_time']); 
            $endTime = $startTime->copy()->addMinutes($testDuration);
    
    
            $test = PresentialTest::create([
                        'type' => 'cme',
                        'staff_id' => $cme['staff_id'],
                        'candidat_id' => $candidat->id,
                        'date_start' => $startTime,
                        'date_end' => $endTime,
                        'location' => 'younge codeur'
                        ]);
    
                        Event::create([
                                    'staff_id' => $cme['staff_id'],
                                    'date_start'  => $startTime,
                                    'date_end' => $endTime,
                                    'title'  => 'soft skils test',
                                    'description' => 'CME test to evaluate the candidate  softs skills',
                                ]);
            $cmeTests[] = $test;
        }
    
        return $cmeTests;
}


public function assignAdministrativTest($candidates,$date_end){
   
    $afterDate = Carbon::now();
    $testDuration = 15;

    $administrativ= $this->findAdmineAvailableSlot('administrativ',  $testDuration, $date_end);
    
  
    foreach ($candidates as $index => $candidat){
        $slotStartTime = Carbon::parse($date_end)
        ->addMinutes($index * $testDuration);
       
        $test = PresentialTest::create([
            'type' => 'administrativ',
            'staff_id' => $administrativ['staff_id'],
            'candidat_id' => $candidat->id,
            'date_start' => $slotStartTime,
            'date_end' => $administrativ->copy()->addMinutes($testDuration),
            'location' => 'younge codeur'
            ]);

            Event::create([
                        'staff_id' => $administrativ['staff_id'],
                        'date_start'  => $slotStartTime,
                        'date_end' => $administrativ->copy()->addMinutes($testDuration),
                        'title'  => 'soft skils test',
                        'description' => 'CME test to evaluate the candidate  softs skills',
                    ]);
             $administrativTests[] = $test;


    }

   return $administrativTests;

}



   



}