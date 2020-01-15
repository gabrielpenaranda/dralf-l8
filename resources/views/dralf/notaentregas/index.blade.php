{{-- PRODUCTO --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <br>
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-8 is-offset-2 has-text-centered">
                <h4 class="title is-4 has-text-centered">
                    {{ 'Registro de Factura' }}
                </h4>
            </div>
            <div class="column is-2">
                <a class="button is-primary" href="{{ route('facturas.create', ['modulo' => $modulo]) }}">Crear Factura</a>
                <br>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($facturas != NULL)
                    <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <th class="has-text-left">Número</th>
                            <th class="has-text-left">Cliente</th>
                            <th class="has-text-left">Fecha</th>
                            <th class="has-text-left">Monto</th>
                            <th class="has-text-left">IVA</th>
                            <th class="has-text-left">Total</th>
                            <th class="has-text-centered">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $f)
                                <tr>
                                <td class="is-size-7 has-text-left">
                                        {{ $f->numero }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->terceros->nombre }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ date("d-m-Y", strtotime($f->fecha)) }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ number_format($f->monto, 2, ',', '.') }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ number_format($f->iva, 2, ',', '.') }}
                                    </td>
                                    @php
                                    $total = $f->monto + $f->iva;
                                    @endphp
                                    <td class="is-size-7 has-text-left">
                                        {{ number_format($total, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        @if (Auth::check())
                                            {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> --}}
                                                <div class="buttons has-addons is-centered">
                                                
                                                
                                                {{-- <a class="button is-primary is-small is-outlined" href="{{ route('detailfacturas.index', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos"><span class="glyphicon glyphicon-plus" aria-hidden="true">Agregar Productos</span></a> --}}

                                                <a class="button is-primary is-small is-outlined" href="{{ route('facturas.show', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Ver factura">Ver</a>

                                                {{-- <a class="btn btn-primary btn-sm" href="{{ route('entregas.create', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar entrega"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>

                                                <a class="btn btn-success btn-sm" href="{{ route('entregas.selectdelivery', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos a entrega"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                                                <a class="btn btn-orange btn-sm" href="{{ route('entregas.show_delivery_detail', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Ver entregas"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a> --}}
                                                </div>


                                            {{-- </form> --}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="container">
                        <div class="columns is-mobile">
                            <div class="column is-12">
                                {!! $facturas->render() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

  @section('javascripts')
      @parent
  @endsection
