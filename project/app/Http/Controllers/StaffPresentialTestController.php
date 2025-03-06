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

    private function findNextAvailableSlot($type, Carbon $afterDate, $duration)
        {
            return StaffAvailabilities::where('staff.type', $type)
                ->join('staff','staff.id',"=","staff_id")
                ->where('start_time', '>', $afterDate) 
                ->whereRaw("DAYOFWEEK(start_time) NOT IN (1, 7)")
                ->where(function ($query) {
                    $query->whereRaw('HOUR(start_time) BETWEEN 9 AND 11') 
                        ->orWhereRaw('HOUR(start_time) BETWEEN 14 AND 16'); 
                })
                ->whereRaw("TIMESTAMPDIFF(MINUTE, start_time, end_time) >= ?", [$duration]) 
                ->orderBy('start_time', 'asc') 
                ->first();
        }

        
        
    public function assignTechnicalTest($candidatId, $afterDate)
   {


    $testDuration = 20;

     
    $availableSlot = $this->findNextAvailableSlot('coach', $afterDate, $testDuration);
    
    if (!$availableSlot) {
        return null; 
    }

    return DB::transaction(function () use ($candidatId, $availableSlot, $testDuration) {
        $startTime = Carbon::parse($availableSlot['start_time']); 
        $endTime = $startTime->copy()->addMinutes($testDuration);

        $test = PresentialTest::create([
            'type' => 'coach',
            'staff_id' => $availableSlot['staff_id'],
            'candidat_id' => $candidatId,
            'date_start' => $startTime,
            'date_end' => $endTime,
            'location' => 'YouCode youssofia'
            ]);
        
        
        Event::create([
            'staff_id' => $availableSlot['staff_id'],
            'date_start'  => $availableSlot['start_time'],
            'date_end' => $endTime,
            'title'  => 'Technical test',
            'description' => 'Technical test to evaluate the candidate  logical skills',
        ]);

       return $test;

    });

}


public function assignAdministrativTest($candidatId, $afterDate){
    $candidat = Candidat::where('user_id',  auth()->id())->first();
    $candidatId = $candidat->id;
    $afterDate = Carbon::now();
    $testDuration = 15;

    $availableSlot = $this->findNextAvailableSlot('administrativ', $afterDate, $testDuration);
    
    if (!$availableSlot) {
        return null; 
    }



    return DB::transaction(function () use ($candidatId, $availableSlot, $testDuration) {
        $startTime = Carbon::parse($availableSlot['start_time']); 
        $endTime = $startTime->copy()->addMinutes($testDuration);

        $test = PresentialTest::create([
            'type' => 'administrativ',
            'staff_id' => $availableSlot['staff_id'],
            'candidat_id' => $candidatId,
            'date_start' => $startTime,
            'date_end' => $endTime,
            'location' => 'YouCode youssofia'
            ]);
        
        
        Event::create([
            'staff_id' => $availableSlot['staff_id'],
            'date_start'  => $availableSlot['start_time'],
            'date_end' => $endTime,
            'title'  => 'administartiv test',
            'description' => 'administrativ test to evaluate the candidate  softs skills',
        ]);

        return $test;

    });
}


public function assignCmeTest($candidatId, $afterDate){
   
    $testDuration = 20;
    
    $groupCme = DB::table('test_groups')
    ->where('occupied', '<', 4)
    ->orderBy('id', 'desc') 
    ->first(); 

    

    if($groupCme == null){
        $availableSlot = $this->findNextAvailableSlot('cme', $afterDate, $testDuration);
    
        if (!$availableSlot) {
            return null; 
        }

        return DB::transaction(function () use ($candidatId, $availableSlot, $testDuration) {
            $startTime = Carbon::parse($availableSlot['start_time']); 
            $endTime = $startTime->copy()->addMinutes($testDuration);

            // dd($startTime,$endTime);

             $group = TestGroup::create([
                 'candidat_id' => $candidatId,
                 'occupied' => 1,
                 'date_start' => $startTime,
                 'date_end' => $endTime
             ]);

    
            $test = PresentialTest::create([
                'type' => 'administrativ',
                'staff_id' => $availableSlot['staff_id'],
                'candidat_id' => $candidatId,
                'date_start' => $startTime,
                'date_end' => $endTime,
                'location' => 'YouCode youssofia'
                ]);
            
            
            Event::create([
                'staff_id' => $availableSlot['staff_id'],
                'date_start'  => $availableSlot['start_time'],
                'date_end' => $endTime,
                'title'  => 'CME test',
                'description' => 'CME test to evaluate the candidate  softs skills',
            ]);
    
    
            
        });

    
    }else{
        $startTest = $groupCme->date_start;
        $endTest = $groupCme->date_end;
        $occupied = $groupCme->occupied;

        $group = TestGroup::create([
            'date_start' => $startTest,
            'date_end' => $endTest,
            'candidat_id' => $candidatId,
            'occupied' => $occupied + 1,
         ]);


    }

}


public function scheduleAllTestsForCandidate()
    {
        $results = [
            'technique' => null,
            'administratif' => null,
            'cme' => null
        ];

        $candidat = Candidat::where('user_id',  auth()->id())->first();
        $candidatId = $candidat->id;
        $afterDate = Carbon::now();


        
        $results['technique'] = $this->assignTechnicalTest($candidatId, $afterDate);
        
        $results['administrativ'] = $this->assignAdministrativTest($candidatId, $afterDate);

        $results['cme'] = $this->assignCmeTest($candidatId, $afterDate);

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



}