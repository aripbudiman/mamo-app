@extends('mobile.app')
@section('mobile')
<header class="flex justify-between p-5 bg-blue-800 text-white shadow-md">
    <a href="{{  url()->previous() }}"><i class="bi bi-chevron-left fill-blue-800 font-semibold mr-3"></i> Details
        Kunjungan PYDB</a>
</header>
<div class="bg-blue-800 pt-7 pb-28">
    <div class="card max-w-full bg-white mx-4 rounded-t-lg flex relative overflow-hidden">
        <div class="w-[95%]">
            <div class="logo h-36 flex justify-center items-center text-blue-800">
                <i class="bi bi-camera text-6xl"></i>
                <p class="text-5xl font-righteous font-bold uppercase">Mamo</p>
            </div>
            <div class="px-4 py-2 flex justify-between">
                <p class="text-[10px] text-gray-500 font-poppins">
                    {{ date('d F Y',strtotime($details->tanggal)) }} •
                    {{ date('H:i',strtotime($details->created_at)) }}</p>
                <p class="text-[10px] text-gray-500 font-poppins">@if ($details->ditemui=='bisa')<i
                        class="bi bi-check-circle-fill text-green-500"></i> @else <i
                        class="bi bi-x-circle-fill text-red-500"></i> @endif
                    {{ $details->ditemui }}
                    ditemui</p>
            </div>
            <hr class="border-dashed border-gray-500 mx-4">
            <div class="px-4 pt-2 pb-4">
                <p class="font-poppins text-xs text-gray-500 mb-2"><i
                        class="bi bi-check-circle-fill text-green-500"></i>Penagihan</p>
                <p class="text-sm text-slate-900">{{ $details->anggota }}</p>
                <p class="text-sm text-slate-900">{{ $details->majelis }}</p>
                <div class="flex justify-between bg-blue-200 font-semibold py-1 mt-3 px-3 ">
                    <p>Total Bayar</p>
                    <p>Rp{{ number_format($details->nominal,0,',','.') }}</p>
                </div>
            </div>
            <hr class="border-dashed border-gray-500 mx-4">
            <div class="px-4 pt-2 pb-4">
                <p class="font-poppins text-xs">Details Kunjungan</p>
                <p class="text-slate-900 text-xs">Ditemui: {{ $details->ditemui }}</p>
                <p class="text-slate-900 text-xs">Pola Bayar: {{ $details->pola_bayar }}</p>
                <p class="text-slate-900 text-xs"></p>
                <p class="text-slate-900 text-xs">Kondisi: <span class="lowercase">{{ $details->kondisi }}</span></p>
                <p class="text-slate-900 text-xs">Hasil: <span class="lowercase">{{ $details->hasil }}</span></p>
            </div>
            <hr class="border-dashed border-gray-500 mx-4">
            <div class="h-48 px-4 py-4 overflow-hidden">
                <img src="{{ asset(str_replace('public','storage',$details->dokumentasi)) }}" class="">
            </div>
            <hr class="border-dashed border-gray-500 mt-3 mx-4">
            <div class="px-4 pt-2 pb-7 text-xs text-gray-500">
                <p>*Alamat</p>
                <p>Kspps Baytul Ikhtiar</p>
                <p>Cabang Manonjaya</p>
                <p>kp Tangsi 23/03, Manonjaya</p>
                <p>baikmanonjaya@gmail.com</p>
            </div>
        </div>
        <div class="flex flex-col justify-between w-[5%] pr-3">
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
            <div class="logo -rotate-90 h-10 flex justify-center items-center text-gray-300">
                <i class="bi bi-camera text-xs mr-[2px]"></i>
                <p class="text-xs font-righteous font-thin uppercase">Mamo</p>
            </div>
        </div>
        <div class="-bottom-3 absolute flex justify-between w-full px-1">
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
            <div class="w-4 h-4 bg-blue-800 rounded-full"></div>
        </div>
    </div>
</div>
@endsection
