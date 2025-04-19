<x-app-layout>

    <!-- Fixed Sidebar -->
    <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
        @include('admin.sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-72">
        <!-- Top Header -->
        <div class="bg-gray-150 shadow-sm">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Pending Pet Requests</h2>
                </div>

                <!-- Status Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    <!-- Total Requests Card -->
                    <div
                        class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-teal-400">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Total Requests</p>
                                <p class="text-3xl font-bold text-gray-800">{{ $totalPets }}</p>
                            </div>
                            <div class="bg-teal-100 rounded-full p-3 group-hover:bg-teal-200">
                                <i class="fas fa-paw text-teal-600 text-2xl group-hover:text-teal-700"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card -->
                    <div
                        class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-yellow-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Pending</p>
                                <p class="text-3xl font-bold text-yellow-600">{{ $pendingCount }}</p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-3 group-hover:bg-yellow-200">
                                <i class="fas fa-clock text-yellow-600 text-2xl group-hover:text-yellow-700"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Approved Requests Card -->
                    <div
                        class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-green-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Approved</p>
                                <p class="text-3xl font-bold text-green-600">{{ $approvedCount }}</p>
                            </div>
                            <div class="bg-green-100 rounded-full p-3 group-hover:bg-green-200">
                                <i class="fas fa-check-circle text-green-600 text-2xl group-hover:text-green-700"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Requests Card -->
                    <div
                        class="bg-white rounded-lg shadow-lg transition-transform transform hover:scale-105 p-5 border border-gray-200 hover:shadow-2xl hover:border-red-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-500">Rejected</p>
                                <p class="text-3xl font-bold text-red-600">{{ $rejectedCount }}</p>
                            </div>
                            <div class="bg-red-100 rounded-full p-3 group-hover:bg-red-200">
                                <i class="fas fa-times-circle text-red-600 text-2xl group-hover:text-red-700"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tabs -->
        {{-- <div class="p-6">
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('admin.pets.pending') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white">
                        All Requests
                    </a>
                </div> --}}

        @if ($pendingPets->isEmpty())
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="flex flex-col items-center">
                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xl font-medium text-gray-600">No pet requests found</p>
                    <p class="text-gray-400 mt-2">There are currently no pet requests to display</p>
                </div>
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($pendingPets as $pet)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                                <!-- Left Side: Pet Details -->
                                <div class="flex items-center space-x-4 flex-1">
                                    @if ($pet->image)
                                        <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}"
                                            class="h-20 w-20 rounded-lg object-cover">
                                    @else
                                        <p class="text-gray-500">No image available</p>
                                    @endif
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $pet->name }}</h3>
                                        <p class="text-gray-600">Owner: {{ $pet->owner_name }}</p>
                                        <p class="text-gray-600">Type: {{ $pet->petType->name }}</p>
                                        <p class="text-gray-600">Submitted: {{ $pet->created_at->diffForHumans() }}</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize
                                                    {{ strtolower($pet->status) === 'approved'
                                                        ? 'bg-green-100 text-green-800'
                                                        : (strtolower($pet->status) === 'pending'
                                                            ? 'bg-yellow-100 text-yellow-800'
                                                            : 'bg-red-100 text-red-800') }}">
                                            {{ $pet->status }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Right Side: Approve/Reject Buttons -->
                                @if (strtolower($pet->status) == 'pending')
                                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                                        <form action="{{ route('admin.pets.approve', $pet->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
                                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Approve
                                            </button>
                                        </form>
                                        <button onclick="openRejectModal({{ $pet->id }})"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
                                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Reject
                                        </button>
                                    </div>
                                @endif
                            </div>
                            @if (strtolower($pet->status) == 'rejected' && $pet->rejection_reason)
                                <div class="mt-4 p-4 bg-red-50 rounded-md">
                                    <p class="text-red-700 font-medium">Rejection Reason:</p>
                                    <p class="text-red-600">{{ $pet->rejection_reason }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $pendingPets->links() }}
            </div>
        @endif
    </div>
    </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white rounded-xl shadow-xl w-96 mx-auto mt-20 p-6">
            <h3 class="text-xl font-bold mb-4">Reject Pet Request</h3>
            <form id="rejectForm" method="POST" action="">
                @csrf
                <input type="hidden" name="pet_id" id="pet_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                    <textarea name="rejection_reason" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" rows="4"
                        placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition duration-150">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-150">
                        Reject Request
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openRejectModal(petId) {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('pet_id').value = petId;
            document.getElementById('rejectForm').action = `/admin/pets/${petId}/reject`;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
