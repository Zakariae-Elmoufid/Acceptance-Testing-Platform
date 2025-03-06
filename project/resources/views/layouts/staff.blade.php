<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Staff YouCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
   
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white p-4">
            <h1 class="text-2xl font-bold mb-6">Staff YouCode</h1>
            <ul class="space-y-3">
                <li>
                    <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100 rounded">Tableau de bord</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100 rounded">Événements</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100 rounded">Candidats</a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100 rounded">Paramètres</a>
                </li>
            </ul>
        </div>

        <!-- Contenu principal -->
        <div class="flex-grow p-6">
        @yield('content')
        </div>
    </div>

  
</body>
</html>