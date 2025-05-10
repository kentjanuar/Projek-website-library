@extends('base.base')

@section('container')
    <div class="max-w-lg my-20 mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Borrow a Book</h2>

        <form action="{{ url('/dashboard/bookBorrows/borrow/' . $book->id) }}" method="POST">
            @csrf

            <!-- Display User Name -->
            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Name</label>
                <input type="text" id="user_name" value="{{ Auth::user()->name }}" class="block w-full p-2.5 mt-1 bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly>
            </div>

            <!-- Display Book Title -->
            <div class="mb-4">
                <label for="book_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Book Title</label>
                <input type="text" id="book_title" value="{{ $book->title }}" class="block w-full p-2.5 mt-1 bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly>
            </div>

            <!-- Hidden Book and User IDs -->
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <!-- Borrow Date -->
            <div class="mb-4">
                <label for="borrow_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Borrow Date</label>
                <input type="date" name="borrow_date" id="borrow_date" class="block w-full p-2.5 mt-1 bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" required readonly>
                <p id="borrow_date_display" class="mt-2 text-sm text-gray-500"></p> <!-- Display readable date -->
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="block w-full p-2.5 mt-1 bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly required>
                <p id="due_date_display" class="mt-2 text-sm text-gray-500"></p> <!-- Display readable date -->
            </div>


            <div class="flex justify-end">
                <button type="submit" class="p-2.5 mr-5 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-600 dark:focus:ring-blue-800">
                    Borrow Book
                </button>

                <a href="/explore" class="p-2.5 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                    Cancel
                </a>
            </div>     
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const borrowDateInput = document.getElementById('borrow_date');
            const dueDateInput = document.getElementById('due_date');
            const borrowDateDisplay = document.getElementById('borrow_date_display');
            const dueDateDisplay = document.getElementById('due_date_display');
    
            // Function to format date as "Tuesday, 1 November 2014"
            function formatDate(date) {
                const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                return new Intl.DateTimeFormat('en-GB', options).format(date);
            }
    
            function setBorrowDate() {
                const today = new Date();
                const formattedToday = today.toISOString().split('T')[0]; // For input date format (YYYY-MM-DD)
                borrowDateInput.value = formattedToday;
                borrowDateDisplay.textContent = formatDate(today); // Display formatted date
            }
    
            function setDueDate() {
                const borrowDate = new Date(borrowDateInput.value);
                borrowDate.setDate(borrowDate.getDate() + 14); // Add 14 days for due date
                const formattedDueDate = borrowDate.toISOString().split('T')[0]; // For input date format (YYYY-MM-DD)
                dueDateInput.value = formattedDueDate;
                dueDateDisplay.textContent = formatDate(borrowDate); // Display formatted due date
            }
    
            // Set initial borrow and due dates
            setBorrowDate();
            setDueDate();
    
            // Update due date when borrow date changes
            borrowDateInput.addEventListener('change', setDueDate);
        });
    </script>
@endsection
