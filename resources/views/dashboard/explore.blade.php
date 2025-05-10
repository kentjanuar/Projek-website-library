@extends('base.base')

@section('container')

<h2 class="text-5xl italic font-bold text-center text-white my-16 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">Explore and Find Books</h2>


<form class="max-w-lg mt-9 mx-auto border-2 border-white rounded-lg" action="/explore">

    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">                
    @endif

    <div class="flex">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
            {{ request('category') ? request('category') : 'All categories' }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <!-- Opsi 'All categories' -->
                <li>
                    <a href="/explore" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        All categories
                    </a>
                </li>
                
                <!-- Opsi kategori lainnya -->
                @foreach ($categories as $category)
                <li>
                    <a href="?category={{ $category->name }}" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="relative w-full">
            <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Authors, Categories..." value="{{ request('search') }}" />
            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-indigo-900 rounded-e-lg border border-indigo-900 hover:bg-indigo-800 focus:outline-none focus:ring-indigo-300 ">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>


<div class="max-w-screen-xl mx-auto p-5">
    @if (!auth()->user())
        <p class="text-white font-semibold mt-8 mb-3">To borrow books, you must <a href="/login" class="text-lg text-yellow-400 hover:underline">login</a> first.</p>
    @endif
    <div class="grid grid-cols-1 mt-8 md:grid-cols-3 sm:grid-cols-2 gap-10">
        @if ($books->count())
            @foreach ($books as $book)
                <div class="rounded-lg bg-gray-200 overflow-hidden shadow-lg bg-white  dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative">
                        <a href="/dashboard/books/{{ $book->id }}">
                                @if ($book->image)
                                <img 
                                class="w-full h-64 object-cover rounded-t-lg" 
                                src="{{ asset('storage/' . $book->image) }}" 
                                alt="{{ $book->title }}" 
                                />                        
                            @else
                                <img class="w-full" src="https://picsum.photos/300/199" alt="Placeholder Image">
                            @endif
                            <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                        </a>
                        <a href="?category={{ $book->category->name }}">
                            <div class="absolute bottom-0 left-0 bg-indigo-900 px-4 py-2 rounded-tr-lg text-white text-sm hover:bg-white font-semibold hover:text-indigo-900 transition duration-500 ease-in-out">
                                {{ $book->category->name }}
                            </div>
                        </a>
                        
                        <div class="text-sm absolute top-0 right-0 bg-indigo-900 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-indigo-900 transition duration-500 ease-in-out">
                            <span class="font-bold">{{ $book->created_at->format('d') }}</span>
                            <small>{{ date('M', strtotime($book->created_at)) }}</small>
                        </div>
                        
                    </div>
                    <div class="flex flex-col">
                        <div class="px-6 flex-1 py-4">
                            <a href="/dashboard/books/{{ $book->id }}" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">
                                {{ $book->title }}
                            </a>
                            <p class="text-gray-500 text-sm">
                                Author: {{ $book->author }}
                            </p>
                        </div>


                        <div class="px-6 py-4 duration-300">
                            
                                
                        <a href="/dashboard/books/{{ $book->id }}" class="inline-flex items-center px-4 py-2 bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-lg hover:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-900 transition duration-300">
                                        <span class="mr-2">View details</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 " fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 7l5 5-5 5M5 12h14"></path>
                                        </svg>
                                    </a>
                                
                            
                        </div>
                        
                    </div>
                    
                </div>
            @endforeach
        @else
            <h1 class="col-span-full mt-16 text-center text-3xl font-semibold xl text-gray-500 dark:text-gray-400">No books are found</h1>
        @endif
    </div>
</div>

<div class="mt-4 flex justify-center">
    {{ $books->links() }}
</div>

    <!-- SweetAlert untuk pesan sukses -->
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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