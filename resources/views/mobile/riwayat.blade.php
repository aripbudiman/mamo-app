@extends('mobile.app')
@section('mobile')
@php
$dates = generateDateRangeForThisMonth();
$datesAsString = implode(', ', $dates);
$month=getMonthList();
@endphp
<header class="list-tanggal-bulanan overflow-x-scroll bg-hijau-30 fixed w-full py-2 h-28">
    <div class="flex overflow-x-scroll mb-3">
        @foreach ($month as $item)
        <div class="btn-bulan px-2 flex justify-center mx-1 rounded-lg text-center py-2 text-xs bg-hijau-10">
            <a href="#">
                <button class="flex" type="button"
                    onclick="fetchDatesByMonth(`{{ date('m',strtotime($item)) }}`,'{{ date('Y',strtotime($item)) }}')">
                    <p class="text-slate-10">{{ date('F',strtotime($item)) }}</p>
                    <p class="text-slate-10 font-bold font-poppins ml-2">{{ date('Y',strtotime($item)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
    <div id="list-day" class="flex overflow-x-scroll items-center">

        @foreach ($dates as $date)
        <div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-hijau-10">
            <a onclick="fetchHistoryByDate(`{{date('Y-m-d',strtotime($date))}}`)">
                <button type="button">
                    <p class="text-slate-10">{{ date('D',strtotime($date)) }}</p>
                    <p class="text-slate-10 font-bold font-poppins">{{ date('d',strtotime($date)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
</header>
<main class="absolute inset-x-0 bottom-20 top-28 overflow-y-auto">
    <div id="list-monitoring-harian" class="px-5 w-full box-border">
        @forelse ($data as $item)
        <a href="{{ route('riwayat.show',$item->id) }}">
            <div class="card bg-hijau-10 my-2 px-4 py-3 flex justify-between rounded-md shadow-lg">
                <div>
                    <h1 class="text-md text-slate-900 font-poppins font-semibold lowercase">{{ $item->anggota }}</h1>
                    <h1 class="text-sm text-slate-900 font-poppins font-semibold capitalize">{{ $item->majelis }}</h1>
                    <div class="flex">
                        <p class="text-[10px] text-slate-700 font-poppins">
                            {{  date('d-m-Y',strtotime($item->tanggal)) }} 🕛
                            {{  date('H:i',strtotime($item->created_at)) }}
                        </p>
                        <p class="text-[10px] ml-2 text-slate-700 font-poppins font-semibold lowercase">
                            <i class="bi bi-pen"></i> {{ $item->user->name }}
                        </p>
                    </div>
                </div>
                <div class="text-right flex flex-col justify-between">
                    <h1 class="text-xs text-slate-900 font-poppins font-semibold capitalize">Rp
                        {{ number_format($item->nominal,0,',','.') }}</h1>
                    <div class="flex items-center">
                        <a href="{{ route('riwayat.edit',$item->id) }}"
                            class="text-sky-500 text-[10px] px-1 tex-xs">Edit</a>
                        <form action="{{ route('riwayat.destroy',$item->id) }}" method="post" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" type="submit"
                                class="text-rose-500 text-[10px] px-1 tex-xs">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
        @empty
        @endforelse
    </div>
</main>
@include('mobile.footer')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    var token = $('meta[name="csrf-token"]').attr(
        'content');
    const load = ` <div id="loading" class="text-center my-10">
            <div class="animate-spin inline-block w-16 h-16 border-[6px] border-current border-t-transparent text-hijau-20 rounded-full"
                role="status" aria-label="loading">
                <span class="sr-only">Loading...</span>
            </div>
        </div>`;

    $(document).on('click', '.btn-tgl', function () {
        $('.btn-tgl').removeClass('bg-yellow-10');
        $('.btn-tgl').addClass('bg-hijau-10')
        $(this).removeClass('bg-hijau-10');
        $(this).addClass('bg-yellow-10');
    });

    $(document).on('click', '.btn-bulan', function () {
        $('.btn-bulan').removeClass('bg-yellow-10');
        $('.btn-bulan').addClass('bg-hijau-10');
        $(this).removeClass('bg-hijau-10');
        $(this).addClass('bg-yellow-10');
    });

    function fetchDatesByMonth(bulan, tahun) {
        $('#list-day').html(`<div class="animate-spin inline-block w-6 h-6 border-[3px] border-current border-t-transparent text-hijau-10 rounded-full"
            role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </div>`);
        $.ajax({
            type: "POST",
            url: "{{route('fetchDatesByMonth')}}",
            data: {
                bulan: bulan,
                tahun: tahun,
                _token: token
            },
            dataType: "JSON",
            success: function (response) {
                $('#list-day').html(response)
            }
        });
    }

    function fetchHistoryByDate(tanggal) {
        $('#list-monitoring-harian').html(load)
        $.ajax({
            type: "POST",
            url: "{{route('riwayat.fetchHistoryByDate')}}",
            data: {
                tanggal: tanggal,
                _token: token
            },
            dataType: "JSON",
            success: function (response) {
                $('#list-monitoring-harian').html(response)
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Untuk menampilkan pesan error jika ada
            }
        });
    }

</script>
@endsection
