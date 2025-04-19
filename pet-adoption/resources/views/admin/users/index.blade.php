<x-app-layout>
    <!-- Main Container -->
    <div class="flex flex-col bg-gray-50 min-h-screen">
        <!-- Main Content Area -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Fixed Sidebar -->
            <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
                @include('admin.sidebar')
            </div>
            
            <!-- Main Content -->
            <div id="main-content" class="flex-1 p-6 ml-0 md:ml-64 transition-all duration-300">
                <!-- Header Section -->
                <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">User Management</h2>
                        <p class="text-gray-600 mt-1">View and manage all registered users</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search users..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 w-full sm:w-64">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ count($users) }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-teal-50 text-teal-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Admin Users</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->where('role', 'admin')->count() }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11 11 0 0112 15c2.194 0 4.237.57 6.121 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Regular Users</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $users->where('role', 'user')->count() }}</h3>
                            </div>
                            <div class="p-3 rounded-full bg-green-50 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <!-- Table Header -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <!-- User ID -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $user->id }}
                                    </td>

                                    <!-- Profile Image -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if($user->profile_picture)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-offset-2 {{ $user->role === 'admin' ? 'ring-blue-500' : 'ring-green-500' }}">
                                                @else
                                                    <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-offset-2 {{ $user->role === 'admin' ? 'ring-blue-500' : 'ring-green-500' }}">
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Name -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </td>

                                    <!-- Email -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </td>

                                    <!-- Role -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button 
                                                onclick="openUserModal(this)"
                                                class="text-gray-500 hover:text-teal-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100"
                                                data-user-id="{{ $user->id }}"
                                                data-user-profile="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}"
                                                data-user-name="{{ $user->name }}"
                                                data-user-email="{{ $user->email }}"
                                                data-user-mobile="{{ $user->mobile_no }}"
                                                data-user-city="{{ $user->city}}"
                                                data-user-state="{{ $user->state }}"
                                                data-user-role="{{ $user->role }}"
                                                data-user-edit-url="{{ route('users.edit', $user->id) }}"
                                                data-user-delete-url="{{ route('users.destroy', $user->id) }}"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7S3.732 16.057 2.458 12z" />
                                                </svg>
                                            </button>
                                            
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-gray-500 hover:text-blue-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors duration-200 p-1 rounded-full hover:bg-gray-100" onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ count($users) }}</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Detail Modal -->
        <div id="userDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen p-4">
                <!-- Modal overlay -->
                <div class="fixed inset-0 bg-black opacity-50" onclick="closeUserModal()"></div>

                <!-- Modal content -->
                <div id="userDetailCard" class="bg-white rounded-xl shadow-xl relative z-10 w-full max-w-md overflow-hidden">
                    <!-- Modal header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">User Details</h3>
                        <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-6">
                            <img id="modalUserProfile" src="" alt="Profile" class="h-16 w-16 rounded-full object-cover ring-2 ring-offset-2 ring-teal-500">
                            <div>
                                <h2 id="modalUserName" class="text-xl font-bold text-gray-800"></h2>
                                <div class="flex items-center mt-1">
                                    <svg class="w-4 h-4 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"></path>
                                    </svg>
                                    <span id="modalUserEmail" class="text-sm text-gray-600"></span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="p-2 rounded-full bg-gray-100 text-gray-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l3 7-2 2a11.05 11.05 0 005 5l2-2 7 3v2a2 2 0 01-2 2C9.163 21 3 14.837 3 7a2 2 0 012-2h2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">PHONE</p>
                                    <p id="modalUserMobile" class="text-sm text-gray-800"></p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2 rounded-full bg-gray-100 text-gray-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">LOCATION</p>
                                    <p class="text-sm text-gray-800">
                                        <span id="modalUserCity"></span>, <span id="modalUserState"></span>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2 rounded-full bg-gray-100 text-gray-600 mr-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11 11 0 0112 15c2.194 0 4.237.57 6.121 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">ROLE</p>
                                    <p id="modalUserRole" class="text-sm font-medium text-gray-800"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="px-6 py-4 border-t border-gray-100 flex justify-end space-x-3">
                        <button onclick="closeUserModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Close
                        </button>
                        <a id="modalUserEditUrl" href="#" class="px-4 py-2 text-sm font-medium text-white bg-teal-600 border border-transparent rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Edit User
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openUserModal(button) {
                var modal = document.getElementById('userDetailModal');

                // Read data attributes
                var userProfile = button.getAttribute('data-user-profile');
                var userName = button.getAttribute('data-user-name');
                var userEmail = button.getAttribute('data-user-email');
                var userMobile = button.getAttribute('data-user-mobile');
                var userCity = button.getAttribute('data-user-city');
                var userState = button.getAttribute('data-user-state');
                var userRole = button.getAttribute('data-user-role');
                var userEditUrl = button.getAttribute('data-user-edit-url');

                // Populate modal
                document.getElementById('modalUserProfile').src = userProfile;
                document.getElementById('modalUserName').innerText = userName;
                document.getElementById('modalUserEmail').innerText = userEmail;
                document.getElementById('modalUserMobile').innerText = userMobile || 'Not provided';
                document.getElementById('modalUserCity').innerText = userCity || 'Not provided';
                document.getElementById('modalUserState').innerText = userState || 'Not provided';
                document.getElementById('modalUserRole').innerText = userRole === 'admin' ? 'Administrator' : 'Regular User';
                document.getElementById('modalUserEditUrl').href = userEditUrl;

                // Show modal
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeUserModal() {
                var modal = document.getElementById('userDetailModal');
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        </script>
    </div>
</x-app-layout>