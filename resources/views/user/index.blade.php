@extends('layout.index')
@section('content')

@if(Session::get('success'))
<div class="bg-green-500 text-white p-2">
    {{ Session::get('success') }}
</div>
@endif
<div class="flex justify-end w-full">
    <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5 me-5">
        <a href="{{route('user.form')}}">+ Tambah Akun</a>
    </button>
</div>
<div class="flex justify-center">
    <div class="relative shadow-md rounded-lg w-2/3 mt-9">
        <table class="w-full rounded-lg text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="bg-blue-500 text-white">
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Role
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">()</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users->whereIn('role', ['staff', 'head_staff']) as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user['name'] }}
                </th>
                <td class="px-6 py-4">
                    {{ $user['email'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $user['role'] }}
                </td>
                <td class="px-6 py-4 flex flex-row">
                    <a href="{{ route('user.form.edit', $user['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline me-2">
                        <i class="fa-duotone fa-solid fa-square-pen text-2xl text-blue-700"></i>
                    </a>
                    <form action="{{ route('user.delete', $user['id']) }}" method="POST" id="form-delete-user">
                        @csrf
                        @method('DELETE')
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline" type="submit" onclick="deleteUser({{ $user['id'] }}, '{{ $user['name'] }}')">
                            <i class="fa-duotone fa-solid fa-trash-can text-2xl ms-2 text-red-700"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-full h-auto rounded overflow-hidden shadow-lg bg-white mt-5 p-6">
        <h2 class="text-3xl font-bold mb-6 text-center">Buat Akun Staff</h2>
        <form class="flex flex-col" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <label for="name" class="mb-2 text-gray-700 font-semibold">Name</label>
                    <input type="text" id="name" name="name" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <label for="email" class="mb-2 text-gray-700 font-semibold">Email</label>
                    <input type="text" id="email" name="email" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    <select selected hidden id="role" name="role" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                        <option value="staff" selected hidden {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                    </select>
                <label for="password" class="mb-2 text-gray-700 font-semibold">Password</label>
                    <input type="password" id="password" name="password" class="border border-gray-400 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-red-500" required>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">
                    Pesan
                </button>
        </form>
    </div>
</div>
</div>
@endsection

