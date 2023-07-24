@extends('mobile.app')
@section('mobile')
<header class="flex justify-between p-5 bg-blue-800 text-white shadow-md">
    <a href="{{  route('mobile.home') }}"><i class="bi bi-chevron-left fill-blue-800 font-semibold mr-3"></i> Riwayat
        Kunjungan PYDB</a>
</header>
<div class="px-5 w-full">
    @forelse ($data as $item)
    <a href="{{ route('mobile.details',$item->id) }}"
        class="card flex justify-between items-center border-t border-gray-400 py-2">
        <div class="flex">
            <img class="w-12 h-12 rounded-md border border-gray-300"
                src="{{ asset(str_replace('public','storage',$item->dokumentasi)) }}">
            <div class="ml-2">
                <p class="text-[13px] text-slate-900 font-poppins">{{ $item->anggota }}</p>
                <p class="text-[10px] text-gray-500 font-poppins"> {{ date('d F Y',strtotime($item->tanggal)) }} •
                    {{ date('H:i',strtotime($item->created_at)) }}</p>
            </div>
        </div>
        <p class="text-slate-900 font-semibold text-xs font-poppins">Rp{{ number_format($item->nominal,0,',','.') }}</p>
    </a>
    @empty

    @endforelse
</div>
@endsection
