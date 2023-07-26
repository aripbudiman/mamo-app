@extends('mobile.app')
@section('mobile')
<header class="flex fixed top-0 inset-x-0 justify-center p-5 bg-blue-800 text-white shadow-md">
    <h1 class="font-semibold text-2xl">Achievements</h1>
</header>
<div class="w-full pt-16 flex justify-center">
    <div id="profile"
        class="m-5 flex items-center bg-gradient-to-tr  from-blue-800 via-blue-500  to-blue-800 p-3 w-full rounded-lg shadow-md">
        <img class="w-20 border-blue-800 rounded-full" src="{{ asset(Auth::user()->foto) }}" alt="">
        <div class="ml-3 font-poppins w-full grid grid-cols-2 text-xs">
            <p class="text-white">Nama:</p>
            <p class="text-white">{{ Auth::user()->sub_name }}</p>
            <p class="text-white">Roles:</p>
            <p class="text-white">{{ Auth::user()->roles }}</p>
            <p class="text-white">Total Input:</p>
            <p class="text-white">{{ Auth::user()->roles }}</p>
            <p class="text-white">Nominal:</p>
            <p class="text-white">{{ Auth::user()->roles }}</p>
        </div>
    </div>
</div>
<div class="p-4">
    <canvas id="myChart"></canvas>
</div>
@include('mobile.footer')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const data = {
        labels: [
            'Seminggu Sekali',
            'Sebulan 2x',
            'Sebulan 3x',
            'Sebulan sekali',
            'Tidak bayar bayar',
        ],
        datasets: [{
            label: 'Merah',
            data: [65, 59, 90, 81, 56, ],
            fill: true,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor: 'rgb(255, 99, 132)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(255, 99, 132)'
        }, {
            label: 'Biru',
            data: [28, 48, 40, 19, 66, ],
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'
        }]
    };

    const myChart = new Chart(ctx, {
        type: 'radar', // Jenis grafik (misalnya 'bar', 'line', 'pie', dll.)
        data: data,
    });

</script>
@endsection
