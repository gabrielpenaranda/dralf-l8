@extends('dralf.layouts.base')

@section('title', 'Prueba')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.prueba._show', ['prueba' => $prueba])
@endsection

@section('javascripts')
    @parent
@endsection
