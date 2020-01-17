@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.facturas._detalle', ['productos' => $productos, 'terceros' => $terceros, 'modulo' => $modulo, 'fproductos' => $fproductos, 'facturas' => $facturas ])
@endsection

@section('javascripts')
    @parent
@endsection