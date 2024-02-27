<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="Samadi ecom">

    <!-- Scripts -->



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> --}}

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <style>
        *{
            font-family: 'Cairo';
            font-weight: 500;
        }
    </style>

    {{-- Owl Crousel --}}
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">

    {{-- exzoom Product Image --}}
    <link href="{{ asset('assets/exzoom/jquery.exzoom.css') }}" rel="stylesheet">


    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    @livewireStyles
</head>
<body>
    <div id="app">

        @include('layouts.inc.frontend.navbar')

        <main>
            @yield('content')
        </main>

        @include('layouts.inc.frontend.footer')
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/exzoom/jquery.exzoom.js') }}"></script>
    <script src="{{ asset('assets/notify.js') }}"></script>


   <script>
        window.addEventListener('message', event => {
            if(event.detail)
            {
                alertify.set('notifier','position', 'top-right');
                alertify.notify(event.detail.text,event.detail.type);
            }
        });

    </script>

    <script>
        var source = new EventSource("{{URL('/sse-updates')}}");

        source.onmessage = function(event){

            let ac = JSON.parse(event.data);

            $.notify(ac.message,'success');
        }

    </script>

    @yield('script')

    @livewireScripts
    @stack('scripts')
</body>



</html>
