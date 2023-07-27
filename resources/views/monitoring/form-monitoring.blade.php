@extends('layouts.main')
@section('main')
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-2xl lg:text-left text-center font-extrabold text-gray-800 sm:text-3xl dark:text-white">
            Form
            Monitoring PYDB
    </header>
    <hr class="my-5">
    @include('alert')
    <div class="w-full lg:w-1/3 mb-20">
        <form action="{{ route('monitoring.store') }}" method="post" enctype="multipart/form-data" class="mx-3">
            @csrf
            <div class="mb-3">
                <label for="tanggal" class="block text-sm font-semibold mb-2 dark:text-white">Tanggal
                    Kunjungan</label>
                <input type="date" id="tanggal" name="tanggal"
                    class="py-3 @error('tanggal')
                        border-red-500
                    @enderror px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    required>
                @error('tanggal')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="petugas" class="block text-sm font-semibold mb-2 dark:text-white">Petugas</label>
                <select id="petugas"
                    class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    required>
                    <option value="">--Pilih Petugas--</option>
                    @foreach ($user as $item)
                    <option value="{{ $item->sub_name }}">{{ $item->sub_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="majelis" class="block text-sm font-semibold mb-2 dark:text-white">Majelis</label>
                <select id="majelis" name="majelis"
                    class="@error('majelis')
                        border-red-500
                    @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    required>
                </select>
                @error('majelis')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="anggota" class="block text-sm font-semibold mb-2 dark:text-white">Anggota</label>
                <select id="anggota" name="anggota"
                    class="@error('anggota')
                        border-red-500
                    @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    required>
                </select>
                @error('anggota')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nominal" class="block text-sm font-semibold mb-2 dark:text-white">Nominal Bayar</label>
                <input type="text" name="nominal" id="nominal"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    required>
            </div>
            <div class="mb-3">
                <label for="ditemui" class="block text-sm font-semibold mb-2 dark:text-white">Ditemui</label>
                <div class="grid grid-cols-2 gap-2">
                    <label for="hs-radio-on-right"
                        class="flex p-3 block w-full bg-white border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Bisa</span>
                        <input type="radio" name="ditemui" value="bisa"
                            class="shrink-0 ml-auto mt-0.5 border-gray-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                            id="hs-radio-on-right">
                    </label>

                    <label for="hs-radioradio-on-right"
                        class="flex p-3 block w-full bg-white border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Tidak Bisa</span>
                        <input type="radio" name="ditemui" value="tidak bisa"
                            class="shrink-0 ml-auto mt-0.5 border-gray-200 rounded-full text-blue-600 pointer-events-none focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                            id="hs-radioradio-on-right" checked>
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="pola_bayar" class="block text-sm font-semibold mb-2 dark:text-white">Pola Bayar</label>
                <select name="pola_bayar" id="pola_bayar"
                    class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                    <option value="seminggu sekali">seminggu sekali</option>
                    <option value="sebulan 2 kali">sebulan 2 kali</option>
                    <option value="sebulan 3 kali">sebulan 3 kali</option>
                    <option value="sebulan sekali">sebulan sekali</option>
                    <option value="tidak bayar bayar">tidak bayar bayar</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="block text-sm font-semibold mb-2 dark:text-white">kondisi / situasi
                    anggota saat ini:</label>
                <textarea name="kondisi" id="kondisi"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="hasil" class="block text-sm font-semibold mb-2 dark:text-white">Hasil penagihan atau
                    kunjungan ke PYDB:</label>
                <textarea name="hasil" id="hasil"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                    rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="input-label" class="block text-sm font-semibold mb-2 dark:text-white">Dokumentasi:</label>
                <input type="file" name="dokumentasi" id="dokumentasi" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                      file:bg-transparent file:border-0
                      file:bg-gray-100 file:mr-4
                      file:py-3 file:px-4
                      dark:file:bg-gray-700 dark:file:text-gray-400">
            </div>
            <div class="mb-3">
                <button type="submit"
                    class="py-3 w-full mb-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                    Simpan
                </button>
                <a href="{{ route('monitoring.index') }}"
                    class="py-3 px-4 w-full inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        select_majelis();
        $('#petugas').change(function (e) {
            e.preventDefault();
            var petugas = $(this).val();
            var token = $('meta[name="csrf-token"]').attr('content'); // Ambil nilai token CSRF
            $.ajax({
                url: "{{ route('monitoring.majelis') }}",
                type: "POST",
                data: {
                    petugas: petugas,
                    _token: token // Sertakan token CSRF dalam data permintaan
                },
                success: function (response) {
                    $('#majelis').html(response)
                    var majelis = $('#majelis').val();
                    var token = $('meta[name="csrf-token"]').attr(
                        'content');
                    $.ajax({
                        url: "{{ route('monitoring.anggota') }}",
                        type: "POST",
                        data: {
                            majelis: majelis,
                            _token: token
                        },
                        success: function (response) {
                            $('#anggota').html(response)
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        function select_majelis() {
            $('#majelis').change(function (e) {
                e.preventDefault();
                var majelis = $(this).val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('monitoring.anggota') }}",
                    type: "POST",
                    data: {
                        majelis: majelis,
                        _token: token
                    },
                    success: function (response) {
                        $('#anggota').html(response)
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        }
    });

</script>
@endsection
