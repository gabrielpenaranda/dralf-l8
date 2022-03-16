@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.terceros._form', ['ciudades' => $ciudades])
@endsection

@section('javascripts')
    @parent
@endsection
