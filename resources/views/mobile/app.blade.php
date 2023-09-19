<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('link')
</head>

<body class="antialiased bg-slate-800">
    <div class="w-full lg:w-96 mx-auto min-h-screen relative bg-white">
        @yield('mobile')
    </div>
    <script src="{{asset('assets/swiper-element-bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/swipper-bundle.min.js')}}" />
    <script src="{{ asset('assets/jquery-3.7.0.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
