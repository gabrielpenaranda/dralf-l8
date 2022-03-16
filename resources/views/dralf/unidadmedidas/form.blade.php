@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.unidadmedidas._form', ['unidadmedidas' => $unidadmedidas])
@endsection

@section('javascripts')
    @parent
@endsection
