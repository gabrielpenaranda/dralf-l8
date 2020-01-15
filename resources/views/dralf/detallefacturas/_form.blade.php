{{-- DETALLEFACTURA --}}
<div class="container">

    <div class="row">
        <div class="col-xs-7 col-md-offset-2 col-md-6">
            @if ($detallefactura->exists)
                @if ($modulo == 'factura')
                <h4>Edición de Item de Factura</h4>
                @else
                <h4>Edición de Item de Nota de Entrega</h4>
                @endif
                <form action="{{ route('detailfacturas.update', ['factura' => $factura->id, 'modulo' => $modulo]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                @if ($modulo == 'factura')
                <h4>Nuevo Item de Factura Nº {{ $factura->numero_factura }}</h4>
                @else
                <h4>Nuevo Item de Nota de Entrega Nº {{ $factura->numero_factura }}</h4>
                @endif
                <form action="{{ route('detailfacturas.store', ['modulo' => $modulo]) }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('detailfacturas.index', ['factura' => $factura->id, 'modulo' => $modulo]) }}">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="lote_id">Producto: </label>
                <select name="lote_id" class="form-control">
                    @foreach ($lote as $l)
                        @if ($detallefactura->lote_id == $l->id)
                            <option value="{{ $l->id }}" selected>
                        @else
                            <option value="{{ $l->id }}">
                            @php
                            $cantidad = $l->cantidad_disponible_lote;
                            @endphp
                        @endif
                            @php
                            $fecha = date("d-m-Y",strtotime($l->fecha_produccion_lote));
                            @endphp
                            {{ $l->producto->nombre_producto }} - Lote: {{ $l->numero_lote }} - Producido: {{ $fecha }} - Disponible: {{ $l->cantidad_disponible_lote }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="cantidad_detalle_factura">Cantidad:</label>
                <input type="text" name="cantidad_detalle_factura" class="form-control" value="{{ $detallefactura->cantidad_detalle_factura or old('cantidad_detalle_factura')}}" />
            </div>
        </div>
    </div>

    <input type="hidden" name="cantidad_disponible" value={{ $cantidad }}>
    <input type="hidden" name="factura_id" value="{{ $factura->id }}">

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
