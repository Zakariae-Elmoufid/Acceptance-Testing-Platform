<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('answers')->get();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $question = Question::create($request->only('content', 'points'));
        foreach ($request->input('answers') as $index => $answerContent) {
            $answer = new Answer([
                'content' => $answerContent,
                'is_correct' => in_array($index + 1, $request->input('is_correct')),
            ]);

            $question->answers()->save($answer);
        }
    
        return redirect()->route('questions.index')->with('success', 'La question a été créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {    
        $question = Question::with('answers')->findOrFail($id);
        return view('admin.questions.edit', compact('question'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->only('content', 'points'));
    
        $question->answers()->delete();
    
        foreach ($request->input('answers') as $index => $answerContent) {
            $answer = new Answer([
                'content' => $answerContent,
                'is_correct' => in_array($index + 1, (array)$request->input('is_correct')),
            ]);
            $question->answers()->save($answer);
        }
    
        return redirect()->route('questions.index')->with('success', 'La question a été mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
    
        return redirect()->route('questions.index')->with('success', 'La question a été supprimée avec succès.');
    }
}
