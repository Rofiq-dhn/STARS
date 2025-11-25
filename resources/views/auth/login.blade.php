<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STARS</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Open+Sans:wght@400;600&family=Poppins:wght@400&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .font-opensans {
            font-family: 'Open Sans', sans-serif;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }

        /* Background dengan gambar S pattern */
        .bg-container {
            background-image: url('{{ asset('img/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Dissolve/Fade-in Animation */
        @keyframes dissolveIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .dissolve-in {
            animation: dissolveIn 1s ease-in-out forwards;
        }

        /* Background decoration animation */
        .bg-decoration {
            animation: dissolveIn 1.5s ease-in-out forwards;
        }

        /* Content animation */
        .login-content {
            animation: dissolveIn 1.2s ease-in-out forwards;
        }

        .illustration-image {
            animation: dissolveIn 1.3s ease-in-out forwards;
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <!-- Background Container -->
    <div class="bg-container w-full min-h-screen relative flex items-center justify-center p-4">

        <!-- Overlay untuk membuat background lebih terlihat -->
        <div class="absolute inset-0 bg-white/5 z-0"></div>

        <!-- Logo (Top Right) -->
        <div class="dissolve-in absolute top-6 right-6 md:top-12 md:right-12 sm: z-20">
            <img class="w-48 h-auto md:w-64" src="{{ asset('img/logohorizontal.png') }}" alt="Logo Sekolah"
                onerror="this.style.display='none'" />
        </div>

        <!-- Main Container -->
        <div class="w-full max-w-8xl mx-auto grid grid-cols-1 lg:grid-cols-2 items-center relative z-10">

            <!-- Login Box -->
            <div
                class="login-content w-full max-w-xl mx-auto bg-white rounded-2xl shadow-2xl border border-gray-200 px-8 md:px-14 py-8 md:py-10">

                <!-- Title -->
                <h1 class="text-center text-gray-900 text-4xl md:text-5xl font-bold mb-2">STARS</h1>

                <!-- Subtitle -->
                <p class="text-center text-gray-600 text-sm md:text-base font-semibold font-opensans mb-6">
                    Sistem Tagihan Dan Pembayaran Sekolah
                </p>

                <!-- Login Heading -->
                <h2 class="text-center text-gray-900 text-3xl md:text-4xl font-bold mb-4">Login</h2>

                <!-- Description -->
                <p class="text-center text-gray-600 text-base md:text-lg font-normal font-opensans mb-8">
                    Silahkan masukkan username dan password<br class="hidden sm:block" />untuk melakukan pembayaran.
                </p>

                <!-- Login Form -->
                <form action="{{ route('login.post') }}" method="POST" class="w-full flex flex-col items-center gap-5">
                    @csrf

                    <!-- Username Input -->
                    <div class="w-full">
                        <div
                            class="w-full h-14 md:h-16 px-4 py-2 bg-gray-50 rounded-lg shadow-md border border-gray-300 flex justify-between items-center focus-within:ring-2 focus-within:ring-red-500 focus-within:border-red-500 transition-all">
                            <input type="text" id="username" name="username" value="{{ old('username') }}"
                                placeholder="Username" required autofocus autocomplete="username"
                                class="flex-1 bg-transparent text-gray-900 text-lg md:text-xl font-normal font-poppins outline-none placeholder-gray-400">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-500 flex-shrink-0 ml-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        @error('username')
                            <div class="w-full text-red-600 text-sm mt-1 px-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="w-full">
                        <div
                            class="w-full h-14 md:h-16 px-4 py-2 bg-gray-50 rounded-lg shadow-md border border-gray-300 flex justify-between items-center focus-within:ring-2 focus-within:ring-red-500 focus-within:border-red-500 transition-all">
                            <input type="password" id="password" name="password" placeholder="Password" required
                                autocomplete="current-password"
                                class="flex-1 bg-transparent text-gray-900 text-lg md:text-xl font-normal font-poppins outline-none placeholder-gray-400">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-gray-500 flex-shrink-0 ml-2 cursor-pointer hover:text-gray-700 transition-colors" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" id="togglePassword">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </div>
                        @error('password')
                            <div class="w-full text-red-600 text-sm mt-1 px-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-red-500 bg-white rounded border-gray-300 focus:ring-red-500 cursor-pointer">
                            <span class="text-gray-700 text-sm md:text-base font-normal">Remember Me</span>
                        </label>
                        <a href="#"
                            class="text-red-500 text-sm md:text-base font-normal font-opensans hover:text-red-600 hover:underline transition-colors">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full sm:w-44 h-12 md:h-14 px-6 bg-red-500 rounded-lg shadow-lg hover:shadow-xl hover:bg-red-600 active:scale-95 transition-all duration-200">
                        <span class="text-white text-xl md:text-2xl font-bold">Login</span>
                    </button>

                    <!-- Register Link -->
                    <div class="text-center mt-2">
                        <span class="text-gray-700 text-sm md:text-base font-normal font-opensans">Tidak Memiliki akun?
                        </span>
                        <a href="#"
                            class="text-indigo-600 text-sm md:text-base font-semibold font-opensans hover:text-indigo-700 hover:underline transition-colors">
                            Daftar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Illustration (Hidden on mobile) -->
            <div class="illustration-image hidden lg:flex justify-center items-center">
                <img class="w-full max-w-lg h-auto drop-shadow-2xl" src="{{ asset('img/Hero.png') }}"
                    alt="Illustration" />
            </div>
        </div>
    </div>

    <script>
        // Ensure animations start when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.dissolve-in, .login-content, .illustration-image');
            elements.forEach(el => {
                el.style.opacity = '0';
                setTimeout(() => {
                    el.classList.add('dissolve-in');
                }, 50);
            });
        });

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Change SVG path for eye open/closed
            if (type === 'text') {
                // Mata terbuka (password ditampilkan)
                togglePassword.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            } else {
                // Mata tertutup/tercoreng (password tersembunyi)
                togglePassword.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
            }
        });
    </script>
</body>

</html>
