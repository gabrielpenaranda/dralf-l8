{{-- REPORTE DE IVA --}}

@extends('dralf.layouts.base')

@section('title', 'Reporte de IVA')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-center">
                Reporte de IVA
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
                        <th class="text-center">IVA</th>
                    </thead>
                    <tbody>
                        @php $total_iva = 0 @endphp
                        @foreach ($iva as $i)
                            <tr>
                                <td class="text-left">{{ date('d-m-Y', strtotime($i->fecha_factura)) }}</td>
                                <td class="text-left">{{ $i->numero_factura }}</td>
                                <td class="text-left">{{ $i->cliente->nombre_cliente }}</td>
                                <td class="text-right">{{ number_format($i->iva_factura, 2, ",", ".") }}</td>
                            </tr>
                            @php $total_iva += $i->iva_factura @endphp
                        @endforeach
                    </tbody>
                </table>
                <h4 class="text-right">
                    <strong>Total IVA Bs. {{ number_format($total_iva, 2, ",", ".") }}</strong>
                </h4>
            </div>
    </div>

</div>
@endsection

@section('javascripts')
    @parent
@endsection
