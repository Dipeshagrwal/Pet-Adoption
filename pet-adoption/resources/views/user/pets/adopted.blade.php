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
        </style>
    </head>

    <body class="bg-gray-50 text-gray-800 font-sans">
        <!-- Banner -->
        <section class="relative py-24 text-white banner-bg">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="container mx-auto px-6 relative z-10 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Happy <span class="text-green-300">Adopted Pets</span></h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Meet our beloved pets who have found their forever homes.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('welcome') }}"
                        class="bg-primary-600 hover:bg-primary-700 text-white py-3 px-8 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        Browse Available Pets
                    </a>
                    <a href="{{ route('user.pets.create') }}"
                        class="bg-white hover:bg-gray-100 text-primary-600 py-3 px-8 rounded-full font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
                        List a Pet
                    </a>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="container mx-auto py-12 px-4 sm:px-6">
            <section class="mt-6">
                <div class="text-center mb-12">
                    <h3 class="text-3xl font-bold text-gray-800 mb-3">Recently Adopted Pets</h3>
                    <p class="text-gray-600 max-w-2xl mx-auto">These lucky pets have found their loving forever families.</p>
                </div>

                <!-- Adopted Pets Grid -->
                @if ($adoptedPets->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach ($adoptedPets as $pet)
                            <div class="pet-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group">
                                <!-- Image with Adoption Badge -->
                                <div class="relative h-64 overflow-hidden">
                                    @if ($pet->image)
                                        <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm bg-green-100 text-green-800">
                                            Adopted
                                        </span>
                                    </div>
                                </div>

                                <!-- Pet Details -->
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-xl font-bold text-gray-800 truncate">{{ $pet->name }}</h4>
                                        <span class="bg-primary-100 text-primary-800 text-xs px-2 py-1 rounded-full">
                                            DOB: {{ \Carbon\Carbon::parse($pet->dob)->format('d-m-Y') }}
                                        </span>
                                    </div>

                                    <p class="text-gray-600 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        {{ $pet->gender }}, {{ $pet->petBreed->breed }}
                                    </p>

                                    <div class="flex items-center text-gray-500 mb-4">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <span class="text-sm text-green-600 font-medium">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Happy Home Found
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($adoptedPets->hasPages())
                        <div class="mt-12">
                            {{ $adoptedPets->links('pagination::tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="mx-auto h-40 w-40 flex items-center justify-center rounded-full bg-green-50 text-green-400 mb-6">
                            <svg class="h-20 w-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-600">No adopted pets yet</h3>
                        <p class="text-gray-400 mt-2">Check back later to see pets who have found their forever homes.</p>
                        <a href="{{ route('welcome') }}"
                            class="inline-block mt-4 bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                            Browse Available Pets
                        </a>
                    </div>
                @endif
            </section>
        </main>
        @include('layouts.footer')
    </body>

    </html>
</x-app-layout>