@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.structure.min.css') }}">
@endsection

@section('content')
    @include('dralf.pruebaanticoagulantes._form', ['pruebaanticoagulantes' => $pruebaanticoagulantes, 'lotes' => $lotes])
@endsection

@section('javascripts')
    @parent
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src=" {{ asset('js/jquery.timepicker.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input.timepicker').timepicker({
                timeFormat: 'hh:mm p',
                defaultTime: '11:00',
                minTime: new Date(0,0,0,0,0,0),
                maxTime: new Date(0,0,0,23,55,0),
                interval: 5,
                dynamic: true,
                dropdown: true,
                scrollbar: true
                // timeFormat: 'H:mm',
                // interval: 5,
                // minTime: '0',
                // maxTime: '23:45',
                // defaultTime: '12',
                // startTime: '0',
                // dynamic: false,
                // dropdown: true,
                // scrollbar: true
            });
        });
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            minDate: +0,
            maxDate: "+3M +15D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker1" ).datepicker({
            minDate: +0,
            maxDate: "+3M +15D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
@endsection
