@extends('dralf.layouts.base')

@section('title')
    {{ $titulo ?? '' }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.entregas._show', [ 'facturas' => $facturas , 'detallefacturas' => $detallefacturas, 'entregas' => $entregas, 'detalleentregas' => $detalleentregas, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
