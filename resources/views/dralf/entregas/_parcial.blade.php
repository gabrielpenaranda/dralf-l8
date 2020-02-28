{{-- VER FACTURA --}}

<div class="container">

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-1">
            <h4 class="title is-4 has-text-centered">
             @if ($modulo == "factura")
                {{ 'Entrega Parcial (Factura)' }}
            @else
                {{ 'Entrega Parcial (Nota de Entrega)' }}
            @endif
            </h4>
        </div>
        <div class="column is-2">
            <a class="button is-danger"
                href="{{ route('entregas.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-10 is-offset-1">
            <div class="table-container">

                <table class="table is-fullwidth">
                    <thead>
                        <th class="text-left">Número Factura</th>
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

<div class="columns is-mobile">
    <div class="column is-10 is-offset-1">
        <div class="table-container">
            <form action="{{ route('entregas.eparcial')}}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" value="{{ $facturas->id }}" name="facturas">
                <input type="hidden" value="{{ $facturas->documento }}" name="modulo">

                <table class="table is-fullwidth">
                    <thead>
                        <th>Producto</th>
                        <th>Lote</th>
                        <th class="has-text-centered">Facturado</th>
                        <th class="has-text-centered">Por entregar</th>
                        <th class="has-text-centered">Entrega</th>
                    </thead>
                    <tbody>

                        @foreach($detallefacturas as $d)
                        <input type="hidden" value={{ $d->id }} name=detallefacturas_id[]>
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
                            <td class="has-text-right">
                                <input type="number" step="1" min="0" max="{{ $d->resto }}" value="0" name=cantidad[]>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</div>

 <div class="column is-2 is-offset-1">
                    <div class="control">
                        <button type="submit" class="button is-success">Procesar Entrega</button>
                    </div>
                </div>
            </form>
