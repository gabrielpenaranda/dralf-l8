@extends('dralf.layouts.base')

@section('title', 'Crear Factura')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    @include('dralf.notaentrega._form', [ 'factura' => $factura , 'cliente' => $cliente, 'modulo' => $modulo ])
@endsection

@section('javascripts')
    @parent
    <script>
        function agregarNE()
        {
            document.getElementById("numero_factura").value = "NE" + document.getElementById("numero_factura").value;
        }
    </script>
@endsection
