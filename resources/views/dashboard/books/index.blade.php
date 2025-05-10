@extends('base.base')

@section('container')

<div>
    <h2 class="text-4xl font-bold text-center text-white my-9 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">Manage Books</h2>
</div>


<form id="filters-form" class="max-w-lg mx-auto mb-8 space-y-6 p-6 bg-white rounded-lg shadow-lg" method="GET" action="{{ url('/dashboard/books') }}">

    <div class="flex items-center mb-7">
        <h2 class="flex-1 text-lg font-semibold text-gray-700 dark:text-gray-100">Filter Books</h2>
        <button type="reset" id="clearButton" class="bg-yellow-500 text-white py-1 px-4 rounded-lg font-medium text-sm hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 transition-all ease-in-out duration-300">
            Clear All
        </button>
    </div>     

    <input type="hidden" name="category" value="{{ request('category') }}">

    {{-- Header filter --}}
    <div class="flex mb-5 relative">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
            {{ request('category') ? request('category') : 'All categories' }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>

        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                    <a href="#" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setCategory(null)">All categories</a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a href="#" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" onclick="setCategory('{{ $category->name }}')">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="relative w-full">
            <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Authors, Categories..." value="{{ request('search') }}" />
        </div>

        <button type="submit" class="absolute top-0 right-0 p-3 text-sm font-medium text-white bg-indigo-700 rounded-e-lg border border-indigo-700 hover:bg-indigo-800 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 z-10">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </div>

    <!-- Filter Condition Buttons -->
    <div class="bg-white block">
        <div class="w-full p-2 flex cursor-pointer relative">
            <p class="font-bold leading-5 w-full text-md text-center">Condition:</p>
        </div>
        <div class="p-2 w-full relative inline-block">
            @php
                $selectedConditions = request('condition', []);
                if (!is_array($selectedConditions)) {
                    $selectedConditions = [$selectedConditions];
                }
            @endphp

            <div class="flex items-center">
                <!-- Good -->
                <button 
                    type="button" 
                    class="inline-flex flex-col items-center condition-btn w-1/3 p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                            {{ in_array('Good', $selectedConditions) ? 'text-green-800 border-green-500' : 'text-gray-600 border-gray-300' }} 
                            hover:border-green-500 hover:text-green-500 group"
                    data-condition="Good">
                        <!-- Icon -->
                        <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="2" 
                        stroke="currentColor" 
                        class="size-6 group-hover:stroke-green-800">
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                        <!-- Text -->
                        <span class="group-hover:text-green-800">Good</span>
                </button>


                <!-- Broken -->
                <button 
                    type="button" 
                    class="inline-flex flex-col items-center w-1/3 condition-btn p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                            {{ in_array('Broken', $selectedConditions) ? 'text-red-500 border-red-500' : 'text-gray-600 border-gray-300' }} 
                            hover:border-red-500 group"
                    data-condition="Broken">
                        <!-- Icon -->
                        <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="2" 
                        stroke="currentColor" 
                        class="size-6 group-hover:stroke-red-500">
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <!-- Text -->
                        <span class="group-hover:text-red-500">Broken</span>
                </button>


                <!-- In Repair -->
                <button 
                    type="button" 
                    class="inline-flex flex-col items-center w-1/3 condition-btn p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                            {{ in_array('In Repair', $selectedConditions) ? 'text-gray-800 border-gray-500' : 'text-gray-600 border-gray-300' }} 
                            hover:border-black group"
                    data-condition="In Repair">
                        <!-- Icon -->
                        <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="2" 
                        stroke="currentColor" 
                        class="size-6 group-hover:stroke-black">
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <!-- Text -->
                        <span class="group-hover:text-black">In Repair</span>
                </button>

            </div>
            
            <!-- Hidden Inputs for Conditions -->
            @foreach ($selectedConditions as $condition)
                <input type="hidden" name="condition[]" value="{{ $condition }}">
            @endforeach
        </div>
    </div>
</form>

{{-- <form class="max-w-lg mx-auto" action="/dashboard/books">
    @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">                
    @endif

    <div class="flex mb-5">
        <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
            {{ request('category') ? request('category') : 'All categories' }}
            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                    <a href="/dashboard/books" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        All categories
                    </a>
                </li>
                @foreach ($categories as $category)
                <li>
                    <a href="/dashboard/books?category={{ $category->name }}" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="relative w-full">
            <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Authors, Categories..." value="{{ request('search') }}" />
            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>

<form id="advanced_filters" class="mb-4 max-w-lg mx-auto" method="GET" action="{{ url('/dashboard/books') }}">
    <div class="bg-white block">
        <div class="w-full p-2 flex cursor-pointer relative">
            <p class="font-bold leading-5 w-11/12 text-md">Condition:</p>
        </div>
        <div class="p-2 w-full relative inline-block">
            @php
                $selectedConditions = request('condition', []);
                if (!is_array($selectedConditions)) {
                    $selectedConditions = [$selectedConditions];
                }
            @endphp

            <!-- Good -->
            <button type="button" 
                    class="condition-btn p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                    {{ in_array('Good', $selectedConditions) ? 'text-blue-800 border-blue-500' : 'text-gray-600 border-gray-300' }}" 
                    data-condition="Good">
                Good
            </button>

            <!-- Broken -->
            <button type="button" 
                    class="condition-btn p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                    {{ in_array('Broken', $selectedConditions) ? 'text-blue-800 border-blue-500' : 'text-gray-600 border-gray-300' }}" 
                    data-condition="Broken">
                Broken
            </button>

            <!-- In Repair -->
            <button type="button" 
                    class="condition-btn p-1 px-4 m-0.5 text-sm font-bold border-2 rounded-lg 
                    {{ in_array('In Repair', $selectedConditions) ? 'text-blue-800 border-blue-500' : 'text-gray-600 border-gray-300' }}" 
                    data-condition="In Repair">
                In Repair
            </button>

            <!-- Hidden Inputs -->
            @foreach ($selectedConditions as $condition)
                <input type="hidden" name="condition[]" value="{{ $condition }}">
            @endforeach
        </div>
    </div>
</form> --}}

<div class="container mx-auto">

    <a href="/dashboard/books/create" class="inline-block px-6 py-3 text-black font-bold hover:text-white bg-yellow-500 rounded-lg shadow-lg hover:bg-yellow-700 transition duration-200 ease-in-out transform hover:scale-105">Add a New Book</a>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Author
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Category
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Condition
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Upd / Del
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="group hover:bg-gray-300 bg-white transition-all duration-200">
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $book->title }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $book->author }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $book->category->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                @if (!$book->image)
                                    <span class="text-gray-500 dark:text-gray-400">No image</span>
                                @else
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-16 h-16 object-cover rounded-md">    
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm border-b border-gray-200 dark:border-gray-700">
                                @if ($book->status == 1)
                                    <span class="inline-flex items-center bg-red-600 text-white font-medium px-2 py-1 rounded-full">
                                        Borrowed
                                    </span>
                                @else
                                    <span class="inline-flex items-center bg-gray-100 text-gray-900 font-medium px-2 py-1 rounded-full">
                                        Available
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                @if ($book->condition == 'Good')
                                    <div class="flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="green" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </div>
                                @elseif ($book->condition == 'Broken')
                                    <div class="flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="red" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            
                            
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <a href="/dashboard/books/{{ $book->id }}/edit" class="inline-flex items-center justify-center w-8 h-8 bg-yellow-300 rounded-lg text-yellow-900 hover:bg-yellow-400 transition duration-200 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="black" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

                                <form id="delete-book-form-{{$book->id}}" action="/dashboard/books/{{ $book->id }}" method="post" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="inline-flex items-center justify-center w-8 h-8 bg-red-600 rounded-lg text-white hover:bg-red-500 transition duration-200 ease-in-out" onclick="confirmDelete({{ $book->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                          </svg>
                                          
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($books->count() == 0)
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">No books found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert untuk pesan sukses -->
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


<script>
    function confirmDelete(bookId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this book?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form if the user confirmed
            document.getElementById(`delete-book-form-${bookId}`).submit();
        }
    });
}
</script>

{{-- Script filter condition FIX --}}
<script>
    // Menangani pemilihan kategori
    function setCategory(category) {
        let form = document.getElementById('filters-form');
        let categoryInput = form.querySelector('input[name="category"]');
        if (!categoryInput) {
            categoryInput = document.createElement('input');
            categoryInput.type = 'hidden';
            categoryInput.name = 'category';
            form.appendChild(categoryInput);
        }
        categoryInput.value = category;
        form.submit(); // Submit form setelah memilih kategori
    }

    // Menangani pemilihan kondisi
    document.querySelectorAll('.condition-btn').forEach(button => {
        button.addEventListener('click', function () {
            const condition = this.getAttribute('data-condition');
            const form = document.getElementById('filters-form');
            const input = form.querySelector(`input[name="condition[]"][value="${condition}"]`);

            // Mengubah warna berdasarkan kondisi
            let colorClass = '';
            if (condition === 'Good') {
                colorClass = 'text-green-800 border-green-500';
            } else if (condition === 'Broken') {
                colorClass = 'text-red-800 border-red-500';
            } else if (condition === 'In Repair') {
                colorClass = 'text-gray-800 border-gray-500';
            }

            // Jika kondisi sudah dipilih, hapus dari form dan reset warna
            if (input) {
                input.remove();
                this.classList.remove('text-blue-800', 'border-blue-500', 'text-green-800', 'border-green-500', 'text-red-800', 'border-red-500', 'text-gray-800', 'border-gray-500');
                this.classList.add('text-gray-600', 'border-gray-300');
            } else {
                // Jika belum dipilih, tambahkan ke form dan set warna sesuai kondisi
                const newInput = document.createElement('input');
                newInput.type = 'hidden';
                newInput.name = 'condition[]';
                newInput.value = condition;
                form.appendChild(newInput);

                // Reset semua warna kelas dan tambahkan yang baru
                this.classList.remove('text-gray-600', 'border-gray-300');
                this.classList.add(...colorClass.split(' '));
            }

            // Submit form setelah setiap klik
            form.submit();
        });
    });

</script>


{{-- Reset filter --}}
<script>
    // Fungsi untuk mereset semua filter
    document.getElementById('clearButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default reset action to handle custom reset

        // Reset kategori dropdown
        const dropdownButton = document.getElementById('dropdown-button');
        dropdownButton.textContent = 'All categories';  // Set kembali ke "All categories"

        // Reset input pencarian
        const searchInput = document.querySelector('input[name="search"]');
        searchInput.value = '';  // Kosongkan input pencarian

        // Reset tombol kondisi (Good, Broken, In Repair) ke default
        const conditionButtons = document.querySelectorAll('.condition-btn');
        conditionButtons.forEach(button => {
            button.classList.remove('text-blue-800', 'border-blue-500');  // Hapus kelas yang menunjukkan kondisi yang dipilih
            button.classList.add('text-gray-600', 'border-gray-300');  // Set ulang ke nilai default
        });

        // Hapus semua hidden inputs untuk kondisi
        const conditionInputs = document.querySelectorAll('input[name="condition[]"]');
        conditionInputs.forEach(input => {
            input.remove();  // Hapus elemen input tersembunyi
        });

        // Reset nilai kategori di input hidden (untuk category)
        const categoryInput = document.querySelector('input[name="category"]');
        if (categoryInput) {
            categoryInput.value = '';  // Mengosongkan nilai input hidden category
        }

        // Menyusun ulang hidden input kondisi (reset state) di dalam form jika diperlukan
        const form = document.getElementById('filters-form');
        form.submit();  // Submit form setelah mereset
    });
</script>



{{-- Script filter condition --}}
{{-- <script>
        document.querySelectorAll('.condition-btn').forEach(button => {
        button.addEventListener('click', function () {
            const condition = this.getAttribute('data-condition');
            const form = document.getElementById('advanced_filters');
            const input = form.querySelector(`input[name="condition[]"][value="${condition}"]`);

            // Jika kondisi sudah dipilih, hapus dari form
            if (input) {
                input.remove();
                this.classList.remove('text-blue-800', 'border-blue-500');
                this.classList.add('text-gray-600', 'border-gray-300');
            } else {
                // Jika belum dipilih, tambahkan ke form
                const newInput = document.createElement('input');
                newInput.type = 'hidden';
                newInput.name = 'condition[]';
                newInput.value = condition;
                form.appendChild(newInput);

                this.classList.remove('text-gray-600', 'border-gray-300');
                this.classList.add('text-blue-800', 'border-blue-500');
            }

            // Submit form setelah setiap klik
            form.submit();
        });
    });

</script> --}}



@endsection


{{-- @extends('base.base')

@section('container')


<form class="max-w-lg mx-auto" action="/dashboard/books">

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
        </button>
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <!-- Opsi 'All categories' -->
                <li>
                    <a href="/dashboard/books" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        All categories
                    </a>
                </li>
                
                <!-- Opsi kategori lainnya -->
                @foreach ($categories as $category)
                <li>
                    <a href="/dashboard/books?category={{ $category->name }}" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="relative w-full">
            <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Authors, Categories..." value="{{ request('search') }}" required />
            <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>



<a href="/dashboard/books/create" class="hover:underline">Create a new book here</a>

<div class="grid grid-cols-4 gap-9 w-full mx-auto">

    @if ($books->count())
        @foreach ($books as $book) 
    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        @if ($book->image)          
            <img class="rounded-t-lg" src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" />           
        @endif
        <div class="p-5">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}</h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Author: {{ $book->author }}</p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Category: {{ $book->category->name }}</p>
            <a href="/dashboard/books/{{ $book->id }}/edit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>

        <form action="/dashboard/books/{{ $book->id }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class=" py-2 px-5 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
    @endforeach
    

    @else
        <h1>No post found</h1>
    @endif
    

</div>
@endsection --}}