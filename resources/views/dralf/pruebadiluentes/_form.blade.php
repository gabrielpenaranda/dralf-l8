{{-- ESTADO --}}
<br>
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h3 class="title is-4 has-text-centered">Registro de Prueba Diluente</h3>
            @if ($pruebadiluentes->exists)
                <form action="{{ route('pruebadiluentes.update', ['pruebadiluentes' => $pruebadiluentes->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <form action="{{ route('pruebadiluentes.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="column is-2">
            <a class="button is-danger" href="{{ route('pruebadiluentes.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="lote_id" class="is-size-7 has-text-weight-bold">Número de Lote:</label>
                    @if (!$pruebadiluentes->exists)
                        <select name="lotes_id" class="form-control">
                            @foreach ($lotes as $l)
                                @if ($pruebadiluentes->lotes_id == $l->id)
                                    <option value="{{ $l->id }}" selected>
                                @else
                                    <option value="{{ $l->id }}">
                                @endif
                                        {{ $l->numero }}-{{ $l->productos->nombre }}
                                    </option>
                            @endforeach
                        </select>
                    @else
                        <span class="is-size-7">{{ $pruebadiluentes->lotes->numero }}</span>
                    @endif
                    @if ($pruebadiluentes->exists)
                        <br>
                        <label for="" class="is-size-7 has-text-weight-bold">Producto:</label>
                            <span class="is-size-7">
                                {{ $pruebadiluentes->lotes->productos->nombre }}
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
                    <input type="number" name="ph" class="input is-small" value="{{ $pruebadiluentes->exists ? $pruebadiluentes->ph : old('ph') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="conductividad" class="is-size-7 has-text-weight-bold">Conductividad:</label>
                    <input type="number" name="conductividad" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->conductividad : old('conductividad') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="plt_1" class="is-size-7 has-text-weight-bold">PLT 1:</label>
                    <input type="number" name="plt_1" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->plt_1 : old('plt_1') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="plt_2" class="is-size-7 has-text-weight-bold">PLT 2:</label>
                    <input type="number" name="plt_2" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->plt_2 : old('plt_2') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="plt_3" class="is-size-7 has-text-weight-bold">PLT 3:</label>
                    <input type="number" name="plt_3" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->plt_3 : old('plt_3') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="plt_4" class="is-size-7 has-text-weight-bold">PLT 4:</label>
                    <input type="number" name="plt_4" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->plt_4 : old('plt_4') }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <div class="field">
                <div class="control">
                    <label for="plt_5" class="is-size-7 has-text-weight-bold">PLT 5:</label>
                    <input type="number" name="plt_5" class="input is-small" min=0 step=0.05 value="{{ $pruebadiluentes->exists ? $pruebadiluentes->plt_5 : old('plt_5') }}" />
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
