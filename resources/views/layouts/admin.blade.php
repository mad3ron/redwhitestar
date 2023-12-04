<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset ('assets/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'e-Digitalsystem') }}</title>


        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset ('assets/css/app.css') }}" />
        <!-- END: CSS Assets-->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <!-- BEGIN: Mobile Menu -->
        <x-side-mobile></x-side-mobile>

        <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
            <!-- BEGIN: Side Menu -->
            <x-side-menu></x-side-menu>

            <!-- BEGIN: Content -->
            <div class="content">

                <!-- BEGIN: Top Bar -->
                <x-top-bar></x-top-bar>

                <div class="relative">
                    {{ $slot }}
                </div>
            </div>

            <!-- END: Content -->
        </div>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    </body>
</html>
