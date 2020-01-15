{{-- prueba --}}
<div class="container">

    <div class="row">
        <div class="col-xs-7 col-md-offset-2 col-md-6">
            @if ($prueba->exists)
                <h4>Edición de Prueba</h4>
                <form action="{{ route('pruebas.update', ['prueba' => $prueba->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4>Nueva Prueba</h4>
                <form action="{{ route('pruebas.store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('pruebas.index') }}">Regresar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-4 col-md-offset-2 col-md-3">
            <div class="form-group">
                <label for="lote_id">Número de Lote:</label>
                @if (!$prueba->exists)
                    <select name="lote_id" class="form-control">
                        @foreach ($lote as $l)
                            @if ($prueba->lote_id == $l->id)
                                <option value="{{ $p->id }}" selected>
                                @else
                                    <option value="{{ $l->id }}">
                                    @endif
                                    {{ $l->numero_lote }}
                                </option>
                            @endforeach
                    </select>
                @else
                    <span>{{ $prueba->lote->numero_lote }}</span>
                @endif
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-offset-1 col-sm-6 col-md-offset-2 col-md-5">
            <div class="form-group">
                <label for="">Producto:</label>
                @if ($prueba->exists)
                    {{ $prueba->lote->producto->nombre_producto }}-{{ $prueba->lote->fecha_produccion_lote }}-{{ $prueba->lote->fecha_vencimiento_lote }}
                @endif
            </div>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-5 col-md-offset-2 col-md-4">
            <div class="form-group">
                <label for="ph_prueba">PH:</label>
                <input type="number" step="0.01" min="0" name="ph_prueba" class="form-control" value="{{ $prueba->ph_prueba or old('ph_prueba')}}" />
            </div>
        </div>
        <div class="col-xs-6 col-sm-5 col-md-4">
            <div class="form-group">
                <label for="conductividad_prueba">Conductividad:</label>
                <input type="number" step="0.01" min="0" name="conductividad_prueba" class="form-control" value="{{ $prueba->conductividad_prueba or old('conductividad_prueba')}}" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-5 col-md-offset-2 col-md-4">
            <div class="form-group">
                <label for="plt_1_prueba">PLT valor 1:</label>
                <input type="number" step="0.01" min="0" name="plt_1_prueba" class="form-control" value="{{ $prueba->plt_1_prueba or old('plt_1_prueba')}}" />
            </div>
        </div>
        <div class="col-xs-6 col-sm-5 col-md-4">
            <div class="form-group">
                <label for="plt_2_prueba">PLT valor 2:</label>
                <input type="number" step="0.01" min="0" name="plt_2_prueba" class="form-control" value="{{ $prueba->plt_2_prueba or old('plt_2_prueba')}}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-5 col-md-offset-2 col-md-4">
            <div class="form-group">
                <label for="plt_3_prueba">PLT valor 3:</label>
                <input type="number" step="0.01" min="0" name="plt_3_prueba" class="form-control" value="{{ $prueba->plt_3_prueba or old('plt_3_prueba')}}" />
            </div>
        </div>
        <div class="col-xs-6 col-sm-5 col-md-4">
            <div class="form-group">
                <label for="plt_4_prueba">PLT valor 4:</label>
                <input type="number" step="0.01" min="0" name="plt_4_prueba" class="form-control" value="{{ $prueba->plt_4_prueba or old('plt_4_prueba')}}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-offset-1 col-sm-5 col-md-offset-2 col-md-4">
            <div class="form-group">
                <label for="plt_5_prueba">PLT valor 5:</label>
                <input type="number" step="0.01" min="0" name="plt_5_prueba" class="form-control" value="{{ $prueba->plt_5_prueba or old('plt_5_prueba')}}" />
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="ccol-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Grabar</button>
            </div>
        </div>
    </div>

    </form>
</div>
</div>
