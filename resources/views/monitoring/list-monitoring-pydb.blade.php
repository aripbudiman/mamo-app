@extends('layouts.main')
@section('main')
<div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <header class="">
        <h1 class="block text-2xl font-bold text-gray-800 sm:text-3xl dark:text-white">Monitoring PYDB
    </header>
    <hr class="my-5">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <caption class="py-2 text-left text-sm text-gray-600 dark:text-gray-500">List of users</caption>
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Tanggal</th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nama</th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Majelis</th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nominal Bayar</th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Ditemui</th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Pola Bayar
                                </th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($monitoring as $item)
                            <tr>
                                <td
                                    class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ date('d-m-Y',strtotime($item->tanggal)) }}</td>
                                <td
                                    class="px-2 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $item->anggota }}</td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item->majelis }}</td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ number_format($item->nominal,0,',','.') }}</td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item->ditemui }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item->pola_bayar }}
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-left text-sm font-medium">

                                </td>
                                <td class="px-2 py-2 whitespace-nowrap text-left text-sm font-medium">
                                    <a class="text-blue-500 hover:text-blue-700" href="#">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
