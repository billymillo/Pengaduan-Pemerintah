@extends('layout.index')
@section('content')

    <section
        class="bg-cover bg-no-repeat bg-[url('https://c0.wallpaperflare.com/path/968/80/27/jakarta-indonesia-city-building-fa7f4b6e1a08bce421245eedfd7c3111.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="flex justify-center items-center w-full h-screen">
            <div class="w-11/12 h-5/6 p-6 bg-white border border-gray-200 rounded-lg">
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
                <div class="flex flex-row justify-between">
                    <h2 class="font-bold text-lg">{{ $response->report->user->email }}</h2>
                    <button class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                        onclick="history.back()">Kembali</button>
                </div>
                <p class="text-md">
                    {{ \Carbon\Carbon::parse($response->report->created_at)->locale('id')->translatedFormat('d F Y') }}
                    <span class="font-bold">Status Tanggapan :
                        <button
                            class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">{{ strtoupper($response->responses_status) }}</button>
                    </span>
                </p>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col w-1/2 mt-4 me-10 p-6 bg-blue-300 border border-gray-300 rounded-lg">
                        <p class="text-md font-bold">{{ $response->report->province }}, {{ $response->report->regency }},
                            {{ $response->report->subdistrict }}, {{ $response->report->village }}</p>
                        <p class="mt-4">{{ $response->report->description }} </p>
                        <img class="mt-3 w-1/2 h-auto" src="/images/{{ $response->report->image }}" alt="">
                    </div>
                    <div class="flex flex-col w-1/2 mt-4">
                        <div class="flex flex-col h-full">
                            @foreach ($response->progress as $progress)
                                <ol class="relative border-l pt-3 border-gray-200 dark:border-gray-700">
                                    <li class="ms-4">
                                        <div
                                            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                                        </div>
                                        <form action="{{ route('response.delete', $progress->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <p
                                                    class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500 underline hover:text-blue-500">
                                                    {{ \Carbon\Carbon::parse($progress->created_at)->locale('id')->translatedFormat('d F Y') }}
                                                </p>
                                            </button>
                                        </form>
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $progress->histories }}</h3>
                                    </li>
                                </ol>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-end items-end w-full">

                    <form action="{{ route('response.store.done', $response->id) }}" method="POST">
                        @csrf
                        <button class="bg-blue-800 me-1 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">Nyatakan
                            Selesai</button>
                    </form>
                    <button type="button" data-modal-target="history-modal-{{ $response->report->id }}"
                        data-modal-toggle="history-modal-{{ $response->report->id }}"
                        class="bg-gray-200 hover:bg-gray-300 text-blue-800 font-bold py-2 px-4 rounded">Tambah
                        Tanggapan</button>
                </div>
            </div>

            {{-- Modal Report Progress --}}
            <form action="{{ route('response.store') }}" method="POST">
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
                <div id="history-modal-{{ $response->report->id }}" data-modal-backdrop="static" tabindex="-1"
                    class="hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen">
                    <div class=" flex justify-center items-center relative p-4 w-full max-w-4xl">
                        <div class="relative w-full bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                                <h3 class="text-xl font-semibold dark:text-white">Progress Tindak Lanjut</h3>
                                <button type="button" class="text-gray-400 hover:text-gray-900"
                                    data-modal-hide="history-modal-{{ $response->report->id }}">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 me-8">
                                <p class="font-semibold text-md text-gray-600">Tanggapan</p>
                                <textarea id="histories" name="histories" rows="4"
                                    class="w-full p-5 mt-5 px-4  text-sm text-gray-900 bg-white border border-gray-300 rounded-lg hover:border-blue-500 focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400 dark:border-gray-600 dark:hover:border-blue-500"
                                    placeholder="Write a response..." required></textarea>
                            </div>
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <input type="hidden" name="response_id" value="{{ $response->id }}">
                                <button data-modal-hide="default-modal" type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Buat
                                </button>
                                <button data-modal-hide="default-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection
