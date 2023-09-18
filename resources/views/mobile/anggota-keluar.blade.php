@extends('mobile.app')
@section('mobile')
<header class="bg-green-2 h-15 fixed z-50 flex justify-center items-center w-full top-0">
    <a href="{{  url()->previous() }}"
        class=" bg-white text-green-2 absolute left-4 flex justify-center w-[30px] h-[30px] shadow-md items-center px-2 py-1 rounded-md inset-y-4"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="text-white font-poppins font-semibold">Form Anggota Keluar</h1>
</header>
<main class="absolute inset-x-0 pt-15 pb-20 overflow-y-auto mx-5">
    <form action="{{ route('mobile.store_anggota_keluar') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="my-3">
            <label for="tanggal" class="font-medium text-gray-900">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="w-full rounded-md outline-green-2 h-12">
        </div>
        <div class="my-3">
            <label for="nama_anggota" class="font-medium text-gray-900">Nama Anggota</label>
            <input type="text" name="nama_anggota" id="nama_anggota"
                class="w-full rounded-md outline-green-2 read-only:text-gray-500 read-only:bg-gray-100 h-12"
                value="{{ $anggota[0]->nama_anggota }}" readonly>
        </div>
        <div class="my-3">
            <label for="nama" class="font-medium text-gray-900">Majelis</label>
            <input type="text" name="majelis" id="majelis"
                class="w-full rounded-md outline-green-2 read-only:text-gray-500 read-only:bg-gray-100 h-12"
                value="{{ $anggota[0]->majelis }}" readonly>
        </div>
        <div class="my-3">
            <p class="font-medium text-gray-900">Foto</p>
            <label for="selectImage" class="read-only:text-gray-500 group ">
                <img for="image" id="preview" src="/preview.png" alt="" class="border-dashed p-1 border-gray-500 border-2 bg-gray-100 group-hover:opacity-90 w-full h-40 rounded-lg object-fit
            " /></label>
            <input type="file" name="image" id="selectImage"
                class="w-full hidden rounded-md outline-green-2 read-only:text-gray-500 read-only:bg-gray-100 h-12">
        </div>
        <div class="my-3">
            <label for="alesan" class="font-medium  text-gray-900">Alesan Keluar</label>
            <textarea name="alesan" id="alesan" class="w-full @error('alesan')
            border-red-500
        @enderror rounded-md h-32" placeholder="Alesan"></textarea>
            @error('alesan')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="my-3">
            <button
                class="inline-flex w-full items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-green-2 hover:bg-green-3 focus:bg-green-3 hover:shadow-lg">
                <span>Submit Anggota Keluar</span>
            </button>
        </div>
    </form>
</main>

@include('mobile.footer')
@endsection
@push('scripts')
<script>
    const imageLabel = document.getElementById('imageLabel');
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            const urlPreview = URL.createObjectURL(file)
            preview.src = URL.createObjectURL(file)
            console.log(urlPreview)
        }
    }

</script>
@endpush
