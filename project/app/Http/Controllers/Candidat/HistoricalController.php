<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Http\Request;
use App\Models\Historical;
use App\Http\Controllers\Controller;
use App\Models\Candidat;
use Illuminate\Support\Facades\DB;

class HistoricalController extends Controller
{
    
    public function store(Request $request){
        
        $candidat = Candidat::where('user_id',  auth()->id())->first();
        $candidatId = $candidat->id;
        

        $answersArray = json_decode($request->answers ,true);
        $answersIntegers = array_map('intval', $answersArray);
        
        foreach ($answersIntegers as $answerId) {
            Historical::create([
                'answer_id' => $answerId,
                'candidat_id' => $candidatId,
            ]);
        }
    
       return  redirect()->route('candidat.result');
     }


     public function calcul(){
        $historicals = DB::table('historicals')
        ->join('candidats','candidats.id', '=' , 'historicals.candidat_id')
        ->join('users','users.id','=','candidats.user_id')
        ->join('answers', 'answers.id', '=', 'historicals.answer_id')
        ->join('questions', 'questions.id', '=', 'answers.question_id')
        ->select('users.name  as name' , 'users.email as email' , 'questions.content as question', 'answers.content as answer', 'answers.is_correct')
        ->get(); 
        
        return view('admin.quiz.result', compact('historicals'));

    }

    public function show(){

        $candidat = Candidat::where('user_id',  auth()->id())->first();
        $candidatId = $candidat->id;
        
            if (!$candidat) {
                return redirect()->route('home')->with('error', 'Aucun candidat trouvé.');
            }

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
