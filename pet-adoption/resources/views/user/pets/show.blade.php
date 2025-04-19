<x-app-layout>
    <div class="bg-gray-100 min-h-screen flex">
        <!-- Fixed Sidebar -->
        <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
            @include('user.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-72">
            <div class="container mx-auto py-8 px-4">
                <!-- Original Back Button -->
                <div class="mb-6">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Pets
                    </a>
                </div>

                <!-- Pet Details Card -->
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="md:flex">
                        <!-- Pet Image -->
                        <div class="md:w-1/2 p-6">
                            @if($pet->image)
                                <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">No Image Available</span>
                                </div>
                            @endif

                            <!-- Status Badges -->
                            <div class="mt-4 flex flex-wrap gap-2">
                                <!-- Approval Status -->
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ strtolower($pet->status) === 'approved' ? 'bg-green-100 text-green-800' : 
                                       (strtolower($pet->status) === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    Status: {{ ucfirst($pet->status) }}
                                </span>
                                
                                <!-- Pet Availability Status -->
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $pet->pet_status === 'Available' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $pet->pet_status }}
                                </span>
                                
                                @if($pet->vaccinated)
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                                        Vaccinated: {{ $pet->vaccinated }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Pet Information -->
                        <div class="md:w-1/2 p-6">
                            <div class="flex justify-between items-start">
                                <h1 class="text-3xl font-bold text-gray-800">{{ $pet->name }}</h1>
                            </div>

                            <!-- Rejection Reason (if rejected) -->
                            @if(strtolower($pet->status) === 'rejected' && $pet->rejected_reason)
                                <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-100">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-red-700">Rejection Reason:</p>
                                            <p class="text-sm text-red-600 mt-1 whitespace-pre-line">{{ $pet->rejected_reason }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Basic Info -->
                            <div class="mt-6 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Type</p>
                                    <p class="font-medium">{{ $pet->petType->name ?? 'Unknown' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Breed</p>
                                    <p class="font-medium">{{ $pet->petBreed->breed ?? 'Unknown' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Gender</p>
                                    <p class="font-medium">{{ ucfirst($pet->gender) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date of Birth</p>
                                    <p class="font-medium">{{ $pet->dob ? date('M d, Y', strtotime($pet->dob)) : 'Unknown' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Vaccinated</p>
                                    <p class="font-medium">{{ $pet->vaccinated ?? 'Unknown' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">{{ $pet->city ?? 'N/A' }}, {{ $pet->state ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <!-- Characteristics -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800">Characteristics</h3>
                                <p class="mt-2 text-gray-600">{{ $pet->pet_characteristics ?? 'Not specified' }}</p>
                            </div>

                            <!-- Description -->
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-800">About</h3>
                                <p class="mt-2 text-gray-600 whitespace-pre-line">{{ $pet->description ?? 'No description available' }}</p>
                            </div>

                            <!-- Action Buttons -->
                            @if(strtolower($pet->status) !== 'adopted')
                                <div class="mt-6 flex flex-wrap gap-3">
                                    <a href="{{ route('user.pets.edit', $pet->id) }}" 
                                       class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow hover:shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit Pet
                                    </a>
                                    <form action="{{ route('user.pets.destroy', $pet->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this pet?')" 
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete Pet
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>