@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">List of Questions</h1>

        @foreach ($questions as $question)
            <div class="bg-white shadow-md rounded-lg p-6 mb-4">
                <h2 class="text-xl font-bold mb-2">{{ $question->content }}</h2>
                <p class="text-gray-600 mb-4">Points: {{ $question->points }}</p>

                <h3 class="text-lg font-bold mb-2">Answers:</h3>
                <ul class="space-y-2">
                    @foreach ($question->answers as $answer)
                        <li class="flex items-center">
                            <span class="mr-2">-</span>
                            <span class="text-gray-800">{{ $answer->content }}</span>
                            <span class="ml-auto {{ $answer->is_correct ? 'text-green-500' : 'text-red-500' }} font-bold">
                                {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 flex justify-end">
                    <a href="{{ route('questions.edit', $question) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <form action="{{ route('questions.destroy', $question) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this question?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
