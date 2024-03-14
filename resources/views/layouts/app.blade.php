<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{asset('assets/css/siqtheme.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->

    </head>
    <body class="font-sans antialiased theme-dark" style="overflow: scroll;">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="grid-wrapper sidebar-bg bg1" style="min-height: 95vh;">
                
                <div class="header">
                    @include('layouts.navbar')
                </div>
    

                <div id="sidebar" class="sidebar">
                    @include('layouts.sidebar')
                </div>
                <
                <!-- Page Heading -->
                
                @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="background-color: #2a2f34;"> 
                    <br>
                        <ol class="breadcrumb" style="margin:0;">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="ti-user"></i>  {{ __('Profile') }}</a></li>
                        </ol>
                    </div>
                </header>

                @endif
                <!-- BOF ASIDE-RIGHT -->
                <div id="sidebar-right">
                    @include('layouts.sidebar-right')
                </div>
                <!-- EOF ASIDE-RIGHT -->
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script src="{{asset('assets/scripts/siqtheme.js')}}"></script>
        <script>
            document.getElementById('logout').addEventListener('click', function(e) {
                e.preventDefault();
                document.getElementById('logoutForm').submit();
            });
        </script>
    </body>
</html>
