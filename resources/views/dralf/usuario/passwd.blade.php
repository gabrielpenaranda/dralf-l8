@extends('admin.index')

@section('title', 'Cambiar Contraseña')

@section('stylesheets')
    @parent
@endsection

@section('content')
    @include('admin.usuario._formpasswd', ['usuario' => $usuario])
@endsection

@section('javascripts')
    @parent
@endsection
