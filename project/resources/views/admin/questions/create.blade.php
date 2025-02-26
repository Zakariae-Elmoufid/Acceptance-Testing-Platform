@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-3xl font-bold mb-8 text-center text-primary font-poppins">Créer une nouvelle question</h1>

    <form action="{{ route('questions.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="content" class="block text-sm font-medium text-secondary mb-2">Question :</label>
            <input type="text" name="content" id="content" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <div>
            <label for="points" class="block text-sm font-medium text-secondary mb-2">Points :</label>
            <input type="number" name="points" id="points" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>

        <h2 class="text-2xl font-bold mb-4 text-secondary font-poppins">Réponses</h2>

        @for ($i = 1; $i <= 4; $i++)
            <div class="mb-4">
                <label for="answer_{{ $i }}" class="block text-sm font-medium text-secondary mb-2">Réponse {{ $i }} :</label>
                <input type="text" name="answers[]" id="answer_{{ $i }}" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="is_correct[]" id="is_correct_{{ $i }}" value="{{ $i }}" class="mr-2">
                <label for="is_correct_{{ $i }}" class="text-sm font-medium text-secondary">Correcte</label>
            </div>
        @endfor

        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-orange-600 transition duration-200 font-poppins">Créer la question</button>
    </form>
</div>
@endsection