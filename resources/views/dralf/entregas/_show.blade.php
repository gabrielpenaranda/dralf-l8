{{-- VER FACTURA --}}

<div class="container">

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-1">
            <h4 class="title is-4 has-text-centered">
             @if ($modulo == "factura")
                    {{ 'Entregas (Factura)' }}
                    @else
                    {{ 'Entregas (Nota de Entrega)' }}
                    @endif
            </h4>
        </div>
        <div class="column is-2">
            <a class="button is-danger"
                href="{{ route('entregas.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-1">
            <h5 class="title is-5 has-text-centered">
                @if ($modulo == "factura")
                       {{ 'Datos de Factura' }}
                       @else
                       {{ 'Datos de Nota de Entrega' }}
                @endif
            </h5>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-10 is-offset-1">
            <div class="table-container">

                <table class="table is-fullwidth">
                    <thead>
                        <th class="text-left">Número</th>
                        <th class="text-left">Cliente</th>
                        <th class="text-left">Fecha</th>
                        <th class="text-left">Monto</th>
                        <th class="text-left">IVA</th>
                        <th class="text-left">Total</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">
                                {{ $facturas->numero }}
                            </td>
                            <td class="text-left">
                                {{ $facturas->terceros->nombre}}
                            </td>
                            <td class="text-left">
                                {{ date("d-m-Y", strtotime($facturas->fecha)) }}
                            </td>
                            <td class="text-left">
                                {{ number_format($facturas->monto, 2, ',', '.') }}
                            </td>
                            <td class="text-left">
                                {{ number_format($facturas->iva, 2, ',', '.') }}
                            </td>
                            @php $total = $facturas->monto + $facturas->iva; @endphp
                            <td class="text-left">
                                {{ number_format($total, 2, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="columns is-mobile">
        <div class="column is-10 is-offset-1">
            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <th>Producto</th>
                        <th>Lote</th>
                        <th class="has-text-centered">Cantidad</th>
                        <th class="has-text-centered">Por Entregar</th>
                    </thead>
                    <tbody>
                        @foreach($detallefacturas as $d)
                            <tr>
                                <td>
                                    {{ $d->lotes->productos->nombre }}
                                </td>
                                <td>
                                    {{ $d->lotes->numero }}
                                </td>
                                <td class="has-text-centered">
                                    {{ $d->cantidad }}
                                </td>
                                <td class="has-text-centered">
                                    {{ $d->resto }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>


    {{-- DESPLIEGE DE ENTREGAS --}}

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-1">
            <h5 class="title is-5 has-text-centered">
             {{ 'Entregas'}}
            </h5>
        </div>
    </div>

    @foreach ($entregas as $e)

    <div class="columns is-mobile">
        <div class="column is-10 is-offset-1">
            <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <th class="text-left">Número</th>
                            <th class="text-left">Fecha</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="title is-6 has-text-link has-text-left">
                                    {{ $e->numero }}
                                </td>
                                <td class="text-left">
                                    {{ date("d-m-Y", strtotime($e->fecha)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    <div class="columns is-mobile">
        <div class="column is-10 is-offset-1">
            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <th>Producto</th>
                        <th>Lote</th>
                        <th class="has-text-centered">Cantidad Entregada</th>
                    </thead>
                    <tbody>
                        @foreach($detalleentregas as $de)
                            @foreach($de as $d)
                                @if ($d->entregas_id == $e->id)
                            <tr>
                                <td>
                                    {{ $d->detallefacturas->lotes->productos->nombre }}
                                </td>
                                <td>
                                    {{ $d->detallefacturas->lotes->numero }}
                                </td>
                                <td class="has-text-centered">
                                    {{ $d->cantidad }}
                                </td>
                            </tr>
                        @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    @endforeach

</div>




{{-- FIN DESPLIEGUE DE ENTREGAS --}}
