<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetAdoption - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                        pet: {
                            100: '#f0f9ff',
                            200: '#e0f2fe',
                            300: '#bae6fd',
                            400: '#7dd3fc',
                            500: '#38bdf8',
                            600: '#0ea5e9',
                            700: '#0284c7',
                            800: '#0369a1',
                            900: '#075985',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .pet-bg {
            background-image: url('https://images.unsplash.com/photo-1586671267731-da2cf3ceeb80?q=80&w=2098&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .shake {
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .error-input {
            border-color: #f87171 !important;
            background-color: #fef2f2;
        }
        .success-input {
            border-color: #34d399 !important;
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
        }
        .error-icon {
            margin-right: 0.25rem;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
           <div class="flex items-center space-x-2">
                <i class="fas fa-paw text-3xl mr-2 text-primary-600"></i>
                <h1 class="text-3xl font-bold text-primary-600">PetAdoption</h1>
            </div>
            <nav class="flex items-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="bg-primary-600 hover:bg-primary-700 text-white py-2 px-5 rounded-full font-medium transition-colors duration-200 shadow-md hover:shadow-lg">
                    Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen bg-gradient-to-br from-teal-50 to-blue-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl transition-all duration-300 hover:shadow-xl">
            <div class="p-8">
                <div class="flex justify-center mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Create Account</h2>
                <p class="text-center text-gray-500 mb-8">Register to start adopting pets</p>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shake">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="block w-full px-4 py-2 border {{ $errors->has('name') ? 'border-red-500 error-input' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                            placeholder="Enter your full name">
                        @if($errors->has('name'))
                            <p class="error-message">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="block w-full px-4 py-2 border {{ $errors->has('email') ? 'border-red-500 error-input' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                            placeholder="you@example.com">
                        @if($errors->has('email'))
                            <p class="error-message">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $errors->first('email') }}
                            </p>
                        @else
                            <p id="emailError" class="error-message hidden">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span id="emailErrorText"></span>
                            </p>
                        @endif
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="block w-full px-4 py-2 border {{ $errors->has('password') ? 'border-red-500 error-input' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="togglePassword" class="far fa-eye text-gray-400 cursor-pointer hover:text-gray-600"></i>
                            </div>
                        </div>
                        @if($errors->has('password'))
                            <p class="error-message">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $errors->first('password') }}
                            </p>
                        @else
                            <div id="passwordRequirements" class="mt-2 text-xs text-gray-500">
                                <p class="flex items-center mb-1">
                                    <span id="lengthReq" class="inline-block w-4 h-4 mr-1 border rounded-full border-gray-400"></span>
                                    At least 8 characters
                                </p>
                                <p class="flex items-center mb-1">
                                    <span id="numberReq" class="inline-block w-4 h-4 mr-1 border rounded-full border-gray-400"></span>
                                    Contains a number
                                </p>
                                <p class="flex items-center">
                                    <span id="specialReq" class="inline-block w-4 h-4 mr-1 border rounded-full border-gray-400"></span>
                                    Contains a special character
                                </p>
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="block w-full px-4 py-2 border {{ $errors->has('password_confirmation') ? 'border-red-500 error-input' : 'border-gray-300' }} rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i id="toggleConfirmPassword" class="far fa-eye text-gray-400 cursor-pointer hover:text-gray-600"></i>
                            </div>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <p class="error-message">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $errors->first('password_confirmation') }}
                            </p>
                        @else
                            <p id="passwordMatchError" class="error-message hidden">
                                <svg class="error-icon h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Passwords do not match
                            </p>
                        @endif
                    </div>

                    <button type="submit" id="submitBtn"
                        class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded shadow-sm transition duration-150 ease-in-out flex justify-center items-center">
                        <span id="btnText">Register</span>
                        <svg id="loadingSpinner" class="hidden animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <p class="text-sm text-center text-gray-500 mt-4">
                        Already registered?
                        <a href="{{ route('login') }}" class="text-teal-600 hover:underline">Sign In</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md mt-10">
        <div class="container mx-auto py-6 px-6 text-center text-gray-700">
            &copy; 2025 PetAdopt. All Rights Reserved.
        </div>
    </footer>

    <!-- Enhanced Validation Script -->
    <script>
        $(document).ready(function() {
            // Password toggle functionality
            $('#togglePassword').click(function() {
                const passwordField = $('#password');
                const icon = $(this);
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Confirm Password toggle functionality
            $('#toggleConfirmPassword').click(function() {
                const confirmField = $('#password_confirmation');
                const icon = $(this);
                if (confirmField.attr('type') === 'password') {
                    confirmField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    confirmField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Real-time email validation
            $('#email').on('blur', function() {
                const email = $(this).val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (email === '') {
                    showEmailError('Email is required');
                } else if (!emailRegex.test(email)) {
                    showEmailError('Please enter a valid email address');
                } else {
                    hideEmailError();
                    checkEmailAvailability(email);
                }
            });

            // Password strength validation
            $('#password').on('keyup', function() {
                const password = $(this).val();
                
                // Check length
                if (password.length >= 8) {
                    $('#lengthReq').removeClass('border-gray-400').addClass('bg-green-500 border-green-500');
                } else {
                    $('#lengthReq').removeClass('bg-green-500 border-green-500').addClass('border-gray-400');
                }
                
                // Check for number
                if (/\d/.test(password)) {
                    $('#numberReq').removeClass('border-gray-400').addClass('bg-green-500 border-green-500');
                } else {
                    $('#numberReq').removeClass('bg-green-500 border-green-500').addClass('border-gray-400');
                }
                
                // Check for special character
                if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    $('#specialReq').removeClass('border-gray-400').addClass('bg-green-500 border-green-500');
                } else {
                    $('#specialReq').removeClass('bg-green-500 border-green-500').addClass('border-gray-400');
                }
            });

            // Confirm password match validation
            $('#password_confirmation').on('keyup', function() {
                const password = $('#password').val();
                const confirmPassword = $(this).val();
                
                if (confirmPassword !== '' && password !== confirmPassword) {
                    showPasswordMatchError();
                } else {
                    hidePasswordMatchError();
                }
            });

            // Form submission validation
            $('#registerForm').on('submit', function(e) {
                let isValid = true;
                
                // Validate name
                if ($('#name').val().trim() === '') {
                    $('#name').addClass('error-input').removeClass('success-input');
                    isValid = false;
                }
                
                // Validate email
                const email = $('#email').val();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === '' || !emailRegex.test(email)) {
                    showEmailError(email === '' ? 'Email is required' : 'Please enter a valid email address');
                    isValid = false;
                }
                
                // Validate password
                const password = $('#password').val();
                if (password.length < 8 || !/\d/.test(password) || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    $('#password').addClass('error-input').removeClass('success-input');
                    isValid = false;
                }
                
                // Validate password match
                if ($('#password_confirmation').val() !== password) {
                    showPasswordMatchError();
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $('.error-input:first').offset().top - 100
                    }, 500);
                    
                    // Shake effect on error
                    $('.error-input').each(function() {
                        $(this).addClass('shake');
                        setTimeout(() => {
                            $(this).removeClass('shake');
                        }, 500);
                    });
                    
                    // Show alert for general errors
                    if ($('.error-input').length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Form Errors',
                            text: 'Please fix the highlighted errors before submitting.',
                            confirmButtonColor: '#14b8a6',
                        });
                    }
                } else {
                    // Show loading spinner
                    $('#btnText').text('Processing...');
                    $('#loadingSpinner').removeClass('hidden');
                    $('#submitBtn').prop('disabled', true);
                }
            });

            function showEmailError(message) {
                $('#email').addClass('error-input').removeClass('success-input');
                $('#emailError').removeClass('hidden');
                $('#emailErrorText').text(message);
            }

            function hideEmailError() {
                $('#email').removeClass('error-input').addClass('success-input');
                $('#emailError').addClass('hidden');
            }

            function showPasswordMatchError() {
                $('#password_confirmation').addClass('error-input').removeClass('success-input');
                $('#passwordMatchError').removeClass('hidden');
            }

            function hidePasswordMatchError() {
                $('#password_confirmation').removeClass('error-input').addClass('success-input');
                $('#passwordMatchError').addClass('hidden');
            }

            function checkEmailAvailability(email) {
                $.ajax({
                    url: "{{ route('check-email') }}",
                    type: "POST",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.exists) {
                            showEmailError('This email is already registered');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus);
                    }
                });
            }
        });
    </script>
    <!-- SweetAlert for beautiful alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>