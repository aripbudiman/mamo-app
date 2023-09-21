@extends('mobile.app')
@section('mobile')
<header class="bg-green-2 h-15 fixed z-50 flex justify-center items-center w-full lg:w-96">
    <a href="{{  url()->previous() }}"
        class=" bg-white text-green-2 absolute left-4 flex justify-center w-[30px] h-[30px] shadow-md items-center px-2 py-1 rounded-md inset-y-4"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="text-white font-poppins font-semibold">List Sp3 Yang Belum Masuk</h1>
</header>
<main class="absolute inset-x-0 py-20 overflow-y-auto bg-gray-200 h-screen">
    <div id="list-sp" class="px-5 flex flex-col gap-y-3"></div>
</main>
@include('mobile.footer')
@endsection
@push('scripts')
<script>
    //     let html = `<div class="flex flex-col bg-white border shadow-sm rounded-xl p-4 md:p-5 dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7] dark:text-gray-400">
    // asd
    // </div>`
    const data = fetch('https://stok.mamo-app.my.id/api/sp3')
        .then(response => response.json())
        .then(data => {
            let html = ``
            data.forEach(item => {
                let tgl = item.wakalah[0].trx_mba
                const date = new Date(tgl);
                html += `<div class="flex flex-col bg-white border shadow-md rounded-xl p-4 md:p-5 dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7] dark:text-gray-400">
<p class="text-blue-1 font-semibold lowercase first-letter:uppercase">petugas: ${item.wakalah[0].petugas}</p>
<p>Anggota: ${item.wakalah[0].nama_anggota}</p>
<p>Majelis: ${item.wakalah[0].majelis}</p>
<p>Tgl Mba: ${date.toLocaleDateString("id-ID", {
  format: "dd-MM-yyyy",
})}</p>
<p>Droping: ${parseInt(item.wakalah[0].nominal).toLocaleString("id-ID", {
  currency: "IDR",
})}</p>
<p>Status: ${item.status}</p>
</div>`
            });
            $('#list-sp').html(html);
        })

</script>
@endpush
