@extends('mobile.app')
@section('mobile')
<header class="fixed h-15 w-full lg:w-96 z-50 top-0 bg-green-2 flex justify-center items-center">
    <a href="javascript:void(0);" onclick="history.back();"
        class="bg-white absolute left-4 flex justify-center text-green-2 w-[30px] h-[30px] shadow-md items-center px-2 py-1 rounded-md inset-y-4"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="font-bold text-xl text-white">Form Murabahah</h1>
</header>
<main class="absolute inset-0 pt-15 pb-20 overflow-y-auto">
    <form action="{{ route('murabahah.store') }}" method="POST" enctype="multipart/form-data" class="p-5">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="mb-1 block">Tanggal</label>
            <input type="date" name="tanggal"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
        </div>
        <div class="mb-3">
            <label for="petugas" class="mb-1 block">Petugas</label>
            <select id="petugas"
                class="@error('petugas')
                border-red-500
            @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                <option>--Pilih Petugas--</option>
                @foreach ($data as $item)
                <option value="{{ $item->sub_name }}">{{ $item->sub_name }}</option>
                @endforeach
            </select>
            @error('petugas')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="majelis" class="mb-1 block">Majelis</label>
            <select name="majelis" id="majelis"
                class="@error('majelis')
                border-red-500
            @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </select>
            @error('majelis')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="anggota" class="block mb-1">Anggota</label>
            <select id="anggota" name="anggota"
                class="@error('anggota')
                    border-red-500
                @enderror py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </select>
            @error('anggota')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nominal" class="block mb-1">Nominal Droping</label>
            <input type="text" id="nominal" name="nominal"
                class="@error('record')
                    border-red-500
                @enderror py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            @error('nominal')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi"
                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                rows="3"></textarea>
        </div>
        <div class="mb-3" id="list-foto">
            <div class="flex justify-between">
                <label for="dokumentasi" class="block mb-1">Foto Dokumentasi</label>
                <button type="button" id="tambah-foto"
                    class="py-1 px-1 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-green-2 text-white hover:bg-hijau-20  focus:ring-offset-2 transition-all text-xs dark:focus:ring-offset-gray-800">
                    Tambah Foto
                </button>
            </div>
            <p class="text-xs intalic text-gray-500">pastikan foto yg unggah berjenis jpg,png atau jpeg</p>
            <div class="mb-2 foto-container">
                <label for="foto" class="text-xs text-hijau-20">Foto 1</label><button type="button"
                    onclick="deleteFoto(this)"
                    class="px-2 ml-2 bg-rose-500 text-white rounded-md text-xs">delete</button>
                <input type="file" name="foto[]" id="foto" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
              file:bg-transparent file:border-0
              file:bg-gray-100 file:mr-4
              file:py-3 file:px-4
              dark:file:bg-gray-700 dark:file:text-gray-400">
            </div>
            @error('foto')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-10">
            <button type="submit"
                class="py-3 px-4 w-full inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
                Submit
            </button>
        </div>
    </form>
</main>
@include('mobile.footer')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        let no = 1;
        $('#tambah-foto').click(function (e) {
            e.preventDefault();
            const foto = `<div class="mb-2 foto-container">
                <label for="foto" class="text-xs text-hijau-20">Foto ${no+1}</label><button type="button"
                    onclick="deleteFoto(this)" class="px-2 ml-2 bg-rose-500 text-white rounded-md text-xs">delete</button>
                <input type="file" name="foto[]" id="foto" class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-hijau-20 focus:ring-hijau-20 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
              file:bg-transparent file:border-0
              file:bg-gray-100 file:mr-4
              file:py-3 file:px-4
              dark:file:bg-gray-700 dark:file:text-gray-400">
            </div>`
            $('#list-foto').append(foto);
            no++;
        });


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

    function deleteFoto(element) {
        $(element).parent().remove();
    }

</script>
@endsection
