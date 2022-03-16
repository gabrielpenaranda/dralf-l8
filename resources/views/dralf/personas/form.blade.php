@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.personas._form', ['personas' => $personas, 'terceros' => $terceros, 'tipopersonas' => $tipopersonas])
@endsection

@section('javascripts')
    @parent
@endsection
