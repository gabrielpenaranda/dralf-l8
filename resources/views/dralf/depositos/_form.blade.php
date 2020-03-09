{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Deposito</h3>
            @if ($depositos->exists)
                <form action="{{ route('depositos.update', ['depositos' => $depositos->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('depositos.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('depositos.index') }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombre:</label>
                    @if (!$depositos->exists)
                        <input type="text" name="nombre" class="input is-small" value="{{ $depositos->exists ? $depositos->nombre : old('nombre') }}" />
                    @else
                        <span>{{ $depositos->nombre }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="direccion" class="is-size-7 has-text-weight-bold">Dirección:</label>
                    <input type="text" name="direccion" class="input is-small" value="{{ $depositos->exists ? $depositos->direccion : old('direccion') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="telefono" class="is-size-7 has-text-weight-bold">Teléfonos:</label>
                    <input type="text" name="telefono" class="input is-small" value="{{ $depositos->exists ? $depositos->telefono : old('telefono') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="ciudades_id" class="is-size-7 has-text-weight-bold">Ciudad: </label>
                <div class="select">
                    <select name="ciudades_id" class="is-size-7">
                        @foreach ($ciudades as $e)
                            @if ($depositos->ciudades_id == $e->id)
                                <option value="{{ $e->id }}" selected>
                            @else
                                <option value="{{ $e->id }}">
                            @endif
                                {{ $e->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>



    <div class="columns is-mobile">
        <div class="column is-2 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="factura" class="radio is-size-7 has-text-weight-bold">
                        Deposito para facturación:
                        @if ($depositos->exists)
                            @if ($depositos->factura == 1)
                                @php
                                $checked1 = "checked";
                                $checked2 = "";
                                @endphp
                            @else
                                @php
                                $checked1 = "";
                                $checked2 = "checked";
                                @endphp
                            @endif
                        @else
                            @php
                            $checked1 = "";
                            $checked2 = "";
                            @endphp
                        @endif
                        <br>
                        <input type="radio" name="factura" class="is-small" value="1" {{ $checked1 }}/> Si <br>
                        <input type="radio" name="factura" class="is-small" value="0" {{ $checked2 }}/> No
                    </label>
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
</div>
