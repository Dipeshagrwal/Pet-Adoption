<x-app-layout>
    <div class="flex bg-gray-100 min-h-screen">
        <!-- Sidebar -->
        <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
            @include('admin.sidebar')
        </div>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 md:ml-72 p-6 transition-all duration-300 ease-in-out">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Manage Pet Breeds</h2>
                    <div class="flex gap-3">
                        <a href="{{ route('pet_breeds.create') }}"
                           class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                            <i class="fas fa-plus mr-2"></i> Add New Breed
                        </a>
                        <a href="{{ route('pet_breeds.export_pdf') }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                            <i class="fas fa-file-pdf mr-2"></i> Export PDF
                        </a>
                    </div>
                </div>

                <!-- Success Alert -->
                @if(session('success'))
                    <div id="success-alert" class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Filter Form -->
                <form method="GET" action="{{ route('pet_breeds.index') }}" class="bg-white p-6 rounded-lg shadow flex flex-wrap gap-4 items-end mb-6">
                    <div class="flex flex-col w-full sm:w-auto">
                        <label class="text-sm font-medium text-gray-600 mb-1">Search by Breed</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="px-4 py-2 border border-gray-300 rounded-md w-60 focus:ring-teal-500 focus:border-teal-500"
                               placeholder="e.g., Labrador">
                    </div>

                    <div class="flex flex-col w-full sm:w-auto">
                        <label class="text-sm font-medium text-gray-600 mb-1">Filter by Pet Type</label>
                        <select name="pet_type_id" class="px-4 py-2 border border-gray-300 rounded-md w-60 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">All Types</option>
                            @foreach($petTypes as $type)
                                <option value="{{ $type->id }}" {{ request('pet_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2 mt-2 sm:mt-7">
                        <button type="submit"
                                class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2 rounded-md shadow">
                            Filter
                        </button>
                        <a href="{{ route('pet_breeds.index') }}"
                           class="text-sm text-teal-600 hover:underline transition">
                            Reset
                        </a>
                    </div>
                </form>

                <!-- Results Summary -->
                <p class="text-sm text-gray-600 mb-2">
                    Showing <strong>{{ $breeds->firstItem() }}</strong> to <strong>{{ $breeds->lastItem() }}</strong> of <strong>{{ $breeds->total() }}</strong> results
                </p>

                <!-- Table -->
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full bg-white divide-y divide-gray-200">
                        <thead class="bg-teal-600 text-white text-left text-sm uppercase font-semibold tracking-wider">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Breed</th>
                                <th class="px-6 py-3">Pet Type</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($breeds as $breed)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 font-medium text-gray-700">{{ $breed->id }}</td>
                                    <td class="px-6 py-3 text-gray-700">{{ $breed->breed }}</td>
                                    <td class="px-6 py-3 text-gray-700">{{ $breed->petType->name }}</td>
                                    <td class="px-6 py-3 flex items-center space-x-4">
                                        <a href="{{ route('pet_breeds.edit', $breed->id) }}"
                                           class="text-teal-600 hover:text-teal-800 transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pet_breeds.destroy', $breed->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-800 transition"
                                                    onclick="return confirm('Are you sure you want to delete this breed?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center px-6 py-4 text-gray-500">No breeds found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $breeds->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) alert.style.display = 'none';
        }, 3000);
    </script>
</x-app-layout>
