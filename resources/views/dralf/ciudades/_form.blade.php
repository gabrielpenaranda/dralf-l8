{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Ciudad</h3>
            @if ($ciudades->exists)
                <form action="{{ route('ciudades.update', ['ciudades' => $ciudades->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('ciudades.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('ciudades.index') }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="nombre" class="is-size-7 has-text-weight-bold">Ciudad:</label>
                    <input type="text" name="nombre" class="input is-small" value="{{ $ciudades->exists ? $ciudades->nombre : old('nombre') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <label for="estados_id" class="is-size-7 has-text-weight-bold">Estado: </label>
                <div class="select">
                    <select name="estados_id" class="is-size-7">
                        @foreach ($estados as $e)
                            @if ($ciudades->estados_id == $e->id)
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
        <div class="column is-6 is-offset-3">
            <button type="submit" class="button is-success">Grabar</button>
        </div>
    </div>
    <br>
    </form>
</div>
</div>
