{{-- ENTREGA DELIVERY --}}
<div class="container">
  
  <div class="row">
    <div class="col-xs-7 col-md-offset-2 col-md-6">
      <h4>Nueva Entrega de Producto</h4>
      <div class="row">
        <div class="col-xs-12 col-md-6"
          @if ($modulo == 'factura')
          <h5> Factura Nº {{ $entrega->factura->numero_factura }}</h5>
          @else
          <h5> Nota de Entrega Nº {{ $entrega->factura->numero_factura }}</h5>
          @endif
        </div>
        <div class="col-xs-12 col-md-6"
          <h5>Entrega Nº {{ $entrega->numero_entrega }}</h5>
        </div>
      </div>
      <form action="{{ route('entregas.storedelivery', ['modulo' => $modulo])  }}" method="POST">

      {{ csrf_field() }}
    </div>
    <div class="col-xs-3 col-md-4">
      <a class="btn btn-danger" href="{{ route('entregas.selectdelivery', ['factura' =>  $entrega->factura_id, 'modulo' => $modulo]) }}">Regresar</a>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <div class="form-group">
        <label for="numero_entrega">Número Entrega:</label>
        <span class="form-control">{{ $entrega->numero_entrega }}</span>
        <input type="hidden" name="numero_entrega" class="form-control" value="{{ $entrega->numero_entrega }}" />
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      @php
      $fecha = date("d-m-Y",strtotime($entrega->fecha_entrega));
      @endphp
      <div class="form-group">
        <label for="fecha_entrega">Fecha :</label>
        <span class="form-control">{{ $fecha }}</span>
        <input type="hidden" name="fecha_entrega" id="datepicker" class="form-control" value="{{ $fecha }}" />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <div class="form-group">
        <label for="detallefactura_id">Producto :</label>
        
        <select name="detallefactura_id" class="form-control">
          @foreach ($detallefactura as $d)
          <option value="{{ $d->id }}">
            {{ $d->lote->producto->nombre_producto }} - {{ $d->resto_detalle_factura }}
            
          </option>
          @endforeach
        </select>    
          {{-- @foreach ($detallefactura as $d)
            @if ($detallefactura->factura_id == $d->id)
              <option value="{{ $d->id }}" selected>
            @else
              <option value="{{ $d->id }}">
              @php
              $cantidad = $d->cantidad_disponible_lote;
              @endphp
            @endif
              @php
              $fecha = date("d-m-Y",strtotime($l->fecha_produccion_lote));
              @endphp
              {{ $l->producto->nombre_producto }} - Lote: {{ $l->numero_lote }} - Producido: {{ $fecha }} - Disponible: {{ $l->cantidad_disponible_lote }}
            </option>
          @endforeach
        </select>--}}
      </div>
    </div>
  </div>
   
  {{-- <input type="hidden" name="factura_id" value="{{ $factura->id }}">
  <input type="hidden" name="ffactura" value="{{ $factura->fecha_factura }}"> --}}

   <div class="row">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <div class="form-group">
        <label for="cantidad_detalle_entrega">Cantidad Entrega:</label>
        <input type="text" name="cantidad_detalle_entrega" class="form-control" value="{{ $entrega->cantidad_detalle_entrega or old('cantidad_detalle_entrega')}}" />
      </div>
    </div>
  </div>
  
  {{--
  <input type="hidden" name="resto_detalle_factura" value="{{ $detallefactura->resto_detalle_factura }}" />
  --}}
  <input type="hidden" name="entrega_id" value="{{ $entrega->id }}" />
  
  <br>
  @if ($detallefactura->count() > 0)
  <div class="row">
    <div class="ccol-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <div class="form-group">
        <button type="submit" class="btn btn-success">Grabar</button>
      </div>
    </div>
  </div>
  @endif

  </form>
</div>
</div>
