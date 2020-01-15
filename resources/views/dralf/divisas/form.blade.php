@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.divisas._form', ['divisas' => $divisas])
@endsection

@section('javascripts')
    @parent
@endsection
