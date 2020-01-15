{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Prueba Rinse</h3>
            @if ($pruebarinses->exists)
                <form action="{{ route('pruebarinses.update', ['pruebarinses' => $pruebarinses->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('pruebarinses.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('pruebarinses.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="lote_id" class="is-size-7 has-text-weight-bold">Número de Lote:</label>
                    @if (!$pruebarinses->exists)
                        <select name="lotes_id" class="form-control">
                            @foreach ($lotes as $l)
                                @if ($pruebarinses->lotes_id == $l->id)
                                    <option value="{{ $l->id }}" selected>
                                @else
                                    <option value="{{ $l->id }}">
                                @endif
                                        {{ $l->numero }}-{{ $l->productos->nombre }}
                                    </option>
                            @endforeach
                        </select>
                    @else
                        <span class="is-size-7">{{ $pruebarinses->lotes->numero }}</span>
                    @endif
                    @if ($pruebarinses->exists)
                        <br>
                        <label for="" class="is-size-7 has-text-weight-bold">Producto:</label>
                            <span class="is-size-7">
                                {{ $pruebarinses->lotes->productos->nombre }}
                            </span> 
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="ph" class="is-size-7 has-text-weight-bold">PH:</label>
                    <input type="number" name="ph" class="input is-small" value="{{ $pruebarinses->exists ? $pruebarinses->ph : old('ph') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="conductividad" class="is-size-7 has-text-weight-bold">Conductividad:</label>
                    <input type="number" name="conductividad" class="input is-small" min=0 step=0.05 value="{{ $pruebarinses->exists ? $pruebarinses->conductividad : old('conductividad') }}" />
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
