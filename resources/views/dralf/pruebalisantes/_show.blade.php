{{-- pruebalisantes --}}
<div class="container">

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h4 class="title is-4 has-text-centered">Resultado Prueba Lisante</h4>
        </div>
        <div class="column is-3">
            <a class="button is-danger" href="{{ route('pruebalisantes.index') }}">Regresar</a>
        </div>
    </div>

    <br><br>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Número de Lote:</span>
            <span class="is-size-7">
                {{ $pruebalisantes->lotes->numero }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Producto:</span>
            <span class="is-size-7">
                {{ $pruebalisantes->lotes->productos->nombre }}
            </span>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($pruebalisantes->lotes->fecha_produccion));
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
    $fecha = date("d-m-Y",strtotime($pruebalisantes->lotes->fecha_vencimiento));
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
                {{ number_format($pruebalisantes->ph, 2, ',', '') }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">Conductividad:</span>
                <span class="is-size-7">
                    {{ number_format($pruebalisantes->conductividad, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">Contaje:</span>
                <span class="is-size-7">
                    {{ number_format($pruebalisantes->contaje, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

</div>
