@extends('layouts.admin')

@section('content')
<div class="bg-white shadow-md rounded my-6">
    <table class="min-w-max w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Candidat</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Question</th>
                <th class="py-3 px-6 text-left">Réponse</th>
                <th class="py-3 px-6 text-center">Correcte</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($historicals as $historical)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $historical->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $historical->email }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $historical->question }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $historical->answer }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="@if($historical->is_correct) bg-green-200 text-green-600 @else bg-red-200 text-red-600 @endif py-1 px-3 rounded-full text-xs">
                            @if($historical->is_correct) Oui @else Non @endif
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection