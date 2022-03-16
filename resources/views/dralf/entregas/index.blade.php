{{-- facturas --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <br>
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-8 is-offset-2 has-text-centered">
                <h4 class="title is-4 has-text-centered">
                    {{ 'Registro de Entregas' }}
                </h4>
            </div>
            {{-- <div class="column is-2">
                <span class="title is-6 has-text-centered">
                    {{ 'Registro de facturas' }}
                </span>
                <a class="button is-link" href="{{ route('facturas.createtotal') }}">
                {{ 'Total' }}
                </a>
                <a class="button is-info" href="{{ route('facturas.createparcial') }}">
                {{ 'Parcial' }}
                </a>
                <br>
            </div> --}}
        </div>
        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($facturas != NULL)
                    <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <th class="has-text-left">Número</th>
                            <th class="has-text-left">Documento</th>
                            <th class="has-text-left">Fecha</th>
                            <th class="has-text-left">Cliente</th>
                            <th class="has-text-centered">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $f)
                                <tr>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->numero }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        @if ($f->documento == "factura")
                                            {{ "Factura" }}
                                        @else
                                            {{ "Nota de Entrega" }}
                                        @endif
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ date("d-m-Y", strtotime($f->fecha)) }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->terceros->nombre }}
                                    </td>
                                    <td>
                                        @if (Auth::check())
                                            {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> --}}
                                                <div class="buttons has-addons is-centered">


                                                {{-- <a class="button is-primary is-small is-outlined" href="{{ route('detailfacturas.index', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos"><span class="glyphicon glyphicon-plus" aria-hidden="true">Agregar Productos</span></a> --}}
                                                @if ($f->entregado == 'N')
                                                <a class="button is-danger is-outlined is-small" href="{{ route('entregas.total', ['facturas' => $f->id, 'modulo' => $f->documento]) }}" title="Entrega total">Total</a>
                                                @endif
                                                @if ($f->entregado == 'P' || $f->entregado == 'N')
                                                <a class="button is-link is-outlined is-small" href="{{ route('entregas.parcial', ['facturas' => $f->id, 'modulo' => $f->documento]) }}" title="Entrega parcial">Parcial</a>
                                                @endif
                                                @if ($f->entregado == 'E'  || $f->entregado == 'P')
                                                <a class="button is-success is-small is-primary is-outlined" href="{{ route('entregas.show', ['facturas' => $f->id, 'modulo' => $f->documento]) }}" title="Ver entregas">Ver</a>
                                                @endif

                                                {{-- <a class="btn btn-primary btn-sm" href="{{ route('facturas.create', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar entrega"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>

                                                <a class="btn btn-success btn-sm" href="{{ route('facturas.selectdelivery', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos a entrega"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                                                <a class="btn btn-orange btn-sm" href="{{ route('facturas.show_delivery_detail', ['facturas' => $f->id, 'modulo' => $modulo]) }}" title="Ver facturas"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a> --}}
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
