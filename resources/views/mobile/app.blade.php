<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('link')
</head>

<body class="antialiased">
    <div class="w-full h-screen relative bg-blue-100">
        @yield('mobile')
    </div>
</body>

</html>
