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
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Majelis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nominal Bayar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    dokumentasi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($monitoring as $item)
                            <tr>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $item->anggota }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item->majelis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    {{ $item->nominal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                    <img src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}" alt="">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="hs-tooltip inline-block [--trigger:click]">
                                        <a class="hs-tooltip-toggle block text-center" href="javascript:;">
                                            <span
                                                class="w-10 h-10 inline-flex justify-center items-center gap-2 rounded-md bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[.05] dark:hover:border-white/[.1] dark:hover:text-white">
                                                <i class="bi bi-card-image"></i>
                                            </span>
                                            <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible hidden opacity-0 transition-opacity inline-block absolute invisible z-10 max-w-xs bg-white border border-gray-100 text-left rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
                                                role="tooltip">
                                                <span
                                                    class="pt-3 px-4 block text-lg font-bold text-gray-800 dark:text-white">Overview</span>
                                                <div class="py-3 px-4 text-sm text-gray-600 dark:text-gray-400">
                                                    <img src="{{ asset($item->dokumentasi) }}" alt="" srcset="">
                                                    <p>This is a popover body with supporting text below as a natural
                                                        lead-in to additional content.</p>
                                                    <dl class="mt-3">
                                                        <dt class="font-bold pt-3 first:pt-0 dark:text-white">Assigned
                                                            to:</dt>
                                                        <dd class="text-gray-600 dark:text-gray-400">Mark Welson</dd>
                                                        <dt class="font-bold pt-3 first:pt-0 dark:text-white">Due:</dt>
                                                        <dd class="text-gray-600 dark:text-gray-400">December 21, 2021
                                                        </dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
