{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Prueba Anticoagulante</h3>
            @if ($pruebaanticoagulantes->exists)
                <form action="{{ route('pruebaanticoagulantes.update', ['pruebaanticoagulantes' => $pruebaanticoagulantes->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('pruebaanticoagulantes.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('pruebaanticoagulantes.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="lote_id" class="is-size-7 has-text-weight-bold">Número de Lote:</label>
                    @if (!$pruebaanticoagulantes->exists)
                        <select name="lotes_id" class="select">
                            @foreach ($lotes as $l)
                                @if ($pruebaanticoagulantes->lotes_id == $l->id)
                                    <option value="{{ $l->id }}" selected>
                                @else
                                    <option value="{{ $l->id }}">
                                @endif
                                        {{ $l->numero }}-{{ $l->productos->nombre }}
                                    </option>
                            @endforeach
                        </select>
                    @else
                        <span class="is-size-7">{{ $pruebaanticoagulantes->lotes->numero }}</span>
                    @endif
                    @if ($pruebaanticoagulantes->exists)
                        <br>
                        <label for="" class="is-size-7 has-text-weight-bold">Producto:</label>
                            <span class="is-size-7">
                                {{ $pruebaanticoagulantes->lotes->productos->nombre }}
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
                    <input type="number" name="ph" class="input is-small" value="{{ $pruebaanticoagulantes->exists ? $pruebaanticoagulantes->ph : old('ph') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="tubo" class="is-size-7 has-text-weight-bold">Tubo:</label>
                    <input type="number" name="tubo" class="input is-small" min=0 step=0.05 value="{{ $pruebaanticoagulantes->exists ? $pruebaanticoagulantes->tubo : old('tubo') }}" />
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
