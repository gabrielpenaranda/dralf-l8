{{-- PRODUCTO --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <br>
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                <h3 class="title is-4 has-text-centered">Producto</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('productos.create') }}">Crear Producto</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-10 is-offset-1">
                @if ($productos != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Código</th>
                                <th class="has-text-left">Nombre</th>
                                <th class="has-text-left">Capacidad</th>
                                <th class="has-text-left">Unidad de medida</th>
                                <th class="has-text-left">Tipo</th>
                                <th class="has-text-left">Precio US$</th>
                                <th class="has-text-left">Precio</th>
                                <th class="text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($productos as $p)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->codigo }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->capacidad }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->unidadmedidas->unidad }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->tipoproductos->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->preciodolar }}
                                        </td>
                                         <td class="is-size-7 has-text-left">
                                            {{ $p->precio }}
                                        </td>
                                        <td>
                                            @if (Auth::check())

                                                <form action="{{ route('productos.destroy', ['productos' => $p->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('productos.edit', ['productos' => $p->id]) }}" title="Editar">Editar</a>
                                                        <button class="button is-danger is-small is-outlined confirmation" title="Eliminar">Eliminar</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <div class="columns is-mobile">
                            <div class="column is-6 is-offset-2">
                                {!! $productos->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Productos</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
