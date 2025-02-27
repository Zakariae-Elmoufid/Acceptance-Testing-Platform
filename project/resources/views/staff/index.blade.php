@extends('layouts.staff')

@section('content')

<div class="container mx-auto">
    <h2 class="text-3xl font-bold mb-8">Dashboard</h2>
    
    <div class="grid grid-cols-4 gap-4">
        
        <div class="col-span-2 space-y-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-xl font-bold mb-4">Add an Event</h3>
                <form id="eventForm" method="POST" class="space-y-4" action="{{ route('event.store') }}">
                @csrf

                    <div>
                        <label class="block font-medium text-gray-700">Title</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 text-sm font-semibold mb-2">
                            start:
                        </label>
                        <input type="datetime-local" name="date_start" class="w-full bg-gray-200 border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                    </div>
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 text-sm font-semibold mb-2">
                             end:
                        </label>
                        <input type="datetime-local" name="date_end" class="w-full bg-gray-200 border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none" />
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add</button>
                </form>
            </div>
        </div>
        
        <div class="bg-white p-4 rounded-lg shadow col-span-2">
            <h3 class="text-xl font-bold mb-4">Today's Events</h3>
            <ul id="eventList" class="divide-y divide-gray-200"></ul>
        </div>

    </div>
</div>


@endsection