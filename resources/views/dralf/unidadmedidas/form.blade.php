@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.unidadmedidas._form', ['unidadmedidas' => $unidadmedidas])
@endsection

@section('javascripts')
    @parent
@endsection
