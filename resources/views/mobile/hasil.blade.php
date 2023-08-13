@extends('mobile.app')
@section('mobile')
<header class="flex fixed z-50 bg-white top-0 inset-x-0 justify-center p-5 text-hijau-20 h-20">
    <a href="{{ route('home.index') }}" class="absolute left-0 px-3"><i
            class="bi bi-arrow-left text-xl text-hijau-20 dark:text-slate-100"></i></a>
    <h1 class="font-semibold text-2xl">Capaian</h1>
</header>
<main class="absolute inset-x-0 inset-y-20 overflow-y-auto">
    <div class="grid grid-cols-2 bg-yellow-20 text-center mx-4 my-3 px-4 py-2 rounded-lg shadow-lg shadow-gray-200">
        <div>
            <h1 class="font-righteous text-white">Rupiah</h1>
            <p class="font-righteous text-white">{{ number_format($nominal,0,',','.') }}</p>
        </div>
        <div>
            <h1 class="font-righteous text-white">Input</h1>
            <p class="font-righteous text-white">{{ $akun }}</p>
        </div>
    </div>
    <div class="p-2 bg-slate-100 border backdrop-blur-lg shadow-md mx-5 box-border rounded-lg">
        <canvas id="myChart"></canvas>
    </div>
</main>
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
            backgroundColor: 'rgba(54, 162, 235, 0.4)',
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
                stepSize: 20,
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
