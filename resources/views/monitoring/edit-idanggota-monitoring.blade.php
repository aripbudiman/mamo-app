@extends('layouts.main')
@section('main')
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-2xl font-bold text-gray-800 sm:text-3xl dark:text-white">Edit idanggota Monitoring PYDB
    </header>
    <hr class="my-5">
    <div class="grid grid-cols-4 gap-x-4">
        <div>
            <label for="petugas">Petugas</label>
            <select id="petugas" name="petugas"
                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                <option>--Pilih Petugas--</option>
                @foreach ($petugas as $item)
                <option value="{{ $item->sub_name }}">{{ $item->sub_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="majelis">Majelis</label>
            <select id="majelis" name="majelis"
                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </select>
        </div>
        <div class="flex items-end">
            <button type="button" id="tampilkan"
                class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                Tampilkan
            </button>
        </div>
    </div>
    <hr class="my-5">
    <div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <form action="{{ route('update_id') }}" method="post">
                        @csrf
                        <div class="border overflow-hidden dark:border-gray-700">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-1 py-3 w-20 text-center text-xs font-medium text-gray-500 uppercase">
                                            Id
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 w-64 text-center text-xs font-medium text-gray-500 uppercase">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 w-64 text-center text-xs font-medium text-gray-500 uppercase">
                                            Majelis
                                        </th>
                                        <th scope="col"
                                            class="px-1 py-3 w-40 text-center text-xs font-medium text-gray-500 uppercase">
                                            Tanggal
                                        </th>
                                        <th scope="col"
                                            class="px-1 w-40 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Id
                                            Anggota
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="divide-y divide-gray-200 dark:divide-gray-700">
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <button type="submit"
                                class="py-3 px-4 m-2 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-gray-900 dark:focus:ring-offset-gray-800">
                                Update All
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#petugas').change(function (e) {
            e.preventDefault();
            var petugas = $(this).val();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('monitoring.majelis') }}",
                type: "POST",
                data: {
                    petugas: petugas,
                    _token: token // Sertakan token CSRF dalam data permintaan
                },
                success: function (response) {
                    $('#majelis').html(response)
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#tampilkan').click(function (e) {
            e.preventDefault();
            var majelis = $('#majelis').val();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "{{route('tampilkan')}}",
                data: {
                    majelis: majelis,
                    _token: token
                },
                dataType: "JSON",
                success: function (response) {
                    if (response != '') {
                        $('#list-data').html(response)
                    } else {
                        $('#list-data').html(
                            `<h1 class="text-2xl text-center text-red-500">Tidak ada</h1>`
                            )
                    }
                }
            });
        });
    });

</script>
@endsection
