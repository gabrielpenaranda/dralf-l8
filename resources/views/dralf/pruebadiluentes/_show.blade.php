{{-- pruebadiluentes --}}
<div class="container">

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <h4 class="title is-4 has-text-centered">Resultado Prueba Diluente</h4>
        </div>
        <div class="column is-3">
            <a class="button is-danger" href="{{ route('pruebadiluentes.index') }}">Regresar</a>
        </div>
    </div>

    <br><br>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Número de Lote:</span>
            <span class="is-size-7">
                {{ $pruebadiluentes->lotes->numero }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <span class="is-size-7 has-text-weight-bold">Producto:</span>
            <span class="is-size-7">
                {{ $pruebadiluentes->lotes->productos->nombre }}
            </span>
        </div>
    </div>

    @php
    $fecha = date("d-m-Y",strtotime($pruebadiluentes->lotes->fecha_produccion));
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
    $fecha = date("d-m-Y",strtotime($pruebadiluentes->lotes->fecha_vencimiento));
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
                {{ number_format($pruebadiluentes->ph, 2, ',', '') }}
            </span>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">Conductividad:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->conductividad, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">PLT 1:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->plt_1, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

     <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">PLT 2:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->plt_2, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

     <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">PLT 3:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->plt_3, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">PLT 4:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->plt_4, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-6 is-offset-4">
            <div class="form-group">
                <span class="is-size-7 has-text-weight-bold">PLT 5:</span>
                <span class="is-size-7">
                    {{ number_format($pruebadiluentes->plt_5, 2, ',', '') }}
                </span>
            </div>
        </div>
    </div>

</div>
</div>
