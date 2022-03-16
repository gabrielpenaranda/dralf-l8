@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.pruebalisantes._form', ['pruebalisantes' => $pruebalisantes, 'lotes' => $lotes])
@endsection

@section('javascripts')
    @parent
@endsection
