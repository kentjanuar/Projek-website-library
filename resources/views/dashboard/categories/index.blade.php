@extends('base.base')

@section('container')


<div class="container mx-auto">
    <div class="pt-8">
        <div class="pb-9">
            <h2 class="text-4xl font-bold text-center text-white my-9 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">Categories</h2>
        </div>
        <a href="categories/create" class="inline-block px-6 py-3 text-black font-bold hover:text-white bg-yellow-500 rounded-lg shadow-lg hover:bg-yellow-700 transition duration-200 ease-in-out transform hover:scale-105">Add a New Category</a>

    </div>

<div class="container mx-auto">
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4">
        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Category Name
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Edit
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr class="group hover:bg-gray-300 bg-white transition-all duration-200">
                            <td class="px-5 py-5 border-b border-gray-200  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $index + 1 }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $category->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200  text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $category->description }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200  text-sm">
                                <a href="/dashboard/categories/{{ $category->id }}/edit" class="inline-flex items-center justify-center w-8 h-8 bg-yellow-300 rounded-lg text-yellow-900 hover:bg-yellow-400 transition duration-300 ease-in-out">
                                    <!-- Heroicons pencil icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="black" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </td>                            
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- SweetAlert for Success Message -->
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
