<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- TinyMCE --}}
    <script src="https://cdn.tiny.cloud/1/ltx2i0i5ckkd0qz95tu9sep4j77rh4z81zizib19cnst238a/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Dashboard" icon="o-sparkles" link="/dashboard" />
                <x-menu-item title="Users" icon="o-users" link="/users" />
                <x-menu-item title="Log Pengguna" icon="o-user-group" link="/log-pengguna" />
                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Rule Base" icon="o-code-bracket" link="/rule-base" />
                    <x-menu-item title="Kriteria" icon="o-archive-box" link="/kriteria" />
                    {{-- <x-menu-item title="Solusi" icon="o-key" link="/solusi" /> --}}
                </x-menu-sub>
                <x-menu-sub title="Article" icon="o-puzzle-piece">
                    <x-menu-item title="Posts" icon="o-face-smile" link="/admin/article" />
                    <x-menu-item title="Category" icon="o-archive-box" link="/admin/category" />
                    {{-- <x-menu-item title="Solusi" icon="o-key" link="/solusi" /> --}}
                </x-menu-sub>

                    <x-theme-toggle class="btn btn-ghost" label="Theme" />

            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</body>
</html>
