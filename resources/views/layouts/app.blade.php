<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset ('assets/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'e-Digitalsystem') }}</title>

        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset ('assets/css/app.css') }}" />
        <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" rel="stylesheet" />
        <link href="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datepickerjs/datepicker.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/datepickerjs/datepicker.min.js"></script>
        <script>
            flatpickr('.datepicker');
        </script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </body>
</html>
