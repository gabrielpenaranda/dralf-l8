@extends('dralf.layouts.base')

@section('title', 'Prueba Anticoagulante')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.pruebaanticoagulantes._show', ['pruebaanticoagulantes' => $pruebaanticoagulantes])
@endsection

@section('javascripts')
    @parent
@endsection
