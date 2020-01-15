{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Materia Prima</h3>
            @if ($materiaprimas->exists)
                <form action="{{ route('materiaprimas.update', ['materiaprimas' => $materiaprimas->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('materiaprimas.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('materiaprimas.index') }}">Regresar</a>
        </div>
    </div>

    {{-- CODIGO --}}
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="codigo" class="is-size-7 has-text-weight-bold">Código:</label>
                    <input type="text" name="codigo" class="input is-small" value="{{ $materiaprimas->exists ? $materiaprimas->codigo : old('codigo') }}" />
                </div>
            </div>
        </div>
    </div>

    {{-- NOMBRE --}}
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombre:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $materiaprimas->exists ? $materiaprimas->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    {{-- FRACCIONABLE --}}
    <div class="column is-2 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="fraccionable" class="radio is-size-7 has-text-weight-bold">
                    Fraccionable: 
                        @if ($materiaprimas->exists)
                            @if ($materiaprimas->fraccionable == 1)
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
                        <input type="radio" name="fraccionable" class="is-small" value="1" {{ $checked1 }}/> Si <br>
                        <input type="radio" name="fraccionable" class="is-small" value="0" {{ $checked2 }}/> No
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

    {{-- UNIDAD DE MEDIDA --}}
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="unidadmedidas_id" class="is-size-7 has-text-weight-bold">Unidad de medida: </label>
                <div class="select">
                    <select name="unidadmedidas_id" class="is-size-7">
                        @foreach ($unidadmedidas as $u)
                            @if ($materiaprimas->unidadmedidas_id == $u->id)
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
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
