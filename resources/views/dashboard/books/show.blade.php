@extends('base.base')

@section('container')

<section class="min-h-screen text-gray-700 body-font overflow-hidden bg-gray-200">
    <div class="container px-5 py-24 mx-auto">
      <div class="lg:w-4/5 mx-auto flex flex-wrap">
        @if ($book->image)
            <img alt="{{ $book->title }}" class="lg:w-1/2 w-full object-cover object-center rounded-md border border-gray-200" src="{{ asset('storage/' . $book->image) }}">

        @else
            <img alt="{{ $book->title }}" class="lg:w-1/2 w-full object-cover object-center rounded-md border border-gray-200" src="https://picsum.photos/400/300">
        @endif
        
        <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
          <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $book->category->name }}</h2>
          <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $book->title }}</h1>
          <!-- Additional Book Information -->
          <div class="mt-3 mb-3">
            <div class="flex items-center text-sm pb-1 text-gray-700">
                <strong class="mr-2">Author:</strong>
                <span>{{ $book->author }}</span>
            </div>
            <div class="flex items-center text-sm text-gray-700">
                <strong class="mr-2">Publisher:</strong>
                <span>{{ $book->publisher }} • {{ $book->published_year }}</span>
            </div>
        </div>

          

          <p class="leading-relaxed">{{ $book->description }}</p>
          <div class="mt-6 pb-5 border-b-2 border-gray-500 mb-5">
            
          </div>
          <div class="flex">
            <span class="title-font font-medium text-2xl text-gray-900">Condition : {{ $book->condition }}</span>
            @auth
                                @if (!$book->status)
                                    <a href="/dashboard/bookBorrows/borrow/{{ $book->id }}" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                                        <span class="mr-2">Borrow Now</span>
                                    
                                    </a>
                                @else
                                    <p class="text-sm font-medium text-red-700 dark:text-red-400 bg-red-100 border border-red-300 rounded-lg px-4 py-2 flex ml-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                          </svg>
                                          
                                        Borrowed
                                    </p>
                                @endif
                            @endauth
            <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
              <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>


@endsection
