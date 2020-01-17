@extends('dralf.layouts.base')

@section('title')
    {{ $titulo }}
@endsection

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    
    <div class="container">

        <div class="columns is-mobile">
            <div class="column is-8 is-offset-2">
                <br>
                <h3 class="title is-4 has-text-centered">Reporte de Ventas desde {{ $desde }} hasta {{ $hasta }}</h3>
            </div>
        </div>

        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($facturas != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Documento</th>
                                <th class="has-text-left">Número</th>
                                <th class="has-text-left">Cliente</th>
                                <th class="has-text-left">Fecha</th>
                                <th class="has-text-centered">Monto</th>
                                <th class="has-text-centered">IVA</th>
                                <th class="has-text-centered">Total</th>
                            </thead>
                            <tbody>
                                @php
                                    $acumulador = 0;
                                    $acumulador_iva = 0;
                                @endphp
                                @foreach ($facturas as $f)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            @if ($f->documento == 'factura')
                                                FACTURA
                                            @else
                                                NOTA DE ENTREGA
                                            @endif    
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $f->numero }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $f->terceros->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ date("d-m-Y", strtotime($f->fecha)) }}
                                        </td>
                                        <td class="is-size-7 has-text-right">
                                            {{ number_format($f->monto, 2, ',', '.') }}
                                        </td>
                                        <td class="is-size-7 has-text-right">
                                            {{ number_format($f->iva, 2, ',', '.') }}
                                        </td>
                                        @php
                                        $total = $f->monto + $f->iva;
                                        @endphp
                                        <td class="is-size-7 has-text-right">
                                            {{ number_format($total, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                    @php
                                        $acumulador += $f->monto;
                                        $acumulador_iva += $f->iva;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                @else
                    <br>
                    <h3 class="title is-4 has-text-centered">No se encontraron registros para el rango de fecha seleccionado.</h3>
                @endif
            </div>
        </div>
         <div class="columns is-mobile">
                            <div class="column is-offset-6 is-6">
                            <br>
                                 <span class="title is-4 has-text-centered">Total IVA Cobrado   {{ number_format($acumulador_iva, 2, ',', '.') }}</span>
                            </div>
                        </div>
    </div>

@endsection

@section('javascripts')
    @parent
@endsection