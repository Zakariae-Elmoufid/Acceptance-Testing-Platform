<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Event;

class EventController extends Controller
{
   public function index(){
    $events = Event::all();

    return view('staff.index', compact('events'));
   }

    public function store(Request $request){
        $staff = Staff::where('user_id',  auth()->id())->first();
        $staffId  = $staff->id;

        Event::create([
            'staff_id' => $staffId,
            'title' => $request->title,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'description' => $request->description,
        ]);

        return redirect()->route('satff')->with('success', 'event  saved with  succussful!');  
    }


}
