@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.facturas._form', [ 'facturas' => $facturas , 'terceros' => $terceros, 'modulo' => $modulo ])
@endsection

@section('javascripts')
    @parent
@endsection
