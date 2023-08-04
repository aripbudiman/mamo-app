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
                <p class="text-xs text-slate-800 font-poppins"></p>
                <h1 class="text-slate-900 font-poppins font-bold">Today</h1>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-800 font-poppins">Input</p>
                <h1 class="text-slate-900 font-poppins font-bold">Rp</h1>
            </div>
        </div>
    </div>
</div>
@include('mobile.footer')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
</script>
@endsection
