<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ session('theme') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @stack('css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="text-base-content">
        <div
            class="navbar bg-base-100 sticky top-0 z-30 flex h-16 w-full justify-center bg-opacity-80 backdrop-blur transition-shadow duration-100 [transform:translate3d(0,0,0)]">
            <div class="navbar-start min-h-screen">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>
                            <x-navbar-item url="{{ route('landing') }}" active="{{ request()->routeIs('landing') }}">
                                Home
                            </x-navbar-item>
                        </li>
                        <li>
                            <x-navbar-item url="{{ route('cek') }}" active="{{ request()->routeIs('cek') }}">
                                Cek Risiko
                            </x-navbar-item>
                        </li>
                        <li>
                            <x-navbar-item url="{{ route('petunjuk') }}" active="{{ request()->routeIs('petunjuk') }}">
                                Petunjuk
                            </x-navbar-item>
                        </li>
                        <li>
                            <x-navbar-item url="{{ route('pengembang') }}"
                                active="{{ request()->routeIs('pengembang') }}">
                                Pengembang
                            </x-navbar-item>
                        </li>
                        <li class="mb-6">
                            <x-navbar-item url="{{ route('blog') }}"
                                active="{{ request()->routeIs('blog') OR request()->routeIs('blog-detail') }}">
                                Blog
                            </x-navbar-item>
                        </li>
                        <li>
                            <a class="btn btn-primary btn-sm" href="{{ url('login') }}">Login</a>
                        </li>
                        {{-- <li>
                    <x-navbar-item url="{{ route('gejala') }}" active="{{ request()->routeIs('gejala') }}">
                        Gejala & Solusi
                    </x-navbar-item>
                </li> --}}
                    </ul>
                </div>
                <a data-sveltekit-preload-data href="/" aria-current="page" aria-label="daisyUI"
                    class="flex-0 btn btn-ghost gap-1 px-2 md:gap-2"><svg class="h-6 w-6 md:h-8 md:w-8" width="32"
                        height="32" viewBox="0 0 415 415" xmlns="http://www.w3.org/2000/svg">
                        <rect x="82.5" y="290" width="250" height="125" rx="62.5" fill="#1AD1A5">
                        </rect>
                        <circle cx="207.5" cy="135" r="130" fill="black" fill-opacity=".3">
                        </circle>
                        <circle cx="207.5" cy="135" r="125" fill="white"></circle>
                        <circle cx="207.5" cy="135" r="56" fill="#FF9903"></circle>
                    </svg> <span class="font-title text-base-content text-lg md:text-2xl">CyberSense UMKM</span>
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 text-lg">
                    <li>
                        <x-navbar-item url="{{ route('landing') }}" active="{{ request()->routeIs('landing') }}">
                            Home
                        </x-navbar-item>
                    </li>
                    <li>
                        <x-navbar-item url="{{ route('cek') }}" active="{{ request()->routeIs('cek') OR  request()->routeIs('form')}}">
                            Cek Risiko
                        </x-navbar-item>
                    </li>
                    <li>
                        <x-navbar-item url="{{ route('petunjuk') }}" active="{{ request()->routeIs('petunjuk') }}">
                            Petunjuk
                        </x-navbar-item>
                    </li>
                    <li>
                        <x-navbar-item url="{{ route('pengembang') }}"
                            active="{{ request()->routeIs('pengembang') }}">
                            Pengembang
                        </x-navbar-item>
                    </li>
                    <li>
                        <x-navbar-item url="{{ route('blog') }}"
                            active="{{ request()->routeIs('blog') OR request()->routeIs('blog-detail') }}">
                            Blog
                        </x-navbar-item>
                    </li>
                    {{-- <li>
                <x-navbar-item url="{{ route('gejala') }}" active="{{ request()->routeIs('gejala') }}">
                    Gejala & Solusi
                </x-navbar-item>
            </li> --}}
                </ul>
            </div>
            <div class="navbar-end lg:me-5">
                <x-theme-toggle class="btn btn-circle btn-sm" darkTheme="synthwave" lightTheme="cupcake" />
                <a class="btn btn-primary ms-4 btn-sm hidden lg:flex" href="{{ url('login') }}">Login</a>
            </div>
        </div>

            {{ $slot }}

    </div>

    <x-toast />
    @stack('js')
    @livewireScripts
</body>

</html>
