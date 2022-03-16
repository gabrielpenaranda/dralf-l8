@extends('dralf.layouts.base')

@section('title', 'Ver Nota de Entrega')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.facturas._show', [ 'facturas' => $facturas , 'detallefacturas' => $detallefacturas, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
