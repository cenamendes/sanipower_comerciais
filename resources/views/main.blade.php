<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <title>Sanipower Comerciais</title>

    <link href="{{asset('assets/css/siqtheme.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">

    <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet" />
    <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet" />
    <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet" />

    @livewireStyles


    @include('layouts.styles')

    <style>
        #tab5 #DataTables_Table_0_wrapper{
            display: flex;
            min-height: 740px;
            flex-direction: column;
            justify-content: space-between;
        }
        #tab5 #DataTables_Table_0_wrapper .row:nth-of-type(2){
            height: 650px;
        }
        .dropdownIcon {
            position: relative;
            display: inline-block;
        }

        .dropdownIcon-menu {
            left: -186px;
            top: -7px;
            display: none;
            position: absolute;
            z-index: 1;
            background-color: #ffffff;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 2px;
            margin: 2px 0 0;
            border-radius: 5px;
            list-style: none;
        }
        .dropdownIcon-menu .icon-play{
            position: absolute;
            top: 0px;
            right: -26px;
            font-size: 36px;
            color: #ffffff;
        }

        .dropdownIcon-item {
            background-color: transparent;
            border: none;
            cursor: pointer;
            padding: 8px 0;
        }

        .dropdownIcon-menu li{
            font-size: 16px;
        }

        .dropdownIcon-item:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body class="theme" style="overflow: scroll; overflow-x:hidden;">

    <div class="loader"></div>

    <div class="grid-wrapper grid-wrapper-small sidebar-bg bg1" style="min-height: 95vh;background: #f8f9fa;">

        <!-- BOF HEADER -->
        <div class="header">
            @include('layouts.navbar')
        </div>
        <!-- EOF HEADER -->

        <!-- BOF ASIDE-LEFT -->
        <div id="sidebar" class="sidebar">
            @include('layouts.sidebar')
        </div>
        <!-- EOF ASIDE-LEFT -->

        <!-- BOF MAIN -->
        <div class="main">

        <!-- BOF MAIN-BODY -->
           @yield('body')
        <!-- EOF MAIN-BODY -->
        </div>
        <!-- EOF MAIN -->

        <!-- BOF FOOTER -->
        <div class="footer" style="padding-bottom: 78px; padding-top:15px;">
            @include('layouts.footer')
        </div>
        <!-- EOF FOOTER -->

        <!-- BOF ASIDE-RIGHT -->
        <div id="sidebar-right">
            @include('layouts.sidebar-right')
        </div>
        <!-- EOF ASIDE-RIGHT -->

        <div id="overlay"></div>

    </div> <!-- END WRAPPER -->

    <script src="{{asset('assets/scripts/siqtheme.js')}}"></script>

    <script>


        document.getElementById('logout').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('logoutForm').submit();
        });


        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            loader.classList.add("loader--hidden");

            loader.addEventListener("transitionend", () => {
                document.body.removeChild(loader);
            });

        });

        // document.addEventListener('livewire:load', function() {
        //     Livewire.hook('message.sent', () => {
        //         document.getElementById('loader').style.display = 'block';
        //     });

        //     // Oculta o loader quando o Livewire terminar de carregar
        //     Livewire.hook('message.processed', () => {
        //         document.getElementById('loader').style.display = 'none';
        //     });
        // });


    </script>
    @livewireScripts
    @stack('scripts_footer')

</body>

</html>
