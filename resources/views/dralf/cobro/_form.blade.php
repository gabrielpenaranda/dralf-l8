{{-- LOTE --}}
<div class="container">

    <div class="row">
        <div class="col-xs-7 col-md-offset-2 col-md-6">
            @if ($cobro->exists)
                <h4>Edición de Cobro</h4>
                <form action="{{ route('cobros.update', ['factura' => $factura->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4>Nuevo Cobro</h4>
                <form action="{{ route('cobros.store', ['modulo' => $modulo]) }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('cobros.index', ['modulo' => $modulo]) }}">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="numero_cobro">Número de Referencia:</label>
                @if (!$cobro->exists)
                    <input type="text" name="numero_cobro" class="form-control" value="{{ $cobro->numero_cobro or old('numero_cobro')}}" />
                @else
                    <span>{{ $cobro->numero_cobro }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            @if ($cobro->exists)
                @php
                $fecha = date("d-m-Y",strtotime($cobro->fecha_cobro));
                @endphp
            @else
                @php
                $fecha = $cobro->fecha_cobro;
                @endphp
            @endif
            <div class="form-group">
                <label for="fecha_cobro">Fecha :</label>
                <input type="text" name="fecha_cobro" id="datepicker" class="form-control" value="{{ $fecha or old('fecha_cobro')}}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="monto_cobro">Monto Bs.:</label>
                <input type="number" step="0.01" min="0" name="monto_cobro" class="form-control" value="{{ $cobro->monto_cobro or old('monto_cobro')}}" />
            </div>
        </div>
    </div>

    @php
        $banco = ['Provincial', 'Mercantil', 'Banplus'];
    @endphp

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <label for="banco_cobro">Banco:</label>
                <select name="banco_cobro" class="form-control">
                    @foreach ($banco as $b)
                        @if ($cobro->exists)
                        <option value="{{ $cobro->banco_cobro }}" selected>
                            {{ $cobro->banco_cobro }}
                        </option>
                        @else
                        <option value="{{ $b }}">
                            {{ $b }}
                        </option>
                        @endif
                    @endforeach
                </select>    
            </div>
        </div>
    </div>

    <input type="hidden" name="factura_id" value="{{ $factura->id }}"

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
