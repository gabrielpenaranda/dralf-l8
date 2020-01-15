@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.tipopersonas._form', ['tipopersonas' => $tipopersonas])
@endsection

@section('javascripts')
    @parent
@endsection
