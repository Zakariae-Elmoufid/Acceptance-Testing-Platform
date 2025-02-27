<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Http\Request;
use App\Models\Question;
use  App\Http\Controllers\Controller;
class QuizController extends Controller
{
    public function show()
{
    $questions = Question::with('answers')->inRandomOrder()->get();
    return view('candidat.quizz', compact('questions'));
}


}
