{{-- NOTA ENTREGA --}} 

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-xs-offset-1 col-xs-8 text-center">
            <h4>
                {{ 'Nota de Entrega' }}
            </h4>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-danger" href="{{ route('notaentrega.index', ['modulo' => $modulo]) }}">Regresar</a>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Número Factura</th>
                            <th class="text-left">Cliente</th>
                            <th class="text-left">Fecha</th>
                            <th class="text-left">Monto</th>
                            <th class="text-left">Total</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">
                                    {{ $factura->numero_factura }}
                                </td>
                                <td class="text-left">
                                    {{ $factura->cliente->nombre_cliente }}
                                </td>
                                <td class="text-left">
                                    {{ date("d-m-Y", strtotime($factura->fecha_factura)) }}
                                </td>
                                <td class="text-left">
                                    {{ number_format($factura->monto_factura, 2, ',', '.') }}
                                </td>
                                <td class="text-left">
                                    {{ number_format($factura->monto_factura, 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <table class="table table-striped">
                    <thead>
                        <th>Producto</th>
                        <th>Lote</th>
                        <th class="text-center">Cantidad</th>
                    </thead>
                    <tbody>
                        @foreach($detallefactura as $d)
                        <tr>
                            <td>
                                {{ $d->lote->producto->nombre_producto }}
                            </td>
                            <td>
                                {{ $d->lote->numero_lote }}
                            </td>
                            <td class="text-center">
                                {{ $d->cantidad_detalle_factura }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                {!! $detallefactura->render() !!}
            </div>
        </div>
</div>

@endsection

@section('javascripts')
    @parent
@endsection