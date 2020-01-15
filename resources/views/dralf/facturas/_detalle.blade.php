{{-- FACTURA --}}
{{-- @php
dd($facturas)
@endphp --}}
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-7 is-offset-2">
            <h4 class="title is-4 has-text-centered">
                @if ($modulo == "factura")
                    {{ 'Factura' }}
                    @else
                    {{ 'Nota de Entrega' }}
                    @endif
            </h4>
            <form action="{{ route('facturas.fproducto', ['terceros' => $terceros->id, 'facturas' => $facturas->id, 'modulo' => $modulo]) }}" method="POST">

            {{ csrf_field() }}
        </div>
        <div class="column is-3">
            @if ($fproductos == "null")
            <a class="button is-danger" href="{{ route('facturas.freverse', ['facturas' => $facturas->id, 'modulo' => $modulo]) }}">Regresar</a>
            @endif
        </div>
    </div>

    <div class="columns is-mobile">
    </div>
    <div class="columns is-mobile">
        <div class="column is-1">
            <span class="is-size-5 has-text-weight-bold">CLIENTE</span>
        </div>
        <div class="column is-5">
            <span class="is-size-7 has-text-weight-bold">Nombre: </span>
            <span  class="is-size-7">{{ $terceros->nombre }}</span> <br>
            <span class="is-size-7 has-text-weight-bold">Razón Social: </span>
            <span  class="is-size-7">{{ $terceros->razon_social }}</span> <br>
            <span class="is-size-7 has-text-weight-bold">RIF: </span>
            <span  class="is-size-7">{{ $terceros->rif }}</span> <br>
            <span class="is-size-7 has-text-weight-bold">Dirección: </span>
            <span  class="is-size-7">{{ $terceros->direccion }}</span> <br>
            <span class="is-size-7 has-text-weight-bold">Teléfono: </span>
            <span  class="is-size-7">{{ $terceros->telefono }}</span>
        </div>
        <div class="column is-2">
            <span class="is-size-5 has-text-weight-bold">PRODUCTOS</span>
        </div>
        <div class="column is-3">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="lotes_id" class="label">Producto </label>
                </div>
                <div class="field-body">
                    <select name="lotes_id" class="select">
                        @foreach ($productos as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->numero }} ({{ $p->productos->codigo }}-{{ $p->productos->nombre }}) {{ $p->cantidad_disponible }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
       
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="cantidad" class="label">Cantidad </label>
                </div>
                <div class="field-body">
                    <input type="number" step="1" class="is-size-7 input" name="cantidad">
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label for="precio" class="label">Precio (Opcional) </label>
                </div>
                <div class="field-body">
                    <input type="number" step="0.01" class="is-size-7 input" name="precio" value="0">
                </div>
            </div>
            <div class="control">
                <button type="submit" class="button is-success is-outlined">Agregar</button>
            </div>
            </div>
    </div>



        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($fproductos != "null")
                    <div class="table-container">
                    <table class="table is-fullwidth">
                        <thead>
                            <th class="has-text-left">Producto</th>
                            <th class="has-text-left">Lote</th>
                            <th class="has-text-left">Unidad</th>
                            <th class="has-text-left">Cantidad</th>
                            <th class="has-text-left">Precio</th>
                            <th class="has-text-left">IVA</th>
                            <th class="has-text-centered">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($fproductos as $f)
                                <tr>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->lotes->productos->nombre }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->lotes->numero }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                       {{$f->lotes->productos->capacidad}}{{ $f->lotes->productos->unidadmedidas->abreviatura }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->cantidad }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->precio }}
                                    </td>
                                    <td class="is-size-7 has-text-left">
                                        {{ $f->impuesto }}
                                    </td>
                                    <td>
                                        @if (Auth::check())
                                            <div class="buttons has-addons is-centered">

                                            <a class="button is-danger is-small is-outlined" href="{{ route('facturas.fproductodestroy', ['terceros' => $terceros->id, 'facturas' => $facturas->id, 'detalle' => $f->id, 'modulo' => $modulo]) }}" title="Ver factura">Quitar</a>

                                            </div>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="container">
                        <div class="columns is-mobile">
                            <div class="column is-12">
                                {!! $fproductos->render() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>






    @if ($fproductos != "null")
            <div class="columns is-mobile">
                <div class="column is-2">
                    <div class="control">
                        <a class="button is-success confirmation" href="{{ route('facturas.fstore', ['terceros' => $terceros->id, 'facturas' => $facturas->id, 'modulo' => $modulo]) }}">Grabar y Generar</a>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="control">
                        <a class="button is-danger confirmation" href="{{ route('facturas.fdestroy', ['facturas' => $facturas->id, 'modulo' => $modulo]) }}">Anular</a>
                    </div>
                </div>
            </div>
    @endif

    </form>
</div>
