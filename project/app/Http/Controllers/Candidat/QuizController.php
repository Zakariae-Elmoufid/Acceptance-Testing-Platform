<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Http\Request;
use App\Models\Question;
use  App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\Historical;

class QuizController extends Controller
{
    public function show()
{
    $candidat = Candidat::where('user_id',  auth()->id())->first();

    $exists = Historical::where('candidat_id', $candidat)->exists();
    if($exists){
        $questions = Question::with('answers')->inRandomOrder()->get();
        return view('candidat.quizz', compact('questions'));
    }else {
        return view('Candidat.result');  
    }

}
}



