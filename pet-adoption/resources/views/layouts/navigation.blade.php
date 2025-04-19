<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Pet Adoption Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
   <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center space-x-2">
                <i class="fas fa-paw text-3xl mr-2 text-primary-600"></i>
                <h1 class="text-3xl font-bold text-primary-600">PetAdoption</h1>
            </div>
            
            @auth
                <!-- Profile Dropdown -->
                <div class="relative">
                    <button id="profileDropdownToggle" class="flex items-center space-x-2 text-gray-600 hover:text-primary-600 focus:outline-none transition-colors duration-200">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-10 h-10 rounded-full object-cover border-2 border-primary-100">
                        @else
                            <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center border-2 border-primary-200">
                                <span class="text-primary-600 font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="font-semibold hidden md:inline">{{ Auth::user()->name }}</span>
                        <svg class="w-5 h-5 hidden md:inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="profileDropdownContent" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-50 overflow-hidden border border-gray-100">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 border-b border-gray-100">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Admin Dashboard</span>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 border-b border-gray-100">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    <span>Dashboard</span>
                                </div>
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200 border-b border-gray-100">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Profile</span>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors duration-200">
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Log Out</span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Guest Navigation -->
                <nav class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" 
                       class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-5 rounded-full font-medium transition-colors duration-200 shadow-md hover:shadow-lg">
                            Register
                        </a>
                    @endif
                </nav>
            @endauth
        </div>
    </nav>

    <!-- Scripts -->
    <script>
        // Toggle Profile Dropdown
       document.addEventListener('DOMContentLoaded', function () {
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdownContent = document.getElementById('profileDropdownContent');

        if (profileDropdownToggle && profileDropdownContent) {
            profileDropdownToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                profileDropdownContent.classList.toggle('hidden');
            });

            window.addEventListener('click', function (e) {
                if (!profileDropdownToggle.contains(e.target) && !profileDropdownContent.contains(e.target)) {
                    profileDropdownContent.classList.add('hidden');
                }
            });
        }
    });
    </script>
</body>
</html>