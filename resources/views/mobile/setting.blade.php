@extends('mobile.app')
@section('mobile')
<header class="h-15 bg-green-2 fixed z-50 w-full lg:w-96 top-0 flex justify-start items-center">
    <a href="javascript:void(0);" onclick="history.back();"
        class="left-2 py-1 px-2 ml-5 text-green-2 p-2 hover:bg-slate-200 border rounded-md bg-white"><i
            class="bi bi-arrow-left"></i></a>
    <h1 class="font-bold text-xl text-white ml-2">Pengaturan</h1>
</header>
<main class="pt-15">
    <ul>
        <li class="border-b border-gray-300 h-10 flex items-center">
            <form action="{{ route('logout') }}" method="post" class="ml-5">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </li>
    </ul>
</main>
@endsection
