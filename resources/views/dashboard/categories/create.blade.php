@extends('base.base')

@section('container')
<div class="max-w-lg mx-auto mt-10 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Create a New Category</h2>
    
    <form method="POST" action="/dashboard/categories">
        @csrf

        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autofocus/>
        </div>

        <div class="mb-5">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
        </div>
        
        
            <button type="submit" class="w-full py-3 mt-4 text-white bg-indigo-600 rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-indigo-300 transition ease-in-out duration-150 dark:bg-indigo-700 dark:hover:bg-indigo-800 dark:focus:ring-indigo-900">
                Add Category
            </button>
        
        
    </form>
</div>
@endsection
