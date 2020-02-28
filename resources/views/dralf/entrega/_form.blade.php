{{-- entregas --}}

<div class="container">
<div class="columns is-mobile">
  <div class="column is-7 is-offset-2">
    @if ($entregas->exists)
    <h4>Edición de Entregas</h4>
    <form action="{{ route('entregas.update', ['entregas' => $entregas->id]) }}" method="POST">
      {{ method_field('PUT') }}
      @else
      @if ($modulo == 'factura')
      <h4>Nueva entrega a Factura Nº {{ $facturas->numero }}</h4>
      @else
      <h4>Nueva entrega a Nota de entregas Nº {{ $facturas->numero }}</h4>
      @endif
      <form action="{{ route('entregas.store', ['modulo' => $modulo]) }}" method="POST">
        @endif

        {{ csrf_field() }}
      </div>
      <div class="col-xs-3 col-md-4">
        @if ($modulo == 'factura')
        <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
        @else
        <a class="btn btn-danger" href="{{ route('notaentregas.index', ['modulo' => $modulo]) }}">Regresar</a>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <div class="form-group">
          <label for="numero_entregas">Número entregas:</label>
          <input type="text" name="numero_entregas" class="form-control" value="{{ $entregas->numero_entregas or old('numero_entregas')}}" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        @if ($entregas->exists)
        @php
        $fecha = date("d-m-Y",strtotime($entregas->fecha_entregas));
        @endphp
        @else
        @php
        $fecha = $entregas->fecha_entregas;
        @endphp
        @endif
        <div class="form-group">
          <label for="fecha_entregas">Fecha :</label>
          <input type="text" name="fecha_entregas" id="datepicker" class="form-control" value="{{ $fecha or old('fecha_entregas')}}" />
        </div>
      </div>
    </div>

    <input type="hidden" name="factura_id" value="{{ $facturas->id }}">
    <input type="hidden" name="ffactura" value="{{ $facturas->fecha }}">

    <br>
    <div class="row">
      <div class="ccol-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <div class="form-group">
          <button type="submit" class="btn btn-success">Grabar</button>
        </div>
      </div>
    </div>

  </form>
</div>
</div>
