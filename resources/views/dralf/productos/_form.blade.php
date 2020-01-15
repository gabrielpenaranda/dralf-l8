{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Producto</h3>
            @if ($productos->exists)
                <form action="{{ route('productos.update', ['productos' => $productos->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('productos.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('productos.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="codigo" class="is-size-7 has-text-weight-bold">Código:</label>
                    <input type="text" name="codigo" class="input is-small" value="{{ $productos->exists ? $productos->codigo : old('codigo') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombre:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $productos->exists ? $productos->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="capacidad" class="is-size-7 has-text-weight-bold">Capacidad:</label>
                    <input type="number" name="capacidad" class="input is-small" min=0 step=0.05 value="{{ $productos->exists ? $productos->capacidad : old('capacidad') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="unidadmedidas_id" class="is-size-7 has-text-weight-bold">Unidad de medida: </label>
                <div class="select">
                    <select name="unidadmedidas_id" class="is-size-7">
                        @foreach ($unidadmedidas as $u)
                            @if ($productos->unidadmedidas_id == $u->id)
                                <option value="{{ $u->id }}" selected>
                            @else
                                <option value="{{ $u->id }}">
                            @endif
                                {{ $u->unidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="tipoproductos_id" class="is-size-7 has-text-weight-bold">Tipo de producto: </label>
                <div class="select">
                    <select name="tipoproductos_id" class="is-size-7">
                        @foreach ($tipoproductos as $t)
                            @if ($productos->tipoproductos_id == $t->id)
                                <option value="{{ $t->id }}" selected>
                            @else
                                <option value="{{ $t->id }}">
                            @endif
                                {{ $t->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="prueba" class="is-size-7 has-text-weight-bold">Tipo de prueba: </label>
                <div class="select">
                    <select name="prueba" class="is-size-7">
                        @foreach ($prueba as $p)
                            @if ($productos->prueba == $p)
                                <option value="{{ $p }}" selected>
                            @else
                                <option value="{{ $p }}">
                            @endif
                                {{ $p }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="preciodolar" class="is-size-7 has-text-weight-bold">Precio US$:</label>
                    <input type="number" name="preciodolar" class="input is-small" min=0 step=0.01 value="{{ $productos->exists ? $productos->preciodolar : old('preciodolar') }}" />
                </div>
            </div>
        </div>
    </div>

    <input type="hidden">

    {{-- IMPUESTO --}}
    <div class="column is-2 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="impuest" class="radio is-size-7 has-text-weight-bold">
                    Incluye IVA: 
                        @if ($productos->exists)
                            @if ($productos->impuesto == 1)
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
                        <input type="radio" name="impuesto" class="is-small" value="1" {{ $checked1 }}/> Si <br>
                        <input type="radio" name="impuesto" class="is-small" value="0" {{ $checked2 }}/> No
                    </label>

                    {{-- @if ($materiaprimas->exists)
                        <label for="fraccionable" class="radio is-size-7 has-text-weight-bold">
                            <input type="radio" name="fraccionable" class="is-small" value="fraccionable" {{ $materiaprimas->fraccionable ? "checked" : "" }}/>
                            Fraccionable
                        </label>
                    @else
                        <label for="fraccionable" class="radio is-size-7 has-text-weight-bold">
                            <input type="radio" name="fraccionable" class="is-small" value="fraccionable" />
                            Fraccionable
                        </label>
                    @endif --}}

                </div>
            </div>
        </div>

    {{-- <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="prueba" class="is-size-7 has-text-weight-bold">Tipo de prueba: </label>
                <div class="select">
                    <select name="prueba" class="is-size-7">
                        <option value="NO" selected>NO REQUIERE</option>
                        <option value="ANTICOAGULANTE">ANTICOAGULANTE</option>
                        <option value="DILUENTE">DILUENTE</option>
                        <option value="LISANTE">LISANTE</option>
                        <option value="RINSE">RINSE</option>
                    </select>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
