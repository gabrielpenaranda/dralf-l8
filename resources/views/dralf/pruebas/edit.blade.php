@extends('dralf.layouts.base')

@section('title', 'Editar Prueba')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.prueba._form', ['prueba' => $prueba, 'lote' => $lote])
@endsection

@section('javascripts')
    @parent
@endsection
