{{-- DETALLE FACTURA --}}
@extends('dralf.layouts.base')

@section('stylesheets')

@parent @endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-8 text-center">
            <h4>
                @if ($modulo == 'factura')
                <h4>Registro de Productos a Entregar Factura Nº {{ $factura->numero_factura }}</h4>
                @else
                 <h4>Registro de Productos a Entregar Nota de Entrega Nº {{ $factura->numero_factura }}</h4>
                @endif
            </h4>
        </div>
        <div class="col-xs-2">
             @if ($modulo == 'factura')
            <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo', $modulo]) }}">Regresar</a>
            @else
            <a class="btn btn-danger" href="{{ route('notaentrega.index', ['modulo', $modulo]) }}">Regresar</a>
            @endif
        </div>
    </div>
    <div class="row">
        @if ($factura != NULL)
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            <table class="table">
                <thead>
                    <th class="text-left">Número</th>
                    <th class="text-left">Fecha</th>
                     <th class="text-left">Cliente</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            {{ $factura->numero_factura }}
                        </td>
                        <td class="text-left">
                            {{ date("d-m-Y", strtotime($factura->fecha_factura)) }}
                        </td>
                        <td class="text-left">
                            {{ $factura->cliente->nombre_cliente }}
                        </td>
                        {{-- <td>
                            <a class="btn btn-success" href="{{ route('detailfacturas.create', ['factura' => $factura->id]) }}">Agregar Entrega</a>
                        </td> --}}
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            @if ($entrega != NULL)
            <table class="table table-striped">
                <thead>
                    <th class="text-left">Número Entrega</th>
                    <th class="text-left">Fecha</th>
                </thead>
                <tbody>
                    @foreach ($entrega as $f)
                    <tr>
                        <td class="text-left">
                            {{ $f->numero_entrega }}
                        </td>
                        @php $fecha = date('d-m-Y', strtotime($f->fecha_entrega)); @endphp
                        <td class="text-left">
                            {{ $fecha }}
                        </td>
                        <td class="text-center">
                            @if (Auth::check())
                            {{--<form action="{{ route('detailfacturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-danger" title="Eliminar">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>--}}
                                <a class="btn btn-info" href="{{ route('entregas.createdelivery', ['entrega' => $f->id, 'modulo' => $modulo]) }}" title="Agregar Productos">                                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </a>
                                {{-- <a class="btn btn-warning" href="{{ route('entregas.show', ['detallefactura' => $f->id]) }}" title="Ver factura">
                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                </a> --}}
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        {!! $entrega->render() !!}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascripts')

@parent @endsection