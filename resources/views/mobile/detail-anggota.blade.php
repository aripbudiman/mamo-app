@extends('mobile.app')
@section('mobile')
<header class="bg-hijau-20 h-20 fixed z-50 flex justify-center items-center w-full">
    <h1 class="text-white font-poppins font-semibold">Statistik Kunjungan Anggota</h1>
</header>
<main class="absolute inset-x-0 pt-20 pb-20 overflow-y-auto">
    <div class="overflow-hidden text-center bg-white rounded shadow-md text-slate-500 shadow-slate-200">
        <div class="p-6">
            <header class="mb-4">
                <h3 class="text-xl font-semibold text-slate-700">{{ $anggota[0]['nama_anggota'] }}</h3>
                <p class=" text-slate-400">{{ $anggota[0]['id_anggota'] }}</p>
                <p class=" text-slate-400">{{ $anggota[0]['majelis'] }}</p>
            </header>
        </div>
        <div class="flex flex-col justify-end gap-2 p-6 pt-0">
            <label class="text-left pl-3" for="bisa-ditemui">Sisa Hutang outstanding</label>
            <div
                class="inline-flex items-center justify-start flex-1 h-10 gap-2 px-5 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-emerald-300 disabled:bg-emerald-300 disabled:shadow-none">
                {{ 'Rp '. number_format($anggota[0]['outstanding'],0,',','.') }}
                </span>
            </div>
            <label class="text-left pl-3" for="bisa-ditemui">Total Bayar</label>
            <div
                class="inline-flex items-center justify-start flex-1 h-10 gap-2 px-5 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-emerald-300 disabled:bg-emerald-300 disabled:shadow-none">
                {{ 'Rp '. number_format($result['totalBayar'],0,',','.') }} / {{ $result['totalKunjungan'] }} Kali
                Kunjungan
                </span>
            </div>
            <label class="text-left pl-3" for="bisa-ditemui">Total Kunjungan</label>
            <div
                class="inline-flex items-center justify-start flex-1 h-10 gap-2 px-5 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-700 disabled:cursor-not-allowed disabled:border-emerald-300 disabled:bg-emerald-300 disabled:shadow-none">
                {{ $result['totalKunjungan'] }} Kali Kunjungan
                </span>
            </div>
        </div>
        @php
        $persenBisaDitemui=($result['totalKunjungan']!==0) ?
        round(($result['ditemui'][1]['count']/$result['totalKunjungan'])*100,2) :0;
        $persenTidakBisaDitemui=($result['totalKunjungan']!==0) ?
        round(($result['ditemui'][0]['count']/$result['totalKunjungan'])*100,2):0;
        $persenBayar=($result['totalKunjungan']!==0)?round(($result['countBayar']/$result['totalKunjungan'])*100,2):0;
        $persenTidakBayar=($result['totalKunjungan']!==0)?
        round(($result['countTidakBayar']/$result['totalKunjungan'])*100,2) :0;
        @endphp
        <div class="flex flex-col justify-end gap-2 px-6 pt-0">
            <label class="text-left pl-3" for="bisa-ditemui">Bisa ditemui</label>
            <div class="relative w-full">
                <label id="p04d-label" for="p04d"
                    class="absolute top-0 left-0 block w-full mb-0 text-xs text-left pl-4 text-white"><span
                        class="sr-only">uploading</span>{{ $persenBisaDitemui }}%</label>
                <progress aria-labelledby="p04d-label" id="p04d" max="100" value="{{ $persenBisaDitemui }}"
                    class="block w-full overflow-hidden rounded bg-slate-100 [&::-webkit-progress-bar]:bg-slate-100 [&::-webkit-progress-value]:bg-emerald-500 [&::-moz-progress-bar]:bg-emerald-500">
                    100%</progress>
            </div>
            <label class="text-left pl-3" for="tidak-bisa-ditemui">Tidak Bisa ditemui</label>
            <div class="relative w-full">
                <label id="p04d-label" for="p04d"
                    class="absolute top-0 left-0 block w-full mb-0 text-xs text-left pl-4 text-white"><span
                        class="sr-only">uploading</span>{{ $persenTidakBisaDitemui }}%</label>
                <progress aria-labelledby="p04d-label" id="p04d" max="100" value="{{ $persenTidakBisaDitemui }}"
                    class="block w-full overflow-hidden rounded bg-slate-100 [&::-webkit-progress-bar]:bg-slate-100 [&::-webkit-progress-value]:bg-emerald-500 [&::-moz-progress-bar]:bg-emerald-500">
                    100%</progress>
            </div>

            <label class="text-left pl-3" for="bayar">Bayar</label>
            <div class="relative w-full">
                <label id="p04d-label" for="p04d"
                    class="absolute top-0 left-0 block w-full mb-0 text-xs text-left pl-4 text-white"><span
                        class="sr-only">uploading</span>{{ $persenBayar }}%</label>
                <progress aria-labelledby="p04d-label" id="p04d" max="100" value="{{ $persenBayar }}"
                    class="block w-full overflow-hidden rounded bg-slate-100 [&::-webkit-progress-bar]:bg-slate-100 [&::-webkit-progress-value]:bg-emerald-500 [&::-moz-progress-bar]:bg-emerald-500">
                    100%</progress>
            </div>
            <label class="text-left pl-3" for="tidak-bayar">Tidak Bayar</label>
            <div class="relative w-full">
                <label id="p04d-label" for="p04d"
                    class="absolute top-0 left-0 block w-full mb-0 text-xs text-left pl-4 text-white"><span
                        class="sr-only">uploading</span>{{ $persenTidakBayar }}%</label>
                <progress aria-labelledby="p04d-label" id="p04d" max="100" value="{{ $persenTidakBayar }}"
                    class="block w-full overflow-hidden rounded bg-slate-100 [&::-webkit-progress-bar]:bg-slate-100 [&::-webkit-progress-value]:bg-emerald-500 [&::-moz-progress-bar]:bg-emerald-500">
                    100%</progress>
            </div>
        </div>
    </div>
</main>
@include('mobile.footer')
@endsection
