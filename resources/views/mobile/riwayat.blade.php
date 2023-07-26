@extends('mobile.app')
@section('mobile')
<header class="flex fixed top-0 inset-x-0 justify-between p-5 bg-blue-800 text-white shadow-md">
    <a href="{{  route('mobile.home') }}"><i class="bi bi-chevron-left fill-blue-800 font-semibold mr-3"></i> Riwayat
        Kunjungan PYDB</a>
</header>
<div class="px-5 pt-16 w-full bg-blue-200 box-border">
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
@endsection
