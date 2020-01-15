@extends('dralf.layouts.base')

@section('title', 'Crear Entrega')

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.structure.min.css') }}">
@endsection

@include('dralf.layouts._nav')

@section('content')
@include('dralf.entrega._form', ['factura' => $factura, 'entrega' => $entrega, 'modulo' => $modulo])
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
