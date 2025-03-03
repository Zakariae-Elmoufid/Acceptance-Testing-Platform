<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Http\Request;
use App\Models\Question;
use  App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Historical;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    public function show()
{ 
    
    $candidatId = DB::table('candidats')
    ->where('user_id', Auth::id())
    ->value('id'); 

    
    $exists = DB::table('historicals')
    ->where('candidat_id', $candidatId)
    ->exists();

        if($exists  == false) {
            $questions = Question::with('answers')->inRandomOrder()->get();
            return view('candidat.quizz', compact('questions'));
        } else {
            return view('candidat.result');  
        }
    }

    

}



