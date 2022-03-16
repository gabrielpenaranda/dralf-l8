@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.tipopersonas._form', ['tipopersonas' => $tipopersonas])
@endsection

@section('javascripts')
    @parent
@endsection
