@extends('base.base')

@section('container')

<!-- Arrow Up Icon -->
<a href="#" id="scrollToTopBtn" class="fixed bottom-8 right-8 bg-yellow-300 text-white p-4 z-30 rounded-full shadow-lg hover:bg-yellow-400 transition-all duration-300 opacity-0 pointer-events-none">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="5" stroke="black" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
    </svg>      
  </a>
  


<!-- Full-Screen Image Section -->
<section class="relative w-full h-screen bg-cover bg-center" style="background-image: url('https://miro.medium.com/v2/resize:fit:1400/1*6Jp3vJWe7VFlFHZ9WhSJng.jpeg');">
    <!-- Overlay to Darken the Background Image -->
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <!-- Content Over the Image -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center space-y-4">
        @auth
            {{-- <h1 class="text-5xl font-bold text-yellow-300">Hi {{ auth()->user()->name }} !</h1> --}}
            <h1 class="text-5xl font-bold text-yellow-300">Welcome to Our Library</h1>
        @else
            <h1 class="text-5xl font-bold text-yellow-300">Welcome to Our Library</h1>
        @endauth
        <p class="text-lg text-white">Explore a world of knowledge, fiction, and more.</p>
        <a href="/explore" class="mt-6 px-6 py-3 bg-yellow-300 text-black rounded-lg shadow-lg hover:bg-yellow-400 transition duration-300 font-semibold">Explore Now</a>
    </div>
</section>


{{-- Box section --}}
<section class="relative w-full">
    <div class="absolute z-20 inset-x-0 -top-1 transform -translate-y-1/2 flex justify-center">
        <div class="bg-yellow-300 rounded-lg border-4 white shadow-lg w-full max-w-lg text-center space-y-6 relative">
            <div class="flex justify-between w-full">
                <!-- Membungkus seluruh div dengan <a> agar bisa diklik seluruh area -->
                <a href="#history" class="relative flex-1 cursor-pointer p-8 hover:bg-black hover:bg-opacity-10 transition-all duration-200">
                    <div id="history-box">
                        <p class="text-xl font-semibold text-black">History</p>
                    </div>
                </a>
                <a href="#preview" class="relative flex-1 cursor-pointer p-8 hover:bg-black hover:bg-opacity-10 transition-all duration-200">
                    <div id="preview-box">
                        <p class="text-xl font-semibold text-black">Preview Books</p>
                    </div>
                </a>
            </div>
            <!-- Membuat garis aktif lebih proporsional sesuai dengan ukuran konten -->
            <div class="absolute bottom-0 left-0 w-1/2 h-1 bg-black transition-all duration-300" id="active-line"></div>
        </div>
    </div>
</section>



<!-- History Section -->
<section class="bg-black text-white py-8 mb-0 relative" id="history">
    <!-- Overlay hitam transparan -->
    <div class="absolute inset-0 bg-black bg-opacity-90 z-10"></div>
    
    <!-- Gambar latar belakang -->
    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://img.freepik.com/premium-vector/book-large-book-pattern-white-black_718551-278.jpg');"></div>
    
    <div class="container mx-auto flex flex-col items-start md:flex-row my-12 md:my-24 z-20 relative">
        <div class="flex flex-col w-full sticky md:top-36 lg:w-1/3 mt-2 md:mt-12 px-8">
            <p class="ml-2 text-yellow-300 uppercase tracking-loose">History</p>
            <p class="text-3xl md:text-4xl leading-normal md:leading-relaxed mb-2 text-yellow-300">History of The Library</p>
            <p class="text-sm md:text-base text-gray-50 mb-4">
                Discover the journey of how our library came to life, from its humble beginnings to becoming a hub of knowledge.
            </p>
            {{-- <a href="#"
            class="bg-transparent mr-auto hover:bg-yellow-300 text-yellow-300 hover:text-black rounded shadow hover:shadow-lg py-2 px-4 border border-yellow-300 hover:border-transparent">
            Explore Now</a> --}}
        </div>
        <div class="ml-0 md:ml-12 lg:w-2/3 sticky">
            <div class="container mx-auto w-full h-full">
                <div class="relative wrap overflow-hidden p-10 h-full">
                    <div class="border-2-2 border-yellow-300 absolute h-full border"
                        style="right: 50%; border: 2px solid #FFC100; border-radius: 1%;"></div>
                    <div class="border-2-2 border-yellow-300 absolute h-full border"
                        style="left: 50%; border: 2px solid #FFC100; border-radius: 1%;"></div>
                    <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="order-1 w-5/12 px-1 py-4 text-right">
                            <p class="mb-3 text-base text-yellow-300">1st January, 1800</p>
                            <h4 class="mb-3 font-bold text-lg md:text-2xl text-yellow-300">Library Foundation</h4>
                            <p class="text-sm md:text-base leading-snug text-gray-50 text-opacity-100">
                                The library was founded by a group of philanthropists with a vision to provide access to books for the local community.
                            </p>
                        </div>
                    </div>
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="order-1  w-5/12 px-1 py-4 text-left">
                            <p class="mb-3 text-base text-yellow-300">15th March, 1850</p>
                            <h4 class="mb-3 font-bold text-lg md:text-2xl text-yellow-300">First Major Expansion</h4>
                            <p class="text-sm md:text-base leading-snug text-gray-50 text-opacity-100">
                                The library expanded its collection, introducing thousands of new books and rare manuscripts to the public.
                            </p>
                        </div>
                    </div>
                    <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="order-1 w-5/12 px-1 py-4 text-right">
                            <p class="mb-3 text-base text-yellow-300">5th July, 1901</p>
                            <h4 class="mb-3 font-bold text-lg md:text-2xl text-yellow-300">Incorporation of Digital Archives</h4>
                            <p class="text-sm md:text-base leading-snug text-gray-50 text-opacity-100">
                                With the advent of technology, the library incorporated digital archives, making a significant portion of the collection available online.
                            </p>
                        </div>
                    </div>
                    <div class="mb-8 flex justify-between items-center w-full right-timeline">
                        <div class="order-1 w-5/12"></div>
                        <div class="order-1  w-5/12 px-1 py-4">
                            <p class="mb-3 text-base text-yellow-300">20th August, 2005</p>
                            <h4 class="mb-3 font-bold  text-lg md:text-2xl text-left text-yellow-300">Renovation & Modernization</h4>
                            <p class="text-sm md:text-base leading-snug text-gray-50 text-opacity-100">
                                The library underwent a major renovation to enhance its infrastructure, including new reading areas, a larger collection, and a modernized online portal for easier access.
                            </p>
                        </div>
                    </div>
                </div>
                <img class="mx-auto -mt-48 md:-mt-36 relative z-100" src="https://png.pngtree.com/png-vector/20221020/ourmid/pngtree-female-smiling-librarian-standing-at-counter-png-image_6329223.png" />
            </div>
        </div>
    </div>
</section>

<!-- Books Section -->
<section id="preview">
    <div class="relative overflow-hidden bg-gray-900 pt-16 pb-16 space-y-24">
        <!-- Section Title -->
        <div class="text-center">
            <h2 class="text-4xl font-extrabold text-yellow-300">Our Best Books</h2>
            <p class="mt-4 text-xl text-gray-300">Explore our curated selection of the best books from various genres, handpicked for your reading pleasure.</p>
        </div>
        
        @foreach ($books->take(3) as $index => $book)
            <div class="book-item opacity-0"> <!-- Add a class here for the observer -->
                <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8">
                    <div class="mx-auto max-w-xl px-6 lg:mx-0 lg:max-w-none lg:py-8 lg:px-0 @if ($index % 2 == 0) lg:col-start-1 @else lg:col-start-2 @endif">
                        <div>
                            <div>

                                @if ($book->category->name == 'Technology')
                                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z" />
                                          </svg>
                                          
                                    </span>
                                    
                                @elseif ($book->category->name == 'Fiction')
                                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                          </svg>                                                                                 
                                    </span>

                                @elseif ($book->category->name == 'Non-fiction')
                                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                                      </svg>
                                                                                                                     
                                </span>
                                @endif
                            </div>
                            <div class="mt-6">
                                <h2 class="text-3xl font-bold tracking-tight text-white">
                                    {{ $book->title }}
                                </h2>
                                <p class="mt-4 text-lg text-gray-300">
                                    Author: {{ $book->author }} <br>
                                    Category: {{ $book->category->name }}
                                </p>
                                <p class="mt-4 text-lg text-gray-300">
                                    {{ $book->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-16">
                        <div class="flex justify-center lg:relative lg:m-0 lg:h-full lg:px-0">
                            @if ($book->image)
                                <img alt="Book Image" loading="lazy" width="256" height="256"
                                class="w-96 h-96 rounded-xl object-cover shadow-2xl ring-1 ring-black ring-opacity-5"
                                src="{{ asset('storage/' . $book->image) }}">

                            @else
                                <img alt="Book Image" loading="lazy" width="256" height="256"
                                class="w-96 h-96 rounded-xl object-cover shadow-2xl ring-1 ring-black ring-opacity-5"
                                src="https://picsum.photos/300/230">
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        

        @auth
        <div class="text-center mt-16">
            <!-- Horizontal Line -->
            <hr class="border-gray-500 my-8 mx-auto w-1/2">
            
            <h3 class="text-2xl font-semibold text-white">Find another book for you to borrow !</h3>
            <p class="mt-4 text-lg text-gray-300">
                <a href="/explore" class="underline text-yellow-300 hover:text-yellow-400">Click here</a> to search for more books.
            </p>
            
        </div>
        @else
        <div class="text-center mt-16">
            <!-- Horizontal Line -->
            <hr class="border-gray-500 my-8 mx-auto w-1/2">
            
            <h3 class="text-2xl font-semibold text-white">Full Access Awaits</h3>
            <p class="mt-4 text-lg text-gray-300">
                <a href="/register" class="underline text-yellow-300 hover:text-yellow-400">Sign up</a> or log in to explore all our book features and get personalized recommendations.
            </p>
            
            <a href="{{ route('login') }}" class="mt-6 inline-block px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-yellow-300 hover:bg-yellow-400 shadow-lg transform hover:scale-105 transition duration-300 ease-in-out">
                Login
            </a>
        </div>
        @endauth


    </div>

    </div>
</section>




{{-- Animasi button arrow up --}}
<script>
    // Ambil elemen tombol dan section
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    const historySection = document.getElementById('history');
  
    // Fungsi untuk mengecek apakah section history sudah terlihat sedikit
    function checkScroll() {
      const rect = historySection.getBoundingClientRect();
  
      // Tentukan batas di mana tombol mulai muncul (misalnya, 20% dari tinggi section)
      const threshold = window.innerHeight * 0.4; // 20% dari tinggi viewport
  
      // Tombol muncul saat bagian atas history section sudah mencapai threshold
      if (rect.top <= threshold) {
        scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        scrollToTopBtn.classList.add('opacity-100', 'pointer-events-auto');
      } else {
        // Jika section history belum mencapai threshold, sembunyikan tombol
        scrollToTopBtn.classList.remove('opacity-100', 'pointer-events-auto');
        scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
      }
    }
  
    // Jalankan fungsi checkScroll saat user scroll
    window.addEventListener('scroll', checkScroll);
  
    // Scroll ke atas saat tombol diklik
    scrollToTopBtn.addEventListener('click', function (e) {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  
    // Jalankan checkScroll saat halaman pertama kali dimuat untuk mengecek posisi awal
    window.addEventListener('load', checkScroll);
</script>
    

{{-- Animasi active line  --}}
<script>
    // Get the elements for the History and Preview Books boxes
    const historyBox = document.getElementById('history-box');
    const previewBox = document.getElementById('preview-box');
    const activeLine = document.getElementById('active-line');

    // Set initial active state for History
    activeLine.style.left = '0'; // Position the active line at History initially

    // Add hover event for History
    historyBox.addEventListener('mouseenter', function() {
        activeLine.style.left = '0'; // Move the active line to History
        activeLine.style.width = '50%'; // Ensure the line is half-width
    });

    // Add hover event for Preview Books
    previewBox.addEventListener('mouseenter', function() {
        activeLine.style.left = '50%'; // Move the active line to Preview Books
        activeLine.style.width = '50%'; // Ensure the line is half-width
    });
</script>


{{-- Intersection bagian preview --}}
<script>
    // Function to handle intersection (when the element enters the viewport)
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            // When the element enters the viewport
            if (entry.isIntersecting) {
                entry.target.classList.remove('fade-out-down'); // Remove the fade-out-down class if it's coming back to view
                entry.target.classList.add('fade-in-up'); // Add fade-in-up class for entering
            } else {
                entry.target.classList.remove('fade-in-up'); // Remove the fade-in-up class when it's out of view
                entry.target.classList.add('fade-out-down'); // Add fade-out-down class for leaving
            }
        });
    }, {
        threshold: 0.5 // Trigger when 50% of the element is in view
    });

    // Observe each book item
    document.querySelectorAll('.book-item').forEach(item => {
        observer.observe(item);
    });
</script>

<!-- SweetAlert untuk pesan sukses -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Logout Success!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif


@endsection
