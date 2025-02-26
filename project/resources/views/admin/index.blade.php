@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-6">
    <!-- Card - Total des candidats -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 flex items-center">
            <div class="rounded-full bg-blue-100 p-3">
                <i class="fas fa-users text-blue-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Total Candidats</h3>
                <p class="text-2xl font-semibold">{{ $totalCandidates ?? 0 }}</p>
            </div>
        </div>
        <div class="bg-blue-500 text-white px-4 py-2 text-sm flex justify-between items-center">
            <span>Voir détails</span>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>

    <!-- Card - Candidats en attente -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 flex items-center">
            <div class="rounded-full bg-yellow-100 p-3">
                <i class="fas fa-hourglass-half text-yellow-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">En Attente</h3>
                <p class="text-2xl font-semibold"></p>
            </div>
        </div>
        <div class="bg-yellow-500 text-white px-4 py-2 text-sm flex justify-between items-center">
            <span>Voir détails</span>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>

    <!-- Card - Candidats validés -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 flex items-center">
            <div class="rounded-full bg-green-100 p-3">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Validés</h3>
                <p class="text-2xl font-semibold"></p>
            </div>
        </div>
        <div class="bg-green-500 text-white px-4 py-2 text-sm flex justify-between items-center">
            <span>Voir détails</span>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>

    <!-- Card - Tests planifiés -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 flex items-center">
            <div class="rounded-full bg-purple-100 p-3">
                <i class="fas fa-calendar-alt text-purple-500 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-gray-500 text-sm">Tests Planifiés</h3>
                <p class="text-2xl font-semibold"></p>
            </div>
        </div>
        <div class="bg-purple-500 text-white px-4 py-2 text-sm flex justify-between items-center">
            <span>Voir détails</span>
            <i class="fas fa-arrow-right"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Derniers candidats inscrits -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Derniers candidats inscrits</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($recentCandidates ?? [] as $candidate)
                            <tr>
                                <td class="py-3 px-4 whitespace-nowrap">{{ $candidate->name }}</td>
                                <td class="py-3 px-4 whitespace-nowrap">{{ $candidate->email }}</td>
                                <td class="py-3 px-4 whitespace-nowrap">{{ $candidate->created_at->format('d/m/Y') }}</td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-center text-gray-500">Aucun candidat récent</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4 text-right">
                <a href="" class="text-primary hover:underline">Voir tous les candidats →</a>
            </div>
        </div>
    </div>

    <!-- Tests à venir -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Tests à venir</h3>
        </div>
        <div class="p-6">
            @forelse($upcomingTests ?? [] as $test)
                <div class="mb-4 pb-4 border-b border-gray-200 last:border-0 last:mb-0 last:pb-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800"></h4>
                            <p class="text-sm text-gray-500"></p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-600"></p>
                            <p class="text-sm text-gray-500"></p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <i class="fas fa-user-tie mr-2"></i>
                        <span>Examinateur: </span>
                    </div>
                </div>
            @empty
                <div class="text-center py-4 text-gray-500">
                    <p>Aucun test planifié</p>
                </div>
            @endforelse
            <div class="mt-4 text-right">
                <a href="" class="text-primary hover:underline">Voir tous les tests →</a>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques du Quiz -->
<div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="border-b border-gray-200 px-6 py-4">
        <h3 class="text-lg font-semibold text-gray-800">Statistiques du Quiz</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="text-sm text-gray-500 mb-2">Score moyen</h4>
                <p class="text-2xl font-bold text-gray-800"></p>
                <div class="mt-2 text-sm">
                    <span class="text-green-500">
                        <i class="fas fa-arrow-up mr-1"></i>2.5%
                    </span>
                    <span class="text-gray-500 ml-1">par rapport au mois dernier</span>
                </div>
            </div>
            
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="text-sm text-gray-500 mb-2">Taux de réussite</h4>
                <p class="text-2xl font-bold text-gray-800"></p>
                <div class="mt-2 text-sm">
                    <span class="text-green-500">
                        <i class="fas fa-arrow-up mr-1"></i>1.8%
                    </span>
                    <span class="text-gray-500 ml-1">par rapport au mois dernier</span>
                </div>
            </div>
            
            <div class="bg-gray-100 rounded-lg p-4">
                <h4 class="text-sm text-gray-500 mb-2">Nombre total de quiz passés</h4>
                <p class="text-2xl font-bold text-gray-800"></p>
                <div class="mt-2 text-sm">
                    <span class="text-red-500">
                        <i class="fas fa-arrow-down mr-1"></i>0.5%
                    </span>
                    <span class="text-gray-500 ml-1">par rapport au mois dernier</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection