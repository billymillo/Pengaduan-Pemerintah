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
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        @if(Session::get('failed'))
        <div class="flex flex-col justify-center items-center mb-10">
            <div class="bg-red-500 text-white p-2 w-2/3 rounded-xl">
                {{ Session::get('failed') }}
            </div>
        </div>
        @endif
        @if(Session::get('success'))
        <div class="flex flex-col justify-center items-center mb-10">
            <div class="bg-green-500 text-white p-2 w-2/3 rounded-xl">
                {{ Session::get('success') }}
            </div>
        </div>
        @endif

        <div class="flex items-center justify-center">
        <div class="w-full max-w-2xl p-8 bg-white border border-gray-200 rounded-lg shadow sm:p-10 md:p-12 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="{{route('login.auth')}}" method='POST'>
                @csrf
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Login Your Account</h5>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-start text-gray-900 dark:text-white">Your email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                </div>
                <div>
                    <label for="password" class="text-start block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                </div>
                <div class="flex flex-col gap-6">
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Login to your account
                </button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a href="{{route('register')}}" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('content')
</body>
</html>

