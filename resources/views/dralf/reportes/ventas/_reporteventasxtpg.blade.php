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
            <h3 class="title is-4 has-text-centered">Reporte de Ventas de Producto x Tercero desde {{ $desde }}
                hasta {{ $hasta }}</h3>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-12">
            @if ($terceros != "null")
            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <th class="has-text-centered">RIF</th>
                        <th class="has-text-left">Nombre</th>
                        <th class="has-text-left">Razón Social</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="is-size-7 has-text-centered">
                                {{ $terceros->rif }}
                            </td>
                            <td class="is-size-7 has-text-left">
                                {{ $terceros->nombre }}
                            </td>
                            <td class="is-size-7 has-text-left">  
                                {{ $terceros->razon_social }}
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <th class="has-text-centered">CODIGO</th>
                        <th class="has-text-left">NOMBRE</th>
                        <th class="has-text-centered">CANTIDAD</th>
                        <th class="has-text-right">MONTO</th>
                    </thead>
                    <tbody>
                        @php
                        $acumulador = 0;
                        @endphp
                        @foreach ($productos as $p)
                        @if ($aproducto[$p->id] > 0)
                        <tr>
                            <td class="is-size-7 has-text-centered">
                                {{ $p->codigo }}
                            </td>
                            <td class="is-size-7 has-text-left">
                                {{ $p->nombre }}
                            </td>
                            <td class="is-size-7 has-text-centered">
                                {{ $aproducto[$p->id] }}
                            </td>
                            <td class="is-size-7 has-text-right">
                                {{ number_format($amonto[$p->id], 2, ',', '.') }}
                            </td>
                        </tr>
                        @php
                        $acumulador += $amonto[$p->id]
                        @endphp
                        @endif
                        @endforeach
                        <tr>
                            <td class="is-size-7 has-text-centered">
                            </td>
                            <td class="is-size-7 has-text-left">
                            </td>
                            <td class="is-size-7 has-text-centered">
                            </td>
                            <td class="title is-6 has-text-right">
                                {{ number_format($acumulador, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
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
