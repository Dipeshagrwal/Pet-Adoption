<!-- resources/views/components/admin/sidebar.blade.php -->
<div id="sidebar"
    class="fixed left-0 top-0 h-full w-72 bg-gradient-to-b from-teal-700 to-teal-900 text-white p-6 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-50 shadow-xl border-r border-teal-500/20">
    
    <!-- Logo or Brand Name -->
    <div class="mb-6 px-2">
        <a href="#" class="flex items-center justify-start group">
            <div class="bg-white/10 p-3 rounded-xl group-hover:bg-teal-600 transition-all duration-300 shadow-md group-hover:shadow-teal-500/20">
                <i class="fas fa-paw text-2xl text-teal-200 group-hover:text-white"></i>
            </div>
            <span class="ml-4 text-2xl font-bold bg-gradient-to-r from-teal-200 to-white bg-clip-text text-transparent group-hover:text-white transition duration-300">PetAdoption</span>
        </a>
    </div>

    <!-- Sidebar Links -->
    <ul class="space-y-2">
        <!-- Home Link -->
        <li>
            <a href="{{route('welcome')}}" 
               class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-home text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">Home</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>
        
        <!-- Dashboard Link -->
        <li class="{{ request()->routeIs('dashboard') ? 'active-sidebar-item' : '' }}">
            <a href="{{ route('dashboard') }}"
                class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-tachometer-alt text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">Dashboard</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>

        <!-- Add Pets Link -->
        <li class="{{ request()->routeIs('user.pets.create') ? 'active-sidebar-item' : '' }}">
            <a href="{{ route('user.pets.create') }}"
                class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-plus-circle text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">Add Pets</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>
        
        <!-- My Pets Link -->
        <li class="{{ request()->routeIs('user.pets.index') ? 'active-sidebar-item' : '' }}">
            <a href="{{route('user.pets.index')}}"
                class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-paw text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">My Pets</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>

        <!-- Manage Adoption Requests Link -->
        <li class="{{ request()->routeIs('admin.pets.pending') ? 'active-sidebar-item' : '' }}">
            <a href="{{ route('adoption-request.index') }}"
                class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-hand-holding-heart text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">Adoption Requests</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>

        <!-- My Adoptions Link -->
        <li class="{{ request()->routeIs('adopter.adoptions.index') ? 'active-sidebar-item' : '' }}">
            <a href="{{ route('adopter.adoptions.index') }}"
                class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                    <i class="fas fa-heart text-lg text-teal-200 group-hover:text-white"></i>
                </div>
                <span class="font-medium text-teal-100 group-hover:text-white">My Adoptions</span>
                <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
            </a>
        </li>
    </ul>

    <!-- User Profile Section at Bottom -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-teal-500/20 bg-teal-800/50">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                <i class="fas fa-user text-teal-200"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white">Welcome  {{ Auth::user()->name }}</p>
            </div>
            
        </div>
    </div>
</div>

<!-- Sidebar Toggle Button (should be placed in your layout) -->
<button id="toggle-sidebar" class="fixed top-4 left-4 z-50 md:hidden p-2 rounded-lg bg-teal-700 text-white shadow-lg">
    <i class="fas fa-bars"></i>
</button>

<!-- Add this to your CSS or style tag -->
<style>
    .active-sidebar-item {
        position: relative;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .active-sidebar-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: linear-gradient(to bottom, #5eead4, #0d9488);
        border-radius: 4px 0 0 4px;
    }
    
    .active-sidebar-item a {
        background: rgba(255, 255, 255, 0.05) !important;
    }
</style>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Sidebar Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleSidebarBtn = document.getElementById('toggle-sidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        // Toggle Sidebar
        if (toggleSidebarBtn) {
            toggleSidebarBtn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                if (mainContent) {
                    mainContent.classList.toggle('ml-72');
                }
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768 && !sidebar.contains(event.target) && 
                event.target !== toggleSidebarBtn && !toggleSidebarBtn.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
                if (mainContent) {
                    mainContent.classList.remove('ml-72');
                }
            }
        });
    });
</script>