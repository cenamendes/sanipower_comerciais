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

    @livewireStyles
    @livewireScripts

    @include('layouts.styles')
</head>

<body class="theme-dark" style="overflow: scroll; overflow-x:hidden;">

    <div class="loader"></div>

    <div class="grid-wrapper sidebar-bg bg1" style="min-height: 95vh;">

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
        <div class="footer" style="padding-bottom: 70px;">
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

        
       
        


    </script>
    
    @stack('scripts_footer')
</body>

</html>