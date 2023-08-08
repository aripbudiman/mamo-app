@extends('mobile.app')
@section('mobile')
<main class="absolute inset-x-0 bottom-20 top-64 overflow-y-auto">
    <section class="mx-3 my-2">
        <ul aria-label="User feed" role="feed"
            class="relative flex flex-col gap-x-12 gap-y-6 py-12 pl-8 before:absolute before:top-0 before:left-8 before:h-full before:border before:-translate-x-1/2 before:border-hijau-20 before:border-dashed after:absolute after:top-6 after:left-8 after:bottom-6 after:border after:-translate-x-1/2 after:border-hijau-20 ">
            @foreach ($data as $item)
            <li role="article" class="relative pl-8">
                <div class="flex flex-col flex-1 gap-4">
                    <a href="#"
                        class="absolute z-10 inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 ring-2 ring-white">
                        <img src="{{ asset($item->user->foto) }}" class="rounded-full" />
                    </a>
                    <h4
                        class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700">
                        <span
                            class="flex-1 first-letter:uppercase text-hijau-30 font-semibold">{{ $item->user->name }}<span
                                class="text-base font-normal text-slate-500">
                                created a new
                                monitoring</span></span><span
                            class="text-sm font-normal text-slate-400">{{ date('d-m-Y',strtotime($item->tanggal)) }}</span>
                    </h4>
                    <p class=" text-slate-500 lowercase first-letter:uppercase">{{ $item->anggota }} majelis
                        {{ $item->majelis .' '.$item->ditemui}} ditemui, {{ $item->kondisi }}. {{ $item->hasil }}
                        {{ ($item->nominal==0)?'':number_format($item->nominal,0,',','.') }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
</main>
<header class="fixed top-0 inset-x-0 h-64">
    <section class="mx-4 my-4 box-border flex justify-between items-center">
        <div class="flex">
            <img class="w-10 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="" srcset="">

        </div>
        <div>
            <button class="px-1 rounded-md bg-yellow-20 text-white"><i class="bi bi-plus-lg"></i></button>
        </div>
    </section>
    <section class="max-w-full flex justify-between items-end text-slate-900 my-4 px-4">
        <div>
            <h4 class="text-xs text-slate-700">👋Hello!</h4>
            <h1 class="font-bold text-slate-900 font-poppins">{{ Auth::user()->sub_name }}</h1>
        </div>
    </section>
    <section
        class="bg-hijau-20 mx-4 max-w-full rounded-lg grid grid-cols-3 justify-items-stretch backdrop-blur-xl py-4 shadow-md">
        <a href="{{ route('mobile.anggota') }}" class="text-center group"><i
                class="bi bi-people-fill text-3xl text-slate-100 group-active:text-hijau-10"></i>
            <p class="text-xs text-slate-100 group-active:text-hijau-10">Anggota</p>
        </a>
        <a class="border-x-2 border-white/40 text-center group">
            <i class="bi bi-display-fill text-3xl text-slate-100 group-active:text-hijau-10"></i>
            <p class="text-xs text-slate-100 group-active:text-hijau-10">Monitoring</p>
        </a>
        <a href="{{ route('mobile.cashin') }}" class="text-center group"><i
                class="bi bi-wallet-fill text-3xl text-slate-100 group-active:text-hijau-10"></i>
            <p class="text-xs text-slate-100 group-active:text-hijau-10">Cash In</p>
        </a>
    </section>
    <h1 class="text-hijau-20 font-poppins font-bold ml-4 my-3">History</h1>
</header>
@include('mobile.footer')
@endsection
