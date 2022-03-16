@extends('dralf.layouts.base')

@section('title', 'Editar de Entrega')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.structure.min.css') }}">
@endsection


@section('content')
    @include('dralf.entrega._form', ['factura' => $factura, 'entrega' => $entrega])
@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({
            minDate: -5,
            maxDate: 0,
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
@endsection

