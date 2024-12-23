@extends('layout.index')
@section('content')

<div class="mx-10 my-10">
    @if($reports->isEmpty())
        <div class="bg-white mt-5 border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-lg shadow-lg p-4 text-center">
            <p class="text-xl font-semibold">Kamu Belum Memiliki Pengaduan</p>
        </div>
    @else
        @foreach ($reports as $report)
        <div class="bg-white mt-5 border-gray-200 dark:border-gray-600 dark:bg-gray-900 rounded-lg shadow-lg">
            <div class="flex justify-between items-center p-4">
                <p class="text-xl font-semibold">
                    Pengaduan {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('d F Y') }}
                </p>
                <button
                    class="dropdown-toggle flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                    data-dropdown="menu-{{ $loop->index }}">
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
            </div>
            <div
                class="dropdown-menu hidden flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4"
                id="menu-{{ $loop->index }}"
                data-menu="menu-{{ $loop->index }}">
                <ul class="flex w-full justify-between p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 dark:border-gray-700">
                    <li class="flex justify-start">
                        <a href="#" class="section-link" data-section="data-{{ $loop->index }}">Data</a>
                    </li>
                    <li class="flex justify-center">
                        <a href="#" class="section-link" data-section="gambar-{{ $loop->index }}">Gambar</a>
                    </li>
                    <li class="flex justify-end">
                        <a href="#" class="section-link" data-section="status-{{ $loop->index }}">Status</a>
                    </li>
                </ul>
            </div>
            <div class="p-4">
                <!-- Data Section -->
                <div class="content-section hidden" id="data-{{ $loop->index }}">
                    <h2 class="text-lg font-semibold">Data</h2>
                    <p>Tipe: {{ $report->type }}</p>
                    <p>Lokasi: {{ $report->village }}, {{ $report->subdistrict }}, {{ $report->regency }}, {{ $report->province }}</p>
                    <p>Deskripsi: {{ $report->description }}</p>
                    <p>Pelapor: {{ $report->user->name }} - {{ $report->user->email }}</p>
                </div>

                <!-- Image Section -->
                <div class="content-section hidden" id="gambar-{{ $loop->index }}">
                    <h2 class="text-lg font-semibold">Gambar</h2>
                    <img src="/images/{{ $report->image }}" alt="Report Image" class="rounded-lg">
                </div>

                <!-- Status Section -->
                <div class="content-section hidden" id="status-{{ $loop->index }}">
                    <h2 class="text-lg font-semibold">Progress Status</h2>
                    <p>Pengaduan belum direspon petugas, ingin menghapus data pengaduan?.</p>
                <form action="{{ route('report.delete', $report->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-700 hover:bg-red-800 rounded-lg px-5 py-2.5">Hapus</button>
                </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownButtons = document.querySelectorAll(".dropdown-toggle");
        const sectionLinks = document.querySelectorAll(".section-link");
        const contentSections = document.querySelectorAll(".content-section");

        // Function to hide all content sections
        const hideAllSections = () => {
            contentSections.forEach(section => section.classList.add("hidden"));
        };

        // Handle dropdown toggle
        dropdownButtons.forEach(button => {
            button.addEventListener("click", () => {
                const menuId = button.dataset.dropdown;
                const menu = document.querySelector(`[data-menu="${menuId}"]`);

                // Hide all sections whenever dropdown toggles
                hideAllSections();

                // Toggle dropdown visibility
                menu.classList.toggle("hidden");
            });
        });

        // Handle section links
        sectionLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();

                // Get target section ID
                const sectionId = link.dataset.section;

                // Hide all sections and show the selected one
                hideAllSections();
                document.getElementById(sectionId).classList.remove("hidden");
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
@endsection

