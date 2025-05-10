@extends('base.base')

@section('container')

<div class="bg-black dark:bg-gray-900" style="background-image: url('https://img.freepik.com/premium-vector/book-large-book-pattern-white-black_718551-278.jpg'); position: relative;"> 

    <div class="absolute inset-0 bg-black opacity-80"></div> 

    <!-- Container -->
    <div class="mx-auto relative">
        <div class="flex justify-center py-24 ">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-gray-400 dark:bg-gray-800 hidden lg:block lg:w-5/12 bg-cover rounded-l-lg"
                    style="background-image: url('https://d4804za1f1gw.cloudfront.net/wp-content/uploads/sites/50/2018/11/06110356/hero.jpg')" ></div>
                <!-- Col -->
                <div class="w-full lg:w-7/12 bg-gray-900 dark:bg-gray-700 p-5 rounded-lg lg:rounded-l-none">
                    <h3 class="py-4 text-2xl text-center font-bold text-yellow-300">Create an Account!</h3>
                    <form class="px-8 pt-6 pb-2 mb-4 bg-gray-900 dark:bg-gray-800 rounded" action="/register" method="post">
                        @csrf

                        <div class="flex row">
                            <div class="mb-4 md:flex flex-1 md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="name">
                                        Name
                                    </label>
                                    <input
                                        class="w-full pr-9 py-2 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                        id="name" name="name" type="text" placeholder="Name" required value="{{ old('name') }}" autofocus />
                                    @error('name')
                                        <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="username">
                                        Username
                                    </label>
                                    <input
                                        class="w-full pr-9 py-2 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                        id="username" name="username" type="text" placeholder="Username" value="{{ old('username') }}" required />
                                    @error('username')
                                        <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="email">
                                Email
                            </label>
                            <input
                                class="w-full px-3 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                id="email" name="email" type="email" placeholder="name@example.com" value="{{ old('email') }}" required />
                            @error('email')
                                 <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex row">
                            <div class="mb-4 mr-4 flex-1">
                                <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="alamat">
                                    Address
                                </label>
                                <input
                                    class="w-full px-3 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                    id="alamat" name="alamat" type="text" placeholder="Your address" value="{{ old('alamat') }}" required />
                                @error('alamat')
                                    <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="phone">
                                    Phone (10-15 numbers)
                                </label>
                                <input
                                    class="w-full px-3 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                    id="phone" name="phone" type="tel" placeholder="Your phone number" value="{{ old('phone') }}" required />
                                @error('phone')
                                    <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-yellow-300 dark:text-yellow-500" for="password">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    class="w-[315px] mb-5 rounded-lg px-4 border border-gray-600 bg-gray-800 shadow-sm text-white focus:border-white"
                                    id="password" name="password" type="password" placeholder="Your password" required />
                                    
                                    <button type="button" id="togglePassword" class="absolute left-60 top-1/2 transform -translate-y-7 translate-x-9 mt-1.5 text-gray-500 hover:text-white transition-colors duration-100">
                                        <!-- Default icon -->
                                        <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>

                            </div>
                            @error('password')
                                <p class="text-yellow-500 italic text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6 text-center">
                            <button
                                class="w-full px-4 py-2 font-bold text-black bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 rounded-full transition duration-300 ease-in-out transform hover:scale-105 shadow-lg"
                                type="submit">
                                Register Account
                            </button>
                        </div>

                        <div>
                            <p class="text-center text-white">Already have an account? 
                                <a href="/login" class="text-yellow-400 hover:underline">Login here</a>
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

@endsection
