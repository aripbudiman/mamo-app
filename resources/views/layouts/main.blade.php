<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('link')
</head>

<body class="antialiased box-border">
    <div
        class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center py-4">
            <!-- Navigation Toggle -->
            <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar-brand"
                aria-controls="application-sidebar-brand" aria-label="Toggle navigation">
                <span class="sr-only">Toggle Navigation</span>
                <svg class="w-5 h-5" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <!-- End Navigation Toggle -->
            <!-- Breadcrumb -->
            <ol class="ml-3 flex items-center whitespace-nowrap min-w-0" aria-label="Breadcrumb">
                <li class="flex items-center text-sm text-gray-800 dark:text-gray-400">
                    Application Layout
                    <i class="bi bi-chevron-right"></i>
                </li>
                <li class="text-sm font-semibold text-gray-800 truncate dark:text-gray-400" aria-current="page">
                    Dashboard
                </li>
            </ol>
            <!-- End Breadcrumb -->
        </div>
    </div>
    <!-- End Sidebar Toggle -->

    <!-- Sidebar -->
    <div id="application-sidebar-brand"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[60] w-64 bg-blue-700 pt-7 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0">
        <div class="px-6">
            <a class="flex-none text-xl font-semibold text-white" href="#" aria-label="Brand">Manonjaya Empire</a>
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
            <ul class="space-y-1.5">
                <li>
                    <a class="flex items-center gap-x-3 py-2 px-2.5 bg-blue-600 text-sm text-white rounded-md"
                        href="{{ url('/') }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>

                <li class="hs-accordion" id="users-accordion">
                    <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-white hs-accordion-active:hover:bg-transparent text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                        href="javascript:;">
                        <i class="bi bi-people"></i>
                        Users
                        <i
                            class="bi bi-chevron-up hs-accordion-active:block ml-auto hidden w-3 h-3 text-white group-hover:text-white"></i>
                        <i
                            class="bi bi-chevron-down hs-accordion-active:hidden ml-auto block w-3 h-3 text-white group-hover:text-white"></i>
                    </a>

                    <div id="users-accordion-child"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                        <ul class="hs-accordion-group pl-3 pt-2" data-hs-accordion-always-open>
                            <li class="hs-accordion" id="users-accordion-sub-1">
                                <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-white hs-accordion-active:hover:bg-transparent text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="javascript:;">
                                    Daftar User

                                    <i
                                        class="bi bi-chevron-up hs-accordion-active:block ml-auto hidden w-3 h-3 text-white group-hover:text-white"></i>
                                    <i
                                        class="bi bi-chevron-down hs-accordion-active:hidden ml-auto block w-3 h-3 text-white group-hover:text-white"></i>
                                </a>

                                <div id="users-accordion-sub-1-child"
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                                    <ul class="pt-2 pl-2">
                                        <li>
                                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                                href="javascript:;">
                                                Link 1
                                            </a>
                                        </li>
                                        <li>
                                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                                href="javascript:;">
                                                Link 2
                                            </a>
                                        </li>
                                        <li>
                                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                                href="javascript:;">
                                                Link 3
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="hs-accordion" id="account-accordion">
                    <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-white hs-accordion-active:hover:bg-transparent text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                        href="javascript:;">
                        <i class="bi bi-database"></i>
                        Database
                        <i
                            class="bi bi-chevron-up hs-accordion-active:block ml-auto hidden w-3 h-3 text-white group-hover:text-white"></i>
                        <i
                            class="bi bi-chevron-down hs-accordion-active:hidden ml-auto block w-3 h-3 text-white group-hover:text-white"></i>
                    </a>

                    <div id="account-accordion-child"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                        <ul class="pt-2 pl-2">
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('anggota.index') }}">
                                    Import Anggota
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('roadmap.index') }}">
                                    Import roadmap
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="hs-accordion" id="account-accordion">
                    <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-white hs-accordion-active:hover:bg-transparent text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                        href="javascript:;">
                        <i class="bi bi-display"></i>
                        Monitoring

                        <i
                            class="bi bi-chevron-up hs-accordion-active:block ml-auto hidden w-3 h-3 text-white group-hover:text-white"></i>
                        <i
                            class="bi bi-chevron-down hs-accordion-active:hidden ml-auto block w-3 h-3 text-white group-hover:text-white"></i>
                    </a>

                    <div id="account-accordion-child"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                        <ul class="pt-2 pl-2">
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('import') }}">
                                    Import
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('monitoring.create') }}">
                                    Form Monitoring PYDB
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('monitoring.index') }}">
                                    List Monitoring PYDB
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('monitoring.edit_idanggota') }}">
                                    Edit Monitoring Anggota
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="hs-accordion" id="projects-accordion">
                    <a class="hs-accordion-toggle flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-white hs-accordion-active:hover:bg-transparent text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                        href="javascript:;">
                        <i class="bi bi-file-earmark"></i>
                        Laporan
                        <i
                            class="bi bi-chevron-up hs-accordion-active:block ml-auto hidden w-3 h-3 text-white group-hover:text-white"></i>
                        <i
                            class="bi bi-chevron-down hs-accordion-active:hidden ml-auto block w-3 h-3 text-white group-hover:text-white"></i>
                    </a>
                    <div id="projects-accordion-child"
                        class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                        <ul class="pt-2 pl-2">
                            <li>
                                <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600"
                                    href="{{ route('laporan.monitoring') }}">
                                    Laporan PYDB
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li><a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600-300"
                        href="{{ route('road_maps') }}">
                        <i class="fa-solid fa-map-location-dot"></i>
                        Road Maps
                    </a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white hover:text-white rounded-md hover:bg-blue-600-300">
                            <i class="bi bi-box-arrow-left"></i>Logout
                        </button>
                </li>
                </form>
                </li>
            </ul>
        </nav>
    </div>
    <!-- End Sidebar -->
    @yield('main')
    @stack('scripts')
</body>

</html>
