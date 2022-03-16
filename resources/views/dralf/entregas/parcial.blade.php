@extends('dralf.layouts.base')

@section('title')
    {{ $titulo ?? '' }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.entregas._parcial', [ 'facturas' => $facturas , 'detallefacturas' => $detallefacturas, 'modulo' => $modulo])
@endsection

@section('javascripts')
    @parent
@endsection
