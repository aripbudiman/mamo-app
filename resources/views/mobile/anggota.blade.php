@extends('mobile.app')
@section('mobile')
<Header class="fixed z-50 w-full lg:w-96 top-0 h-15 bg-green-2">
    <section class="search px-5 h-15 flex items-center">
        <div class="flex rounded-md shadow-sm w-full relative">
            <input type="text" id="search"
                class="py-3 pr-4 pl-8 block foces:pl-4 w-full shadow-sm rounded-md text-sm focus:z-10 focus:border-green-1 focus:ring-gray-200 bg-gray-200"
                placeholder="seacrh"><i class="bi bi-search absolute z-50 p-2 text-gray-600 text-lg"></i>
        </div>
    </section>
</Header>
<main class="absolute inset-x-0 pb-20 pt-15 overflow-y-auto bg-white">
    <section id="list-anggota" class="m-5">
        @foreach ($anggota as $item)
        <div class="w-full flex gap-x-3 mb-8">
            <div class="">
                <img src="{{ asset($item->user->foto) }}" class="w-16 rounded-full block">
                <p class="text-xs text-center text-gray-800 first-letter:uppercase">{{ $item->user->name }}</p>
            </div>
            <div class="border-b border-gray-400 flex justify-between gap-x-5 w-full">
                <div>
                    <h1 class="text-sm text-gray-800 lowercase first-letter:uppercase">
                        {{ $item->nama_anggota }}</h1>
                    <h2 class="text-sm text-gray-800 lowercase first-letter:uppercase">{{ $item->majelis }}</h2>
                    <p class="text-xs">Rp {{ number_format($item->monitoring_sum_nominal,0,',','.') }}</p>
                </div>
                <div class="flex flex-col gap-y-3">
                    <a href="{{ route('mobile.detail_anggota', $item->id_anggota) }}"
                        class="text-xs border border-green-500 bg-green-300 text-green-900 px-2 py-1 rounded-lg">Detail</a>
                    <a href="{{ route('mobile.anggota_keluar', $item->id_anggota) }}"
                        class="text-xs border border-red-500 bg-red-300 text-red-900 px-2 py-1 rounded-lg">Keluar</a>

                </div>
            </div>
        </div>
        @endforeach
    </section>
</main>
@include('mobile.footer')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    const load = `<div id="loading" class="flex justify-center items-center h-60">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="title-04a desc-04a"
                aria-live="polite" aria-busy="true" class="w-20 h-20 animate animate-spin">
                <title id="title-04a">Icon title</title>
                <desc id="desc-04a">Some desc</desc>
                <circle cx="12" cy="12" r="10" class="stroke-slate-200" stroke-width="4" />
                <path
                    d="M12 22C14.6522 22 17.1957 20.9464 19.0711 19.0711C20.9464 17.1957 22 14.6522 22 12C22 9.34784 20.9464 6.8043 19.0711 4.92893C17.1957 3.05357 14.6522 2 12 2"
                    class="stroke-emerald-500" stroke-width="4" />
            </svg>
        </div>`;

    $('#search').on('input', function () {
        const anggota = $(this).val().trim();
        $('#list-anggota').html(load)
        $.ajax({
            type: "post",
            url: "{{route('live_search.anggota')}}",
            data: {
                anggota: anggota
            },
            dataType: "JSON",
            success: function (response) {
                $('#list-anggota').html(response)
            }
        });
    });

</script>
@endsection
