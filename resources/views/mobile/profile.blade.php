@extends('mobile.app')
@section('mobile')
<header
    class="bg-gradient-to-tr from-hijau-20 from-50% to-hijau-30 w-full z-50 p-5 fixed box-border h-60 rounded-b-3xl overflow-hidden">
    <section class="flex justify-between z-50">
        <h1 class="font-semibold text-xl text-white dark:text-yellow-20 font-poppins">MyProfile</h1>
        <div>
            <div class="hs-dropdown" data-hs-dropdown-placement="bottom-right" data-hs-dropdown-offset="30">
                <a class="hs-dropdown-toggle hs-dark-mode group flex items-center text-gray-300 hover:text-hijau-10 font-medium dark:text-yellow-20 dark:hover:text-hijau-10"
                    href="javascript:;">
                    <svg class="hs-dark-mode-active:hidden block w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278zM4.858 1.311A7.269 7.269 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.316 7.316 0 0 0 5.205-2.162c-.337.042-.68.063-1.029.063-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286z" />
                    </svg>
                    <svg class="hs-dark-mode-active:block hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
                    </svg>
                </a>

                <div id="selectThemeDropdown"
                    class="hs-dropdown-menu hs-dropdown-open:opacity-100 mt-2 hidden z-10 transition-[margin,opacity] opacity-0 duration-300 mb-2 origin-bottom-left bg-white shadow-md rounded-lg p-2 space-y-1 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700">
                    <a class="hs-auto-mode-active:bg-gray-100 flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                        href="javascript:;" data-hs-theme-click-value="auto">
                        Perangkat
                    </a>
                    <a class="hs-default-mode-active:bg-gray-100 flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                        href="javascript:;" data-hs-theme-click-value="default">
                        Light
                    </a>
                    <a class="hs-dark-mode-active:bg-gray-700 flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                        href="javascript:;" data-hs-theme-click-value="dark">
                        Dark
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="flex mt-10 box-border">
        <img src="{{ asset(Auth::user()->foto) }}" class="w-24 rounded-full border-4 border-yellow-20">
        <div class="ml-5">
            <h1 class="first-letter:text-4xl text-2xl font-righteous text-white">{{ Auth::user()->sub_name }}</h1>
            <hr>
            <p class="text-white ">{{ Auth::user()->roles }}</p>
            <p class="text-white text-sm">{{ Auth::user()->email }}</p>
        </div>
    </section>
    <div class="h-8 w-1/2 bg-yellow-20 rounded-t-lg absolute bottom-0 right-10">

    </div>
</header>
<main class="max-w-full mx-7 py-6 absolute inset-x-0 top-60">
    <ul>
        <li>
            <form action="{{ route('logout') }}" method="post" class="flex justify-between py-3">
                @csrf
                <button type="submit" class="capitalize font-poppins font-semibold text-slate-700"><i
                        class="text-xl bi bi-person-fill text-hijau-10 mr-3"></i>
                    personal
                </button>
                <i class="bi bi-chevron-right text-lg text-gray-500"></i>
            </form>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="post" class="flex justify-between py-3">
                @csrf
                <button type="submit" class="capitalize font-poppins font-semibold text-slate-700"><i
                        class="text-xl bi bi-arrow-right-circle-fill text-hijau-10 mr-3"></i>
                    logout
                </button>
                <i class="bi bi-chevron-right text-lg text-gray-500"></i>
            </form>
        </li>
    </ul>

</main>
@include('mobile.footer')
<script>
    const HSThemeAppearance = {
        init() {
            const defaultTheme = 'default'
            let theme = localStorage.getItem('hs_theme') || defaultTheme

            if (document.querySelector('html').classList.contains('dark')) return
            this.setAppearance(theme)
        },
        _resetStylesOnLoad() {
            const $resetStyles = document.createElement('style')
            $resetStyles.innerText = `*{transition: unset !important;}`
            $resetStyles.setAttribute('data-hs-appearance-onload-styles', '')
            document.head.appendChild($resetStyles)
            return $resetStyles
        },
        setAppearance(theme, saveInStore = true, dispatchEvent = true) {
            const $resetStylesEl = this._resetStylesOnLoad()

            if (saveInStore) {
                localStorage.setItem('hs_theme', theme)
            }

            if (theme === 'auto') {
                theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'
            }

            document.querySelector('html').classList.remove('dark')
            document.querySelector('html').classList.remove('default')
            document.querySelector('html').classList.remove('auto')

            document.querySelector('html').classList.add(this.getOriginalAppearance())

            setTimeout(() => {
                $resetStylesEl.remove()
            })

            if (dispatchEvent) {
                window.dispatchEvent(new CustomEvent('on-hs-appearance-change', {
                    detail: theme
                }))
            }
        },
        getAppearance() {
            let theme = this.getOriginalAppearance()
            if (theme === 'auto') {
                theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'
            }
            return theme
        },
        getOriginalAppearance() {
            const defaultTheme = 'default'
            return localStorage.getItem('hs_theme') || defaultTheme
        }
    }
    HSThemeAppearance.init()

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (HSThemeAppearance.getOriginalAppearance() === 'auto') {
            HSThemeAppearance.setAppearance('auto', false)
        }
    })

    window.addEventListener('load', () => {
        const $clickableThemes = document.querySelectorAll('[data-hs-theme-click-value]')
        const $switchableThemes = document.querySelectorAll('[data-hs-theme-switch]')

        $clickableThemes.forEach($item => {
            $item.addEventListener('click', () => HSThemeAppearance.setAppearance($item.getAttribute(
                'data-hs-theme-click-value'), true, $item))
        })

        $switchableThemes.forEach($item => {
            $item.addEventListener('change', (e) => {
                HSThemeAppearance.setAppearance(e.target.checked ? 'dark' : 'default')
            })

            $item.checked = HSThemeAppearance.getAppearance() === 'dark'
        })

        window.addEventListener('on-hs-appearance-change', e => {
            $switchableThemes.forEach($item => {
                $item.checked = e.detail === 'dark'
            })
        })
    })

</script>
@endsection
