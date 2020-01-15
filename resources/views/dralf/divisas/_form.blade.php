{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Divisa</h3>
            @if ($divisas->exists)
                <form action="{{ route('divisas.update', ['divisas' => $divisas->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('divisas.store') }}" method="POST">
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
                    <span class="is-size-7 has-text-weight-bold">Divisa:</span>
                    <span class="input is-small">{{$divisas->nombre}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="cambio" class="is-size-7 has-text-weight-bold">Tasa de Cambio:</label>
                    <input type="number" step="0.01" name="cambio" class="input is-small" value="{{ $divisas->exists ? $divisas->cambio : old('cambio') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <button type="submit" class="button is-success">Grabar (Actualizar Precios)</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
