{{-- prueba --}}
<div class="container">

    <div class="row">
        <div class="col-xs-6 col-md-offset-3 col-md-5">
            <h4>Resultado Prueba</h4>
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('pruebas.index') }}">Regresar</a>
        </div>
    </div>

    <br><br>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">Número de Lote:</label>
                <span>
                    {{ $prueba->lote->numero_lote }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">Producto:</label>
                <span>
                    {{ $prueba->lote->producto->nombre_producto }}
                </span>
            </div>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($prueba->lote->fecha_produccion_lote));
    @endphp
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">Fecha Producción:</label>
                <span>
                    {{ $fecha }}
                </span>
            </div>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($prueba->lote->fecha_vencimiento_lote));
    @endphp
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">Fecha Vencimiento:</label>
                <span>
                    {{ $fecha }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PH:</label>
                <span>
                    {{ number_format($prueba->ph_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">Conductividad:</label>
                <span>
                    {{ number_format($prueba->conductividad_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PLT 1:</label>
                <span>
                    {{ number_format($prueba->plt_1_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PLT 2:</label>
                <span>
                    {{ number_format($prueba->plt_2_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PLT 3:</label>
                <span>
                    {{ number_format($prueba->plt_3_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PLT 4:</label>
                <span>
                    {{ number_format($prueba->plt_4_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-9 col-md-offset-3 col-md-7">
            <div class="form-group">
                <label for="lote_id">PLT 5:</label>
                <span>
                    {{ number_format($prueba->plt_5_prueba, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

</div>
</div>
