@extends('dralf.layouts.base')

@section('title', 'Crear de Entrega de Producto')

@section('stylesheets')
  @parent
@endsection


@section('content')
  @include('dralf.entrega._formdelivery', ['entrega' => $entrega, 'detallefactura' => $detallefactura, 'modulo' => $modulo])
@endsection

@section('javascripts')
  @parent
@endsection
