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
                <h3 class="title is-4 has-text-centered">Tercero</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('terceros.create') }}">Crear Tercero</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-10 is-offset-1">
                @if ($terceros != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Nombre</th>
                                <th class="has-text-left">Razón social</th>
                                <th class="has-text-centered">RIF</th>
                                <th class="has-text-left">Ubicación</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($terceros as $t)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $t->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $t->razon_social }}
                                        </td>
                                        <td class="is-size-7 has-text-centered">
                                            {{ $t->rif }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $t->ciudades->nombre }}-{{ $t->ciudades->estados->nombre }}
                                        </td>
                                        <td>

                                            @if (Auth::check())
                                                <form action="{{ route('terceros.destroy', ['terceros' => $t->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-primary is-small is-outlined" href="{{ route('terceros.show', ['terceros' => $t->id]) }}" title="Editar">Ver</a>
                                                        <a class="button is-link is-small is-outlined" href="{{ route('terceros.edit', ['terceros' => $t->id]) }}" title="Editar">Editar</a>
                                                        <button type="submit" class="button is-danger is-small is-outlined confirmation" title="Eliminar">Eliminar</button>
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
                                {!! $terceros->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Terceros</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
