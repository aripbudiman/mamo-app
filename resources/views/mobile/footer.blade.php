<footer class="dark:bg-slate-10 bg-white z-50 fixed bottom-0 inset-x-0 h-20 border-t">
    <div class="grid grid-cols-4 place-items-center">
        <a class="{{ request()->routeIs('home.index')  ? 'text-green-2 font-semibold h-14 w-14 rounded-full flex justify-center items-center flex-col' : 'text-gray-500' }} p-4 text-center "
            href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i>
            <p class="text-xs text-gray-800">Home</p>
        </a>
        <a class="{{ request()->routeIs('mobile.anggota') || request()->routeIs('mobile.anggota') ? 'text-green-2 font-semibold h-14 w-14 rounded-full flex justify-center items-center flex-col' : 'text-gray-500' }} p-4 text-center"
            href="{{ route('mobile.anggota') }}"><i class="fa-solid fa-magnifying-glass"></i>
            <p class="text-xs text-gray-800">Search</p>
        </a>
        <a class="{{ request()->routeIs('mobile.hasil') ? 'text-green-2 font-semibold h-14 w-14 rounded-full flex justify-center items-center flex-col' : 'text-gray-500' }} p-4 text-center"
            href="{{ route('mobile.hasil') }}"><i class="bi bi-trophy"></i>
            <p class="text-xs text-gray-800">Capaian</p>
        </a>
        <a class="{{ request()->routeIs('profile.index') ? 'text-green-2 font-semibold h-14 w-14 rounded-full flex justify-center items-center flex-col' : 'text-gray-500' }} p-4 text-center"
            href="{{ route('profile.index') }}"><i class="fa-regular fa-user"></i>
            <p class="text-xs text-gray-800">Profile</p>
        </a>
    </div>
</footer>
