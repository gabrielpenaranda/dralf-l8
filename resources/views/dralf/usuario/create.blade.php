@extends('admin.index')

@section('title', 'Crear Usuario')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('admin.usuario._form', ['usuario' => $usuario])
@endsection

@section('javascripts')
    @parent
@endsection
