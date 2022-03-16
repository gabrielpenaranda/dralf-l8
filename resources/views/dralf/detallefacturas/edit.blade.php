@extends('dralf.layouts.base')

@section('title', 'Editar Item de Factura')

@section('stylesheets')
    @parent
@endsection


@section('content')
    @include('dralf.detallefactura._form', [ 'lote' => $lote, 'factura' => $factura , 'detallefactura' => $detallefactura ])
@endsection

@section('javascripts')
    @parent
@endsection
