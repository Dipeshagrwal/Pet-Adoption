<x-app-layout>

        <main class="min-h-screen bg-gray-100 py-12">
            <!-- Conditional Sidebar -->
            @if (Auth::user()->role === 'admin')
                <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
                    @include('admin.sidebar')
                </div>
            @else
                <div class="w-64 bg-white shadow-lg fixed h-full hidden md:block">
                    @include('user.sidebar')
                </div>
            @endif

            <!-- Light background for content -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ml-0 md:ml-64">
                <!-- Added margin to account for sidebar -->
                <!-- Update Profile Information -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Update Profile Information
                        </h3>
                        <p class="text-sm text-gray-600">
                            Keep your profile information up to date.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Update Password
                        </h3>
                        <p class="text-sm text-gray-600">
                            Change your password to ensure account security.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Delete Account
                        </h3>
                        <p class="text-sm text-gray-600">
                            Permanently delete your account and all associated data.
                        </p>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </main>
    
</x-app-layout>
