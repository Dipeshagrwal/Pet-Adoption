<!-- resources/views/components/admin/sidebar.blade.php -->
<div id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-teal-700 to-teal-900 text-white shadow-xl z-50 flex flex-col border-r border-teal-500/20 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Fixed Header Section with improved styling -->
    <div class="p-6 bg-teal-800/50 border-b border-teal-500/20">
        <h2 class="text-2xl font-bold text-center">
            <a href="#" class="flex items-center justify-center group">
                
                <span class="bg-gradient-to-r from-teal-200 to-white bg-clip-text text-transparent group-hover:text-white transition duration-300">PetAdoption</span>
            </a>
        </h2>
    </div>

    <!-- Scrollable Content Section with better spacing -->
    <div class="flex-1 overflow-y-auto scrollbar-hide py-4">
        <ul class="space-y-2 px-4">
            <!-- Home Link -->
            <li>
                <a href="{{ route('welcome') }}" class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-home text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Home</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>
            
            <!-- Dashboard Link -->
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-tachometer-alt text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Dashboard</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Management Section Header -->
            <li class="pt-4 pb-2 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-teal-300/80">Management</span>
            </li>

            <!-- Manage Users Link -->
            <li class="{{ request()->routeIs('users.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('users.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-users text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Manage Users</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Manage Pet Types Link -->
            <li class="{{ request()->routeIs('pet_types.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('pet_types.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-tags text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Pet Types</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Manage Pet Breeds Link -->
            <li class="{{ request()->routeIs('pet_breeds.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('pet_breeds.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-dna text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Pet Breeds</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Manage Pets Link -->
            <li class="{{ request()->routeIs('admin.pets.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('admin.pets.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-paw text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Manage Pets</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Requests Section Header -->
            <li class="pt-4 pb-2 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-teal-300/80">Requests</span>
            </li>

            <!-- Manage Pet Requests Link -->
            <li class="{{ request()->routeIs('admin.pets.pending') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('admin.pets.pending') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-clock text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Pet Requests</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Manage Adoption Requests Link -->
            <li class="{{ request()->routeIs('admin.adoption-requests.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('admin.adoption-requests.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-hand-holding-heart text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">Adoption Requests</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- My Adoptions Link -->
            <li class="{{ request()->routeIs('admin.adoptions.index') ? 'active-sidebar-item' : '' }}">
                <a href="{{ route('admin.adoptions.index') }}"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-heart text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">My Adoptions</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>

            <!-- Settings Section Header -->
            <li class="pt-4 pb-2 px-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-teal-300/80">Settings</span>
            </li>

            <!-- Settings Link -->
            <li class="{{ request()->routeIs('settings') ? 'active-sidebar-item' : '' }}">
                <a href="#"
                    class="flex items-center p-3 rounded-xl hover:bg-white/10 hover:shadow-md transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-white/5 rounded-lg group-hover:bg-teal-600/50 mr-3">
                        <i class="fas fa-cog text-lg text-teal-200 group-hover:text-white"></i>
                    </div>
                    <span class="font-medium text-teal-100 group-hover:text-white">System Settings</span>
                    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition duration-300"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- User Profile Footer Section -->
    <div class="p-4 bg-teal-800/50 border-t border-teal-500/20">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                <i class="fas fa-user-cog text-teal-200"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white">Admin Panel</p>
                <p class="text-xs text-teal-200">{{ Auth::user()->name }}</p>
            </div>
            <a href="{{ route('logout') }}" 
               class="ml-auto p-2 rounded-lg hover:bg-white/10 transition duration-300"
               title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt text-teal-200 hover:text-white"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>

<!-- Sidebar Toggle Button (place this in your main layout) -->
<button id="toggle-sidebar" class="fixed top-4 left-4 z-50 md:hidden p-3 rounded-lg bg-teal-700 text-white shadow-lg hover:bg-teal-600 transition duration-300">
    <i class="fas fa-bars"></i>
</button>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* Active sidebar item styling */
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
    
    /* Custom scrollbar styling - hide it completely */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

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