@extends('layout.index')
@section('content')
    <div class="flex flex-row w-full h-auto">
        {{-- Left Section --}}
        <div class="flex flex-col items-center w-2/3 bg-blue-900">

            {{-- SEARCH --}}
            {{-- Success Message --}}
            @if (Session::get('success'))
                <div class="bg-green-500 text-white p-2 w-full">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('failed'))
                <div class="bg-red-500 text-white p-2 w-full">
                    {{ Session::get('failed') }}
                </div>
            @endif
            <form class="w-full mt-8 mb-5" action="{{ route('report.data') }}" method="GET" role="search">
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative mx-10">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <select name="search_province" id="search_province"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected hidden class="text-gray-900">Search Keluhan</option>
                    </select>
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            {{-- Reports Section --}}
            <div class="flex flex-col items-center">
                @foreach ($reports as $report)
                    <div class="flex flex-col gap-6 w-full items-center mb-3">
                        <div
                            class="flex flex-col w-3/4 items-center bg-white border border-gray-200 rounded-lg shadow mx-10 md:flex-row hover:bg-blue-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="object-cover m-3 rounded-t-lg h-48 w-96" src="/images/{{ $report['image'] }}"
                                alt="Image Keluhan">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <div class="flex flex-row justify-between">
                                    <a href="{{ route('report.show', $report['id']) }}"
                                        class="mb-2 text-xl font-bold tracking-tight hover:underline text-gray-900 dark:text-white">
                                        <span class="limit-text">{{ Str::limit($report->description, 50) }}</span>
                                    </a>
                                    {{-- <p>{{ $report->province}}</p>
                            <p>{{ $report->regency}}</p>
                            <p>{{ $report->subdistrict}}</p>
                            <p>{{ $report->village}}</p> --}}
                                    <form method="POST" action="{{ route('report.like', $report['id']) }}">
                                        @csrf
                                        <button type="submit" onclick="this.querySelector('i').style.color = 'red'">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                </div>
                                <p class="font-normal text-gray-700 dark:text-gray-400 province-name"
                                    data-id="{{ $report->province }}"></p>
                                <p class="font-normal text-gray-700 dark:text-gray-400 regency-name"
                                    data-id="{{ $report->regency }}"></p>
                                <p class="font-normal text-gray-700 dark:text-gray-400 subdistrict-name"
                                    data-id="{{ $report->subdistrict }}"></p>
                                <p class="font-normal text-gray-700 dark:text-gray-400 village-name"
                                    data-id="{{ $report->village }}"></p>
                                <div class="flex flex-row space-x-2">
                                    <p><i class="fa-solid fa-eye"> {{ $report->viewers }}</i></p>
                                    <p><i class="fa-solid fa-shield-heart"> {{ $report->upvotes }}</i></p>
                                </div>
                                <p>{{ $report->created_at }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Right Section --}}
        <div class="flex flex-col justify-center items-center w-1/3 h-screen bg-white">
            <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 8.5a3.5 3.5 0 113.5 3.5A3.5 3.5 0 0112 8.5z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800 ml-3">Informasi Pembuatan Pengaduan</h2>
                </div>
                <ol class="list-decimal list-inside text-gray-700 space-y-2">
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <span class="font-bold">BENAR dan DAPAT DIPERTANGGUNG
                            JAWABKAN</span>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam <span class="font-bold">2x24 Jam</span>.</li>
                    <li>Periksa tanggapan Kami, pada <span class="font-bold">Dashboard</span> setelah Anda <span
                            class="font-bold">Login</span>.</li>
                    <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="{{ route('report.create') }}"
                            class="text-blue-600 underline">Ikuti Tautan</a>.</li>
                </ol>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch Provinces for Search Dropdown
            $.ajax({
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',
                method: 'GET',
                success: function(response) {
                    // Populate dropdown
                    $('#search_province').empty().append(
                        '<option value="" selected hidden>Select Province</option>');
                    response.forEach(function(province) {
                        $('#search_province').append('<option value="' + province.name + '">' +
                            province.name + '</option>');
                    });
                },
            });
        });
    </script>
@endsection
