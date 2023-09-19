@extends('mobile.app')
@section('mobile')
<header class="bg-green-2 h-15 fixed z-50 flex justify-center items-center w-full">
    <a href="{{  url()->previous() }}"
        class=" bg-white text-green-2 absolute left-4 flex justify-center w-[30px] h-[30px] shadow-md items-center px-2 py-1 rounded-md inset-y-4"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="text-white font-poppins font-semibold">Statistik Kunjungan Anggota</h1>
</header>
<main class="absolute inset-x-0 pt-15 pb-20 overflow-y-auto bg-white">
    <section class="flex justify-center flex-col items-center m-5">
        <h1 class="font-poppins font-semibold text-gray-700 text-xl">{{ $anggota[0]['nama_anggota'] }}</h1>
        <p class=" text-slate-400 font-poppins">{{ $anggota[0]['id_anggota'] }}</p>
        <p class=" text-slate-400 font-poppins">{{ $anggota[0]['majelis'] }}</p>
    </section>
    <section class="grid grid-cols-2 gap-4 m-5">
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-bold">Total Bayar</h1>
            <p class="text-blue-1 font-semibold">Rp {{ number_format($result['totalBayar'],0,',','.') }}</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-bold">Outstanding</h1>
            <p class="text-red-1 font-semibold">Rp {{ number_format($anggota[0]['outstanding'],0,',','.') }}</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md col-span-2 shadow-sm">
            <h1 class="text-gray-800 font-poppins font-bold">Total Kunjungan</h1>
            <p class="text-pink-500 font-semibold"> {{ $result['totalKunjungan'] }}X Kunjungan</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-semibold text-sm">Bisa Ditemui</h1>
            <p class="text-blue-1 font-bold">{{$result['ditemui'][1]['count']}}</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-semibold text-xs">Tidak Bisa Ditemui</h1>
            <p class="text-red-1 font-bold">{{$result['ditemui'][0]['count']}}</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-semibold text-sm">Bayar</h1>
            <p class="text-blue-1 font-bold">{{$result['countBayar']}}</p>
        </div>
        <div class="bg-slate-200 text-center p-2 rounded-md shadow-sm">
            <h1 class="text-gray-800 font-poppins font-semibold text-sm">Tidak Bayar</h1>
            <p class="text-red-1 font-bold">{{$result['countTidakBayar']}}</p>
        </div>
    </section>
    <section class="mr-5 my-10">
        <h1 class="text-center font-poppins font-semibold text-xl text-gray-800">5 riwayat Kunjungan</h1>
        <ul aria-label="Nested user feed" role="feed"
            class="relative flex flex-col gap-5 py-5 pl-8 before:absolute before:top-0 before:left-8 before:h-full before:border before:-translate-x-1/2 before:border-slate-200 before:border-dashed after:absolute after:top-6 after:left-8 after:bottom-6 after:border after:-translate-x-1/2 after:border-slate-200 ">
            @foreach ($data as $item)
            <li role="article" class="relative pl-8 border-b border-slate-300 pb-5">
                <div class="flex flex-col flex-1 gap-4">
                    <a href="#"
                        class="absolute z-10 inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 ring-2 ring-white">
                        <img src="{{ asset($item->user->foto) }}" alt="user name" title="user name" width="48"
                            height="48" class="max-w-full rounded-full" />
                    </a>
                    <h4
                        class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700">
                        <span class="flex-1 lowercase first-letter:uppercase">{{ $item->user->sub_name }}<span
                                class="text-sm font-normal text-slate-500">
                            </span></span><span
                            class="text-sm font-normal text-slate-400">{{ date("d-m-Y",strtotime($item->tanggal)).' 🕒 ' .date('H:i',strtotime($item->created_at))}}</span>
                    </h4>
                    <p class=" text-slate-500 lowercase">
                        {{ $item->anggota . ' '.$item->majelis.' '.$item->ditemui .' ditemui '. $item->kondisi.' '.$item->hasil.' '.number_format($item->nominal,0,',','.') }}
                    </p>
                    <img src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}" class="rounded-xl">
                </div>
            </li>
            @endforeach
        </ul>
    </section>
</main>
@include('mobile.footer')
@endsection
