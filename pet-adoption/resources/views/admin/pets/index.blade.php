<x-app-layout>
    
        <!-- Fixed Sidebar -->
        <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
            @include('admin.sidebar')
        </div>
        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Header -->
            <div class="bg-gray-150 shadow-sm">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800">Pet Management</h2>
                        <a href="{{ route('admin.pets.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-b from-teal-500 to-teal-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add New Pet
                        </a>
                    </div>

                    <!-- Status Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                        <!-- Total Pets Card -->
                        <div class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-teal-400">
                            <a href="/admin/pets" class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Total Pets</p>
                                    <p class="text-3xl font-bold text-gray-800"></p>
                                </div>
                                <div class="bg-teal-100 rounded-full p-3">
                                   <i class="fas fa-paw text-teal-600 text-2xl"></i>
                                </div>
                            </a>
                        </div>

                        <!-- Approved Pets Card -->
                        <div class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-green-400">
                            <a href="{{ route('admin.pets.index', ['status' => 'approved']) }}" class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Approved</p>
                                    <p class="text-3xl font-bold text-green-600">{{ $approvedCount }}</p>
                                </div>
                                <div class="bg-green-100 rounded-full p-3">
                                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                                </div>
                            </a>
                        </div>

                        <!-- Pending Pets Card -->
                        <div class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-yellow-400">
                            <a href="{{ route('admin.pets.index', ['status' => 'pending']) }}" class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Pending</p>
                                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingCount }}</p>
                                </div>
                                <div class="bg-yellow-100 rounded-full p-3">
                                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                                </div>
                            </a>
                        </div>

                        <!-- Rejected Pets Card -->
                        <div class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-red-400">
                            <a href="{{ route('admin.pets.index', ['status' => 'rejected']) }}" class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500">Rejected</p>
                                    <p class="text-3xl font-bold text-red-600">{{ $rejectedCount }}</p>
                                </div>
                                <div class="bg-red-100 rounded-full p-3">
                                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-6">
                <!-- Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-teal-600 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Photo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Added By</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold uppercase tracking-wider">View</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pets as $pet)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        #{{ $pet->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($pet->image)
                                            <img src="{{ asset('storage/' .$pet->image) }}"
                                                 alt="{{ $pet->name }}"
                                                 class="h-12 w-12 rounded-full object-cover">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $pet->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-b from-teal-500 to-teal-600 text-white">
                                            {{ $pet->created_by_admin ? 'Admin' : ($pet->user ? $pet->user->name : 'User Deleted') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('admin.pets.show', $pet) }}"
                                           class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-gradient-to-b from-teal-500 to-teal-600 hover:bg-teal-600 transition-colors duration-200">
                                            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">No pets found</p>
                                            <p class="text-gray-400 text-sm mt-1">Try adjusting your filters</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $pets->links() }}
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</x-app-layout>