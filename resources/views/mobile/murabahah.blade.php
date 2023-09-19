@extends('mobile.app')
@section('mobile')
<style>
    html,
    body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
    }

    swiper-container {
        width: 100%;
        height: 100%;
    }

    swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

</style>
<header class="fixed z-50 top-0 w-full lg:w-96 bg-green-2 flex justify-center items-center h-15">
    <a href="javascript:void(0);" onclick="history.back();"
        class="left-2 py-1 px-2  absolute text-green-2 p-2 border rounded-md bg-white"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="font-bold text-xl text-white">Beranda Murabahah</h1>
</header>
<main class="pt-15 pb-15 bg-white">
    @foreach ($data as $item)
    <section class="mb-5">
        <section class="flex justify-between items-center px-3">
            <div class="flex gap-x-2 items-center h-15">
                <img src="{{ asset($item->user->foto) }}" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h1 class="text-xl first-letter:uppercase text-slate-900 font-semibold font-poppins lowercase">
                        {{ $item->user->sub_name }}
                    </h1>
                    <p class="text-[10px] text-slate-500">{{ $item->created_at }}</p>
                </div>
            </div>
            <button class=" p-4 rounded-xl"><i
                    class="fa-solid fa-ellipsis-vertical text-xl text-slate-800"></i></button>
        </section>
        <swiper-container class="mySwiper" pagination="true">
            @foreach ($item->dokumentasi as $d)
            <swiper-slide class="h-96"><img class="object-cover"
                    src="{{ asset(str_replace('public','storage',$d->foto)) }}">
            </swiper-slide>
            @endforeach
        </swiper-container>
        <section class="">
            <button class="px-2 py-2"><i class="fa-regular fa-thumbs-up text-xl text-gray-800"></i></button>
            <button class="px-2 py-2"><i class="fa-regular fa-comment-dots text-xl text-gray-800"></i></button>
            <button class="px-2 py-2"><i class="fa-regular fa-paper-plane text-xl text-gray-800"></i></button>
        </section>
        <section class="px-2">
            <p class="text-slate-900 font-medium font-poppins inline lowercase">{{ $item->user->sub_name }}
                <article class="text-slate-700 inline">MBA atas nama {{ $item->anggota.' ' .$item->majelis }}
                    {{ $item->deskripsi }} {{ number_format($item->nominal,0,',','.') }}.</article>
            </p>
        </section>
    </section>
    @endforeach
</main>
@endsection
@push('scripts')
@endpush
