@extends('mobile.app')
@section('mobile')
<header class="bg-green-2 h-15 fixed z-50 flex justify-center items-center w-full lg:w-96 top-0">
    <a href="{{  url()->previous() }}"
        class=" bg-white text-green-2 absolute left-4 flex justify-center w-[30px] h-[30px] shadow-md items-center px-2 py-1 rounded-md inset-y-4"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="text-white font-poppins font-semibold">Mutasi Anggota Keluar</h1>
</header>
<main class="absolute inset-x-0 pt-15 pb-20 overflow-y-auto  bg-gray-200">
    <section>
        @forelse ($data as $item)
        <div class="card bg-white w-full mb-5">
            <header class="flex justify-between">
                <div class="header_left flex gap-x-2 items-center m-3 h-20">
                    <div>
                        <img src="{{ asset($item->user->foto) }}" class="w-15 h-15 rounded-full block">
                    </div>
                    <div>
                        <h1 class="text-xl first-letter:uppercase text-gray-800 font-semibold font-poppins">
                            {{ $item->user->name }}</h1>
                        <p class="text-gray-500">{{ $item->user->email }}</p>
                    </div>
                </div>
                <div class="header_right flex items-start mr-5 mt-4 gap-x-5 h-20">
                    <button><i class="fa-solid fa-ellipsis"></i></button>
                    <button><i class="fa-solid fa-x"></i></button>
                </div>
            </header>
            <main>
                <p class="px-3 mb-2 first-letter:uppercase text-gray-800">{{ $item->alesan }}</p>
                <img src="{{ asset(str_replace('public','storage',$item->image)) }}"
                    class="h-full w-full object-cover bg-gray-100 p-1 overflow-y-scroll">
            </main>
            <footer class="grid grid-cols-2">
                <button class="h-14 text-gray-700 hover:font-semibold"><i
                        class="fa-regular fa-thumbs-up mr-2"></i>Suka</button>
                <button class="h-14 text-gray-700 hover:font-semibold"><i
                        class="fa-solid fa-share mr-2"></i>Bagikan</button>
            </footer>
        </div>
        @empty
        <p class="text-center text-2xl font-semibold text-slate-700">Belum ada data</p>
        @endforelse

    </section>
</main>
@include('mobile.footer')
@endsection
