<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <!-- Back button with improved styling -->
            <div class="mb-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center text-teal-600 hover:text-teal-800 transition-colors duration-200 group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="font-medium">Back to Pets</span>
                </a>
            </div>

            <!-- Pet Details Card - Enhanced with better spacing and shadows -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                <div class="md:flex">
                    <!-- Pet Image Section - Improved with zoom effect -->
                    <div class="md:w-1/2 p-6 md:p-8">
                        <div class="relative overflow-hidden rounded-xl aspect-square">
                            @if ($pet->image)
                                <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex flex-col items-center justify-center p-6">
                                    <svg class="w-16 h-16 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-500 text-sm">No Image Available</span>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                    {{ $pet->pet_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $pet->pet_status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Pet Information Section - Better typography and spacing -->
                    <div class="md:w-1/2 p-6 md:p-8">
                        <div class="flex justify-between items-start mb-1">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $pet->name }}</h1>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold shadow-sm
                                {{ $pet->pet_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $pet->pet_status }}
                            </span>
                        </div>

                        <!-- Tags for pet type and breed -->
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="px-3 py-1 bg-teal-100 text-teal-800 text-xs font-medium rounded-full">
                                {{ $pet->petType->name ?? 'Unknown' }}
                            </span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                {{ $pet->petBreed->breed ?? 'Unknown' }}
                            </span>
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                {{ ucfirst($pet->gender) }}
                            </span>
                        </div>

                        <!-- Basic Info Grid - Improved card-like design -->
                        <div class="mt-8 grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Birth Date</p>
                                <p class="font-semibold text-gray-800">
                                    @if ($pet->dob && $pet->dob instanceof \Carbon\Carbon)
                                        {{ $pet->dob->format('M d, Y') }}
                                    @elseif($pet->dob)
                                        {{ date('M d, Y', strtotime($pet->dob)) }}
                                    @else
                                        Unknown
                                    @endif
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Vaccinated</p>
                                <p class="font-semibold text-gray-800">{{ $pet->vaccinated ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Location</p>
                                <p class="font-semibold text-gray-800">{{ $pet->city }}, {{ $pet->state }}</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Listed On</p>
                                <p class="font-semibold text-gray-800">{{ $pet->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Characteristics Section - Better visual hierarchy -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Characteristics
                            </h3>
                            <div class="mt-3 p-4 bg-gray-50 rounded-lg border border-gray-100">
                                <p class="text-gray-700">
                                    {{ $pet->pet_characteristics ?: 'No characteristics provided' }}</p>
                            </div>
                        </div>

                        <!-- Description Section - Improved readability -->
                        <div class="mt-6">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                                About {{ $pet->name }}
                            </h3>
                            <div class="mt-3 p-4 bg-gray-50 rounded-lg border border-gray-100">
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $pet->description ?: 'No description provided' }}
                                </p>
                            </div>
                        </div>

                        <!-- Owner Info - Better card design -->
                        <div
                            class="mt-8 bg-gradient-to-r from-teal-50 to-blue-50 p-5 rounded-xl border border-teal-100">
                            <h3 class="text-xl font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Owner Information
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Name</p>
                                    <p class="font-semibold text-gray-800">{{ $pet->owner_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider">Contact</p>
                                    <p class="font-semibold text-gray-800">{{ $pet->whatsapp_no }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Adopt Button - More prominent CTA -->
                        @if ($pet->pet_status === 'Available' && (!auth()->check() || auth()->user()->id !== $pet->user_id))
                            <div class="mt-10">
                                <button onclick="openAdoptModal()"
                                    class="w-full bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-700 hover:to-teal-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Adopt {{ $pet->name }}
                                </button>
                            </div>
                        @elseif($pet->pet_status !== 'Available')
                            <div
                                class="mt-8 p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl text-center shadow-inner">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                This pet has already found a loving home
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Adoption Modal - Enhanced with better animations -->
    <div id="adoptModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4 z-50 transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">
                        <svg class="w-6 h-6 inline-block mr-2 text-teal-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Adopt {{ $pet->name }}
                    </h3>
                    <button onclick="closeAdoptModal()"
                        class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('adoption-request.store', $pet) }}" method="POST">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="adopter_name" class="block text-sm font-medium text-gray-700 mb-1">Your Full
                                Name</label>
                            <input type="text" name="adopter_name" id="adopter_name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                                required>
                        </div>

                        <div>
                            <label for="adopter_contact" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                Number</label>
                            <input type="text" name="adopter_contact" id="adopter_contact"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                                required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAdoptModal()"
                            class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-teal-600 to-teal-500 text-white rounded-lg hover:from-teal-700 hover:to-teal-600 transition-all duration-200 font-medium shadow-md">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAdoptModal() {
            const modal = document.getElementById('adoptModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modal.querySelector('div').classList.remove('scale-95');
                modal.querySelector('div').classList.add('scale-100');
            }, 10);
        }

        function closeAdoptModal() {
            const modal = document.getElementById('adoptModal');
            modal.classList.remove('opacity-100');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('adoptModal');
            if (e.target === modal) {
                closeAdoptModal();
            }
        });
    </script>
</x-app-layout>
