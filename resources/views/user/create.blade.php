@extends('layout.index')
@section('content')
<section class="bg-cover w-full h-screen bg-no-repeat bg-[url('https://c0.wallpaperflare.com/path/968/80/27/jakarta-indonesia-city-building-fa7f4b6e1a08bce421245eedfd7c3111.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="container flex justify-center h-full w-full">
        <div class="w-3/4 h-3/4 rounded overflow-hidden shadow-lg bg-white mt-20 ms-5 p-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Tambah Akun</h2>
            <form class="flex flex-col" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <label for="name" class="mb-2 text-gray-700 font-semibold">Name</label>
                        <input type="text" id="name" name="name" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <label for="email" class="mb-2 text-gray-700 font-semibold">Email</label>
                        <input type="text" id="email" name="email" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <label for="role" class="mb-2 text-gray-700 font-semibold">Role</label>
                        <select hidden selected id="role" name="role" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            <option hidden selected value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    <label for="password" class="mb-2 text-gray-700 font-semibold">Password</label>
                        <input type="password" id="password" name="password" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">
                        Pesan
                    </button>
            </form>
        </div>
    </div>
</section>
@endsection
