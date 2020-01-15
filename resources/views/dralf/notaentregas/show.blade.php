@extends('dralf.layouts.base')

@section('title', 'Ver Nota de Entrega')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.facturas._show', [ 'facturas' => $facturas , 'detallefacturas' => $detallefacturas, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
