@extends('dralf.layouts.base')

@if ($modulo == 'factura')
@section('title', 'Crear Item de Factura')
@else
@section('title', 'Crear Item de Nota de Entrega')
@endif

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.detallefactura._form', [ 'lote' => $lote, 'factura' => $factura, 'detallefactura' => $detallefactura, 'modulo' => $modulo ])
@endsection

@section('javascripts')
    @parent
@endsection
