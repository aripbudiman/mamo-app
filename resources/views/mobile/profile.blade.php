@extends('mobile.app')
@section('mobile')
<header class="flex justify-center w-full p-5 bg-blue-800">
    <h1 class="font-semibold text-xl text-white font-poppins">Profile</h1>
</header>

<div class="flex items-center w-full py-10 px-4 bg-blue-800">
    <img class="w-20 rounded-full border-2 border-gray-200" src="{{ asset(Auth::user()->foto) }}">
    <div class="ml-2 text-gray-100">
        <p>{{ Auth::user()->sub_name }}</p>
        <p class="uppercase">{{ Auth::user()->roles }}</p>
        <p class="text-xs">{{ Auth::user()->email }}</p>
    </div>
</div>
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
<div class="w-full px-4 py-4">
    <div class="max-w-xs flex flex-col rounded-md shadow-sm">
        <button type="button"
            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-t-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
            Item 1
        </button>
        <button type="button"
            class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
            Item 2
        </button>
        <button type="button"
            class="-mt-px py-3 px-4 inline-flex justify-center items-center gap-2 rounded-b-md border font-medium bg-white text-gray-700 align-middle hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-600 transition-all text-sm dark:bg-gray-800 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400">
            Item 3
        </button>
    </div>
</div>
<div class="w-full px-4 py-6">
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit"
            class="py-3 w-full px-4 inline-flex justify-center items-center gap-2 rounded-md border-2 bg-white border-blue-800 font-semibold text-blue-800 hover:text-white hover:bg-blue-800 hover:border-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
            KELUAR
        </button>
    </form>
</div>
@include('mobile.footer')
@endsection
