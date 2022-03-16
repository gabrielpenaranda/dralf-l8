@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection


@section('content')
    @include('dralf.depositos._form', ['depositos' => $depositos, 'ciudades' => $ciudades])
@endsection

@section('javascripts')
    @parent
@endsection
