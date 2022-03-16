@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.productos._form', ['productos' => $productos, 'unidadmedidas' => $unidadmedidas, 'tipoproductos' => $tipoproductos, 'prueba' => $prueba])
@endsection

@section('javascripts')
    @parent
@endsection
