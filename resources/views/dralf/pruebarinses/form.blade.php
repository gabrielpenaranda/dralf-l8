@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.pruebarinses._form', ['pruebarinses' => $pruebarinses, 'lotes' => $lotes])
@endsection

@section('javascripts')
    @parent
@endsection
