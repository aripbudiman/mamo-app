@extends('mobile.app')
@section('mobile')
<Header class="h-40">
    <section class="flex justify-center items-center h-10">
        <h1 class="font-righteous text-xl text-hijau-20">Anggota</h1>
    </section>
    <section class="search px-5 h-[60px] flex items-center">
        <div class="flex rounded-md shadow-sm w-full relative">
            <input type="text" id="search"
                class="py-3 px-4 block w-full border-hijau-30 shadow-sm rounded-full text-sm focus:z-10 focus:border-hijau-20 focus:ring-hijau-20 text-hijau-30 bg-hijau-20/10"
                placeholder="seacrh"><i class="bi bi-search absolute right-4 top-2 text-hijau-20 text-xl"></i>
        </div>
    </section>
    <section class="flex justify-around items-center h-[60px]">
        @foreach ($user as $item)
        <a href="#"
            class="relative inline-flex items-center justify-center w-10 h-10 text-lg text-white rounded-full bg-emerald-500">
            <img src="{{ asset($item->foto) }}" class="rounded-full">
            <span
                class="absolute top-0 right-0 inline-flex items-center justify-center gap-1 p-1 text-sm text-white bg-pink-500 border-2 border-white rounded-full">
                <span class="sr-only"> 7 new emails </span>
            </span>
        </a>
        @endforeach
    </section>
</Header>
<main class="absolute inset-x-0 bottom-20 top-40 overflow-y-auto">
    <section id="list-anggota">

        @foreach ($anggota as $item)
        <a href="" class="card bg-hijau-10 mx-5 my-4 p-3 rounded-lg block shadow-md border border-hijau-20">
            <h2 class="lowercase first-letter:uppercase font-poppins font-semibold text-lg text-slate-900">
                {{ $item->nama_anggota }}
            </h2>
            <p class="lowercase first-letter:uppercase text-slate-900">{{ $item->majelis }}</p>
        </a>
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
