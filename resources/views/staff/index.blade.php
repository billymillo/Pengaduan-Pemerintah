@extends('layout.index')
@section('content')
<section class="bg-cover bg-no-repeat bg-[url('https://c0.wallpaperflare.com/path/968/80/27/jakarta-indonesia-city-building-fa7f4b6e1a08bce421245eedfd7c3111.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center h-screen w-full py-32">
                {{-- Success Message --}}
                @if(Session::get('success'))
                <div class="bg-green-500 text-white p-2 w-full">
                    {{ Session::get('success') }}
                </div>
                @endif
                @if(Session::get('failed'))
                <div class="bg-red-500 text-white p-2 w-full">
                    {{ Session::get('failed') }}
                </div>
                @endif
        <div class="flex items-center justify-center w-full">
            <div class="relative w-full shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Gambar & Pengirim</th>
                            <th scope="col" class="px-6 py-3">Lokasi & Tanggal</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                            <th scope="col" class="px-6 py-3">Jumlah Vote</th>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ route('response.data', ['sort' => 'votes', 'order' => request()->query('order') == 'asc' ? 'desc' : 'asc']) }}" class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l5.25 1.58 5.25-1.58M3 8.25V4.5l12 6V8.25" />
                                    </svg>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($responses as $data)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button type="button" data-modal-target="image-modal-{{ $data->id }}" data-modal-toggle="image-modal-{{ $data->id }}"  class="ms-4 w-8 h-8 rounded-full overflow-hidden bg-blue-500 flex items-center justify-center">
                                    <img src="/images/{{ $data->image }}" alt="" class="w-full h-full object-cover">
                                </button>
                                     <p class="ps-4">{{ $data->user->email }}</p>
                            </th>
                            <td class="px-6 py-4 text-black">
                                <p>{{ $data->province }}, {{ $data->regency }}, {{ $data->subdistrict }}, {{ $data->village }}</p>
                                <p>{{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                            </td>
                            <td class="px-6 py-4 text-black">
                                <p class="limit-text">{{ Str::limit($data->description, 50) }}</p>
                            </td>
                            <td class="px-6 py-4 text-black">
                                <p>{{ $data->upvotes }}</p>
                            </td>
                            {{-- DropDown --}}
                            <td class="px-6 py-4 text-black">
                            {{-- Position Relative --}}
                                <div class="relative">
                                    <button id="dropdownButton-{{ $data->id }}" data-dropdown-toggle="dropdown-{{ $data->id }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700" type="button">
                                        Aksi
                                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg>
                                    </button>
                                    <div id="dropdown-{{ $data->id }}" class="z-50 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                                <button type="button" data-modal-target="static-modal-{{ $data->id }}" data-modal-toggle="static-modal-{{ $data->id }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" onclick="this.style.display='none'">Tindak Lanjut</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Form Halaman Report -->
                        <form action="{{ route('response.store.response', $data->id) }}" method="POST">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div id="static-modal-{{ $data->id }}" data-modal-backdrop="static" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen">
                                <div class="relative p-4 w-full max-w-2xl">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                                            <h3 class="text-xl font-semibold dark:text-white">Tindak Lanjut Penanggapan</h3>
                                            <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="static-modal-{{ $data->id }}">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <p class="text-start">Tanggapan</p>
                                            <select name="responses_status" class="w-full p-2.5 rounded-lg border dark:bg-gray-700 dark:text-white">
                                                <option value="on_process" name="on_process">Proses Penyelesaian/Perbaikan</option>
                                                <option value="reject" name="reject">Tolak</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end p-4 border-t dark:border-gray-600">
                                            <input type="hidden" name="report_id" value="{{ $data->id }}">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5">Lanjut</button>
                                            <button type="button" data-modal-hide="static-modal-{{ $data->id }}" class="ms-3 px-5 py-2.5 text-gray-900 bg-gray-200 rounded-lg hover:bg-gray-300">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        {{-- Image Modal --}}
                        <div id="image-modal-{{ $data->id }}" data-modal-backdrop="static" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen">
                            <div class=" flex justify-center items-center relative p-4 w-full max-w-2xl">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                                        <h3 class="text-xl font-semibold dark:text-white">Image</h3>
                                        <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="image-modal-{{ $data->id }}">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 me-8">
                                        <img class="object-cover m-3 rounded-lg w-full" src="/images/{{ $data->image }}" alt="Image Keluhan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Flowbite Script -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
