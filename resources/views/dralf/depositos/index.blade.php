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
                <h3 class="title is-4 has-text-centered">Depositos</h3>
            </div>
            <div class="column is-3">
                {{-- @can('depositos.create') --}}
                <a class="button is-primary" href="{{ route('depositos.create') }}">Crear Deposito</a>
                {{-- @endcan --}}
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-10 is-offset-1">
                @if ($depositos != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Deposito</th>
                                <th class="has-text-left">Direccion</th>
                                <th class="has-text-left">Teléfonos</th>
                                <th class="has-text-left">Ciudad</th>
                                <th class="has-text-centered">Permite Facturar</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($depositos as $c)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->direccion }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->telefono }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $c->ciudades->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-centered">
                                            @if ($c->factura == 1)
                                                {{ 'SI' }}
                                            @else
                                                {{ 'NO' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('depositos.destroy', ['depositos' => $c->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        {{-- @can('depositos.edit') --}}
                                                        <a class="button is-link is-small is-outlined" href="{{ route('depositos.edit', ['depositos' => $c->id]) }}" title="Editar">Editar</a>
                                                        {{-- @endcan --}}
                                                        {{-- @can('depositos.destroy') --}}
                                                        <button class="button is-danger is-small is-outlined confirmation" onclick="" title="Eliminar">Eliminar</button>
                                                        {{-- @endcan --}}
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
                            <div class="column is-12 is-offset-2">
                                {!! $depositos->render() !!}
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Depositos</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
