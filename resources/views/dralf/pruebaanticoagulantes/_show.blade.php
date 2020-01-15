{{-- pruebaanticoagulantes --}}
<div class="container">

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h4 class="title is-4 has-text-centered">Resultado Prueba Anticoagulante</h4>
        </div>
        <div class="column is-3">
            <a class="button is-danger" href="{{ route('pruebaanticoagulantes.index') }}">Regresar</a>
        </div>
    </div>

    <br><br>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Número de Lote:</span>
            <span class="is-size-7">
                {{ $pruebaanticoagulantes->lotes->numero }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Producto:</span>
            <span class="is-size-7">
                {{ $pruebaanticoagulantes->lotes->productos->nombre }}
            </span>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($pruebaanticoagulantes->lotes->fecha_produccion));
    @endphp
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Fecha Producción:</span>
            <span class="is-size-7">
                {{ $fecha }}
            </span>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($pruebaanticoagulantes->lotes->fecha_vencimiento));
    @endphp
    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Fecha Vencimiento:</span>
            <span class="is-size-7">
                {{ $fecha }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">PH:</span>
            <span class="is-size-7">
                {{ number_format($pruebaanticoagulantes->ph, 2, ',', '') }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">Tubo:</span>
                <span class="is-size-7">
                    {{ number_format($pruebaanticoagulantes->tubo, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

</div>
</div>
