@extends('layouts.main')
@section('main')
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-2xl font-bold text-gray-800 sm:text-3xl dark:text-white">Laporan Monitoring
    </header>
    <div>
        <form action="{{ route('laporan.excel') }}" method="post" class="w-1/3 flex items-end mt-7 mb-3">
            @csrf
            <div>
                <div class="flex justify-between items-center">
                    <label for="dari_tanggal" class="block text-sm font-medium mb-2 dark:text-white">Dari
                        Tanggal</label>
                </div>
                <input type="date" id="dari_tanggal" name="dari_tanggal"
                    class="py-3 px-4 block w-full border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </div>
            <div class="h-10 px-5">s/d</div>
            <div>
                <div class="flex justify-between items-center">
                    <label for="sampai_tanggal" class="block text-sm font-medium mb-2 dark:text-white">Sampai
                        Tanggal</label>
                </div>
                <input type="date" id="sampai_tanggal" name="sampai_tanggal"
                    class="py-3 px-4 block w-full border-gray-200 text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
            </div>
            <div class="ml-5">
                <button type="submit"
                    class="py-3 px-4 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                    Tampilkan
                </button>
            </div>
        </form>
    </div>
    <div class="w-1/3 flex items-end my-3">
        <button type="button"
            class="py-3 px-4 inline-flex justify-center items-center gap-2 border border-transparent font-semibold bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
            Excel
        </button>
    </div>
    <hr>
    <div>

    </div>
</div>
@endsection
