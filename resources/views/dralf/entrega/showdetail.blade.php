{{-- ENTREGA MOSTRAR DETALLE --}}
@extends('dralf.layouts.base')

@section('stylesheets')
  @parent
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-offset-1 col-xs-8 text-center">
      <h4>
        {{ 'Detalle de Entrega' }}
      </h4>
    </div>
    <div class="col-xs-2">
       @if ($modulo == 'factura')
      <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
      @else
      <a class="btn btn-danger" href="{{ route('notaentrega.index', ['modulo' => $modulo]) }}">Regresar</a>
      @endif
    </div>
    <br>
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10">

        <div class="panel panel-default">
          <div class="panel-heading">
          @if ($modulo = 'factura')
          Información de Factura
          @else
          Información de Nota de Entrega
          @endif
          </div>
          <div class="panel-body">

            <div class="row">
              <div class="col-xs-offset-1 col-xs-10">
                <table class="table table-striped">
                  <thead>
                    <th class="text-left">Número</th>
                    <th class="text-left">Fecha</th>
                    <th class="text-left">Cliente</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        {{ $factura->numero_factura }}
                      </td>
                      <td>
                        {{ date("d-m-Y", strtotime($factura->fecha_factura)) }}
                      </td>
                      <td>
                        {{ $factura->cliente->nombre_cliente }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-offset-1 col-xs-10">
                <table class="table table-striped">
                  <thead>
                    <th>Producto</th>
                    <th>Lote</th>
                    <th>Cantidad Facturada</th>
                    <th>Cantidad por entregar</th>
                  </thead>
                  <tbody>
                    @foreach($detalle_factura as $df)
                      <tr>
                        <td>
                          {{ $df->lote->producto->nombre_producto }}
                        </td>
                        <td>
                          {{ $df->lote->numero_lote }}
                        </td>
                        <td>
                          {{ $df->cantidad_detalle_factura }}
                        </td>
                        <td>
                          {{ $df->resto_detalle_factura }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-offset-1 col-xs-10">
        @if ($detalle == NULL)
          <h2>Factura no tiene entregas registradas</h2>
        @else
          <table class="table table-striped">
            <thead>
              <th class="text-left">Fecha</th>
              <th class="text-left">Número Entrega</th>
              <th class="text-left">Producto</th>
              <th class="text-left">Cantidad</th>
            </thead>
            <tbody>
              @foreach ($detalle as $de)
                <tr>
                  <td class="text-left">
                    @php $fecha = date("d-m-Y", strtotime($de->fecha_entrega)); @endphp {{ $fecha }}
                  </td>
                  <td class="text-left">
                    {{ $de->numero_entrega }}
                  </td>
                  <td class="text-left">

                    {{ $de->nombre_producto}}
                  </td>
                  <td class="text-left">
                    {{ $de->cantidad_detalle_entrega }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
  </div>
</div>
@endsection

@section('javascripts')
  @parent
@endsection
