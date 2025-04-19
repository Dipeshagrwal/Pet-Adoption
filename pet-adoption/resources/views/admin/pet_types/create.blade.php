<x-app-layout>
    <div class="flex bg-gray-50 min-h-screen">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
            @include('admin.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 md:ml-72 p-6 sm:p-10 transition-all duration-300">
            <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-semibold text-gray-800">Create New Pet Type</h2>
                    <a href="{{ route('pet_types.index') }}"
                        class="inline-flex items-center bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                </div>

                <!-- Form -->
                <form action="{{ route('pet_types.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Pet Type Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:outline-none transition"
                            placeholder="Enter pet type name"
                            required>
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full sm:w-auto bg-teal-600 hover:bg-teal-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all">
                            <i class="fas fa-plus mr-2"></i> Create Pet Type
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
