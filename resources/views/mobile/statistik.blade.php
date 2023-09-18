@extends('mobile.app')
@section('mobile')
<header class="flex fixed z-50 bg-green-2 top-0 inset-x-0 justify-start items-center text-white h-15">
    <a href="{{ route('home.index') }}" class=" bg-white ml-5 py-1 px-2 rounded-md"><i
            class="bi bi-arrow-left text-xl text-green-2 dark:text-slate-100"></i></a>
    <h1 class="font-semibold text-xl ml-2">Statistik</h1>
</header>
<main class="absolute inset-x-0 pt-15 pb-20 overflow-y-auto">
    <div class="w-full bg-green-100 ">
        <h1 class="text-center text-2xl font-semibold text-slate-700 mb-2">Par Petugas</h1>
        <canvas id="parPetugas" class="p-2"></canvas>
    </div>
    <div class="w-full bg-rose-100 ">
        <h1 class="text-center text-2xl font-semibold text-slate-700 mb-2">Par Desa</h1>
        <canvas id="parDesa" class="p-2"></canvas>
    </div>
</main>
@endsection
@push('scripts')
<script>
    const fetchDataParPetugas = async () => {
        try {
            const response = await fetch('statistik/petugas.json');
            const data = await response.json();

            const labelPetugas = [];
            const parPetugas = [];

            data.forEach(item => {
                const shortenedName = item.nama.length > 10 ? item.nama.substring(0, 6) + '...' : item
                    .nama;
                labelPetugas.push(shortenedName);
                parPetugas.push(parseFloat(item.par.replace(",", ".").replace("%", "")));
            });
            const ctx = document.getElementById('parPetugas');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelPetugas,
                    datasets: [{
                        label: 'PAR per Petugas',
                        data: parPetugas,
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (parPetugas, index, values) {
                                    return parPetugas +
                                        '%'; // Menambahkan tanda persen pada label sumbu Y
                                }
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.parsed.y +
                                    '%'; // Menambahkan tanda persen pada label tooltip
                            }
                        }
                    },
                }
            });
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };
    const fetchDataParDesa = async () => {
        try {
            const response = await fetch('statistik/desa.json');
            const data = await response.json();
            console.log(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }
    fetchDataParDesa();
    fetchDataParPetugas();

</script>
@endpush
