{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Tercero</h3>
            @if ($terceros->exists)
                <form action="{{ route('terceros.update', ['terceros' => $terceros->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('terceros.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('terceros.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-2 is-offset-3">
            <div class="field">
                <div class="control">
                    @if ($terceros->exists)
                        <label for="cliente" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="cliente" class="is-small" value="cliente" {{ $terceros->cliente ? "checked" : "" }}/>
                            Cliente
                        </label>
                    @else
                        <label for="cliente" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="cliente" class="is-small" value="cliente" />
                            Cliente
                        </label>
                    @endif

                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <div class="control">
                    @if ($terceros->exists)
                        <label for="proveedor" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="proveedor" class="is-small" value="proveedor" {{ $terceros->proveedor ? "checked" : "" }}/>
                            Proveedor
                        </label>
                    @else
                        <label for="proveedor" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="proveedor" class="is-small" value="proveedor" />
                            Proveedor
                        </label>
                    @endif
                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <div class="control">
                    @if ($terceros->exists)
                        <label for="laboratorio" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="laboratorio" class="is-small" value="laboratorio" {{ $terceros->laboratorio ? "checked" : "" }}/>
                            Laboratorio
                        </label>
                    @else
                        <label for="laboratorio" class="checkbox is-size-7 has-text-weight-bold">
                            <input type="checkbox" name="laboratorio" class="is-small" value="laboratorio" />
                            Laboratorio
                        </label>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Nombre:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $terceros->exists ? $terceros->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="razon_social" class="is-size-7 has-text-weight-bold">Razón Social:</label>
                    <input type="text" name="razon_social" class="input is-small" value="{{ $terceros->exists ? $terceros->razon_social : old('razon_social') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="rif" class="is-size-7 has-text-weight-bold">RIF:</label>
                    <input type="text" name="rif" class="input is-small" value="{{ $terceros->exists ? $terceros->rif : old('rif') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="direccion" class="is-size-7 has-text-weight-bold">Dirección:</label>
                    <input type="text" name="direccion" class="input is-small" value="{{ $terceros->exists ? $terceros->direccion : old('direccion') }}" />
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
                        @foreach ($ciudades as $c)
                            @if ($terceros->ciudades_id == $c->id)
                                <option value="{{ $c->id }}" selected>
                            @else
                                <option value="{{ $c->id }}">
                            @endif
                                {{ $c->nombre }}
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
                    <label for="telefono" class="is-size-7 has-text-weight-bold">Teléfono(s):</label>
                    <input type="text" name="telefono" class="input is-small" value="{{ $terceros->exists ? $terceros->telefono : old('telefono') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="email" class="is-size-7 has-text-weight-bold">E-mail:</label>
                    <input type="text" name="email" class="input is-small" value="{{ $terceros->exists ? $terceros->email : old('email') }}" />
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
