{{-- REPORTE DE IVA --}}

@extends('dralf.layouts.base')

@section('title', 'Reporte de Facturación')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-center">
                Reporte de Facturación
            </h3>
            <h4 class="text-center">
                Desde {{ date('d-m-Y', strtotime($inicio)) }} Hasta {{ date('d-m-Y', strtotime($final)) }}
            </h4>
        </div>
    </div>
    <div class="row">
            <div class="col-xs-12">
                <table class="table table-striped">
                    <thead>
                        <th class="text-left">Fecha</th>
                        <th class="text-left">Nº Factura</th>
                        <th class="text-left">Cliente</th>
                        <th class="text-center">Monto Bs.</th>
                        <th class="text-center">IVA Bs.</th>
                        <th class="text-center">Total Bs.</th>
                    </thead>
                    <tbody>
                        @php
                        $total_monto = 0;
                        $total_iva = 0;
                        @endphp
                        @foreach ($factura as $f)
                            <tr>
                                <td class="text-left">{{ date('d-m-Y', strtotime($f->fecha_factura)) }}</td>
                                <td class="text-left">{{ $f->numero_factura }}</td>
                                <td class="text-left">{{ $f->cliente->nombre_cliente }}</td>
                                <td class="text-right">{{ number_format($f->monto_factura, 2, ",", ".") }}</td>
                                <td class="text-right">{{ number_format($f->iva_factura, 2, ",", ".") }}</td>
                                @php
                                $total = $f->monto_factura + $f->iva_factura
                                @endphp
                                <td class="text-right">{{ number_format($total, 2, ",", ".") }}</td>
                            </tr>
                            @php
                            $total_monto += $f->monto_factura;
                            $total_iva += $f->iva_factura;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                @php
                $total_factura = $total_monto + $total_iva
                @endphp
                <h5 class="text-right">
                    <strong>Total Neto Bs. {{ number_format($total_monto, 2, ",", ".") }}</strong>
                </h5>
                <h5 class="text-right">
                    <strong>Total IVA Bs. {{ number_format($total_iva, 2, ",", ".") }}</strong>
                </h5>
                <h5 class="text-right">
                    <strong>Total Bs. {{ number_format($total_factura, 2, ",", ".") }}</strong>
                </h5>
            </div>
    </div>

</div>
@endsection

@section('javascripts')
    @parent
@endsection
