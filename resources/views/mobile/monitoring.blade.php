@extends('mobile.app')
@section('mobile')
<header class="h-15 fixed w-full lg:w-96 top-0 bg-green-2 z-50 flex items-center">
    <a href="javascript:void(0);" onclick="history.back();"
        class="left-2 py-1 px-2 ml-5 text-green-2 p-2 border rounded-md bg-white"><i class="bi bi-arrow-left"></i></a>
    <h1 class="font-bold text-xl text-white ml-2">Beranda Monitoring</h1>
</header>
<main class="pt-15 pb-20">
    <section class="mr-5 my-3">
        <ul aria-label="Nested user feed" role="feed"
            class="relative flex flex-col gap-5 py-5 pl-8 before:absolute before:top-0 before:left-8 before:h-full before:border before:-translate-x-1/2 before:border-slate-200 before:border-dashed after:absolute after:top-6 after:left-8 after:bottom-6 after:border after:-translate-x-1/2 after:border-slate-200 ">
            @foreach ($monitoring as $item)
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
@endsection
