<footer class="bg-{{Auth::user()->theme}}-800 fixed bottom-0 inset-x-0">
    <div class="grid grid-cols-5 place-items-center">
        <a class="{{ request()->routeIs('mobile.home') || request()->routeIs('mobile.day') ? 'text-white font-semibold' : 'text-blue-200' }} p-4 text-center"
            href="{{ route('mobile.home') }}"><i class="bi bi-house"></i>
            <p class="text-xs">Beranda</p>
        </a>
        <a class="{{ request()->routeIs('mobile.riwayat') ? 'text-white font-semibold' : 'text-blue-200' }} p-4 text-center"
            href="{{ route('mobile.riwayat') }}"><i class="bi bi-receipt-cutoff"></i>
            <p class="text-xs">Riwayat</p>
        </a>
        <a class="p-4 text-center text-blue-800 bg-blue-100 rounded-full w-12 h-12 flex justify-center items-center"
            href="{{ route('mobile.form') }}"><i class="bi bi-camera text-[30px]"></i></a>
        <a class="{{ request()->routeIs('mobile.hasil') ? 'text-white font-semibold' : 'text-blue-200' }} p-4 text-center"
            href="{{ route('mobile.hasil') }}"><i class="bi bi-wallet2"></i>
            <p class="text-xs">Hasil</p>
        </a>
        <a class="{{ request()->routeIs('mobile.profile') ? 'text-white font-semibold' : 'text-blue-200' }} p-4 text-center"
            href="{{ route('mobile.profile') }}"><i class="bi bi-person"></i>
            <p class="text-xs">Profile</p>
        </a>
    </div>
</footer>
