@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.materiaprimas._form', ['materiaprimas' => $materiaprimas, 'unidadmedidas' => $unidadmedidas])
@endsection

@section('javascripts')
    @parent
@endsection
