{{-- LOTE --}}
<div class="container">

    <div class="columns is-mobile">
        <div class="column is-7 is-offset-2">
            <h4 class="title is-4 has-text-centered">
                @if ($modulo == "factura")
                    {{ 'Registro de Factura' }}
                    @else
                    {{ 'Registro de Nota de Entrega' }}
                    @endif
           </h4>
            <form action="{{ route('facturas.ftercero', ['modulo' => $modulo]) }}" method="POST">

            {{ csrf_field() }}
        </div>
        <div class="column is-3">
            <a class="button is-danger" href="{{ route('facturas.index', ['modulo' => $modulo]) }}">Regresar</a>
        </div>
    </div>


    <div class="columns is-mobile">
        <div class="column is-3">
            <div class="control">
                <label for="terceros_id">Tercero: </label>
                <select name="terceros_id" class="select">
                    @foreach ($terceros as $t)
                        <option value="{{ $t->id }}">
                            {{ $t->nombre }} {{ $t->rif }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="column is-2">
            <div class="control">
                <button type="submit" class="button is-success is-outlined" >Buscar</button>
            </div>
        </div>
    </div>


    </form>
</div>
