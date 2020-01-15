@extends('dralf.layouts.base')

@section('title', 'Prueba Rinse')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.pruebarinses._show', ['pruebarinses' => $pruebarinses])
@endsection

@section('javascripts')
    @parent
@endsection
