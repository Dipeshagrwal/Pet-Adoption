<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <style>
            .pet-card {
                transition: all 0.3s ease;
            }

            .pet-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            }

            .banner-bg {
                background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1477884213360-7e9d7dcc1e48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
                background-size: cover;
                background-position: center;
            }

            .filter-dropdown {
                transition: all 0.3s ease;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-800 font-sans">
        <!-- Banner -->
        <section class="relative py-24 text-white banner-bg">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="container mx-auto px-6 relative z-10 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Find Your Perfect <span
                        class="text-primary-300">Furry Friend</span></h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Give a loving home to pets in need. Browse our selection of
                    adorable companions waiting for adoption.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#explore"
                        class="bg-primary-600 hover:bg-primary-700 text-white py-3 px-8 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Browse Pets
                    </a>
                    <a href="{{ route('user.pets.create') }}"
                        class="bg-white hover:bg-gray-100 text-primary-600 py-3 px-8 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        List a Pet
                    </a>
                    <!-- Added Adopted Pets Button -->
                    <a href="{{ route('user.pets.adopted') }}"
                        class="bg-white hover:bg-green-100 text-primary-600 py-3 px-8 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        View Adopted Pets
                    </a>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="container mx-auto py-12 px-4 sm:px-6">
            <section id="explore" class="mt-6">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-800 mb-3">Available Pets</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">Find your perfect companion from our selection of pets
                        looking for their forever homes.</p>
                </div>

                <!-- Enhanced Filter Section -->
                <div class="bg-gradient-to-r from-primary-50 to-secondary-50 rounded-xl shadow-lg p-6 mb-10">
                    <form method="GET" action="{{ route('welcome') }}" class="flex flex-col md:flex-row items-end gap-4">
                        <!-- Search Field -->
                        <div class="relative group flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Search pets..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 shadow-sm hover:shadow-md h-[42px]">
                        </div>

                        <!-- Category Dropdown -->
                        <div class="relative group flex-1 w-full">
                            <select name="category"
                                class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-200 shadow-sm hover:shadow-md h-[42px] text-sm">
                                <option value="">All Categories</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ request('category') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-primary-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Breed Dropdown -->
                        <div class="relative group flex-1 w-full">
                            <select name="breed"
                                class="appearance-none pl-3 pr-8 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white transition-all duration-200 shadow-sm hover:shadow-md h-[42px] text-sm">
                                <option value="">All Breeds</option>
                                @foreach ($breeds as $breed)
                                    <option value="{{ $breed->id }}"
                                        {{ request('breed') == $breed->id ? 'selected' : '' }}>
                                        {{ $breed->breed }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400 group-focus-within:text-primary-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Location Field -->
                        <div class="relative group flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="location" placeholder="Location"
                                value="{{ request('location') }}"
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200 shadow-sm hover:shadow-md h-[42px]">
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2 w-full md:w-auto">
                            <button type="submit"
                                class="bg-gradient-to-r from-primary-600 to-primary-800 hover:from-primary-700 hover:to-primary-900 text-white py-2 px-4 rounded-lg font-medium transition-all duration-300 shadow-md hover:shadow-lg flex items-center text-sm h-[42px]">
                                Apply Filters
                            </button>
                            <a href="{{ route('welcome') }}"
                                class="text-gray-600 hover:text-primary-600 font-medium transition-colors duration-200 flex items-center hover:underline text-sm h-[42px]">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Pet Cards Grid -->
                @if ($approvedPets->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($approvedPets as $pet)
                            <div
                                class="pet-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                                <!-- Image with Status Badge -->
                                <div class="relative h-64 overflow-hidden">
                                    @if ($pet->image)
                                        <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                            {{ $pet->pet_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $pet->pet_status }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Pet Details -->
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-xl font-bold text-gray-800 truncate">{{ $pet->name }}</h4>
                                        <span
                                            class="bg-primary-100 text-primary-800 text-xs px-2 py-1 rounded-full">DOB: {{ \Carbon\Carbon::parse($pet->dob)->format('d-m-Y') }}
                                            </span>
                                    </div>

                                    <p class="text-gray-600 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        {{ $pet->gender }}, {{ $pet->petBreed->breed }}
                                    </p>

                                    <div class="flex items-center text-gray-500 mb-4">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $pet->city }}, {{ $pet->state }}</span>
                                    </div>

                                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                        <a href="{{ route('pets.details', $pet) }}"
                                            class="text-primary-600 hover:text-primary-700 font-medium flex items-center transition-colors duration-200 group-hover:underline">
                                            View Details
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        @if (Auth::check() && Auth::user()->id !== $pet->user_id && $pet->pet_status === 'Available')
                                            <button onclick="openAdoptModal('{{ $pet->id }}')"
                                                class="bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md hover:shadow-lg">
                                                Adopt Me
                                            </button>
                                        @elseif($pet->pet_status === 'Adopted')
                                            <span class="text-sm text-gray-500 font-medium">Already Adopted</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($approvedPets->hasPages())
                        <div class="mt-12">
                            {{ $approvedPets->links('pagination::tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <h3 class="text-2xl font-semibold text-gray-600">No pets found</h3>
                        <p class="text-gray-400 mt-2">Try adjusting your filters or search criteria.</p>
                        <a href="{{ route('welcome') }}"
                            class="inline-block mt-4 bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                            Reset Filters
                        </a>
                    </div>
                @endif
            </section>
        </main>
        @include('layouts.footer')

        <!-- Adoption Form Modal -->
      <div id="adoptModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95 opacity-0"
        id="modalContent">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Adoption Request</h2>
                <button onclick="closeAdoptModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="adoptionForm" action="{{ route('adoption-request.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <input type="hidden" name="pet_id" id="pet_id_input" value="">

                <div class="space-y-4">
                    <div>
                        <label for="adopter_name" class="block text-sm font-medium text-gray-700 mb-1">Your Full Name</label>
                        <input type="text" name="adopter_name" id="adopter_name" placeholder="Enter your full name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                            required>
                        <p id="nameError" class="text-sm text-red-600 mt-1 hidden"></p>
                    </div>

                    <div>
                        <label for="adopter_contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <input type="text" name="adopter_contact" id="adopter_contact" placeholder="Enter your 10-digit mobile number"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200"
                            required>
                        <p id="contactError" class="text-sm text-red-600 mt-1 hidden"></p>
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

            function validateForm() {
        const name = document.getElementById("adopter_name").value.trim();
        const contact = document.getElementById("adopter_contact").value.trim();
        const nameError = document.getElementById("nameError");
        const contactError = document.getElementById("contactError");

        let valid = true;

        // Reset errors
        nameError.classList.add('hidden');
        contactError.classList.add('hidden');
        nameError.textContent = '';
        contactError.textContent = '';

        const nameRegex = /^[a-zA-Z\s]+$/;
        const phoneRegex = /^[6-9]\d{9}$/;

        if (!nameRegex.test(name)) {
            nameError.textContent = "Please enter a valid name (only letters and spaces).";
            nameError.classList.remove('hidden');
            valid = false;
        }

        if (!phoneRegex.test(contact)) {
            contactError.textContent = "Please enter a valid 10-digit mobile number starting with 6-9.";
            contactError.classList.remove('hidden');
            valid = false;
        }

        return valid;
    }
            // Adoption form modal functionality
            function openAdoptModal(petId) {
                const modal = document.getElementById('adoptModal');
                const modalContent = document.getElementById('modalContent');
                const petIdInput = document.getElementById('pet_id_input');

                // Set the pet ID in the hidden input
                petIdInput.value = petId;

                // Show the modal
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeAdoptModal() {
                const modal = document.getElementById('adoptModal');
                const modalContent = document.getElementById('modalContent');

                // Hide the modal with animation
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Reset form
                    document.getElementById('adoptionForm').reset();
                }, 200);
            }

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                const modal = document.getElementById('adoptModal');
                if (e.target === modal) {
                    closeAdoptModal();
                }
            });

            // Breed dropdown population based on selected category
            document.querySelector('[name="category"]').addEventListener('change', function() {
                const typeId = this.value;
                const breedSelect = document.querySelector('[name="breed"]');
                breedSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`/get-breeds/${typeId}`)
                    .then(res => res.json())
                    .then(data => {
                        breedSelect.innerHTML = '<option value="">All Breeds</option>';
                        data.forEach(breed => {
                            breedSelect.innerHTML += `<option value="${breed.id}">${breed.breed}</option>`;
                        });
                    });
            });
        </script>
    </body>

    </html>
</x-app-layout>