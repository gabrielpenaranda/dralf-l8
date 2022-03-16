@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection


@section('content')
    @include('dralf.ciudades._form', ['ciudades' => $ciudades, 'estados' => $estados])
@endsection

@section('javascripts')
    @parent
@endsection
