<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
            @include('admin.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64 p-6">
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 my-10">
                <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Pet</h1>

                <form id="create-pet-form" action="{{ route('admin.pets.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Pet Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter pet name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-4">
                        <label for="dob" class="block text-gray-700 font-medium mb-2">Date of Birth</label>
                        <input type="date" name="dob" id="dob"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                        <p id="dob-error" class="text-red-600 text-sm mt-1"></p>
                    </div>

                    <!-- Pet Type -->
                    <div class="mb-4">
                        <label for="pet_type_id" class="block text-gray-700 font-medium mb-2">Pet Type</label>
                        <select name="pet_type_id" id="pet_type_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                            <option value="">-- Select Pet Type --</option>
                            @foreach ($petTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pet Breed -->
                    <!-- Pet Breed -->
                    <div class="mb-4">
                        <label for="pet_breed_id" class="block text-gray-700 font-medium mb-2">Pet Breed</label>
                        <select name="pet_breed_id" id="pet_breed_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                            <option value="">-- Select Pet Breed --</option>
                        </select>
                    </div>


                    <!-- Gender -->
                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                        <select name="gender" id="gender"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <!-- Vaccination Status -->
                    <div class="mb-4">
                        <label for="vaccinated" class="block text-gray-700 font-medium mb-2">Vaccination Status</label>
                        <select name="vaccinated" id="vaccinated"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                            <option value="">-- Select Vaccination Status --</option>
                            <option value="Vaccinated">Vaccinated</option>
                            <option value="Not Vaccinated">Not Vaccinated</option>
                        </select>
                    </div>

                    <!-- Pet Characteristics -->
                    <div class="mb-4">
                        <label for="pet_characteristics" class="block text-gray-700 font-medium mb-2">Pet
                            Characteristics</label>
                        <textarea name="pet_characteristics" id="pet_characteristics" placeholder="Enter pet characteristics"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required></textarea>
                    </div>

                    <!-- State -->
                    <!-- State Dropdown -->
                    <div class="mb-4">
                        <label for="state" class="block text-gray-700 font-medium mb-2">State</label>
                        <select name="state_id" id="state" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                            <option value="">-- Select State --</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
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


                    <!-- Owner's Name -->
                    <div class="mb-4">
                        <label for="owner_name" class="block text-gray-700 font-medium mb-2">Owner's Name</label>
                        <input type="text" name="owner_name" id="owner_name" placeholder="Enter owner's name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                    </div>

                    <!-- WhatsApp Number -->
                    <div class="mb-4">
                        <label for="whatsapp_no" class="block text-gray-700 font-medium mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp_no" id="whatsapp_no"
                            placeholder="Enter 10-digit WhatsApp number" maxlength="10"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required>
                        <p id="whatsapp-error" class="text-red-600 text-sm mt-1"></p>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" placeholder="Enter pet description"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                            required></textarea>
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium mb-2">Pet Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-teal-600 text-white px-6 py-3 rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-200">
                            Create Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Validation Script -->
    <script>
        const baseUrl = "{{ url('') }}";
        document.getElementById("create-pet-form").addEventListener("submit", function(e) {
            let isValid = true;

            const whatsapp = document.getElementById("whatsapp_no").value.trim();
            const dob = document.getElementById("dob").value;

            const whatsappError = document.getElementById("whatsapp-error");
            const dobError = document.getElementById("dob-error");

            // Clear previous errors
            whatsappError.textContent = "";
            dobError.textContent = "";

            // Validate WhatsApp Number
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(whatsapp)) {
                whatsappError.textContent = "Please enter a valid 10-digit WhatsApp number.";
                isValid = false;
            }

            // Validate DOB
            const today = new Date().toISOString().split('T')[0];
            if (dob > today) {
                dobError.textContent = "Date of Birth cannot be in the future.";
                isValid = false;
            }

            // Prevent form submission if any validation fails
            if (!isValid) {
                e.preventDefault();
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');
            // Base URL of your Laravel app

            stateSelect.addEventListener('change', function() {
                const stateId = this.value;
                citySelect.innerHTML = '<option value="">-- Select City --</option>';

                if (stateId) {
                    fetch(`${baseUrl}/get-cities/${stateId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                option.text = city.name;
                                citySelect.appendChild(option);
                            });
                        })
                        .catch(err => console.error('Error fetching cities:', err));
                }
            });
        });

        const petTypeSelect = document.getElementById('pet_type_id');
        const breedSelect = document.getElementById('pet_breed_id');

        petTypeSelect.addEventListener('change', function() {
            const typeId = this.value;
            breedSelect.innerHTML = '<option value="">-- Select Pet Breed --</option>';

            if (typeId) {
                fetch(`${baseUrl}/get-breeds/${typeId}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(breed => {
                            const option = document.createElement('option');
                            option.value = breed.id;
                            option.text = breed.breed;
                            breedSelect.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error fetching breeds:', err));
            }
        });
    </script>
</x-app-layout>
