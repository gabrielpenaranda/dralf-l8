@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.facturas._form', [ 'facturas' => $facturas , 'terceros' => $terceros, 'modulo' => $modulo ])
@endsection

@section('javascripts')
    @parent
@endsection
