@extends('dralf.layouts.base')

@section('title', 'Crear de Entrega de Producto')

@section('stylesheets')
  @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
  @include('dralf.entrega._formdelivery', ['entrega' => $entrega, 'detallefactura' => $detallefactura, 'modulo' => $modulo])
@endsection

@section('javascripts')
  @parent
@endsection
