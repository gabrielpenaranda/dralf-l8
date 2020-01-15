{{-- ENTREGA --}}

<div class="container">
{{-- @php
dd($modulo)
@endphp --}}
<div class="row">
  <div class="col-xs-7 col-md-offset-2 col-md-6">
    @if ($entrega->exists)
    <h4>Edición de Entrega</h4>
    <form action="{{ route('entregas.update', ['entrega' => $entrega->id]) }}" method="POST">
      {{ method_field('PUT') }}
      @else
      @if ($modulo == 'factura')
      <h4>Nueva Entrega a Factura Nº {{ $factura->numero_factura }}</h4>
      @else
      <h4>Nueva Entrega a Nota de Entrega Nº {{ $factura->numero_factura }}</h4>
      @endif
      <form action="{{ route('entregas.store', ['modulo' => $modulo]) }}" method="POST">
        @endif

        {{ csrf_field() }}
      </div>
      <div class="col-xs-3 col-md-4">
        @if ($modulo == 'factura')
        <a class="btn btn-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
        @else
        <a class="btn btn-danger" href="{{ route('notaentrega.index', ['modulo' => $modulo]) }}">Regresar</a>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <div class="form-group">
          <label for="numero_entrega">Número Entrega:</label>
          <input type="text" name="numero_entrega" class="form-control" value="{{ $entrega->numero_entrega or old('numero_entrega')}}" />
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        @if ($entrega->exists)
        @php
        $fecha = date("d-m-Y",strtotime($entrega->fecha_entrega));
        @endphp
        @else
        @php
        $fecha = $entrega->fecha_entrega;
        @endphp
        @endif
        <div class="form-group">
          <label for="fecha_entrega">Fecha :</label>
          <input type="text" name="fecha_entrega" id="datepicker" class="form-control" value="{{ $fecha or old('fecha_entrega')}}" />
        </div>
      </div>
    </div>

    <input type="hidden" name="factura_id" value="{{ $factura->id }}">
    <input type="hidden" name="ffactura" value="{{ $factura->fecha_factura }}">

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
