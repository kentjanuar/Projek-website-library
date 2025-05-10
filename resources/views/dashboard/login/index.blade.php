@extends('base.base')

@section('container')

<!-- Login Form Component -->
<div class="min-h-screen py-6 flex flex-col justify-center sm:py-12" style="background-image: url('https://img.freepik.com/premium-vector/book-large-book-pattern-white-black_718551-278.jpg'); position: relative;">
    <!-- Transparent Black Overlay -->
    <div class="absolute inset-0 bg-black opacity-80"></div>
    
    <div class="relative py-3 w-2/5 mx-auto">
        <div
            class="absolute inset-0 bg-gradient-to-r from-yellow-500 to-yellow-300 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
        </div>
        <div class="relative px-4 py-10 bg-gray-900 shadow-lg sm:rounded-3xl sm:p-20">

            @if (session()->has('loginError'))
                <div class="flex items-center p-4 mb-4 text-sm text-yellow-300 rounded-lg bg-gray-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Error</span>
                    <div>
                        <span class="font-medium">Login Failed!</span> Check your email and password.
                    </div>
                </div>
            @endif

            <div class="max-w-md mx-auto">
                <div>
                    <h1 class="text-2xl text-center font-semibold text-yellow-300">Login</h1>
                </div>

                <form action="/login" method="post" class="divide-y divide-gray-700">
                    @csrf
                    
                    <div class="py-8 text-base leading-6 space-y-4 text-gray-100 sm:text-lg sm:leading-7">
                        <div class="relative">
                            <input
                                autocomplete="off"
                                id="email"
                                name="email"
                                type="email"
                                class="peer h-12 w-full rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:outline-none focus:border-yellow-500 focus:shadow-md transition placeholder-transparent"
                                placeholder="Email address"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            />
                            <label
                                for="email"
                                class="absolute left-4 -top-3 text-gray-400 text-sm px-1 transition-all duration-200 transform -translate-y-1/2 scale-90 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-6 peer-placeholder-shown:text-gray-500 peer-focus:top-0 peer-focus:bg-gray-900 peer-focus:scale-90 peer-focus:text-yellow-400"
                            >Email Address</label>
                            @error('email')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="relative top-3">
                            <input
                                autocomplete="off"
                                id="password"
                                name="password"
                                type="password"
                                class="peer h-12 w-full rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:outline-none focus:border-yellow-500 focus:shadow-md transition placeholder-transparent"
                                placeholder="Password"
                                required
                            />
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-white transition-colors duration-100">
                                <!-- Default icon -->
                                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                            <label
                                for="password"
                                class="absolute left-4 -top-3 text-gray-400 text-sm px-1 transition-all duration-200 transform -translate-y-1/2 scale-90 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-6 peer-placeholder-shown:text-gray-500 peer-focus:bg-gray-900 peer-focus:top-0 peer-focus:scale-90 peer-focus:text-yellow-400"
                            >Password</label>
                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        <div class="relative">
                            <button type="submit" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 rounded-md px-4 py-2 w-full mt-6 hover:from-yellow-500 hover:to-yellow-600 transform transition duration-300 ease-in-out hover:scale-105 shadow-md font-bold">Login</button>
                        </div>
                        
                        <p class="text-center text-gray-400 mt-4">No account?  
                            <a href="/register" class="text-yellow-400 hover:underline"> Register here</a>.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif

{{-- Password --}}
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const iconEye = document.getElementById('icon-eye');

    togglePassword.addEventListener('click', function () {
        // Ubah tipe input
        const isPassword = passwordField.type === 'password';
        passwordField.type = isPassword ? 'text' : 'password';

        // Ganti ikon
        iconEye.innerHTML = isPassword
            ? `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
               <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />`
            : `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />`;
    });
</script>

@endsection
