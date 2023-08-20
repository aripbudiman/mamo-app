@extends('mobile.app')
@section('mobile')
<header class="flex fixed z-50 bg-green-2 top-0 inset-x-0 justify-start items-center text-white h-15">
    <a href="{{ route('home.index') }}" class=" bg-white ml-5 py-1 px-2 rounded-md"><i
            class="bi bi-arrow-left text-xl text-green-2 dark:text-slate-100"></i></a>
    <h1 class="font-semibold text-xl ml-2">Capaian</h1>
</header>
<main class="absolute inset-x-0 pt-15 pb-20 overflow-y-auto">
    <p class="text-center pr-5 text-slate-900 font-semibold font-cairo">{{ date('01 F Y') }} s/d {{ date('t F Y') }}</p>
    <section class="grid grid-cols-2 gap-3 m-3">
        <div class="bg-purple-500 p-2 rounded-lg text-center">
            <h1 class="text-white font-medium">Majelis</h1>
            <p class="text-white text-2xl font-bold">{{ $data[2]['total_majelis'] }}</p>
        </div>
        <div class="bg-emerald-500 p-2 rounded-lg text-center">
            <h1 class="text-white font-medium">Anggota</h1>
            <p class="text-white text-2xl font-bold">{{ $data[3]['total_anggota']}}</p>
        </div>
        <div class="bg-blue-500 p-2 rounded-lg text-center">
            <h1 class="text-white font-medium">Total Kunjungan</h1>
            <p class="text-white text-2xl font-bold">{{ $data[0]['total_kunjungan'] }}</p>
        </div>
        <div class="bg-rose-500 p-2 rounded-lg text-center">
            <h1 class="text-white text-sm font-medium">Total Pendapatan</h1>
            <p class="text-white text-xl font-bold">{{ number_format($data[1]['total_bayar']),0,',','.' }}</p>
        </div>
        <div class="bg-sky-500 p-2 rounded-lg text-center">
            <h1 class="text-white font-medium">Bayar</h1>
            <p class="text-white text-2xl font-bold">{{ $data[4][0]->bayar }}</p>
        </div>
        <div class="bg-teal-500 p-2 rounded-lg text-center">
            <h1 class="text-white font-medium">Tidak Bayar</h1>
            <p class="text-white text-2xl font-bold">{{ $data[4][0]->tidak_bayar }}</p>
        </div>
    </section>
    <section class="m-3 bg-amber-200 rounded-2xl">
        <div class="p-5">
            <h1 class="text-center text-2xl font-semibold text-slate-700 mb-2">Ditemui</h1>
            <canvas id="myChart"></canvas>
        </div>
    </section>
    <section class="m-3 bg-sky-200 rounded-2xl">
        <div class="p-5">
            <h1 class="text-center text-2xl font-semibold text-slate-700 mb-2">Pola Bayar</h1>
            <canvas id="polaBayar"></canvas>
        </div>
    </section>
</main>
@include('mobile.footer')
@endsection
@push('scripts')
<script>
    const ctx = document.getElementById('myChart');
    const data = @json($data);
    const bisa_ditemui = data[4][0].bisa
    const tidak_bisa_ditemui = data[4][0].tidak_bisa
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Bisa:' + bisa_ditemui, 'Tidak Bisa:' + tidak_bisa_ditemui, ],
            datasets: [{
                label: 'Total',
                data: [bisa_ditemui, tidak_bisa_ditemui],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }

    });

    const dataPola = data[5]['pola_bayar'];
    const totalKunjungan = data[0]['total_kunjungan'];
    const polaBayar = [dataPola['sebulan 2 kali'], dataPola['sebulan 3 kali'], dataPola['sebulan 1 kali'], dataPola[
        'seminggu sekali'], dataPola['tidak bayar bayar']];
    const pola = document.getElementById('polaBayar');
    new Chart(pola, {
        type: 'polarArea',
        data: {
            labels: ['Sebulan 2 kali', 'Sebulan 3 kali', 'Sebulan 1 kali', 'seminggu sekali',
                'Tidak bayar bayar'
            ],
            datasets: [{
                label: 'total',
                data: polaBayar,
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                r: {
                    offset: true, // Aktifkan opsi offset
                    beginAtZero: true, // Pastikan sumbu dimulai dari nol
                    suggestedMax: totalKunjungan / 3, // Nilai maksimal sumbu radial
                    suggestedMin: 0, // Nilai minimal sumbu radial
                    stepSize: 30 // Atur jarak antara label
                }
            }
        }
    });

</script>
@endpush
