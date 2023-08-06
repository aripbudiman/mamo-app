@extends('mobile.app')
@section('mobile')
<header class="flex justify-between p-5 bg-hijau-20 text-white shadow-md">
    <a href="{{  route('mobile.home') }}"><i class="bi bi-chevron-left fill-blue-800 font-semibold mr-3"></i> Form
        Monitoring</a>
</header>
<div class="w-full px-3 py-3 bg-white">
    @if (Session::has('success'))
    <div id="dismiss-alert"
        class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-teal-50 border border-teal-200 rounded-md p-4"
        role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-4 w-4 text-teal-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                </svg>
            </div>
            <div class="ml-3">
                <div class="text-sm text-teal-800 font-medium">
                    File has been successfully uploaded.
                </div>
            </div>
            <div class="pl-3 ml-auto">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button"
                        class="inline-flex bg-teal-50 rounded-md p-1.5 text-teal-500 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-teal-50 focus:ring-teal-600"
                        data-hs-remove-element="#dismiss-alert">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-3 w-3" width="16" height="16" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M0.92524 0.687069C1.126 0.486219 1.39823 0.373377 1.68209 0.373377C1.96597 0.373377 2.2382 0.486219 2.43894 0.687069L8.10514 6.35813L13.7714 0.687069C13.8701 0.584748 13.9882 0.503105 14.1188 0.446962C14.2494 0.39082 14.3899 0.361248 14.5321 0.360026C14.6742 0.358783 14.8151 0.38589 14.9468 0.439762C15.0782 0.493633 15.1977 0.573197 15.2983 0.673783C15.3987 0.774389 15.4784 0.894026 15.5321 1.02568C15.5859 1.15736 15.6131 1.29845 15.6118 1.44071C15.6105 1.58297 15.5809 1.72357 15.5248 1.85428C15.4688 1.98499 15.3872 2.10324 15.2851 2.20206L9.61883 7.87312L15.2851 13.5441C15.4801 13.7462 15.588 14.0168 15.5854 14.2977C15.5831 14.5787 15.4705 14.8474 15.272 15.046C15.0735 15.2449 14.805 15.3574 14.5244 15.3599C14.2437 15.3623 13.9733 15.2543 13.7714 15.0591L8.10514 9.38812L2.43894 15.0591C2.23704 15.2543 1.96663 15.3623 1.68594 15.3599C1.40526 15.3574 1.13677 15.2449 0.938279 15.046C0.739807 14.8474 0.627232 14.5787 0.624791 14.2977C0.62235 14.0168 0.730236 13.7462 0.92524 13.5441L6.59144 7.87312L0.92524 2.20206C0.724562 2.00115 0.611816 1.72867 0.611816 1.44457C0.611816 1.16047 0.724562 0.887983 0.92524 0.687069Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="w-full pt-5 pb-20 bg-white">
    <form action="{{ route('monitoring.store') }}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="block text-sm font-semibold mb-2 dark:text-white">Tanggal
                Kunjungan</label>
            <input type="date" id="tanggal" name="tanggal"
                class="py-3 @error('tanggal')
                    border-red-500
                @enderror px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-white dark:border-gray-700 dark:text-gray-400">
            @error('tanggal')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="petugas" class="block text-sm font-semibold mb-2 dark:text-white">Petugas</label>
            <select id="petugas"
                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
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
                @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
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
                @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </select>
            @error('anggota')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nominal" class="block text-sm font-semibold mb-2 dark:text-white">Nominal Bayar</label>
            <input type="text" name="nominal" id="nominal"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
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
                rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="hasil" class="block text-sm font-semibold mb-2 dark:text-white">Hasil penagihan atau
                kunjungan ke PYDB:</label>
            <textarea name="hasil" id="hasil"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                rows="3"></textarea>
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
            <a href="{{ route('mobile.home') }}"
                class="py-3 px-4 w-full inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
                Kembali
            </a>
        </div>
    </form>
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
                        'content'); // Ambil nilai token CSRF
                    $.ajax({
                        url: "{{ route('monitoring.anggota') }}",
                        type: "POST",
                        data: {
                            majelis: majelis,
                            _token: token
                        },
                        success: function (response) {
                            console.log(response)
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
                var token = $('meta[name="csrf-token"]').attr('content'); // Ambil nilai token CSRF
                $.ajax({
                    url: "{{ route('monitoring.anggota') }}",
                    type: "POST",
                    data: {
                        majelis: majelis,
                        _token: token
                    },
                    success: function (response) {
                        console.log(response)
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
