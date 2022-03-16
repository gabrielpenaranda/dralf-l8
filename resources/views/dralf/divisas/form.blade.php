@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection


@section('content')
    @include('dralf.divisas._form', ['divisas' => $divisas])
@endsection

@section('javascripts')
    @parent
@endsection
