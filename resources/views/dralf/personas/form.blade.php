@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.personas._form', ['personas' => $personas, 'terceros' => $terceros, 'tipopersonas' => $tipopersonas])
@endsection

@section('javascripts')
    @parent
@endsection
