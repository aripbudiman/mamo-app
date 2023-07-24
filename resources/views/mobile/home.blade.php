@extends('mobile.app')
@section('mobile')
<header class="flex justify-between items-center p-5">
    <div>
        <h4 class="text-xs text-blue-800">👋Hello!</h4>
        <h1 class="font-bold text-blue-800 font-poppins">{{ Auth::user()->sub_name }}</h1>
    </div>
    <img class="w-10 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="" srcset="">
</header>
<div class="w-full py-2 px-4">
    <div class="flex justify-between">
        <div class="day">
            <p class="text-xs text-slate-800 font-poppins">{{ date('d,F Y') }}</p>
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
        <div class="px-3 text-center ext-xs">
            <p class="text-slate-700">{{ date('D',strtotime($date)) }}</p>
            <p class="text-slate-900 font-bold font-poppins">{{ date('d',strtotime($date)) }}</p>
        </div>
        @endforeach
    </div>
</div>
<div class="overflow-scroll h-[63%] mt-5">
    @foreach ($data as $item)
    <div class="card bg-white my-2 mx-4 px-2 py-3 rounded-md shadow-sm">
        <h1 class="text-md text-slate-800 font-poppins font-semibold lowercase">{{ $item->anggota }}</h1>
        <p class="text-[10px] text-slate-600 font-poppins">
            {{  date('d-m-Y',strtotime($item->tanggal)) }} 🕛 {{  date('H:i',strtotime($item->created_at)) }}</p>
    </div>
    @endforeach
</div>
@include('mobile.footer')
@endsection
