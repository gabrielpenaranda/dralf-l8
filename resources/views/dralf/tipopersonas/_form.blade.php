{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Tipo Persona</h3>
            @if ($tipopersonas->exists)
                <form action="{{ route('tipopersonas.update', ['tipopersonas' => $tipopersonas->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('tipopersonas.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('tipopersonas.index') }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Tipo Persona:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $tipopersonas->exists ? $tipopersonas->nombre : old('nombre') }}" />
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
