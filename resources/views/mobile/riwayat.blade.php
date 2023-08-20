@extends('mobile.app')
@section('mobile')
@php
$dates = generateDateRangeForThisMonth();
$datesAsString = implode(', ', $dates);
$month=getMonthList();
@endphp
<header class="list-tanggal-bulanan overflow-x-scroll bg-green-2 fixed w-full py-2 h-28">
    <div class="flex overflow-x-scroll mb-3">
        @foreach ($month as $item)
        <div class="btn-bulan px-2 flex justify-center mx-1 rounded-lg text-center py-2 text-xs bg-white/90">
            <a href="#">
                <button class="flex" type="button"
                    onclick="fetchDatesByMonth(`{{ date('m',strtotime($item)) }}`,'{{ date('Y',strtotime($item)) }}')">
                    <p class="text-green-2">{{ date('F',strtotime($item)) }}</p>
                    <p class="text-green-2 font-bold font-poppins ml-2">{{ date('Y',strtotime($item)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
    <div id="list-day" class="flex overflow-x-scroll items-center">
        @foreach ($dates as $date)
        <div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-white/90">
            <a onclick="fetchHistoryByDate(`{{date('Y-m-d',strtotime($date))}}`)">
                <button type="button">
                    <p class="text-green-2">{{ date('D',strtotime($date)) }}</p>
                    <p class="text-green-2 font-bold font-poppins">{{ date('d',strtotime($date)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
</header>
<main class="absolute inset-x-0 bottom-20 top-28 overflow-y-auto">
    <div id="list-monitoring-harian" class="px-5 py-5 w-full box-border flex flex-col gap-y-5">
        @forelse ($data as $item)
        <div class="card bg-blue-2 px-2 py-2 flex justify-between rounded-xl shadow-lg">
            <div class="flex items-start justify-center gap-y-1 flex-col">
                <h1 class="text-xs first-letter:uppercase text-white font-poppins font-semibold lowercase">
                    {{ $item->anggota }}</h1>
                <h1 class="text-[10px] text-white font-poppins font-semibold capitalize">{{ $item->majelis }}</h1>
                <div class="flex">
                    <p class="text-[10px] text-white font-poppins">
                        {{  date('d-m-Y',strtotime($item->tanggal)) }} 🕛
                        {{  date('H:i',strtotime($item->created_at)) }}
                    </p>
                </div>
            </div>
            <div class="w-28">
                <div class="card bg-white/90 py-1 px-3 rounded-lg w-full leading-tight">
                    <div class="flex gap-x-1 justify-start">
                        <img class="block" src="{{ asset('images/icons/dompet-gojek.svg') }}">
                        <h1 class="font-bold text-[10px] text-gray-800 font-poppins">CashIn</h1>
                    </div>
                    <p class="font-semibold font-poppins text-gray-900 text-xs">Rp
                        {{ number_format($item->nominal,0,',','.') }}
                    </p>
                    <a href="{{ route('riwayat.show',$item->id) }}"
                        class="text-green-2 hover:text-green-1 font-semibold font-poppins text-xs">Tap Detail</a>
                </div>
            </div>
        </div>
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
        $('.btn-tgl').children().children().children().removeClass('text-white');
        $('.btn-tgl').addClass('bg-white/90');
        $(this).removeClass('bg-white/90');
        $(this).children().children().children().addClass('text-white');
        $(this).addClass('bg-blue-2');
    });
    $(document).on('click', '.btn-bulan', function () {
        $('.btn-bulan').children().children().children().removeClass('text-white');
        $('.btn-bulan').addClass('bg-white/90');
        $(this).removeClass('bg-white/90');
        $(this).children().children().children().addClass('text-white');
        $(this).addClass('bg-blue-2');
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
