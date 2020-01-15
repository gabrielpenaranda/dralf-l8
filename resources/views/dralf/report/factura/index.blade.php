{{-- REPORTEs DE FACTURACION --}}

@extends('dralf.layouts.base')

@section('title', 'Reportes Facturación')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.structure.min.css') }}">
@endsection

@include('dralf.layouts._nav')

@section('content')
<div class="container">

    <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <table class="table table-striped">
                    <thead>
                        <th class="text-left">Reporte</th>
                        <th class="text-left">Ejecutar</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">
                                Reporte de Facturación
                            </td>
                            <td class="text-left">
                                <a class="btn btn-success" href="{{ route('reportefactura.factura-index') }}" title="Reporte de Facturación"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Reporte de IVA
                            </td>
                            <td class="text-left">
                                <a class="btn btn-success" href="{{ route('reportefactura.iva-index') }}" title="Reporte de IVA"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>

</div>
@endsection

@section('javascripts')
    @parent
@endsection
