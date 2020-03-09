@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.structure.min.css') }}">
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.lotes._form', [ 'lotes' => $lotes, 'productos' => $productos, 'depositos' => $depositos ])
@endsection

@section('javascripts')
    @parent
    <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
                minDate: -5,
                maxDate: "+5D",
                dateFormat: 'dd-mm-yy',
                dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
                monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
            });
    } );
    </script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker1" ).datepicker({
            minDate: +1,
            maxDate: "+12M +15D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
@endsection
