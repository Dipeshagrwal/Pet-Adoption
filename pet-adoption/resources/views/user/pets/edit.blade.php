<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
            @include('user.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 my-10">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Pet</h1>

                <form action="{{ route('user.pets.update', $pet->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Pet Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $pet->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="dob" class="block text-gray-700 font-medium mb-2">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob', $pet->dob) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>

                    <!-- Pet Type -->
                    <div class="mb-4">
                        <label for="pet_type_id" class="block text-gray-700 font-medium mb-2">Pet Type</label>
                        <select name="pet_type_id" id="pet_type_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                            <option value="">-- Select Pet Type --</option>
                            @foreach($petTypes as $type)
                                <option value="{{ $type->id }}" {{ $pet->pet_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pet Breed -->
                    <div class="mb-4">
                        <label for="pet_breed_id" class="block text-gray-700 font-medium mb-2">Pet Breed</label>
                        <select name="pet_breed_id" id="pet_breed_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                            <option value="">-- Select Pet Breed --</option>
                            @foreach($petBreeds as $breed)
                                <option value="{{ $breed->id }}" {{ $pet->pet_breed_id == $breed->id ? 'selected' : '' }}>{{ $breed->breed }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select name="gender" id="gender" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male" {{ $pet->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $pet->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $pet->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Vaccination Status -->
                    <div class="mb-4">
                        <label for="vaccinated" class="block text-gray-700 font-medium mb-2">Vaccination Status</label>
                        <select name="vaccinated" id="vaccinated" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                            <option value="">-- Select Vaccination Status --</option>
                            <option value="Vaccinated" {{ $pet->vaccinated == 'Vaccinated' ? 'selected' : '' }}>Vaccinated</option>
                            <option value="Not Vaccinated" {{ $pet->vaccinated == 'Not Vaccinated' ? 'selected' : '' }}>Not Vaccinated</option>
                        </select>
                    </div>

                    <!-- Pet Characteristics -->
                    <div class="mb-4">
                        <label for="pet_characteristics" class="block text-gray-700 font-medium mb-2">Pet Characteristics</label>
                        <textarea name="pet_characteristics" id="pet_characteristics" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>{{ old('pet_characteristics', $pet->pet_characteristics) }}</textarea>
                    </div>

                      <div class="mb-4">
                        <label for="state" class="block text-gray-700 font-medium mb-2">State</label>
                        <select name="state_id" id="state" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">-- Select State --</option>
                            @foreach ($states as $state)
    <option value="{{ $state->id }}" {{ (old('state_id', $pet->state_id) == $state->id) ? 'selected' : '' }}>
        {{ $state->name }}
    </option>
@endforeach

                        </select>
                    </div>

                    <!-- City Dropdown -->
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 font-medium mb-2">City</label>
                        <select name="city_id" id="city" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">-- Select City --</option>
                        </select>
                    </div>

                    <!-- State -->
                   

                    <!-- Owner's Name -->
                    <div class="mb-4">
                        <label for="owner_name" class="block text-gray-700 font-medium mb-2">Owner's Name</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $pet->owner_name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="mb-4">
                        <label for="whatsapp_no" class="block text-gray-700 font-medium mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp_no" id="whatsapp_no" value="{{ old('whatsapp_no', $pet->whatsapp_no) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required>{{ old('description', $pet->description) }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium mb-2">Pet Image</label>
                        <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <p class="text-gray-500 text-sm mt-1">Leave blank to keep the current image.</p>
                    </div>

                    <!-- Current Image Display -->
                    @if($pet->image)
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                            <img src="{{ asset('storage/' . $pet->image) }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-lg">
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-200">
                            Update Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        const baseUrl = "{{ url('') }}";

        const stateDropdown = document.getElementById('state');
        const cityDropdown = document.getElementById('city');
        const petTypeDropdown = document.getElementById('pet_type_id');
        const breedDropdown = document.getElementById('pet_breed_id');

        const selectedStateId = "{{ old('state_id', $pet->state_id ?? '') }}";
        const selectedCityId = "{{ old('city_id', $pet->city_id ?? '') }}";
        const selectedTypeId = "{{ old('pet_type_id', $pet->pet_type_id ?? '') }}";
        const selectedBreedId = "{{ old('pet_breed_id', $pet->pet_breed_id ?? '') }}";

        // 🔁 Load cities for selected state (edit page)
        if (selectedStateId) {
            fetch(`${baseUrl}/get-cities/${selectedStateId}`)
                .then(res => res.json())
                .then(data => {
                    cityDropdown.innerHTML = '<option value="">-- Select City --</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        if (city.id == selectedCityId) option.selected = true;
                        cityDropdown.appendChild(option);
                    });
                });
        }

        // 🔁 Load breeds for selected pet type (edit page)
        if (selectedTypeId) {
            fetch(`${baseUrl}/get-breeds/${selectedTypeId}`)
                .then(res => res.json())
                .then(data => {
                    breedDropdown.innerHTML = '<option value="">-- Select Pet Breed --</option>';
                    data.forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed.id;
                        option.textContent = breed.breed;
                        if (breed.id == selectedBreedId) option.selected = true;
                        breedDropdown.appendChild(option);
                    });
                });
        }

        // 🧠 On state change → fetch cities
        stateDropdown.addEventListener('change', function () {
            const stateId = this.value;
            cityDropdown.innerHTML = '<option value="">-- Select City --</option>';

            if (stateId) {
                fetch(`${baseUrl}/get-cities/${stateId}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            cityDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading cities:', error));
            }
        });

        // 🧠 On pet type change → fetch breeds
        petTypeDropdown.addEventListener('change', function () {
            const typeId = this.value;
            breedDropdown.innerHTML = '<option value="">-- Select Pet Breed --</option>';

            if (typeId) {
                fetch(`${baseUrl}/get-breeds/${typeId}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(breed => {
                            const option = document.createElement('option');
                            option.value = breed.id;
                            option.textContent = breed.breed;
                            breedDropdown.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error loading breeds:', error));
            }
        });
    });
</script>

</x-app-layout>
