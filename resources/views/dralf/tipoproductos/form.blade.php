@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.tipoproductos._form', ['tipoproductos' => $tipoproductos])
@endsection

@section('javascripts')
    @parent
@endsection
