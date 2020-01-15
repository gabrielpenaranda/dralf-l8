@extends('dralf.layouts.base')

@section('title', 'Editar Prueba')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.prueba._form', ['prueba' => $prueba, 'lote' => $lote])
@endsection

@section('javascripts')
    @parent
@endsection
