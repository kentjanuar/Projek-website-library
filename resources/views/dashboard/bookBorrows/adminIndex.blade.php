@extends('base.base')

@section('container')


{{-- <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($bookBorrows->count())
                @foreach ($bookBorrows as $borrow)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $borrow->book->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $borrow->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $borrow->borrow_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $borrow->due_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if (is_null($borrow->return_date))
                                @if ($borrow->due_date < $borrow->borrow_date && !$borrow->status)
                                    <div class="text-red-600 text-xs mt-1">Check Fines</div>
                                </div>
                                @else
                                    <form id="return-book-form-{{ $borrow->id }}" action="{{ route('returnBook', ['book' => $borrow->id]) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="text-blue-600 hover:underline dark:text-blue-500" onclick="confirmReturn({{ $borrow->id }})">Return Book</button>
                                    </form>
                                @endif
                            @else
                                {{ $borrow->return_date }}
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{ $borrow->status ? 'Returned' : 'Not returned' }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">No records found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div> --}}

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        <div>
            <h2 class="text-4xl font-bold text-center text-white my-9 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">Details of Book Borrows</h2>
        </div>

        <form class="max-w-lg mb-6 mx-auto p-6 mb-9 bg-white shadow-md rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700" action="/dashboard/bookBorrows/admin">

            <div class="flex items-center mb-7">
                <h2 class="flex-1 text-lg font-semibold text-gray-700 dark:text-gray-100">Borrowed Books Filter</h2>
                <button type="reset" id="clearButton" class="bg-yellow-500 text-white py-1 px-4 rounded-lg font-medium text-sm hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 transition-all ease-in-out duration-300">
                    Clear All
                </button>
            </div>                     
            
        
            <!-- Status Filter (hidden input) -->
            <input type="hidden" name="status" value="{{ request('status') }}">                
        
            <div class="flex mb-5">
                <!-- Dropdown Filter Status -->
                <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                    @if(request('status') === '1')
                        Returned
                    @elseif(request('status') === '0')
                        Not Returned
                    @else
                        All Status
                    @endif
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
        
                <!-- Dropdown Menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All Status</a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 1]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Returned</a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 0]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Not Returned</a>
                        </li>
                    </ul>
                </div>
        
                <!-- Search Input -->
                <div class="relative w-full">
                    <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Users, and Others" value="{{ request('search') }}" />
                    <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-indigo-700 rounded-e-lg border border-indigo-700 hover:bg-indigo-800 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        
            <!-- Filter by Borrow Date -->
            <div class="flex flex-row  space-y-2 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Borrow Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ request('start_date') }}">
                </div>
                <div class="w-full md:w-1/2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Borrow End Date</label>
                    <input type="date" name="end_date" id="end_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ request('end_date') }}">
                </div>
            </div>
        </form>
        
        

        {{-- <form class="max-w-lg mb-6 mx-auto p-6 mb-9 bg-white shadow-md rounded-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700" action="/dashboard/bookBorrows/admin">

            <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">Borrowed Books Filter</h2>

            <input type="hidden" name="status" value="{{ request('status') }}">                
        
            <div class="flex mb-5">
                <!-- Dropdown Filter Status -->
                <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">
                    @if(request('status') === '1')
                        Returned
                    @elseif(request('status') === '0')
                        Not Returned
                    @else
                        All Status
                    @endif
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
        
                <!-- Dropdown Menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => null]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All Status</a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 1]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Returned</a>
                        </li>
                        <li>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 0]) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Not Returned</a>
                        </li>
                    </ul>
                </div>

        
                <!-- Search Input -->
                <div class="relative w-full">
                    <input type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search Books, Users, and Others" value="{{ request('search') }}" />
                    <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        
            <!-- Filter by Borrow Date -->
            <div class="flex flex-row  space-y-2 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Borrow Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ request('start_date') }}">
                </div>
                <div class="w-full md:w-1/2">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Borrow End Date</label>
                    <input type="date" name="end_date" id="end_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="{{ request('end_date') }}">
                </div>
            </div>
        </form> --}}
        

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Book Title
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Borrow Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Due Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Return Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bookBorrows->count())
                            @foreach ($bookBorrows as $borrow)
                                <tr class="group hover:bg-gray-300 bg-white transition-all duration-200">
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $borrow->book->title }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $borrow->user->name }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($borrow->borrow_date)->format('j M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($borrow->due_date)->format('j M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        @if ($borrow->status)
                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Returned</span>
                                            </span>
                                        @else
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Not returned</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            @if (is_null($borrow->return_date))
                                                @if ($borrow->due_date < $borrow->borrow_date && !$borrow->status)
                                                <div class="text-sm text-red-600 font-semibold flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M19.071 4.929a10 10 0 1 0-14.142 14.142 10 10 0 0 0 14.142-14.142z"></path>
                                                    </svg>
                                                    <span class="hover:underline"><a href="/dashboard/fines/admin">Check Fines</a></span>
                                                </div>
                                                
                                                @else
                                                    <form id="return-book-form-{{ $borrow->id }}" action="{{ route('returnBook', ['book' => $borrow->id]) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button 
                                                            type="button" 
                                                            class="text-white bg-indigo-700 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-2 py-2 text-center transition duration-300 ease-in-out transform hover:scale-105 active:scale-95"
                                                            onclick="confirmReturn({{ $borrow->id }})"
                                                        >
                                                            Return
                                                        </button>

                                                    </form>
                                                @endif
                                            @else
                                                
                                            <div class="text-gray-400 font-bold">
                                                {{ \Carbon\Carbon::parse($borrow->return_date)->format('d F Y') }}
                                            </div>
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">No records found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- SweetAlert untuk pesan sukses -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Sweetalert --}}
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

{{-- Sweetalert --}}
<script>
    function confirmReturn(bookId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to return this book?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, return it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if the user confirmed
                document.getElementById(`return-book-form-${bookId}`).submit();
            }
        });
    }
</script>

{{-- Auto filter date --}}
<script>
    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = this.value;
        const endDate = document.getElementById('end_date').value;
        const status = document.querySelector('input[name="status"]').value; // Ambil nilai status
        const search = document.querySelector('input[name="search"]').value; // Ambil nilai search
        window.location.href = `?start_date=${startDate}&end_date=${endDate}&status=${status}&search=${search}`;
    });

    document.getElementById('end_date').addEventListener('change', function() {
        const endDate = this.value;
        const startDate = document.getElementById('start_date').value;
        const status = document.querySelector('input[name="status"]').value; // Ambil nilai status
        const search = document.querySelector('input[name="search"]').value;
        window.location.href = `?start_date=${startDate}&end_date=${endDate}&status=${status}&search=${search}`;
    });
</script>

{{-- Reset Search --}}
<script>
    document.getElementById('clearButton').addEventListener('click', function() {
        // Resetkan semua input
        document.querySelector('input[name="search"]').value = '';
        document.querySelector('input[name="start_date"]').value = '';
        document.querySelector('input[name="end_date"]').value = '';
        // Reset hidden input 'status' jika diperlukan
        document.querySelector('input[name="status"]').value = ''; // Status bisa diatur menjadi null atau nilai default lain
        
        // Jika Anda ingin mengatur ulang dropdown status
        const dropdownButton = document.getElementById('dropdown-button');
        dropdownButton.innerHTML = 'All Status';
        
        // Jika Anda ingin mengarahkan ulang URL (menghapus query params)
        window.location.href = window.location.pathname;
    });
</script>
@endsection
