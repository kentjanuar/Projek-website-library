<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>Library</title>

    <!-- Tailwind CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Poppins link for logo font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOutDown {
            0% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .fade-out-down {
            opacity: 1;
            animation: fadeOutDown 0.6s ease-in forwards;
        }
    </style>
</head>

<body class="bg-gray-700">

    <!-- Navbar -->
    <div class="dark">
        @include('include.navbar')
    </div>

    <!-- Main content with sidebar -->
    <div class="dark">
        
        @auth
            <div>
                @include('include.sidebar')
            </div>
        @endauth
       
    </div>
    
    <div>
        @yield('container')
    </div>

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout() {
          Swal.fire({
            title: 'Logout?',
            text: "Do you want to Logout?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout!',
            cancelButtonText: 'No'
          }).then((result) => {
            if (result.isConfirmed) {
              // Jika pengguna mengkonfirmasi logout, kirimkan form
              document.getElementById('logout-form').submit(); // Mengakses form dengan ID 'logout-form' dan submit form tersebut
            }
          });
        }
      </script>
</body>

</html>
