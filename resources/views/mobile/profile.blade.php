@extends('mobile.app')
@section('mobile')
<header class="bg-green-2 fixed z-50 top-0 w-full lg:w-96 h-15 flex justify-end items-center">
    <a href="{{ route('settings') }}"
        class="bg-white hover:bg-slate-200 w-9 h-9 flex justify-center items-center rounded-md mr-5"><i
            class="bi bi-sliders text-green-2 text-3xl"></i></a>
</header>
<main class="max-w-full absolute inset-x-0 pt-15 pb-20">
    <section class="max-w-full m-3">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold lowercase first-letter:uppercase text-slate-3">
                    {{ Auth::user()->sub_name }}</h1>
                <h4 class="text-xl text-gray-600">{{ Auth::user()->name }}</h4>
            </div>
            <img src="{{ asset(Auth::user()->foto) }}" class="w-15 h-15 rounded-full object-cover">
        </div>
        <div>
            <h1 class="text-gray-600"><span class="uppercase">{{ Auth::user()->roles }}</span> | Manonjaya</h1>
            <h1 class="text-gray-600">🏠 Majelis: <span class="text-gray-800">{{ $data['majelis'] }}</span></h1>
            <h1 class="text-gray-600">🚹 Anggota: <span class="text-gray-800">{{ $data['anggota'] }}</span></h1>
            <h1 class="text-gray-600">📷 Monitoring: <span class="text-gray-800">{{ $postMonitoring }}</span></h1>
            <h1 class="text-gray-600">📄 Murabahah: <span class="text-gray-800">{{ $postMurabahah }}</span></h1>
        </div>
    </section>
    <section class="max-w-full mx-3 mt-7 mb-5 grid grid-cols-2 gap-x-5">
        <button class="px-4 border rounded-md border-gray-800 font-medium font-poppins">Edit Profile</button>
        <button class="px-4 border rounded-md border-gray-800 font-medium font-poppins">Tulis Bio</button>
    </section>
    <section class="max-w-full mt-7 grid grid-cols-2">
        <button id="btn-monitoring"
            class="px-4 hover:border-b-2 py-2 border-gray-800 font-medium font-poppins">Monitoring</button>
        <button id="btn-murabahah"
            class="px-4 hover:border-b-2 py-2 border-gray-800 font-medium font-poppins">Murabahah</button>
    </section>
    <section id="list-image" class="grid grid-cols-3 content-center gap-1">
        @foreach ($monitoring as $item)
        <img src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}"
            class="object-contain self-center bg-gradient-to-t from-green-1 via-emerald-300 to-blue-2 h-full">
        @endforeach
    </section>
</main>
@include('mobile.footer')
@endsection
@push('scripts')
<script>
    var token = $('meta[name="csrf-token"]').attr(
        'content');
    document.getElementById('btn-murabahah').addEventListener('click', async function (e) {
        e.preventDefault();
        try {
            const response = await fetch("{{ route('getMurabahahInProfilePage.profile') }}");
            if (response.ok) {
                const data = await response.json();
                if (data == "") {
                    document.getElementById('list-image').innerHTML = "Tidak ada data";
                }
                document.getElementById('list-image').innerHTML = data;
            } else {
                console.error('Error fetching data:', response.status);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

    document.getElementById('btn-monitoring').addEventListener('click', async function (e) {
        e.preventDefault();
        try {
            const response = await fetch("{{ route('getMonitoringInProfilePage.profile') }}");
            if (response.ok) {
                const data = await response.json();
                document.getElementById('list-image').innerHTML = data;
            } else {
                console.error('Error fetching data:', response.status);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });

</script>
@endpush
