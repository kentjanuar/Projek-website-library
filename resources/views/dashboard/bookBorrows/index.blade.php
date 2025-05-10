@extends('base.base')

@section('container')

<h2 class="text-4xl font-bold text-center text-white my-16 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">Books Borrowed By {{ auth()->user()->name }}</h2>

@if ($bookBorrows->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-9 w-full  px-20">
        @foreach ($bookBorrows as $bookBorrow)
            <div class="max-w-sm bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 transition transform hover:scale-105 hover:shadow-xl">
                @if ($bookBorrow->book->image)
                    <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $bookBorrow->book->image) }}" alt="Book Image">
                    
                @else
                    <img class="w-full rounded-t-lg" src="https://picsum.photos/300/200" alt="Placeholder Image">
                @endif
                
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-1">{{ $bookBorrow->book->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300">by {{ $bookBorrow->book->author }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $bookBorrow->book->publisher }} • {{ $bookBorrow->book->published_year }}</p>
                    {{-- <p class="text-gray-700 dark:text-gray-200 mt-4">{{ Str::limit($bookBorrow->book->description, 100, '...') }}</p> --}}
                    
                    <div class="mt-4 flex flex-col items-start space-y-1">
                        <span class="text-xs font-medium text-indigo-700">
                            Borrow Date: {{ \Carbon\Carbon::parse($bookBorrow->borrow_date)->format('l, d F Y') }}
                        </span>
                        <span class="text-xs font-medium text-rose-700">
                            Due Date: {{ \Carbon\Carbon::parse($bookBorrow->due_date)->format('l, d F Y') }}
                        </span>
                    </div>                    
                    
                    
                    <span class="block mt-4 text-sm font-semibold text-gray-800 dark:text-gray-300">
                        Condition: {{ $bookBorrow->book->condition }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h1 class="text-lg text-gray-600 dark:text-gray-400 text-center mt-10">No books are currently borrowed</h1>
@endif 

@endsection
