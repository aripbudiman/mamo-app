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
<header class="fixed z-50 top-0 inset-x-0 bg-hijau-20 flex justify-center items-center h-20">
    <a href="javascript:void(0);" onclick="history.back();"
        class="left-2 py-1 px-2  absolute text-white p-2 border rounded-md bg-yellow-20"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="font-poppins text-xl text-white">Dokumentasi Murabahah</h1>
</header>
<main class="pt-20">
    @foreach ($data as $item)
    <swiper-container class="mySwiper relative" init="true">
        @foreach ($item->dokumentasi as $doc)
        <swiper-slide class="w-full h-52 overflow-auto touch-pan-y"><img class="w-[150%] max-w-none h-auto"
                src="{{ asset(str_replace('public', 'storage', $doc->foto)) }}" alt="">
        </swiper-slide>
        <p class="absolute bg-white">{{ $item->anggota }}</p>
        @endforeach
    </swiper-container>
    @endforeach
</main>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    const swiperEl = document.querySelector('swiper-container')

    const params = {
        injectStyles: [`
  .swiper-pagination-bullet {
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    font-size: 12px;
    color: #000;
    opacity: 1;
    background: rgba(0, 0, 0, 0.2);
  }

  .swiper-pagination-bullet-active {
    color: #fff;
    background: #007aff;
  }
  `],
        pagination: {
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + "</span>";
            },
        },
    }

    Object.assign(swiperEl, params)

    swiperEl.initialize();

</script>
@endsection
