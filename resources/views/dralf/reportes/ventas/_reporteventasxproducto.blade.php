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
                <h3 class="title is-4 has-text-centered">Reporte de Ventas x Producto desde {{ $desde }} hasta {{ $hasta }}</h3>
            </div>
        </div>

        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($productos != "null")
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-centered">Código</th>
                                <th class="has-text-left">Producto</th>
                                <th class="has-text-centered">Cantidad Vendida</th>
                                <th class="has-text-right">Monto (sin IVA)</th>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="is-size-7 has-text-centered">
                                            {{ $productos->codigo }}   
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $productos->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-centered">
                                            {{ $acumulador }}
                                        </td>
                                        <td class="is-size-7 has-text-right">
                                             {{ number_format($acumuladormonto, 2, ',', '.') }}
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                       
                    </div>
                @else
                    <br>
                    <h3 class="title is-4 has-text-centered">No se encontraron registros para el rango de fecha seleccionado.</h3>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('javascripts')
    @parent
@endsection