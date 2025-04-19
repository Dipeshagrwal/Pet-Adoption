<x-app-layout>
    <!-- Sidebar -->
    <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
        @include('admin.sidebar')
    </div>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 p-4 md:p-8 transition-all duration-300 ease-in-out ml-0 md:ml-64">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Pet Details</h1>
                    <p class="text-gray-600 mt-1">Complete information about {{ $pet->name }}</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mt-4 md:mt-0">
                    <a href="{{ route('admin.pets.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                    <a href="{{ route('admin.pets.edit', $pet) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Pet
                    </a>
                    <form action="{{ route('admin.pets.destroy', $pet) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this pet?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete Pet
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Pet Photo Section -->
                        <div class="space-y-6">
                            <!-- Main Pet Photo -->
                            <div class="bg-gray-50 rounded-lg overflow-hidden border border-gray-200">
                                @if($pet->image)
                                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="w-full h-64 md:h-80 object-cover">
                                @else
                                    <div class="w-full h-64 md:h-80 bg-gray-100 flex flex-col items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="mt-2">No Photo Available</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Status Badges -->
                            <div class="flex flex-wrap gap-3">
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    {{ $pet->status === 'Approved' ? 'bg-green-100 text-green-800' : 
                                       ($pet->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    Status: {{ ucfirst($pet->status) }}
                                </span>
                                <span class="px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                    {{ $pet->pet_status }}
                                </span>
                                @if($pet->vaccinated)
                                    <span class="px-4 py-2 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                                        Vaccinated: {{ $pet->vaccinated }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Pet Information Section -->
                        <div class="space-y-6">
                            <!-- Basic Information Card -->
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Basic Information
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Pet Name</p>
                                        <p class="mt-1 font-semibold">{{ $pet->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Pet Type</p>
                                        <p class="mt-1 font-semibold">{{ $pet->petType->name ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Breed</p>
                                        <p class="mt-1 font-semibold">{{ $pet->petBreed->breed ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Gender</p>
                                        <p class="mt-1 font-semibold">{{ $pet->gender ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                                        <p class="mt-1 font-semibold">{{ $pet->dob ? date('M d, Y', strtotime($pet->dob)) : 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Characteristics</p>
                                        <p class="mt-1 font-semibold">{{ $pet->pet_characteristics ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">City</p>
                                        <p class="mt-1 font-semibold">{{ $pet->city ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">State</p>
                                        <p class="mt-1 font-semibold">{{ $pet->state ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Owner Information Card -->
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Owner Information
                                </h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Owner Name</p>
                                        <p class="mt-1 font-semibold">{{ $pet->owner_name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">WhatsApp Number</p>
                                        <p class="mt-1 font-semibold">{{ $pet->whatsapp_no ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Information Card -->
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Additional Information
                                </h3>
                                
                                @if($pet->description)
                                    <div class="mb-6">
                                        <p class="text-sm font-medium text-gray-500">Description</p>
                                        <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $pet->description }}</p>
                                    </div>
                                @endif
                                
                                @if($pet->rejected_reason)
                                    <div class="mb-6">
                                        <p class="text-sm font-medium text-gray-500">Rejection Reason</p>
                                        <p class="mt-2 text-red-600 whitespace-pre-line">{{ $pet->rejected_reason }}</p>
                                    </div>
                                @endif
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Created At</p>
                                        <p class="mt-1 font-semibold">{{ $pet->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Last Updated</p>
                                        <p class="mt-1 font-semibold">{{ $pet->updated_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin Actions -->
                            @if($pet->status === 'pending')
                                <div class="flex flex-wrap gap-4 mt-6">
                                    <form action="{{ route('admin.pets.approve', $pet) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            Approve Pet
                                        </button>
                                    </form>
                                    <button onclick="openRejectModal()"
                                            class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Reject Pet
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    @if($pet->status === 'pending')
        <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md transform transition-all">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Reject Pet</h3>
                        <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <form action="{{ route('admin.pets.reject', $pet) }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                            <textarea name="rejection_reason" required rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"></textarea>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button type="button" onclick="closeRejectModal()"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Confirm Rejection
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openRejectModal() {
                document.getElementById('rejectModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeRejectModal() {
                document.getElementById('rejectModal').classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        </script>
    @endif
</x-app-layout>