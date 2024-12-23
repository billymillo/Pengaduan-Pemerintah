<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Pemerintah</title>
    @vite('resources/css/app.css','resources/js/app.js')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-blue-900">
<section class="bg-cover bg-no-repeat bg-[url('https://c0.wallpaperflare.com/path/968/80/27/jakarta-indonesia-city-building-fa7f4b6e1a08bce421245eedfd7c3111.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-60">
        <h1 class="mb-4 pt-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Pengaduan Masyarakat</h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Website pengaduan masyarakat tentang daerahnya adalah platform online yang memungkinkan masyarakat untuk melaporkan dan mengadukan masalah-masalah yang terjadi di daerah mereka.
            Tujuan dari website ini adalah untuk mempermudah masyarakat dalam proses pengaduan dan memungkinkan pemerintah daerah untuk menangani masalah-masalah tersebut dengan lebih efektif.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="{{ route('login')}}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Bergabung Dengan Kita
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('content')
</body>
</html>
