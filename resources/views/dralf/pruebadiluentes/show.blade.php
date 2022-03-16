@extends('dralf.layouts.base')

@section('title', 'Prueba Diluente')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('dralf.pruebadiluentes._show', ['pruebadiluentes' => $pruebadiluentes])
@endsection

@section('javascripts')
    @parent
@endsection
