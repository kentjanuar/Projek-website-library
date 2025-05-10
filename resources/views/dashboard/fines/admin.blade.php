
@extends('base.base')

@section('container')

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-4xl font-bold text-center text-white my-9 leading-tight" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">All Fines</h2>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Book Title
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                User & Status
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Borrow Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Due Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Return Date
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Fine Amount
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Pay Fine
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fines as $fine)
                            <tr class="group hover:bg-gray-300 bg-white transition-all duration-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $fine->bookBorrow->book->title }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 text-center">{{ $fine->bookBorrow->user->name }}</span>
                                        @if ($fine->status == 'paid')
                                            <span class="relative inline-block px-2 py-1 text-xs font-semibold text-green-900 leading-tight text-center">
                                                <span aria-hidden="true" class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative flex items-center justify-center">Paid</span>
                                            </span>
                                        @else
                                            <span class="relative inline-block px-2 py-1 text-xs font-semibold text-red-900 leading-tight text-center">
                                                <span aria-hidden="true" class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative flex items-center justify-center">Unpaid</span>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ \Carbon\Carbon::parse($fine->bookBorrow->borrow_date)->format('j M Y') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ \Carbon\Carbon::parse($fine->bookBorrow->due_date)->format('j M Y') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-black font-bold whitespace-no-wrap">
                                        {{ $fine->bookBorrow->return_date ? \Carbon\Carbon::parse($fine->bookBorrow->return_date)->format('j M Y') : 'N/A' }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Rp {{ number_format($fine->amount, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    @if($fine->status === 'unpaid')
                                        <form id="paid-book-form-{{ $fine->id }}" action="{{ route('payFine', ['fine' => $fine->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button onclick="confirmPaid({{ $fine->id }})" type="button" 
                                                    class="flex items-center justify-center px-4 py-2 mt-2 font-semibold text-white bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg shadow-lg transform transition-all duration-300 hover:scale-105 hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Pay Now                                                                                         
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-green-600 font-semibold">Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert for success message -->
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
    function confirmPaid(fineId) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, pay now!',
            cancelButtonText: 'Not yet'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`paid-book-form-${fineId}`).submit();
            }
        });
    }
</script>

@endsection


{{-- @extends('base.base')

@section('container')

<h1>All Fines</h1>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Title</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrow Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Date</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fine Amount</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pay Fine</th>
            </tr>
        </thead>
        <tbody>
            @if ($fines->count())
                @foreach ($fines as $fine)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $fine->bookBorrow->book->title}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $fine->bookBorrow->user->name}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $fine->bookBorrow->borrow_date}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $fine->bookBorrow->due_date}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $fine->bookBorrow->return_date ?? 'Not Returned' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            Rp {{ number_format($fine->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{ $fine->status === 'unpaid' ? 'Unpaid' : 'Paid' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($fine->status === 'unpaid')
                                <form id="paid-book-form-{{ $fine->id }}" action="{{ route('payFine', ['fine' => $fine->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button onclick="confirmPaid({{ $fine->id }})" type="button" class="text-green-600 hover:underline">Pay Now</button>
                                </form>
                            @else
                                Paid
                            @endif
                        </td>
                        
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center text-gray-500 dark:text-gray-400">No fines found</td>
                </tr>
            @endif
        </tbody>
    </table>
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
    function confirmPaid(fineId) {
    Swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, pay now!',
        cancelButtonText: 'Not yet'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form if the user confirmed
            document.getElementById(`paid-book-form-${fineId}`).submit();
        }
    });
}
</script>

@endsection --}}