<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - PetAdopt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 h-screen flex items-center justify-center">
    <!-- Main Content -->
    <main class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-3xl font-bold text-teal-600 text-center mb-6">Forgot Password</h2>

            <div class="mb-4 text-sm text-gray-600 text-center">
                {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-500 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" required autofocus class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Enter your email">
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('login') }}" class="underline text-sm text-gray-400 hover:text-gray-900 font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Back to Login') }}
                    </a>

                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white py-2 px-4 rounded">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
