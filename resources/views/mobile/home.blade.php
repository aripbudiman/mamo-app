@extends('mobile.app')
@section('mobile')
<header class="flex justify-between items-center p-5">
    <div>
        <h4 class="text-xs text-blue-800">👋Hello!</h4>
        <h1 class="font-bold text-blue-800 font-poppins">{{ Auth::user()->sub_name }}</h1>
    </div>
    <img class="w-10 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="" srcset="">
</header>
{{-- <div class="bg-yellow-50/80 border border-yellow-200 rounded-md p-4 absolute top-0 inset-x-0" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-4 w-4 text-yellow-400 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-sm text-yellow-800 font-semibold">
                MAMO BETA VERSION
            </h3>
            <div class="mt-1 text-sm text-yellow-700">
                Masih tahap development dan pengujian
            </div>
        </div>
    </div>
</div> --}}
<div class="w-full py-2 px-4 box-border">
    <div class="flex justify-between">
        <div class="day">
            <p class="text-xs text-slate-800 font-poppins">{{ date('d F Y') }}</p>
            <h1 class="text-slate-900 font-poppins font-bold">Today</h1>
        </div>
    </div>
</div>
<div class="list-tanggal-bulanan overflow-x-scroll visible">
    <div class="flex overflow-x-scroll">
        @php
        $dates = generateDateRangeForThisMonth();
        $datesAsString = implode(', ', $dates);
        @endphp
        @foreach ($dates as $date)
        <div class="px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-yellow-300">
            <a href="{{ route('mobile.day',date('Y-m-d',strtotime($date))) }}">
                <button type="button">
                    <p class="text-slate-700">{{ date('D',strtotime($date)) }}</p>
                    <p class="text-slate-900 font-bold font-poppins">{{ date('d',strtotime($date)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div class="overflow-scroll h-[63%] mt-3 pb-20 box-border">
    @foreach ($data as $item)
    <a href="{{ route('mobile.details',$item->id) }}">
        <div class="card bg-white my-2 mx-4 px-4 py-3 flex justify-between rounded-md shadow-sm">
            <div>
                <h1 class="text-md text-slate-800 font-poppins font-semibold lowercase">{{ $item->anggota }}</h1>
                <h1 class="text-sm text-slate-800 font-poppins font-semibold capitalize">{{ $item->majelis }}</h1>
                <div>
                    <p class="text-[10px] text-slate-600 font-poppins">
                        {{  date('d-m-Y',strtotime($item->tanggal)) }} 🕛
                        {{  date('H:i',strtotime($item->created_at)) }}
                    </p>

                </div>
            </div>
            <div class="text-right flex flex-col justify-between">
                <h1 class="text-xs text-slate-800 font-poppins font-semibold capitalize">Rp
                    {{ number_format($item->nominal,0,',','.') }}</h1>
                <div class="flex items-center">
                    <a href="{{ route('mobile.edit_dok',$item->id) }}"
                        class="text-sky-500 text-[10px] px-1 tex-xs">Edit</a>
                    <form action="{{ route('mobile.delete',$item->id) }}" method="post" class="inline-flex">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" type="submit"
                            class="text-rose-500 text-[10px] px-1 tex-xs">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
@include('mobile.footer')
@endsection
