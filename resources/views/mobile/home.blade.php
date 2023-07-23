@extends('mobile.app')
@section('mobile')
<header class="flex justify-between p-5">
    <h1 class="font-bold text-blue-800 font-poppins">Mamo App</h1>
    <a href="#"><i class="bi bi-search fill-blue-800"></i></a>
</header>
<div class="card-balance w-full px-5 py-4">
    <div
        class="card bg-gradient-to-tl from-blue-800 via-blue-500 to-blue-800 w-full h-48 rounded-lg relative overflow-hidden shadow-xl">
        <div class="flex justify-between items-center px-5 mt-5">
            <h1 class="font-bold font-cairo  text-white text-xl">Card Mamo
            </h1>
            <h1 class="font-semibold font-cairo text-white text-sm">Manonjaya
            </h1>
        </div>
        <div class="absolute mt-10 flex justify-center w-full">
            <p class="px-5 text-white">01 01 2023 31 12 2023</p>
        </div>
        <div class="px-5 absolute bottom-7 flex justify-between w-full">
            <div class="left">
                <p class="font-cairo text-white">Arip Budiman</p>
                <p class="font-cairo text-white text-[10px]">12/23</p>
            </div>
            <div>
                <p class="font-cairo text-white drop-shadow-xl">Rp 500.000</p>
            </div>
        </div>
        <img src="{{ asset('images/map.png') }}" class="opacity-10 absolute inset-0">
        <img src="{{ asset('images/chip.png') }}" class="w-8 absolute left-6 top-12">
        <img src="{{ asset('images/visa.png') }}" class="w-14 absolute right-5 bottom-5">
    </div>
</div>
<div class="px-4 rounded-t-2xl bg-white">
    <div class="flex justify-between py-3">
        <h2 class="font-semibold">Today</h2>
        <a href="#" class="text-blue-600">View all</a>
    </div>
    <div class="overflow-y-scroll max-h-80 pb-5">
        @foreach ($data as $item)
        <a class="group flex flex-col bg-white border-b transition border-gray-400 dark:bg-slate-900 dark:border-gray-800"
            href="{{ route('mobile.details',$item->id) }}">
            <div class="p-4 md:p-5">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img class="w-12 h-12 rounded-full"
                            src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}">
                        <div class="ml-3">
                            <h3
                                class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200 text-[12px]">
                                {{ $item->anggota }}
                            </h3>
                            <h3
                                class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200 text-[12px]">
                                {{ $item->majelis }}
                            </h3>
                            <p class="text-[10px] text-gray-500">
                                {{ date('d F Y',strtotime($item->tanggal)) }} •
                                {{ date('H:i',strtotime($item->created_at)) }}
                            </p>
                        </div>
                    </div>
                    <div class="pl-3">
                        <svg class="w-3.5 h-3.5 text-gray-500" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path
                                d="M5.27921 2L10.9257 7.64645C11.1209 7.84171 11.1209 8.15829 10.9257 8.35355L5.27921 14"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@include('mobile.footer')
@endsection
