{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Unidad de Medida</h3>
            @if ($unidadmedidas->exists)
                <form action="{{ route('unidadmedidas.update', ['unidadmedidas' => $unidadmedidas->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('unidadmedidas.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('unidadmedidas.index') }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="unidad" class="is-size-7 has-text-weight-bold">Unidad de Medida:</label>
                    <input type="text" name="unidad" class="input is-small" value="{{ $unidadmedidas->exists ? $unidadmedidas->unidad : old('unidad') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="abreviatura" class="is-size-7 has-text-weight-bold">Abreviatura:</label>
                    <input type="text" name="abreviatura" class="input is-small" value="{{ $unidadmedidas->exists ? $unidadmedidas->abreviatura : old('abreviatura') }}" />
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
