@extends('layouts.main')
@section('main')
<div class="bg-gray-100 h-screen w-full pt-10 px-4 sm:px-6 md:px-8 lg:pl-72">
    <section class="">
        @if (Session::has('success'))
        <div id="alert" class="my-5">
            <div class="flex items-start w-full gap-4 px-4 py-3 text-sm border rounded border-cyan-100 bg-cyan-50 text-cyan-500"
                role="alert">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5" role="graphics-symbol" aria-labelledby="title-03 desc-03">
                    <title id="title-03">Icon title</title>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                <!-- Text -->
                <p>Import hasbeen successfully</p>
            </div>
        </div>
        @endif
        <form action="{{ route('roadmap.import') }}" method="POST" enctype="multipart/form-data"
            class="flex items-center gap-x-3">
            @csrf
            <div>
                <input type="file" name="file" id="file" class="bg-white border p-2 rounded">
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </section>

    <section class="mt-10">
        <!-- Component: Simple Table -->
        <div class="w-full overflow-x-auto bg-white">
            <table class="w-full text-left border border-collapse rounded sm:border-separate border-slate-200"
                cellspacing="0">
                <tbody>
                    <tr>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                            No</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                            Kecamatan</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                            Desa</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                            Majelis</th>
                        <th scope="col"
                            class="h-12 px-6 text-sm font-medium border-l first:border-l-0 stroke-slate-700 text-slate-700 bg-slate-100">
                            Location</th>
                    </tr>
                    @php
                    $no=1;
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $no++ }}</td>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $item->kecamatan }}</td>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $item->desa }}</td>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $item->majelis }}</td>
                        <td
                            class="h-12 px-6 text-sm transition duration-300 border-t border-l first:border-l-0 border-slate-200 stroke-slate-500 text-slate-500 ">
                            {{ $item->latitude .','.$item->longitude }}</td>
                        @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Simple Table -->
    </section>
</div>
@endsection
