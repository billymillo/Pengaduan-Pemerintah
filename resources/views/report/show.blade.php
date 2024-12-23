@extends('layout.index')
@section('content')
<div class="flex flex-row w-full h-screen">
    {{-- Left Section --}}
    <div class="flex flex-col w-2/3 bg-blue-900">
        {{-- Reports Section --}}
        <div class="flex flex-col justify-center w-full mt-20">
            {{-- Success Message --}}
            @if(Session::get('success'))
            <div class="bg-green-500 text-white p-2">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="flex flex-col justify-start items-start w-full pl-10">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <a href="">Proses Pengaduan</a> 
                </button>
            </div>
                <div class="flex rounded-tl-lg rounded-tr-lg flex-col w-11/ mx-10 items-center bg-white border border-gray-200 shadow md:flex-row dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover m-3 rounded-t-lg h-64 w-96" src="/images/{{ $report['image'] }}" alt="Image Keluhan">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <p class="font-bold text-lg">{{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                        <p class="font-bold">{{ $report->user->email }}</p>
                        <h5 class="mb-2 text-xl font-normal tracking-tight text-gray-900 dark:text-white">{{ $report->description }}</h5>
                        <p class=" text-gray-700 dark:text-gray-400 province-name">Provinsi : {{ $report->province }}</p>
                        <p class=" text-gray-700 dark:text-gray-400 regency-name">Kabupaten : {{ $report->regency }}</p>
                        <p class=" text-gray-700 dark:text-gray-400 subdistrict-name">Kacamatan : {{ $report->subdistrict }}</p>
                        <p class=" text-gray-700 dark:text-gray-400 village-name">Desa : {{ $report->village }}</p>
                        <div class="flex flex-row space-x-2">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-start mx-10 py-5 bg-white rounded-bl-xl rounded-br-xl">
                    @if($report->comments && $report->comments->isNotEmpty())
                        @foreach ($report->comments as $comment)
                            <div class="flex justify-start gap-2.5">
                                <div class="ms-4 w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                    <span class="text-white text-lg">{{ substr($comment->user->email, 0, 1)}}</span>
                                </div>
                                <div class="flex flex-col gap-1 w-full max-w-[320px]">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{$comment->user->email}}</span>
                                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($comment->created_at)->locale('id')->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                        <p class="text-sm font-normal text-gray-900 dark:text-white">{{$comment->comment}}</p>
                                    </div>
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center">No comments available.</p>
                    @endif
                </div>


            {{-- COMMENT SITE --}}
            <form action="{{ route('report.comment', $report['id']) }}" method="POST" class="flex flex-col items-center w-full mt-10 h-full">
                @csrf
                <div class="w-11/12 h-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" name="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required ></textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                        <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post comment
                        </button>
                        <input type="hidden" name="report_id" value="{{ $report->id }}">
                        <div class="flex ps-0 space-x-1 rtl:space-x-reverse sm:ps-2">
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 20">
                                     <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6"/>
                                 </svg>
                                <span class="sr-only">Attach file</span>
                            </button>
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                     <path d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                 </svg>
                                <span class="sr-only">Set location</span>
                            </button>
                            <button type="button" class="inline-flex justify-center items-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                     <path d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z"/>
                                 </svg>
                                <span class="sr-only">Upload image</span>
                            </button>
                        </div>
                    </div>
                </div>
             </form>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex flex-col justify-center items-center w-1/3 h-full bg-white">
        <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-md p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 8.5a3.5 3.5 0 113.5 3.5A3.5 3.5 0 0112 8.5z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 ml-3">Informasi Pembuatan Pengaduan</h2>
            </div>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                <li>Keseluruhan data pada pengaduan bernilai <span class="font-bold">BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</span>.</li>
                <li>Seluruh bagian data perlu diisi.</li>
                <li>Pengaduan Anda akan ditanggapi dalam <span class="font-bold">2x24 Jam</span>.</li>
                <li>Periksa tanggapan Kami, pada <span class="font-bold">Dashboard</span> setelah Anda <span class="font-bold">Login</span>.</li>
                <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="{{ route('report.create') }}" class="text-blue-600 underline">Ikuti Tautan</a>.</li>
            </ol>
        </div>

    </div>
</div>
@endsection
