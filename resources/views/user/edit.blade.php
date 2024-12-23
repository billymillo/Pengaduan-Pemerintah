@extends('layout.index')
@section('content')
    <div class="container flex justify-center h-full w-full mt-5">
        <div class="w-3/4 h-3/4 rounded overflow-hidden shadow-lg bg-white mt-5 ms-5 p-6">
            <h2 class="text-3xl font-bold mb-6 text-center">Tambah Akun</h2>
            <form class="flex flex-col" action="{{ route('user.form.update', $userId['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <label for="name" class="mb-2 text-gray-700 font-semibold">Name</label>
                    <input type="text" value="{{$userId['name']}}" id="name" name="name" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <label for="email" class="mb-2 text-gray-700 font-semibold">Email</label>
                    <input type="text" value="{{$userId['email']}}" id="email" name="email" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <label for="role" class="mb-2 text-gray-700 font-semibold">Role</label>
                    <select id="role" name="role" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="head_staff" {{ old('role') == 'head_staff' ? 'selected' : ''   }}>Headstaff</option>
                    </select>
                <label for="password" class="mb-2 text-gray-700 font-semibold">Password</label>
                    <input type="password" id="password" name="password" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" >
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">
                    Edit Akun
                </button>
            </form>
        </div>
    </div>

@endsection
