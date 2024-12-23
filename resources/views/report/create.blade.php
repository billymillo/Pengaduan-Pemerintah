@extends('layout.index')
@section('content')
<section class="bg-cover bg-no-repeat bg-[url('https://c0.wallpaperflare.com/path/968/80/27/jakarta-indonesia-city-building-fa7f4b6e1a08bce421245eedfd7c3111.jpg')] bg-gray-700 bg-blend-multiply">
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
    <div class="flex items-center justify-center ">
        <div class="w-full max-w-2xl p-8 bg-white border border-gray-200 rounded-lg shadow sm:p-10 md:p-12 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6" action="{{route('report.store')}}" method="POST" enctype="multipart/form-data">
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
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Add Your Report</h5>

                <label for="province" class="block text-start text-sm font-medium text-gray-900 dark:text-white">Select a Province</label>
                <select id="province" name="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" selected>Pilih Provinsi</option>
                </select>

                <label for="regency" class="block text-start text-sm font-medium text-gray-900 dark:text-white">Select a City/District</label>
                <select id="regency" name="regency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" selected>Pilih Kota/Kabupaten</option>
                </select>

                <label for="subdistrict" class="block text-start text-sm font-medium text-gray-900 dark:text-white">Select a Sub-district</label>
                <select id="subdistrict" name="subdistrict" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" selected>Pilih Kecamatan</option>
                </select>

                <label for="village" class="block text-start text-sm font-medium text-gray-900 dark:text-white">Select a Village</label>
                <select id="village" name="village" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0" selected>Pilih Kelurahan</option>
                </select>

                <label for="type" class="block text-start text-sm font-medium text-gray-900 dark:text-white">Type Report</label>
                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected hidden>Type Report</option>
                    <option value="kejahatan">Laporan Kejahatan</option>
                    <option value="pembangunan">Laporan Pembangunan</option>
                    <option value="sosial">Laporan Sosial</option>
                </select>

                <label for="description" class=" text-start block text-sm font-medium text-gray-900 dark:text-white">Your description</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>

                <label for="image" class="text-start block text-sm font-medium text-gray-900 dark:text-white">Insert Image</label>
                <input type="file" id="image" name="image" class="block w-full px-8 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" required>

                <div class="flex items-center">
                    <input  type="checkbox" id="statement" name="statement" class="h-4 w-4 border border-gray-300 rounded focus:outline-none focus:ring-primary-500" value="true">
                    <label for="statement" class="ml-2 text-sm text-gray-600">
                        Laporan Yang Disampaikan Sesuai Dengan Kebenaran
                    </label>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500 mt-4">Submit Report</button>
            </form>
        </div>
    </div>
    </div>
</section>
<script>
    // Load provinces
    $.ajax({
        url: `https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`,
        method: "GET",
        success: function (response) {
            response.forEach(province => {
                $('#province').append(
                    `<option value="${province.name}" data-id="${province.id}">${province.name}</option>`
                );
            });
        },
        error: function (xhr, status, error) {
            console.error("Gagal memuat data provinsi:", error);
        }
    });

    // Load regencies
    $('#province').on('change', function () {
        let provinceId = $(this).val();
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${$(this).find('option:selected').data('id')}.json`,
            method: "GET",
            success: function (response) {
                $('#regency').empty();
                $('#regency').append('<option value="0" selected hidden>Pilih Kota/Kabupaten</option>');
                response.forEach(regency => {
                    $('#regency').append(
                        `<option value="${regency.name}" data-id="${regency.id}">${regency.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("Gagal memuat data kota/kabupaten:", error);
            }
        });
    });

    // Load districts
    $('#regency').on('change', function () {
        let regencyId = $(this).val();
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${$(this).find('option:selected').data('id')}.json`,
            method: "GET",
            success: function (response) {
                $('#subdistrict').empty();
                $('#subdistrict').append('<option value="0" selected hidden>Pilih Kecamatan</option>');
                response.forEach(district => {
                    $('#subdistrict').append(
                        `<option value="${district.name}" data-id="${district.id}">${district.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("Gagal memuat data kecamatan:", error);
            }
        });
    });

    // Load villages
    $('#subdistrict').on('change', function () {
        let subdistrictId = $(this).val();
        $.ajax({
            url: `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${$(this).find('option:selected').data('id')}.json`,
            method: "GET",
            success: function (response) {
                $('#village').empty();
                $('#village').append('<option value="0" selected hidden>Pilih Desa/Kelurahan</option>');
                response.forEach(village => {
                    $('#village').append(
                        `<option value="${village.name}" data-id="${village.id}">${village.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("Gagal memuat data desa/kelurahan:", error);
            }
        });
    });
</script>
@endsection

