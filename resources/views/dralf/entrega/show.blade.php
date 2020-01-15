{{-- ENTREGA MOSTRAR--}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-8 text-center">
                <h4>
                    {{ 'Facturas' }}
                </h4>
            </div>
            <div class="col-xs-2">
                <a class="btn btn-danger" href="{{ route('entregas.menu') }}">Regresar</a>
            </div>
            <br>
            <div class="col-xs-offset-1 col-xs-10">
                @if ($factura != NULL)
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Número Factura</th>
                            <th class="text-left">Cliente</th>
                            <th class="text-left">Fecha</th>
                            <th class="text-left">Monto</th>
                            <th class="text-left">IVA</th>
                            <th class="text-left">Total</th>
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
                                    <td class="text-left">
                                        {{ number_format($f->monto_factura, 2, ',', '.') }}
                                    </td>
                                    <td class="text-left">
                                        {{ number_format($f->iva_factura, 2, ',', '.') }}
                                    </td>
                                    @php
                                    $total = $f->monto_factura + $f->iva_factura;
                                    @endphp
                                    <td class="text-left">
                                        {{ number_format($total, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::check())
                                            {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button> --}}
                                                {{-- <a class="btn btn-success" href="{{ route('entregas.create', ['factura' => $f->id]) }}" title="Agregar entrega"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a> --}}
                                                <a class="btn btn-warning" href="{{ route('entregas.show_delivery_detail', ['factura' => $f->id]) }}" title="Ver entregas"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
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
