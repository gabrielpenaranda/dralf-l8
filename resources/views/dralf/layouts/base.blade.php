<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    {{-- @section('title')
        <title></title>
    @endsection --}}
    <title>@yield('title')</title>

    <!-- Styles -->
    @section('stylesheets')
       
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}"> --}}
        
    @show
</head>
<body class="has-navbar-fixed-top">
    <div id="app">
        @include('layouts._errors')
        @include('layouts._message')
        @include('dralf.layouts._nav')
        @yield('content')
    </div>

    <!-- Scripts -->
    @section('javascripts')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        {{-- <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script> --}}
        <script>
            //        $(document).ready(function() {
            //
            //            $(".navbar-burger").click(function() {
            //
            //                $(".navbar-burger").toggleClass("is-active");
            //              $(".navbar-menu").toggleClass("is-active");
            //
            //            });
            //        });
        </script>
        <script>
            $('.confirmation').on('click', function () {
                return confirm('Esta seguro de ejecutar esta acción?');
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                    $notification = $delete.parentNode;
                    $delete.addEventListener('click', () => {
                      $notification.parentNode.removeChild($notification);
                    });
                });
            });
        </script>
    @show
</body>
</html>
