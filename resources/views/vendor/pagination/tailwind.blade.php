@if ($paginator->hasPages())


<div class="flex container px-6 mb-10 justify-between w-full mt-4">
  <!-- Previous Button -->
  @if ($paginator->onFirstPage())
    {{-- <a class="flex items-center justify-center px-4 h-10 me-3 text-base font-medium text-gray-500 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">
      <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
      </svg>
      Previous
    </a> --}}
    <div></div> <!-- INI UNTUK MENJAGA LAYOUT PAKE DIV KOSONG -->
  @else
    <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 me-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
      <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
      </svg>
      Previous
    </a>
  @endif

  <!-- Next Button -->
  @if ($paginator->hasMorePages())
  
    <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
      Next
      <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
      </svg>
    </a>
  @else
    {{-- <a class="flex items-center hidden justify-center px-4 h-10 text-base font-medium text-gray-500 bg-gray-200 border border-gray-300 rounded-lg cursor-not-allowed">
      Next
      <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
      </svg>
    </a> --}}
    <div></div> <!-- INI UNTUK MENJAGA LAYOUT PAKE DIV KOSONG -->
  @endif
</div>
@endif
