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

    .swiper-pagination {
        margin-top: 20px;
        /* Atur margin sesuai preferensi Anda */
    }

</style>
<header class="fixed z-50 top-0 w-full lg:w-96 h-20 bg-green-2">
    <section class="flex items-center h-full">
        <input type="text" class="w-full h-10 mx-5 rounded-full border-none placeholder:font-poppins"
            placeholder="Cari nama anggota">
        <img src="{{ asset(Auth::user()->foto) }}" class="w-10 rounded-full inline-block mr-5">
    </section>
</header>
<main class="absolute inset-x-0 py-20 overflow-y-auto bg-white">
    <section class="m-5 bg-blue-2 p-3 rounded-2xl shadow-gray-300 shadow-md grid-cols-2 grid">
        <div class="card w-32 bg-white/80 py-2 px-3 box-border text-center rounded-lg">
            <h1 class="text-slate-900 text-sm font-poppins font-semibold"><img
                    src="{{ asset('images/icons/dompet-gojek.svg') }}" class="inline-block w-3 mr-1">Capaian</h1>
            <p class="text-md font-semibold">Rp {{ number_format($nominal,0,',','.') }}</p>
            <a href="{{ route('riwayat.index') }}" class="text-sm font-poppins font-semibold text-green-1">Tap
                Riwayat</a>
        </div>
        <div class="grid grid-cols-2 gap-2 mt-2">
            <div class="text-center h-full">
                <a href="{{ route('mobile.form') }}"
                    class="bg-white inline-block leading-10 w-10 h-10 rounded-lg mb-2"><i
                        class="fa-solid fa-plus text-blue-2"></i></a>
                <p class="text-xs text-white">Kunjungan</p>
            </div>
            <div class="text-center h-full">
                <a href="{{ route('murabahah.create') }}"
                    class="bg-white w-10 h-10 rounded-lg inline-block leading-10 mb-2"><i
                        class="fa-solid fa-plus text-blue-2"></i></a>
                <p class="text-xs text-white">Murabahah</p>
            </div>
        </div>
    </section>
    <section class="m-5 grid grid-cols-3 gap-5">
        <a href="{{ route('murabahah.index') }}" class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/transaksi.svg') }}">
            <p class="text-center mt-2 text-xs">Murabahah</p>
        </a>
        <a href="{{ route('wilayah.index') }}" class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/map-pin.svg') }}" alt="">
            <p class="text-center mt-2 text-xs">Wilayah</p>
        </a>
        <a href="{{ route('mobile.cashin') }}" class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/dompet.svg') }}" alt="">
            <p class="text-center mt-2 text-xs">CashIn</p>
        </a>
        <a href="{{ route('mobile.anggota') }}" class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/user.svg') }}">
            <p class="text-center mt-2 text-xs">Anggota</p>
        </a>
        <a href="{{ route('mobilemonitoring.index') }}"
            class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/thread.svg') }}">
            <p class="text-center mt-2 text-xs">Monitoring</p>
        </a>
        <a href="{{ route('par.index') }}"
            class="justify-self-center icon-toggle hidden flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/statistik.svg') }}">
            <p class="text-center mt-2 text-xs">Statistik</p>
        </a>
        <a href="{{ route('mobile.mutasi_keluar') }}"
            class="justify-self-center icon-toggle hidden flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/anggota-keluar.svg') }}">
            <p class="text-center mt-2 text-xs">Mutasi Keluar</p>
        </a>
        <a href="{{ route('mobile.sp3') }}"
            class="justify-self-center flex flex-col justify-center icon-toggle hidden items-center">
            <img class="w-15" src="{{ asset('images/icons/target.svg') }}">
            <p class="text-center mt-2 text-xs">Sp3 Belum Masuk</p>
        </a>
        <a id="toggle-more" class="justify-self-center flex flex-col justify-center items-center">
            <img class="w-15" src="{{ asset('images/icons/more.svg') }}">
            <p class="text-center mt-2 text-xs">More</p>
        </a>
    </section>
    <section class="m-5 mt-10">
        <div class="flex justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/icons/camera-red.svg') }}">
                <h1 class="font-semibold ml-2">Dokumentasi</h1>
            </div>
            <a href="{{ route('mobilemonitoring.index') }}"
                class="text-green-2 text-xs font-bold px-3 py-1 bg-green-1/20 rounded-full">Lihat Semua</a>
        </div>
        <p class="text-sm">Dokumentasi Monitoring</p>
        <p class="text-sm">Terbaru</p>
        <section>
            <swiper-container class="mySwiper relative" init="true" pagination="true" pagination-clickable="false"
                space-between="15" slides-per-view="2" autoplay-delay="2500">
                @foreach ($data as $item)
                <swiper-slide class="w-full overflow-auto touch-pan-y mt-5">
                    <a href="{{ route('riwayat.show', $item->id)}}" class="relative h-52">
                        <img class="w-40 max-w-none"
                            src="{{ asset(str_replace('public', 'storage', $item->dokumentasi)) }}">
                        <p class="absolute text-[8px] bottom-0 inset-x-0 h-6 bg-green-2 leading-6 text-white">
                            {{ $item->anggota }}
                        </p>
                    </a>
                </swiper-slide>
                @endforeach
            </swiper-container>
        </section>
    </section>
    <section>
        <div class="card-balance w-full px-5 py-4">
            <div
                class="card bg-gradient-to-tl from-green-1 via-green-2 to-blue-2 w-full h-48 rounded-lg relative overflow-hidden shadow-md">
                <div class="flex justify-center items-center px-5 mt-5">
                    <h1 class="font-bold font-cairo  text-white text-xl">Tpl Of The Week
                    </h1>
                </div>
                <div class="px-5 absolute bottom-7 flex justify-between w-full">
                    <div class="left">
                        <p class="font-cairo text-white first-letter:uppercase lowercase">{{ Auth::user()->sub_name }}
                        </p>
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
    </section>
    <section class="m-5 mt-10">
        <div class="flex justify-between">
            <div class="flex items-center">
                <img src="{{ asset('images/icons/camera-red.svg') }}">
                <h1 class="font-semibold ml-2">Dokumentasi</h1>
            </div>
            <a href="{{ route('murabahah.index') }}"
                class="text-green-2 text-xs font-bold px-3 py-1 bg-green-1/20 rounded-full">Lihat Semua</a>
        </div>
        <p class="text-sm">Dokumentasi Murabahah</p>
        <p class="text-sm">Terbaru</p>
        <section>
            <swiper-container class="mySwiper relative" init="true" pagination="true" pagination-clickable="true"
                space-between="15" slides-per-view="3" autoplay-delay="2000">
                @foreach ($murabahah as $item)
                <swiper-slide class="w-full overflow-auto touch-pan-y mt-5">
                    <a href="" class="relative h-52">
                        <img class="w-24 max-w-none h-[150px]"
                            src="{{ asset(str_replace('public', 'storage', $item->dokumentasi[0]->foto)) }}">
                        <p class="absolute text-[8px] bottom-10 inset-x-0 h-6 bg-green-2 leading-6 text-white">
                            {{ $item->anggota }}
                        </p>
                    </a>
                </swiper-slide>
                @endforeach
            </swiper-container>
        </section>
</main>
@include('mobile.footer')
@endsection
@push('scripts')
<script>
    const swiperEl = document.querySelector('swiper-container')
    const params = {
        injectStyles: [`
    .swiper-pagination-bullet {
        width: 40px;
        height: 40px;
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


    const toggleMore = document.querySelector('#toggle-more')
    const iconToggle = document.querySelectorAll('.icon-toggle')
    toggleMore.addEventListener('click', () => {
        iconToggle.forEach(el => {
            el.classList.toggle('hidden')
        })
    })

</script>
@endpush
