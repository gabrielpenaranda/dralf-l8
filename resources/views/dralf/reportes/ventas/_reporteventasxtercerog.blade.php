@extends('dralf.layouts.base')

@section('title')
{{ $titulo }}
@endsection

@section('stylesheets')
@parent
@endsection

@include('dralf.layouts._nav')

@section('content')

@php
$acumulador = 0;
$acumulador_monto = 0;
$acumulador_iva = 0;
@endphp

<div class="container">

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">
            <br>
            <h3 class="title is-4 has-text-centered">Reporte General de Ventas x Tercero desde
                {{ $desde }} hasta {{ $hasta }}</h3>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-12">
            @if ($terceros != "null")
            <div class="table-container">
                <table class="table is-fullwidth">
                    @foreach($terceros as $t)
                    @php
                    $acumulador = 0;
                    $acumulador_monto = 0;
                    $acumulador_iva = 0;
                    @endphp
                    <thead>
                        {{-- <th class="has-text-centered">RIF</th>
                        <th class="has-text-left">Nombre</th>
                        <th class="has-text-left">Razón Social</th> --}}
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="title is-6 has-text-link has-text-centered">
                                {{ $t->rif }}
                            </td>
                            <td class="title is-6 has-text-left">
                                {{ $t->nombre }}
                            </td>
                            <td class="title is-6 has-text-left">
                                {{ $t->razon_social }}
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <th class="has-text-left">Documento</th>
                        <th class="has-text-centered">Número</th>
                        <th class="has-text-centered">Fecha</th>
                        <th class="has-text-right">Monto</th>
                        <th class="has-text-right">IVA</th>
                        <th class="has-text-right">Total</th>
                    </thead>
                    @foreach($factura[$t->id] as $f)
                    <tbody>
                        <tr>
                            @php
                            $total = 0;
                            @endphp
                            <td class="is-size-7 has-text-left">
                                @if ($f->documento == "factura")
                                {{ "FACTURA" }}
                                @else
                                {{ "NOTA DE ENTREGA" }}
                                @endif
                            </td>

                            <td class="is-size-7 has-text-centered">
                                {{ $f->numero}}
                            </td>
                            <td class="is-size-7 has-text-centered">
                                {{ date('d-m-Y', strtotime($f->fecha)) }}
                            </td>
                            <td class="is-size-7 has-text-right">
                                {{ number_format($f->monto, 2, ',', '.')}}
                            </td>
                            <td class="is-size-7 has-text-right">
                                {{ number_format($f->iva, 2, ',', '.')}}
                            </td>
                            @php
                            $acumulador_monto += $f->monto;
                            $acumulador_iva += $f->iva;
                            $total = $f->monto + $f->iva;
                            $acumulador += $total;
                            @endphp
                            <td class="is-size-7 has-text-right">
                                {{ number_format($total, 2, ',', '.')}}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    <tbody>
                        <tr>
                            <td class="is-size-7 has-text-centered">
                            </td>
                            <td class="is-size-7 has-text-centered">
                            </td>
                            <td class="is-size-7 has-text-centered">
                            </td>
                            <td class="title is-6 has-text-right">
                                {{ number_format($acumulador_monto, 2, ',', '.')}}
                            </td>
                            <td class="title is-6 has-text-right">
                                {{ number_format($acumulador_iva, 2, ',', '.')}}
                            </td>
                            <td class="title is-6 has-text-right">
                                {{ number_format($acumulador, 2, ',', '.')}}
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>

            </div>
            @else
            <br>
            <h3 class="title is-4 has-text-centered">No se encontraron registros para el rango de
                fecha seleccionado.</h3>
            @endif
        </div>
    </div>
</div>

@endsection

@section('javascripts')
@parent
@endsection
