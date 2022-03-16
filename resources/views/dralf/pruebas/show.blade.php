@extends('dralf.layouts.base')

@section('title', 'Prueba')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.prueba._show', ['prueba' => $prueba])
@endsection

@section('javascripts')
    @parent
@endsection
