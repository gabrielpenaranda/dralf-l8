@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.pruebalisantes._form', ['pruebalisantes' => $pruebalisantes, 'lotes' => $lotes])
@endsection

@section('javascripts')
    @parent
@endsection
