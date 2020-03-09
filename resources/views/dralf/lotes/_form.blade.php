{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Lote</h3>
            @if ($lotes->exists)
                <form action="{{ route('lotes.update', ['lotes' => $lotes->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('lotes.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('lotes.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="numero" class="is-size-7 has-text-weight-bold">Número de Lote:</label>
                    @if (!$lotes->exists)
                        <input type="text" name="numero" class="input is-small" value="{{ $lotes->exists ? $lotes->numero : old('numero')}}" />
                    @else
                        <span>{{ $lotes->numero }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="productos_id" class="is-size-7 has-text-weight-bold">Producto: </label>
                    <select name="productos_id" class="is-size-7">
                        @foreach ($productos as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-3 is-offset-3">
            @if ($lotes->exists)
                @php
                $fecha = date("d-m-Y",strtotime($lotes->fecha_produccion));
                @endphp
            @else
                @php
                $fecha = $lotes->fecha_produccion;
                @endphp
            @endif
            <div class="field">
                <div class="control">
                    <label for="fecha_produccion" class="is-size-7 has-text-weight-bold">Fecha Prod.:</label>
                    <input type="text" name="fecha_produccion" id="datepicker" class="input is-small" value="{{ $lotes->exists ? $fecha : old('fecha_produccion')}}" />
                </div>
            </div>
        </div>
        <div class="column is-3">
            @if ($lotes->exists)
                @php
                $fecha = date("d-m-Y",strtotime($lotes->fecha_vencimiento));
                @endphp
            @else
                @php
                $fecha = $lotes->fecha_vencimiento;
                @endphp
            @endif
            <div class="field">
                <div class="control">
                    <label for="fecha_vencimiento" class="is-size-7 has-text-weight-bold">Fecha Venc.:</label>
                    <input type="text" name="fecha_vencimiento" id="datepicker1" class="input is-small" value="{{ $lotes->exists ? $fecha : old('fecha_vencimiento')}}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-3 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="cantidad_producida" class="is-size-7 has-text-weight-bold">Cant. Prod.:</label>
                    <input type="text" name="cantidad_producida" class="input is-small" value="{{ $lotes->exists ? $lotes->cantidad_producida : old('cantidad_producida')}}" />
                </div>
            </div>
        </div>
        <div class="column is-3">
            <div class="field">
                <div class="control">
                    <label for="cantidad_prueba" class="is-size-7 has-text-weight-bold">Cant. Prueba:</label>
                    <input type="text" name="cantidad_prueba" class="input is-small" value="{{ $lotes->exists ? $lotes->cantidad_prueba : old('cantidad_prueba')}}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="depositos_id" class="is-size-7 has-text-weight-bold">Depósito: </label>
                    <select name="depositos_id" class="is-size-7">
                        @foreach ($depositos as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
