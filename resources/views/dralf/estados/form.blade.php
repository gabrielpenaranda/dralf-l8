@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.estados._form', ['estados' => $estados])
@endsection

@section('javascripts')
    @parent
@endsection
