@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.tipoproductos._form', ['tipoproductos' => $tipoproductos])
@endsection

@section('javascripts')
    @parent
@endsection
