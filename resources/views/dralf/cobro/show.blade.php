{{-- PAGO MOSTRAR --}}

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
                {{ 'Detalle de Cobros a Factura' }}
            </h4>
        </div>
        <div class="col-xs-2">
        @if ($modulo == 'nocancel')
            <a class="btn btn-danger" href="{{ route('cobros.index', ['modulo' => 'nocancel']) }}">Regresar</a>
        @else
            <a class="btn btn-danger" href="{{ route('cobros.facturas-canceladas', ['modulo' => 'cancel']) }}">Regresar</a>
        @endif
        </div>
        <br>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Información de Factura
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped">
                                    <thead>
                                        <th class="text-left">Factura</th>
                                        <th class="text-left">Fecha</th>
                                        <th class="text-left">Cliente</th>
                                        <th class="text-left">Monto</th>
                                        <th class="text-left">IVA</th>
                                        <th class="text-left">Total</th>
                                        <th class="text-left">Resto</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $factura->numero_factura }}
                                            </td>
                                            <td>
                                                {{ date("d-m-Y", strtotime($factura->fecha_factura)) }}
                                            </td>
                                            <td>
                                                {{ $factura->cliente->nombre_cliente }}
                                            </td>
                                            <td>
                                                {{ number_format($factura->monto_factura, 2, ",", ".") }}
                                            </td>
                                            <td>
                                                {{ number_format($factura->iva_factura, 2, ",", ".") }}
                                            </td>
                                            <td>
                                            @php $total = $factura->monto_factura + $factura->iva_factura @endphp
                                                {{ number_format($total, 2, ",", ".") }}
                                            </td>
                                            <td>
                                                {{ number_format($factura->saldo_factura, 2, ",", ".") }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                @if ($cobros == NULL)
                    <h2>Factura no tiene cobros registradas</h2>
                @else
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Fecha</th>
                            <th class="text-left">Referencia</th>
                            <th class="text-left">Monto</th>
                            <th class="text-left">Banco</th>
                        </thead>
                        <tbody>
                            @foreach ($cobros as $p)
                                <tr>
                                    <td class="text-left">
                                        {{ date("d-m-Y", strtotime($p->fecha_cobro)) }}
                                    </td>
                                    <td class="text-left">
                                        {{ $p->numero_cobro }}
                                    </td>
                                    <td class="text-left">

                                        {{ number_format($p->monto_cobro, 2, ',', '.') }}
                                    </td>
                                    <td class="text-left">
                                        {{ $p->banco_cobro }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
    </div>
</div>
@endsection

@section('javascripts')
    @parent
@endsection
