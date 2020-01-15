{{-- NOTA ENTREGA --}}

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
                    {{ 'Registro de Nota de Entrega' }}
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <a class="btn btn-primary" href="{{ route('notaentrega.create', ['modulo' => $modulo]) }}">Crear Nota de Entrega</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @if ($factura != NULL)
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Número</th>
                            <th class="text-left">Cliente</th>
                            <th class="text-left">Fecha</th>
                            <th class="text-left">Monto</th>
                            <th class="text-center">Acciones</th>
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
                                    <td class="text-left">
                                        {{ number_format($f->monto_factura, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::check())
                                            {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> --}}

                                                <a class="btn btn-info btn-sm" href="{{ route('detailfacturas.index', ['factura' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                                                <a class="btn btn-warning btn-sm" href="{{ route('notaentrega.show', ['factura' => $f->id, 'modulo' => $modulo]) }}" title="Ver factura"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>

                                                <a class="btn btn-primary btn-sm" href="{{ route('entregas.create', ['factura' => $f->id, 'modulo' => $modulo]) }}" title="Agregar entrega"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>

                                                <a class="btn btn-success btn-sm" href="{{ route('entregas.selectdelivery', ['factura' => $f->id, 'modulo' => $modulo]) }}" title="Agregar productos a entrega"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>

                                                <a class="btn btn-orange btn-sm" href="{{ route('entregas.show_delivery_detail', ['factura' => $f->id, 'modulo' => $modulo]) }}" title="Ver entregas"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                                
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
