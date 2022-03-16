{{-- IMPRIMIR NOTA ENTREGA --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')

<div class="container">

    <div class="columns is-mobile">
        <div class="column is-3">
            <figure class="image"  style="margin-left: auto; margin-right: auto;">
        
                <img src="{{ asset('img/logo.png') }}" alt="">
            </figure>
            <span class="title is-5">LABORATORIO DR. ALF C.A.</span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-offset-8 is-4">
            <span class="title is-6">NOTA DE ENTREGA Nº {{ $facturas->numero }}</span> <br>
            <span class="title is-6">FECHA EMISIÓN {{ date('d/m/Y', strtotime($facturas->fecha)) }}</span>
        </div>
    </div>
    <br>
    <div class="columns is-mobile">
        <div class="column is-12">
            <span class="is-size-6 has-text-weight-bold">CLIENTE: &nbsp;</span>
            <span class="is-size-6">{{ $facturas->terceros->razon_social }} </span> <br>
            <span class="is-size-6 has-text-weight-bold">RIF: &nbsp;</span>
            <span class="is-size-6">{{ $facturas->terceros->rif }} </span> <br>
            <span class="is-size-6 has-text-weight-bold">DIRECCIÓN: &nbsp;</span>
            <span class="is-size-6">{{ $facturas->terceros->direccion }} </span>
        </div>
    </div>

    @php
    $contador = 40 - count($detallefacturas);
    $acumulador = 0;
    @endphp

    <div class="columns is-mobile">
        <div class="column is-12">
            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <th>CÓDIGO</th>
                        <th>PRODUCTO</th>
                        <th>LOTE</th>
                        <th class="has-text-centered">CANTIDAD</th>
                        <th class="has-text-centered">UNIDAD</th>
                        <th class="has-text-right">PRECIO</th>
                        <th class="has-text-right">TOTAL</th>
                    </thead>
                    <tbody>
                        @foreach($detallefacturas as $d)
                        <tr>
                            <td>
                                {{ $d->lotes->productos->codigo }}
                            </td>
                            <td>
                                {{ $d->lotes->productos->nombre }}
                            </td>
                            <td>
                                {{ $d->lotes->numero }}
                            </td>
                            <td class="has-text-centered">
                                {{ $d->cantidad }}
                            </td>
                            <td class="has-text-centered">
                                {{ $d->lotes->productos->unidadmedidas->abreviatura }}
                            </td>
                            <td class="has-text-right">
                                {{ number_format($d->precio, 2, ',', '.') }}
                            </td>
                            @php
                            $total = $d->cantidad * $d->precio;
                            $acumulador += $total;
                            @endphp
                            <td class="has-text-right">
                                {{ number_format($total, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- @for ($i = 1; $i <= $contador ; $i++)
        <br>
    @endfor --}}
    <br> <br> <br>
    <div class="columns is-mobile">
        <div class="column is-offset-7 is-5">
            <span class="title is-6">TOTAL NOTA DE ENTREGA &nbsp; &nbsp;</span>
            <span class="title is-6 has-text-right"> {{ number_format($acumulador, 2, ',', '.') }}</span>
        </div>
    </div>

</div>

@endsection

@section('javascripts')
    @parent
@endsection


