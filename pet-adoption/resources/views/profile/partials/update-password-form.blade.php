<section class="bg-white shadow-md rounded-lg p-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password Input -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700">
                {{ __('Current Password') }}
            </label>
            <input id="update_password_current_password" name="current_password" type="password" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                autocomplete="current-password" />
            @error('current_password')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- New Password Input -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700">
                {{ __('New Password') }}
            </label>
            <input id="update_password_password" name="password" type="password" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                autocomplete="new-password" />
            @error('password')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password Confirmation Input -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700">
                {{ __('Confirm Password') }}
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                autocomplete="new-password" />
            @error('password_confirmation')
                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit" 
                class="px-4 py-2 bg-teal-600 text-white font-medium text-sm rounded-md shadow-sm hover:bg-teal-700 focus:ring focus:ring-teal-500">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition 
                   x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
