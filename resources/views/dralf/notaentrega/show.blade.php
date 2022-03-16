@extends('dralf.layouts.base')

@section('title', 'Ver Nota de Entrega')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.notaentrega._show', ['factura' => $factura , 'detallefactura' => $detallefactura, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
