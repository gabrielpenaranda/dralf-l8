{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Persona</h3>
            @if ($personas->exists)
                <form action="{{ route('personas.update', ['personas' => $personas->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('personas.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('personas.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombres:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $personas->exists ? $personas->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="apellido" class="is-size-7 has-text-weight-bold">Apellidos:</label>
                    <input type="text" name="apellido" class="input is-small" value="{{ $personas->exists ? $personas->apellido : old('apellido') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="cargo" class="is-size-7 has-text-weight-bold">Cargo:</label>
                    <input type="text" name="cargo" class="input is-small" value="{{ $personas->exists ? $personas->cargo : old('cargo') }}" />
                </div>
            </div>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="telefono" class="is-size-7 has-text-weight-bold">Teléfono(s):</label>
                    <input type="text" name="telefono" class="input is-small" value="{{ $personas->exists ? $personas->telefono : old('telefono') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="email" class="is-size-7 has-text-weight-bold">E-mail:</label>
                    <input type="text" name="email" class="input is-small" value="{{ $personas->exists ? $personas->email : old('email') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="tipopersonas_id" class="is-size-7 has-text-weight-bold">Tipo de persona: </label>
                <div class="select">
                    <select name="tipopersonas_id" class="is-size-7">
                        @foreach ($tipopersonas as $t)
                            @if ($personas->tipopersonas_id == $t->id)
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
                <label for="terceros_id" class="is-size-7 has-text-weight-bold">Tercero: </label>
                <div class="select">
                    <select name="terceros_id" class="is-size-7">
                        @foreach ($terceros as $t)
                            @if ($personas->terceros_id == $t->id)
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
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
