@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.terceros._form', ['ciudades' => $ciudades])
@endsection

@section('javascripts')
    @parent
@endsection
