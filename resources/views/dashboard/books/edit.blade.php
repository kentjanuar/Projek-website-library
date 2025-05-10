@extends('base.base')

@section('container')


{{-- <form class="max-w-sm mx-auto" action="/dashboard/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book title</label>
        <input type="title" name="title" id="title" title="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="title" required value="{{ old('title' , $book->title) }}" autofocus/>

        @error('title')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

      </div>
    <div class="mb-5">
        <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">author</label>
        <input type="text" name="author" id="author" 
       class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 p-2.5"
       placeholder="author" value="{{ old('author' , $book->author) }}" required/>

       @error('author')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

    </div>
    <div class="mb-5">
        <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">publisher</label>
        <input type="text" id="publisher" name="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('publisher' , $book->publisher) }}" placeholder="Publisher" required />

        @error('publisher')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

    </div>
    <div class="mb-5">
        <label for="published_year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Published year</label>
        <input type="text" id="published_year" name="published_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('published_year' , $book->published_year) }}" placeholder="Your address" required />

        @error('published_year')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description</label>
        <input type="text" id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your description" value="{{ old('description' , $book->description) }}" required />

        @error('description')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-5">
        <label for="condition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Condition</label>
        <select id="condition" name="condition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="Good" {{ old('condition', $book->condition) == 'Good' ? 'selected' : '' }}>Good</option>
            <option value="Broken" {{ old('condition', $book->condition) == 'Broken' ? 'selected' : '' }}>Broken</option>
            <option value="In Repair" {{ old('condition', $book->condition) == 'In Repair' ? 'selected' : '' }}>In Repair</option>
        </select>
    
        @error('condition')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
    


    <div class="mb-5">
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
        <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @foreach ($categories as $category)
                 @if (old('category_id', $book->category_id) == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}
                    </option>
                 @else
                    <option value="{{ $category->id }}">{{ $category->name }}
                    </option>
                 @endif
                @endforeach    
        </select>

        @error('category_id')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-3">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload file</label>
        <input type="hidden" name="oldImage" value="{{ $book->image }}">
            @if ($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="img-preview mb-3 w-full max-w-xs mx-auto">
            @else
                <img class="img-preview mb-3 w-full max-w-xs mx-auto">
            @endif
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="image" type="file" onchange="previewImage()">
        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">Give a picture of the book(optional)</div>



        @error('image')
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
      </div>


    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update book</button>

</form> --}}

<form class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg my-14" action="/dashboard/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Edit Book</h2>

    <!-- Book Title -->
    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Book title</label>
        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Title" required value="{{ old('title', $book->title) }}" autofocus/>
        @error('title')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Author -->
    <div class="mb-5">
        <label for="author" class="block mb-2 text-sm font-medium text-gray-900">Author</label>
        <input type="text" name="author" id="author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Author" value="{{ old('author', $book->author) }}" required/>
        @error('author')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Publisher and Published Year -->
    <div class="flex mb-5 space-x-4">
        <div class="flex-1 mr-4">
            <label for="publisher" class="block mb-2 text-sm font-medium text-gray-900">Publisher</label>
            <input type="text" id="publisher" name="publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('publisher', $book->publisher) }}" placeholder="Publisher" required />
            @error('publisher')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-1/3">
            <label for="published_year" class="block mb-2 text-sm font-medium text-gray-900">Published Year</label>
            <input type="text" id="published_year" name="published_year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('published_year', $book->published_year) }}" placeholder="Published Year" required />
            @error('published_year')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Category and Condition -->
    <div class="flex mb-5 space-x-4">
        <!-- Category -->
        <div class="w-2/5 mr-24">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
            <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ($categories as $category)
                    @if (old('category_id', $book->category_id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}
                        </option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}
                        </option>
                    @endif
                @endforeach    
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Condition -->
        <div class="flex-1">
            <label class="block mb-2 text-sm font-medium text-gray-900">Condition</label>
            <div class="flex space-x-4 mt-4">
                <div class="flex items-center">
                    <input type="radio" id="condition_good" name="condition" value="Good" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" {{ old('condition', $book->condition) == 'Good' ? 'checked' : '' }}>
                    <label for="condition_good" class="ml-2 text-sm font-medium text-gray-900">Good</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="condition_broken" name="condition" value="Broken" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" {{ old('condition', $book->condition) == 'Broken' ? 'checked' : '' }}>
                    <label for="condition_broken" class="ml-2 text-sm font-medium text-gray-900">Broken</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="condition_in_repair" name="condition" value="In Repair" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" {{ old('condition', $book->condition) == 'In Repair' ? 'checked' : '' }}>
                    <label for="condition_in_repair" class="ml-2 text-sm font-medium text-gray-900">In Repair</label>
                </div>
            </div>
            @error('condition')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <!-- Description -->
    <div class="mb-5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
        <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-40 p-2.5" placeholder="Your description" required>{{ old('description', $book->description) }}</textarea>
        @error('description')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
        <label class="block mb-2 text-sm font-medium text-center text-gray-900" for="image">Upload Photo</label>
        <input type="hidden" name="oldImage" value="{{ $book->image }}">
            @if ($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="img-preview mb-3 w-full max-w-xs mx-auto">
            @else
                <img class="img-preview mb-3 w-full max-w-xs mx-auto">
            @endif
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image" name="image" type="file" onchange="previewImage()">
        <div class="mt-1 text-sm text-gray-500" id="image_help">Give a picture of the book (optional)</div>
        @error('image')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Update Book</button>
    </div>
    
</form>



  
<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }

    }
</script>
@endsection