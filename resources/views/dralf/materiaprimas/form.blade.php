@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.materiaprimas._form', ['materiaprimas' => $materiaprimas, 'unidadmedidas' => $unidadmedidas])
@endsection

@section('javascripts')
    @parent
@endsection
