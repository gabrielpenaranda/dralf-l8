@extends('dralf.layouts.base')

@section('title', 'Prueba Diluente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.pruebalisantes._show', ['pruebalisantes' => $pruebalisantes])
@endsection

@section('javascripts')
    @parent
@endsection
