<footer class="bg-white absolute bottom-0 inset-x-0">
    <div class="flex justify-between items-center">
        <a class="{{ request()->routeIs('mobile.home') ? 'text-blue-800 font-semibold' : 'text-gray-800' }} p-4 text-center"
            href="{{ route('mobile.home') }}"><i class="bi bi-house"></i>
            <p class="text-xs">Beranda</p>
        </a>
        <a class="{{ request()->routeIs('mobile.riwayat') ? 'text-blue-800 font-semibold' : 'text-gray-800' }} p-4 text-center"
            href="{{ route('mobile.riwayat') }}"><i class="bi bi-receipt-cutoff"></i>
            <p class="text-xs">Riwayat</p>
        </a>
        <a class="p-4 text-center text-gray-100 bg-blue-800 rounded-full w-12 h-12 flex justify-center items-center"
            href="{{ route('mobile.form') }}"><i class="bi bi-plus-circle text-2xl"></i></i></a>
        <a class="p-4 text-center text-gray-800" href="#"><i class="bi bi-wallet2"></i>
            <p class="text-xs">Hasil</p>
        </a>
        <a class="{{ request()->routeIs('mobile.profile') ? 'text-blue-800 font-semibold' : 'text-gray-800' }} p-4 text-center"
            href="{{ route('mobile.profile') }}"><i class="bi bi-person"></i>
            <p class="text-xs">Profile</p>
        </a>
    </div>
</footer>
