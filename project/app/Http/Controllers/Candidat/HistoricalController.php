<?php

namespace App\Http\Controllers\Candidat;

use Illuminate\Http\Request;
use App\Models\Historical;
use App\Http\Controllers\Controller;
use App\Models\Candidat;
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

        return view('Candidat.result')->with('success', 'Réponses enregistrées avec succès!');    }
}
