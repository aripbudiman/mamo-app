@extends('mobile.app')
@section('mobile')
<header class="flex fixed z-50 bg-green-2 top-0 w-full lg:w-96 justify-center p-5 text-hijau-20 h-15">
    <a href="javascript:void(0);" onclick="history.back();" class="left-2 py-1 px-2 rounded-md absolute bg-white"><i
            class="bi bi-arrow-left text-green-2"></i></a>
    <h1 class="font-semibold font-poppins text-white text-xl">Rekap CashIn Harian</h1>
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
                        class="h-12 w-48 px-2 text-center text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        Tanggal</th>
                    <th scope="col"
                        class="h-12 w-32 px-2 text-center text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        CashIn</th>
                    <th scope="col"
                        class="h-12 px-2 text-sm text-center font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                        Total Kunjungan</th>
                </tr>
                @foreach ($data as $item)
                <tr>
                    <td
                        class="h-12 w-48 px-2 text-sm text-center transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        {{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                    <td
                        class="h-12 w-32 px-2 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        {{number_format($item->total_pendapatan,0,',','.')}}</td>
                    <td
                        class="h-12 px-2 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 text-center stroke-slate-500 text-slate-500 ">
                        {{ $item->jumlah_transaksi }}</td>
                </tr>
                @php
                $totalCashin += $item->total_pendapatan;
                $totalTransaksi += $item->jumlah_transaksi;
                @endphp
                @endforeach
                <tr>
                    <td
                        class="h-12 font-bold text-emerald-500 w-44 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        GrandTotal</td>
                    <td
                        class="h-12 font-bold text-emerald-500 w-32 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                        {{number_format($totalCashin,0,',','.')}}</td>
                    <td
                        class="h-12 font-bold text-emerald-500 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 text-center stroke-slate-500 text-slate-500 ">
                        {{ $totalTransaksi }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
@include('mobile.footer')
@endsection
