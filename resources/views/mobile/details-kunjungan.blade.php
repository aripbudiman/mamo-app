@extends('mobile.app')
@section('mobile')
<header class="flex justify-between p-5 bg-green-2 text-white">
    <a href="{{  url()->previous() }}"><i class="bi bi-chevron-left font-semibold mr-3"></i> Details
        Kunjungan PYDB</a>
</header>
<div id="tangkap" class="bg-green-2 pt-7 pb-28">
    <div class="card max-w-full bg-white mx-4 rounded-t-lg flex relative overflow-hidden">
        <div class="w-[95%]">
            <div class="logo h-36 flex justify-center items-center text-green-2">
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
                <div class="flex justify-between bg-green-1/40 font-semibold py-1 mt-3 px-3 ">
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
            <hr class="border-dashed border-gray-500 mx-4 my-3">
            <div class="h-48 px-4 overflow-scroll">
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
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
            <div class="w-4 h-4 bg-green-2 rounded-full"></div>
        </div>
    </div>
    <div class="flex justify-center my-5">
        <p class="text-white font-poppins">Powered by <span class="font-righteous"><i class="bi bi-camera"></i>
                mamo</span></p>
    </div>
    <div class="flex justify-center px-5">
        <button type="button" id="captureButton"
            class="px-4 py-3 bg-white w-full rounded-lg text-xl font-bold text-green-2 hover:bg-gray-100">Bagikan<i
                class="fa-solid fa-share-nodes ml-1"></i></button>
    </div>

    <div id="screenshotContainer"></div>

</div>
@push('scripts')
<script>
    document.getElementById("captureButton").addEventListener("click", function () {
        // Sembunyikan tombol sebelum mengambil tangkapan layar
        document.getElementById("captureButton").style.display = "none";

        const targetElement = document.querySelector(
            "#tangkap"); // Pilih elemen yang ingin Anda ambil tangkapan layarnya

        html2canvas(targetElement).then(canvas => {
            // Kembalikan tampilan tombol setelah selesai mengambil tangkapan layar
            document.getElementById("captureButton").style.display = "block";

            // Ubah data gambar menjadi URL
            const screenshotURL = canvas.toDataURL("image/png");

            // Tampilkan gambar hasil tangkapan layar di dalam elemen gambar
            const screenshotImage = document.createElement("img");
            screenshotImage.src = screenshotURL;
            screenshotImage.style.width = "100%";
            screenshotImage.style.cursor = "pointer"; // Ganti kursor saat diarahkan ke gambar
            screenshotImage.onclick = function () {
                // Saat gambar diklik, unduh gambar
                const a = document.createElement("a");
                a.href = screenshotURL;
                a.download = "screenshot.png";
                a.click();
            };

            const screenshotContainer = document.getElementById("screenshotContainer");
            screenshotContainer.innerHTML = ""; // Bersihkan konten sebelumnya
            screenshotContainer.appendChild(screenshotImage);
        });
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
@endpush
@endsection
