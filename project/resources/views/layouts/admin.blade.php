<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - Gestion des Candidats</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff5722',
                        secondary: '#212121',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-secondary text-white transition duration-300 transform">
            <div class="flex items-center justify-center h-16 border-b border-gray-700">
                <h2 class="text-xl font-semibold text-white">Admin Dashboard</h2>
            </div>
            
            <nav class="mt-5 px-2">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.dashboard')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                    Dashboard
                </a>
                
                <a href="{" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.candidates*')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-users mr-3 text-lg"></i>
                    Candidats
                </a>
                
                <a href="" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.quizzes*')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-question-circle mr-3 text-lg"></i>
                    Quiz
                </a>
                
                <a href="" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.tests*')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-clipboard-list mr-3 text-lg"></i>
                    Tests Présentiels
                </a>
                
                <a href="" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.staff*')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-user-tie mr-3 text-lg"></i>
                    Staff
                </a>
                
                <a href="" class="group flex items-center px-4 py-2 mt-2 text-sm font-medium rounded-md @if(request()->routeIs('admin.settings*')) bg-primary text-white @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                    <i class="fas fa-cog mr-3 text-lg"></i>
                    Paramètres
                </a>
            </nav>
            
            <div class="absolute bottom-0 w-full border-t border-gray-700">
                <div class="flex items-center px-4 py-3">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Admin&background=ff5722&color=fff" alt="Admin">
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Administrateur' }}</div>
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-xs text-gray-300 hover:text-white">
                            Déconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden ml-64">
            <!-- Top Navbar -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-3">
                    <div class="flex items-center">
                        <button id="sidebarToggle" class="text-gray-600 focus:outline-none lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800 ml-4">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="relative">
                            <button class="relative p-1 text-gray-600 hover:text-primary focus:outline-none">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.ml-64');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
            } else {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            }
        });
        
        // Add responsive behavior for the sidebar
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.ml-64');
            
            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-0');
            } else {
                sidebar.classList.remove('-translate-x-full');
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
            }
        }
        
        window.addEventListener('resize', handleResize);
        handleResize(); // Call on initial load
    </script>
    
    @stack('scripts')
</body>
</html>