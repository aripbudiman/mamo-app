@extends('mobile.app')
@section('mobile')
<header class="flex fixed z-50 bg-white top-0 inset-x-0 justify-center p-5 text-hijau-20 h-20">
    <h1 class="font-semibold text-2xl">Rekap CashIn Harian</h1>
</header>
@php
$totalCashin = 0;
$totalTransaksi=0;
@endphp
<main class="overflow-y-auto absolute inset-0 py-20">
    <div class="w-full overflow-x-auto">
        <table class="w-full text-left border border-collapse rounded sm:border-separate border-slate-200"
            cellspacing="0">
            <tbody class="pt-12">
                <tr class="">
                    <th scope="col"
                        class="h-12 w-32 px-6 text-center text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        Tanggal</th>
                    <th scope="col"
                        class="h-12 w-32 px-6 text-center text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        CashIn</th>
                    <th scope="col"
                        class="h-12 px-6 text-sm text-center font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        Total Kunjungan</th>
                </tr>
                @foreach ($data as $item)
                <tr>
                    <td
                        class="h-12 w-32 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        {{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                    <td
                        class="h-12 w-32 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        {{number_format($item->total_pendapatan,0,',','.')}}</td>
                    <td
                        class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 text-center stroke-slate-500 text-slate-500 ">
                        {{ $item->jumlah_transaksi }}</td>
                </tr>
                @php
                $totalCashin += $item->total_pendapatan;
                $totalTransaksi += $item->jumlah_transaksi;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@include('mobile.footer')
@endsection
