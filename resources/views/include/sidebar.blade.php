<div x-data="setup()" >
   <div class="">
     <!-- Loading screen -->
     {{-- <div
       x-ref="loading"
       class="fixed inset-0 z-0 flex items-center justify-center text-2xl font-semibold text-white bg--600"
     >
       Loading.....
     </div> --}}

     <!-- Sidebar -->
     <div
       x-transition:enter="transform transition-transform duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition-transform duration-300"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       x-show="isSidebarOpen"
       class="fixed inset-y-0 z-30 flex w-80"
     >
       <!-- Curvy shape -->
       <svg
         class="absolute inset-0 w-full h-full text-white"
         style="filter: drop-shadow(10px 0 10px #00000030)"
         preserveAspectRatio="none"
         viewBox="0 0 309 800"
         fill="#111827"
         xmlns="http://www.w3.org/2000/svg"
       >
         <path
           d="M268.487 0H0V800H247.32C207.957 725 207.975 492.294 268.487 367.647C329 243 314.906 53.4314 268.487 0Z"
         />
       </svg>
       <!-- Sidebar content -->
       <div class="z-30 flex flex-col flex-1">
         <div class="flex items-center justify-between flex-shrink-0 w-64 p-4">
           <!-- Logo -->
           <h1 class="italic font-bold text-white text-4xl">Library</h1>
           <!-- Close btn -->
           <button @click="isSidebarOpen = false" class="p-1 rounded-lg focus:outline-none focus:ring">
             <svg
               class="w-6 h-6"
               aria-hidden="true"
               xmlns="http://www.w3.org/2000/svg"
               fill="none"
               viewBox="0 0 24 24"
               stroke="white"
             >
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
             </svg>
             <span class="sr-only">Close sidebar</span>
           </button>
         </div>


         
        <nav class="flex flex-col flex-1 w-64 py-4 pl-8 mt-7">

          {{-- USERS AUTH --}}
          <div class="menu">
            <!-- Home Link -->
            <a href="/" class="inline-flex mr-6 items-center space-x-2 mb-5 group 
              {{ request()->is('/') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} 
              hover:text-blue-500 hover:px-2 transition-all duration-100">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 group-hover:text-yellow-500 transition duration-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
              </svg>
              <span class="font-bold {{ request()->is('/') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">Home</span>
            </a>
          
            <!-- Explore Link -->

            
            <a href="/explore" class="inline-flex items-center space-x-2 mb-5 group 
            {{ request()->is('explore') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} 
            hover:text-yellow-500 hover:px-2 transition-all duration-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 group-hover:text-yellow-500 transition duration-100">
              <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="font-bold {{ request()->is('explore') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">Explore</span>
            </a>

            <!-- My Books Link -->
            <a href="/dashboard/bookBorrows" class="inline-flex items-center space-x-2 mb-5 group 
            {{ request()->is('dashboard/bookBorrows') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} 
            hover:text-yellow-500 hover:px-2 transition-all duration-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 group-hover:text-yellow-500 transition duration-100">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="font-bold {{ request()->is('dashboard/bookBorrows') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">My Books</span>
            </a>

          
            <!-- My Fines Link -->
            <a href="/dashboard/fines" class="inline-flex items-center space-x-2 mb-3 group 
              {{ request()->is('dashboard/fines') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} 
              hover:text-yellow-500 hover:px-2 transition-all duration-100">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 group-hover:text-yellow-500 transition duration-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
              </svg>
              <span class="font-bold {{ request()->is('dashboard/fines') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">My Fines</span>
            </a>
          </div>
                              
          
          {{-- ADMINISTRATOR --}}
          <div class="admin">
              
            @can('admin')

              <p class="mt-5 text-lg font-semibold text-gray-500 mb-5">Administrator</p>
              
              <!-- Borrowed Books Link -->
              <a href="/dashboard/bookBorrows/admin" class="inline-flex items-center space-x-2 mb-3 group {{ request()->is  
                  ('dashboard/bookBorrows/admin') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} hover:text-yellow-500 hover:px-2 transition-all duration-100">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-10 group-hover:text-yellow-500 transition duration-100">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                  </svg>
                  <span class="font-bold {{ request()->is('dashboard/bookBorrows/admin') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">Borrowed Books</span>
              </a>
              

              <!-- Manage Books Link -->
              <a href="/dashboard/books" class="inline-flex items-center space-x-2 mb-3 group {{ request()->is('dashboard/books') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} hover:text-yellow-500 hover:px-2 transition-all duration-100">
                <svg class="w-10 h-10 group-hover:text-yellow-500 transition duration-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h14a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2v16M8 2v16" />
                </svg>
                <span class="font-bold {{ request()->is('dashboard/books') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">Manage Books</span>
            </a>
            
              
              <!-- Category Link -->
              <a href="/dashboard/categories" class="inline-flex items-center ml-1 space-x-2 mb-3 group {{ request()->is('dashboard/categories') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} hover:text-yellow-500 hover:px-2 transition-all duration-100">
                <svg class="w-8 h-8 mr-1 group-hover:text-yellow-500 transition duration-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                </svg>
                <span class="font-bold {{ request()->is('dashboard/categories') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">Categories</span>
              </a>
              
              <!-- Manage Users Link -->
              <a href="/dashboard/users" class="inline-flex items-center space-x-2 mb-3 group {{ request()->is('dashboard/users') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} hover:text-yellow-500 hover:px-2 transition-all duration-100">
                <svg class="w-10 h-10 group-hover:text-yellow-500 transition duration-100" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 20c0-2.21 3.58-4 8-4s8 1.79 8 4" />
                </svg>
                <span class="font-bold {{ request()->is('dashboard/users') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">All Users</span>
              </a>
              

              {{-- All fines --}}
              <a href="/dashboard/fines/admin" class="inline-flex items-center space-x-2 mb-3 group {{ request()->is('dashboard/fines/admin') ? 'text-yellow-500 font-bold rounded px-2' : 'text-white' }} hover:text-yellow-500 hover:px-2 transition-all duration-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 group-hover:text-yellow-500 transition duration-100">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="font-bold {{ request()->is('dashboard/fines/admin') ? 'text-yellow-500' : '' }} group-hover:text-yellow-500 transition duration-100">All Fines</span>
              </a>
              
              
            @endcan
          </div>  
            
        </nav>


          {{-- LOGOUT --}}
            <div class="inline-flex p-4">
              @auth
                <form id="logout-form" action="/logout" method="POST">
                  @csrf
                  <button
                    type="button"
                    class="flex items-center space-x-2 py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 group" onclick="confirmLogout()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class=" text-white size-6 transition-all duration-100 group-hover:text-yellow-500 group-hover:ml-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                  
                    <span class="text-white group-hover:text-yellow-500 font-bold">Logout</span>
                  </button>
                </form>
              @else
                <a
                  href="/login"
                  class="flex items-center space-x-2 py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
                >
                  <span>Login</span>
                </a>
              @endauth
            </div>
          
       </div>
     </div>
     
     {{-- Button buka --}}
    <button 
        @click="isSidebarOpen = true" 
        class="fixed px-2 py-5 z-20 rounded-r-full shadow-lg top-1/2 left-0 transform -translate-y-1/2 hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-300 
        @if(request()->is('/')) bg-yellow-400 @else bg-gray-900 @endif"
        >
      <svg
        class="w-8 h-8 @if(request()->is('/')) text-black @else text-white @endif""
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>
 



      
      
       <h1 class="sr-only">Home</h1>

   </div>
 </div>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.1/alpine.js"></script>
 <script>
     const setup = () => {
     return {
             isSidebarOpen: false,
         }
     }
 </script>



