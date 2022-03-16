@extends('dralf.layouts.base')

@section('title', 'Editar Factura')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.factura._form', [ 'factura' => $factura , 'cliente' => $cliente ])
@endsection

@section('javascripts')
    @parent
@endsection
