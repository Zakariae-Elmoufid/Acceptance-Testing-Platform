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

        
        
        
        
        
        
    public function assignTechnicalTest()
   {

    $candidat = Candidat::where('user_id',  auth()->id())->first();
    $candidatId = $candidat->id;
    $afterDate = Carbon::now();
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




        return view('candidat.result', compact('historical','test'));

    });
}




}