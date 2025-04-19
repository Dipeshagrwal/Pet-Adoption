<x-app-layout>
    <div class="flex flex-col bg-gray-50 min-h-screen">
        <!-- Main Content Area -->
        <div class="flex flex-1 overflow-hidden">
            <!-- Sidebar - Fixed on left -->
            <div class="w-40 bg-white shadow-lg fixed h-full hidden md:block">
                @include('user.sidebar')
            </div>

            <!-- Main Content - Adjusted for sidebar -->
            <div class="flex-1 md:ml-72 overflow-y-auto min-h-screen">
                <div class="p-6">
                    <!-- Dashboard Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">Your Pet Adoption Dashboard</h1>
                        <p class="text-gray-600 mt-2">Welcome back, {{ Auth::user()->name }}! Here's your pet adoption overview.</p>
                        
                        <!-- Quick Actions -->
                        <div class="flex flex-wrap gap-3 mt-4">
                            <a href="{{ route('user.pets.create') }}" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New Pet
                            </a>
                            <a href="{{ route('user.pets.index') }}" class="flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                View Your Pets
                            </a>
                            <a href="{{ route('adoption-request.index') }}" class="flex items-center bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                Your Adoption Requests
                            </a>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Total Pets Added -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-blue-500 group transform hover:-translate-y-1 transition-transform">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Your Pets</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_pets'] }}</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-0.5 rounded">{{ $stats['approved_pets'] }} approved</span>
                                <span class="text-xs text-gray-500 ml-2">{{ $stats['pending_pets'] }} pending</span>
                            </div>
                        </div>

                        <!-- Adopted Pets -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-green-500 group transform hover:-translate-y-1 transition-transform">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Adopted Pets</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['adopted_pets'] }}</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full group-hover:bg-green-200 transition-colors">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $stats['adoption_rate'] }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ $stats['adoption_rate'] }}% adoption rate</p>
                            </div>
                        </div>

                        <!-- Adoption Requests -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-yellow-500 group transform hover:-translate-y-1 transition-transform">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Adoption Requests</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_requests'] }}</p>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full group-hover:bg-yellow-200 transition-colors">
                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center space-x-2">
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-0.5 rounded">{{ $stats['approved_requests'] }} approved</span>
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-0.5 rounded">{{ $stats['pending_requests'] }} pending</span>
                            </div>
                        </div>

                        <!-- Pets Available -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 border-l-4 border-purple-500 group transform hover:-translate-y-1 transition-transform">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Available Pets</p>
                                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['available_pets'] }}</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full group-hover:bg-purple-200 transition-colors">
                                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">{{ $stats['available_percentage'] }}% of your pets</p>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Pet Types Distribution -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Your Pets by Type</h3>
                                    <p class="text-sm text-gray-500">Breakdown of your pets by animal type</p>
                                </div>
                            </div>
                            <div class="h-64">
                                <canvas id="petTypesChart"></canvas>
                            </div>
                        </div>

                        <!-- Adoption Status -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Adoption Status</h3>
                                    <p class="text-sm text-gray-500">Current status of your pets</p>
                                </div>
                            </div>
                            <div class="h-64">
                                <canvas id="adoptionStatusChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities & Pending Requests -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Recent Activities -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
                                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</button>
                            </div>
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
                                <div class="flex items-start p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                    <div class="flex-shrink-0 mr-3 mt-1">
                                        <div class="w-8 h-8 rounded-full bg-{{ $activity['color'] }}-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-{{ $activity['color'] }}-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800">{{ $activity['description'] }}</p>
                                        <div class="flex items-center mt-1">
                                            <span class="text-xs text-gray-500">{{ $activity['time'] }}</span>
                                            @if($activity['status'] ?? false)
                                            <span class="ml-2 text-xs px-1.5 py-0.5 rounded bg-{{ $activity['statusColor'] }}-100 text-{{ $activity['statusColor'] }}-800">{{ $activity['status'] }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pending Adoption Requests -->
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Pending Requests</h3>
                                <a href="{{ route('adoption-request.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All</a>
                            </div>
                            <div class="space-y-4">
                                @forelse($pendingRequests as $request)
                                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $request->adopter_name }}</h4>
                                            <p class="text-sm text-gray-600">Wants to adopt {{ $request->pet->name }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $request->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <form action="{{ route('adoption-request.update', $request) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit" class="text-green-600 hover:text-green-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('adoption-request.update', $request) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="Rejected">
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-500">No pending adoption requests</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pet Types Chart
        @if(isset($userPets) && isset($petTypes))
        const petTypesCtx = document.getElementById('petTypesChart').getContext('2d');
        const petTypesChart = new Chart(petTypesCtx, {
            type: 'doughnut',
            data: {
                labels: @json($petTypes->pluck('name')),
                datasets: [{
                    data: @json($petTypes->map(function($type) use ($userPets) {
                        return $userPets->where('pet_type_id', $type->id)->count();
                    })),
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                    ],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                }
            }
        });
        @else
        console.error("Chart data unavailable — userPets or petTypes is not set.");
        @endif
        
        // Adoption Status Chart
        const adoptionStatusCtx = document.getElementById('adoptionStatusChart').getContext('2d');
        const adoptionStatusChart = new Chart(adoptionStatusCtx, {
            type: 'bar',
            data: {
                labels: ['Available', 'Adopted', 'Pending'],
                datasets: [{
                    label: 'Pets',
                    data: [
                        {{ $stats['available_pets'] }},
                        {{ $stats['adopted_pets'] }},
                        {{ $stats['pending_pets'] }}
                    ],
                    backgroundColor: [
                        '#3B82F6', '#10B981', '#F59E0B'
                    ],
                    borderWidth: 0,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>