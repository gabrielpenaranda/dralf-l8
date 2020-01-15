{{-- FACTURAS CANCELADAS --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>
                    {{ 'Facturas Canceladas' }}
                </h4>
            </div>
        </div>
            {{-- <div class="col-xs-2">
                <a class="btn btn-primary" href="{{ route('facturas.create') }}">Crear Pago</a>
            </div> --}}
        <div class="row">
            <div class="col-xs-12">
                @if ($factura != NULL)
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Número Factura</th>
                            <th class="text-left">Cliente</th>
                            <th class="text-left">Fecha</th>
                            <th class="text-left">Monto</th>
                            <th class="text-left">Saldo</th>
                            <th class="text-left">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($factura as $f)
                                <tr>
                                <td class="text-left">
                                        {{ $f->numero_factura }}
                                    </td>
                                    <td class="text-left">
                                        {{ $f->cliente->nombre_cliente }}
                                    </td>
                                    <td class="text-left">
                                        {{ date("d-m-Y", strtotime($f->fecha_factura)) }}
                                    </td>
                                    @php
                                    $total = $f->monto_factura + $f->iva_factura;
                                    @endphp
                                    <td class="text-left">
                                        {{ number_format($total, 2, ",", ".") }}
                                    </td>
                                    <td class="text-left">
                                        {{ number_format($f->saldo_factura, 2, ",", ".") }}
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::check())
                                            {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> --}}
                                                {{-- <a class="btn btn-info" href="{{ route('cobros.create', ['factura' => $f->id]) }}" title="Agregar pagos"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a> --}}
                                                <a class="btn btn-warning btn-sm" href="{{ route('cobros.show',['factura' => $f->id, 'modulo' => $modulo]) }}" title="Ver detalle"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                            {{-- </form> --}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $factura->render() !!}
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
