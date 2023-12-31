@extends('layouts.main')
@section('main')
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-2xl font-bold text-gray-800 sm:text-3xl dark:text-white">Import Anggota
    </header>
    <hr class="my-5">
    <button type="button"
        class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
        data-hs-overlay="#hs-static-backdrop-modal">
        Import Anggota
    </button>
    <form action="{{ route('anggota.reset') }}" method="POST" class="inline" onclick="return confirm('Are you sure?')">
        @csrf
        <button type="submit"
            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-slate-800 text-white hover:bg-slate-600 transition-all text-sm dark:focus:ring-offset-gray-800">
            Reset Anggota
        </button>
    </form>
    @include('alert')
    @include('anggota/modal-import')
    <div class="flex flex-col mt-10">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                    <div class="py-3 px-4">
                        <div class="relative max-w-xs">
                            <label for="search-anggota" class="sr-only">Search</label>
                            <input type="text" name="search-anggota" id="search-anggota"
                                class="p-3 pl-10 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400"
                                placeholder="Search for items">
                            <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none pl-4">
                                <svg class="h-3.5 w-3.5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Id
                                        Anggota
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                        Anggota
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                        Majelis</th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Petugas
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saldo
                                    </th>
                                    <th scope="col"
                                        class="px-2 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="list-data" class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($anggota as $item)
                                <tr>
                                    <td
                                        class="px-2 py-1 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $item->id_anggota }}</td>
                                    <td
                                        class="px-2 py-1 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $item->nama_anggota }}</td>
                                    <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $item->majelis }}
                                    </td>
                                    <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $item->petugas }}</td>
                                    <td class="px-2 py-1 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ number_format($item->outstanding,0,',','.') }}</td>
                                    <td class="px-2 py-1 whitespace-nowrap text-right text-sm font-medium">
                                        <a class="text-blue-500 hover:text-blue-700" href="#">Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="py-1 px-4">
                        <div class="flex items-center space-x-2">
                            <a class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-md"
                                href="{{ $anggota->previousPageUrl() }}">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                            {!! $anggota->links() !!}
                            <!-- Ini akan menampilkan links pagination -->
                            <a class="text-gray-400 hover:text-blue-600 p-4 inline-flex items-center gap-2 font-medium rounded-full"
                                href="{{ $anggota->nextPageUrl() }}">
                                <span class="sr-only">Next</span>
                                <span aria-hidden="true">»</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#search-anggota').on('input', function () {
            let query = $(this).val().trim();
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: "{{route('live_search')}}",
                data: {
                    query: query,
                    _token: token
                },
                dataType: "JSON",
                success: function (response) {
                    $('#list-data').html(response)
                }
            });
        });
    });

</script>
@endsection
