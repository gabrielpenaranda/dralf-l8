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
                <h3 class="title is-4 has-text-centered">Unidad de Medida</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('unidadmedidas.create') }}">Crear Unidad de Medida</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-5 is-offset-4">
                @if ($unidadmedidas != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Unidad</th>
                                <th class="has-text-left">Abreviatura</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($unidadmedidas as $u)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $u->unidad }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $u->abreviatura }}
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('unidadmedidas.destroy', ['unidadmedidas' => $u->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('unidadmedidas.edit', ['unidadmedidas' => $u->id]) }}" title="Editar">Editar</a>
                                                        <button class="button is-danger is-small is-outlined confirmation" onclick="" title="Eliminar">Eliminar</button>
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
                                {!! $unidadmedidas->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Unidad de Medidas</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
