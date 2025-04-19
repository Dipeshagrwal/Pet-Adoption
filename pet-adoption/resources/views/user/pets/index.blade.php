<x-app-layout>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
            @include('user.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-0 md:ml-72 p-4 md:p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header with Add New Pet Button -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Your Pets</h1>
                        <p class="text-gray-500 mt-1">Manage all your pet listings</p>
                    </div>
                    <a href="{{ route('user.pets.create') }}" 
                       class="mt-4 md:mt-0 flex items-center bg-teal-600 hover:bg-teal-700 text-white px-5 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add New Pet
                    </a>
                </div>

                <!-- Pet Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($pets as $pet)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all overflow-hidden">
                            <!-- Pet Image with Status Badge -->
                            <div class="relative w-full h-56 bg-gray-100 overflow-hidden">
                                @if($pet->image)
                                    <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1 text-xs font-semibold text-white rounded-full shadow
                                        {{ strtolower($pet->status) === 'approved' ? 'bg-green-500' : 
                                           (strtolower($pet->status) === 'pending' ? 'bg-yellow-500' : 
                                           (strtolower($pet->status) === 'adopted' ? 'bg-purple-500' : 'bg-red-500')) }}">
                                        {{ ucfirst($pet->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Pet Details -->
                            <div class="p-5">
                                <!-- Pet Name and Type -->
                                <div class="mb-4">
                                    <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $pet->name }}</h2>
                                    <p class="text-gray-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $pet->petType->name ?? 'Unknown' }}
                                    </p>
                                </div>

                                <!-- Rejection Reason (if rejected) - Improved from admin panel -->
                                @if(strtolower($pet->status) === 'rejected' && $pet->rejected_reason)
                                    <div class="mb-4 p-3 bg-red-50 rounded-lg border border-red-100">
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

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <!-- Always show View button -->
                                    <a href="{{ route('user.pets.show', $pet) }}" 
                                       class="flex-1 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow hover:shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>

                                    <!-- Only show Edit/Delete if not Adopted -->
                                    @if(strtolower($pet->status) !== 'adopted')
                                        <a href="{{ route('user.pets.edit', $pet->id) }}" 
                                           class="flex-1 flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow hover:shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('user.pets.destroy', $pet->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this pet?')" 
                                              class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow hover:shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="col-span-full py-12 text-center">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-700">No pets found</h3>
                            <p class="text-gray-500 mt-2 max-w-md mx-auto">You haven't added any pets yet. Click the button above to add your first pet!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($pets->hasPages())
                    <div class="mt-8">
                        {{ $pets->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>