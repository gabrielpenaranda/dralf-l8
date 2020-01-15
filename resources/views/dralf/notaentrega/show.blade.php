@extends('dralf.layouts.base')

@section('title', 'Ver Nota de Entrega')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.notaentrega._show', ['factura' => $factura , 'detallefactura' => $detallefactura, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
