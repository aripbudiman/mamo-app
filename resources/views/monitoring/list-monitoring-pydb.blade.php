@extends('layouts.main')
@section('main')
<div class="w-full pt-10 pb-36 px-4 sm:px-6 md:px-8 lg:pl-72 bg-gray-200">
    <header class="">
        <h1 class="block text-2xl font-bold text-gray-800 sm:text-3xl dark:text-white">Monitoring PYDB
    </header>
    <hr class="my-5">
    <div class="grid grid-cols-3 gap-5">
        @forelse ($monitoring as $item)
        <div class="overflow-hidden bg-white rounded shadow-md text-slate-500 shadow-slate-300">
            <div class="p-6">
                <header class="flex gap-4">
                    <a href="#"
                        class="relative inline-flex items-center justify-center w-12 h-12 text-white rounded-full">
                        <img src="{{ asset($item->user->foto) }}" alt="user name" title="user name" width="48"
                            height="48" class="max-w-full rounded-full" />
                    </a>
                    <div>
                        <h3 class="text-xl font-medium text-slate-700">{{ $item->user->sub_name }}</h3>
                        <p class="text-sm text-slate-400"> Posted on, {{ date('d F Y',strtotime($item->created_at)) }}
                        </p>
                    </div>
                </header>
            </div>
            <figure>
                <img src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}" alt="card image"
                    class="aspect-video w-full object-cover overflow-y-scroll bg-top" />
            </figure>
            <div class="p-6">
                <p> {{ $item->anggota . ' '.$item->majelis.' '.$item->ditemui .' ditemui '. $item->kondisi.' '.$item->hasil.' '.number_format($item->nominal,0,',','.') }}
                </p>
            </div>
            <div class="flex justify-end gap-2 p-2 pt-0">
                <button
                    class="inline-flex items-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 rounded justify-self-center whitespace-nowrap text-emerald-500 hover:bg-emerald-100 hover:text-emerald-600 focus:bg-emerald-200 focus:text-emerald-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:text-emerald-300 disabled:shadow-none disabled:hover:bg-transparent">
                    <span class="relative only:-mx-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5" role="graphics-symbol"
                            aria-labelledby="title-81 desc-81">
                            <title id="title-81">Icon title</title>
                            <desc id="desc-81">A more detailed description of the icon</desc>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </span>
                </button>
                <button
                    class="inline-flex items-center justify-center h-10 gap-2 px-5 text-sm font-medium tracking-wide transition duration-300 rounded justify-self-center whitespace-nowrap text-emerald-500 hover:bg-emerald-100 hover:text-emerald-600 focus:bg-emerald-200 focus:text-emerald-700 focus-visible:outline-none disabled:cursor-not-allowed disabled:text-emerald-300 disabled:shadow-none disabled:hover:bg-transparent">
                    <span class="relative only:-mx-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5" role="graphics-symbol"
                            aria-labelledby="title-82 desc-82">
                            <title id="title-82">Icon title</title>
                            <desc id="desc-82">A more detailed description of the icon</desc>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </span>
                </button>
            </div>
        </div>
        @empty

        @endforelse
    </div>
    <div class="custom-pagination mt-10">
        {{ $monitoring->links() }}
    </div>
</div>
@endsection
