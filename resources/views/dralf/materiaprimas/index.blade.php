{{-- PRODUCTO --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <br>
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                <h3 class="title is-4 has-text-centered">Materia Prima</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('materiaprimas.create') }}">Crear Materia Prima</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-10 is-offset-1">
                @if ($materiaprimas != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Código</th>
                                <th class="has-text-left">Nombre</th>
                                <th class="has-text-left">Unidad de medida</th>
                                <th class="has-text-left">Disponible</th>
                                <th class="has-text-left">Fraccionable</th>
                                <th class="text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($materiaprimas as $p)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->codigo }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->unidadmedidas->unidad }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->cantidad_disponible }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            @if ($p->fraccionable)
                                            SI
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::check())

                                                <form action="{{ route('materiaprimas.destroy', ['materiaprimas' => $p->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('materiaprimas.edit', ['materiaprimas' => $p->id]) }}" title="Editar">Editar</a>
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
                                {!! $materiaprimas->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron items de Materia Primas</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
