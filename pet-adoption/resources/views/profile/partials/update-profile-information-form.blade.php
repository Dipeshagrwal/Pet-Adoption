<section class="bg-white shadow-md rounded-lg p-6">
    <header class="border-b pb-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __("Update your account's profile information, email, and additional details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                {{ __('Name') }} <span class="text-red-500">*</span>
            </label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500" />
            @error('name')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                {{ __('Email') }} <span class="text-red-500">*</span>
            </label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500" />
            @error('email')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-4 text-sm text-gray-800">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="underline text-sm text-teal-600 hover:text-teal-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="mobile_no" class="block text-sm font-medium text-gray-700">
                {{ __('Mobile No') }} <span class="text-red-500">*</span>
            </label>
            <input id="mobile_no" name="mobile_no" type="text" value="{{ old('mobile_no', $user->mobile_no) }}" required
                pattern="\d{10}" maxlength="10" inputmode="numeric" placeholder="Enter 10-digit mobile number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500" />
            @error('mobile_no')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="state" class="block text-sm font-medium text-gray-700">
                {{ __('State') }}
            </label>
            <select id="state" name="state_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="">Select State</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ old('state_id', $user->state_id) == $state->id ? 'selected' : '' }}>
                        {{ $state->name }}
                    </option>
                @endforeach
            </select>
            @error('state_id')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="city" class="block text-sm font-medium text-gray-700">
                {{ __('City') }}
            </label>
            <select id="city" name="city_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="">Select City</option>
            </select>
            @error('city_id')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="profile_picture" class="block text-sm font-medium text-gray-700">
                {{ __('Profile Picture') }}
            </label>
            @if ($user->profile_picture)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-24 h-24 rounded-full object-cover">
                </div>
            @endif
            <input id="profile_picture" name="profile_picture" type="file" accept="image/*"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500" />
            @error('profile_picture')
                <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
            @enderror
        </div>

        @if ($user->profile_picture)
            <div class="mt-2">
                <label for="remove_profile_picture" class="inline-flex items-center">
                    <input id="remove_profile_picture" name="remove_profile_picture" type="checkbox" value="1"
                        class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500">
                    <span class="ml-2 text-sm text-gray-700">{{ __('Remove current profile picture') }}</span>
                </label>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="submit"
                class="px-4 py-2 bg-teal-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-teal-700 focus:ring focus:ring-teal-500">
                {{ __('Save') }}
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const stateDropdown = document.getElementById('state');
    const cityDropdown = document.getElementById('city');
    const baseUrl = "{{ url('') }}"; // Ensures correct full URL

    stateDropdown.addEventListener('change', function () {
        const stateId = this.value;
        cityDropdown.innerHTML = '<option value="">Select City</option>';

        if (stateId) {
            fetch(`${baseUrl}/get-cities/${stateId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.text = city.name;
                        cityDropdown.add(option);
                    });
                })
                .catch(err => console.error("Failed to load cities:", err));
        }
    });

    // For preloading cities when editing existing profile
    const oldCityId = "{{ old('city_id', $user->city_id) }}";
    const selectedStateId = "{{ old('state_id', $user->state_id) }}";
    if (selectedStateId) {
        fetch(`${baseUrl}/get-cities/${selectedStateId}`)
            .then(res => res.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.text = city.name;
                    if (city.id == oldCityId) {
                        option.selected = true;
                    }
                    cityDropdown.add(option);
                });
            });
    }
});
</script>
