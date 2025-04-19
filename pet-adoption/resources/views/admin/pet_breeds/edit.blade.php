<x-app-layout>
    <div class="flex bg-gray-150 min-h-screen">
       <div class="fixed top-0 left-0 h-full z-40 md:z-auto">
            @include('admin.sidebar')
        </div>
        <div class="flex-1 ml-64 p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pet Breed</h2>
            
            <div class="mb-4">
                <a href="{{ route('pet_breeds.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back</a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6">
                <form action="{{ route('pet_breeds.update', $petBreed->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="pet_type_id" class="block text-gray-700 font-medium mb-2">Pet Type</label>
                        <select name="pet_type_id" id="pet_type_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                            <option value="">Select Pet Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == $petBreed->pet_type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('pet_type_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="breed" class="block text-gray-700 font-medium mb-2">Breed Name</label>
                        <input type="text" name="breed" id="breed" value="{{ old('breed', $petBreed->breed) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
                        @error('breed')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-teal-600 text-white px-6 py-3 rounded-md">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>