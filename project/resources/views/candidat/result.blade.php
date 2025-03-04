<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Résultats des candidats</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Nom du candidat</th>
                    <th class="border border-gray-300 px-4 py-2">Total des réponses correctes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historical as $result)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $result->name }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $result->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if(count($historical) == 0)
            <p class="text-gray-500 text-center mt-4">Aucun résultat disponible.</p>
        @endif
    </div>
</div>
</body>
</html>