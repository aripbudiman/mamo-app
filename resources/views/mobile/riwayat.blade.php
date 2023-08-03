@extends('mobile.app')
@section('mobile')
@php
$dates = generateDateRangeForThisMonth();
$datesAsString = implode(', ', $dates);
$month=getMonthList();
@endphp
<div class="list-tanggal-bulanan overflow-x-scroll fixed bg-blue-100 w-full py-2">
    <div class="flex overflow-x-scroll mb-3">
        @foreach ($month as $item)
        <div class="btn-bulan px-2 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-blue-700 text-white">
            <a href="#">
                <button type="button"
                    onclick="getListTanggal(`{{ date('m',strtotime($item)) }}`,'{{ date('Y',strtotime($item)) }}')">
                    <p class="text-slate-50">{{ date('F',strtotime($item)) }}</p>
                    <p class="text-slate-50 font-bold font-poppins">{{ date('Y',strtotime($item)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
    <div id="list-day" class="flex overflow-x-scroll">
        @foreach ($dates as $date)
        <div class="btn-tgl px-2 w-8 flex justify-center mx-2 rounded-lg text-center py-2 text-xs bg-yellow-300">
            <a onclick="getMonitoringHarian(`{{date('Y-m-d',strtotime($date))}}`)">
                <button type="button">
                    <p class="text-slate-700">{{ date('D',strtotime($date)) }}</p>
                    <p class="text-slate-900 font-bold font-poppins">{{ date('d',strtotime($date)) }}</p>
                </button>
            </a>
        </div>
        @endforeach
    </div>
</div>
<div id="list-monitoring-harian" class="px-5 pt-28 pb-24 w-full bg-blue-100 box-border">
    @forelse ($data as $item)
    <a href="{{ route('mobile.details',$item->id) }}">
        <div class="card bg-white my-2 px-4 py-3 flex justify-between rounded-md shadow-sm">
            <div>
                <h1 class="text-md text-slate-800 font-poppins font-semibold lowercase">{{ $item->anggota }}</h1>
                <h1 class="text-sm text-slate-800 font-poppins font-semibold capitalize">{{ $item->majelis }}</h1>
                <div class="flex">
                    <p class="text-[10px] text-slate-600 font-poppins">
                        {{  date('d-m-Y',strtotime($item->tanggal)) }} 🕛
                        {{  date('H:i',strtotime($item->created_at)) }}
                    </p>
                    <p class="text-[10px] ml-2 text-slate-600 font-poppins font-semibold lowercase">
                        <i class="bi bi-pen"></i> {{ $item->user->name }}
                    </p>
                </div>
            </div>
            <div class="text-right flex flex-col justify-between">
                <h1 class="text-xs text-slate-800 font-poppins font-semibold capitalize">Rp
                    {{ number_format($item->nominal,0,',','.') }}</h1>
                <div class="flex items-center">
                    <a href="{{ route('mobile.edit_dok',$item->id) }}"
                        class="text-sky-500 text-[10px] px-1 tex-xs">Edit</a>
                    <form action="{{ route('mobile.delete',$item->id) }}" method="post" class="inline-flex">
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
@include('mobile.footer')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    var token = $('meta[name="csrf-token"]').attr(
        'content');

    $(document).on('click', '.btn-tgl', function () {
        $('.btn-tgl').addClass('bg-yellow-300')
        $('.btn-tgl').find('.text-white').removeClass('text-white');
        $(this).removeClass('bg-yellow-300');
        $(this).addClass('bg-blue-700');
        $(this).find('.text-slate-700').addClass('text-white');
        $(this).find('.text-slate-900').addClass('text-white');
    });

    $(document).on('click', '.btn-bulan', function () {
        $('.btn-bulan').removeClass('bg-yellow-300');
        $('.btn-bulan').addClass('bg-blue-700');
        $('.btn-bulan').find('.text-slate-700').removeClass('text-slate-700');
        $(this).removeClass('bg-blue-300');
        $(this).addClass('bg-yellow-300');
        $(this).find('.text-slate-50').addClass('text-slate-700');
    });

    function getListTanggal(bulan, tahun) {
        $.ajax({
            type: "POST",
            url: "{{route('getListTanggal')}}",
            data: {
                bulan: bulan,
                tahun: tahun
            },
            dataType: "JSON",
            success: function (response) {
                $('#list-day').html(response)
            }
        });
    }

    function getMonitoringHarian(tanggal) {
        $.ajax({
            type: "POST",
            url: "{{route('getMonitoringHarian')}}",
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
