@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Éditer la question</h1>

        <form action="{{ route('questions.update', $question) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Question :</label>
                <input type="text" name="content" id="content" value="{{ $question->content }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="points" class="block text-sm font-medium text-gray-700 mb-2">Points :</label>
                <input type="number" name="points" id="points" value="{{ $question->points }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <h2 class="text-2xl font-bold mb-4">Réponses</h2>

            @foreach ($question->answers as $index => $answer)
                <div class="mb-4">
                    <label for="answer_{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Réponse {{ $index + 1 }} :</label>
                    <input type="text" name="answers[]" id="answer_{{ $index }}" value="{{ $answer->content }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex items-center mb-6">
                    <input type="checkbox" name="is_correct[]" id="is_correct_{{ $index }}" value="{{ $index + 1 }}" {{ $answer->is_correct ? 'checked' : '' }} class="mr-2">
                    <label for="is_correct_{{ $index }}" class="text-sm font-medium text-gray-700">Correcte</label>
                </div>
            @endforeach

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Enregistrer les modifications
            </button>
        </form>
    </div>
@endsection