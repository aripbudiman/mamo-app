@extends('mobile.app')
@section('mobile')
<header class="flex justify-between items-center p-5">
    <div>
        <h4 class="text-xs text-blue-800">👋Hello!</h4>
        <h1 class="font-bold text-blue-800 font-poppins">{{ Auth::user()->sub_name }}</h1>
    </div>
    <img class="w-10 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="" srcset="">
</header>
<div class="w-full py-2 px-4 box-border">
    <div class="flex justify-between">
        <div class="day flex justify-between w-full">
            <div>
                <p class="text-xs text-slate-800 font-poppins">{{ date('d F Y') }}</p>
                <h1 class="text-slate-900 font-poppins font-bold">Today</h1>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-800 font-poppins">{{ $count }} Input</p>
                <h1 class="text-slate-900 font-poppins font-bold">Rp {{ number_format($nominal,0,',','.') }}</h1>
            </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
</script>
@endsection
