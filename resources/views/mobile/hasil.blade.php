@extends('mobile.app')
@section('mobile')
<header class="flex fixed top-0 inset-x-0 justify-center p-5 bg-blue-800 text-white shadow-md">
    <h1 class="font-semibold text-2xl">Achievements</h1>
</header>
<div class="w-full pt-16 flex justify-center">
    <div id="profile"
        class="m-5 flex items-center bg-neutral-800 border-2 border-neutral-100 p-3 w-full rounded-lg shadow-md box-border">
        <img class="w-20 border-blue-800 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="">
        <div class="ml-3 font-poppins w-full grid grid-cols-2 text-xs">
            <p class="text-white font-cairo">Nama:</p>
            <p class="text-white font-cairo">{{ Auth::user()->sub_name }}</p>
            <p class="text-white font-cairo">Roles:</p>
            <p class="text-white font-cairo uppercase">{{ Auth::user()->roles }}</p>
        </div>
    </div>
</div>
<div class="grid grid-cols-2 gap-3 px-1 mx-4 mb-4">
    <div class="card bg-rose-500 shadow-md border-2 border-rose-50 p-2 box-border text-center rounded-md w-full">
        <p class="text-rose-50 font-cairo font-bold">Rupiah</p>
        <p class="text-rose-50 font-cairo">{{ number_format($nominal,0,',','.') }}</p>
    </div>
    <div class="card bg-sky-500 shadow-md border-2 border-sky-50 p-2 box-border text-center rounded-md w-full">
        <p class="text-sky-50 font-cairo font-bold">Input</p>
        <p class="text-sky-50 font-cairo">{{ $akun }}</p>
    </div>
</div>
<div class="p-2 bg-white shadow-sm mx-5 box-border rounded-lg">
    <canvas id="myChart"></canvas>
</div>
@include('mobile.footer')
<script>
    const kategori = @json($kategori);
    const nilai = @json($count_pola);
    const count = @json($count);
    console.log(kategori)
    const ctx = document.getElementById('myChart').getContext('2d');
    const data = {
        labels: kategori,
        datasets: [{
            label: 'Pola Bayar',
            data: nilai,
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
        }]
    };
    const options = {
        scale: {
            angleLines: {
                display: true,
            },
            ticks: {
                suggestedMin: 0, // Nilai minimum pada sumbu radial
                suggestedMax: 100, // Nilai maksimum pada sumbu radial
                stepSize: 10,
                fontSize: 7,
            },
        },
    };
    const myChart = new Chart(ctx, {
        type: 'radar', // Jenis grafik (misalnya 'bar', 'line', 'pie', dll.)
        data: data,
        options: options,
    });

</script>
@endsection
