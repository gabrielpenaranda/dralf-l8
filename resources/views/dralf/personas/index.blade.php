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
                <h3 class="title is-4 has-text-centered">Persona</h3>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('personas.create') }}">Crear Persona</a>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-10 is-offset-1">
                @if ($personas != NULL)
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Apellido</th>
                                <th class="has-text-left">Nombre</th>
                                <th class="has-text-left">Cargo</th>
                                <th class="has-text-left">Tipo persona</th>
                                <th class="has-text-left">Tercero</th>
                                <th class="has-text-left">Teléfono</th>
                                <th class="has-text-left">Email</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($personas as $p)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->apellido }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->cargo }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->tipopersonas->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->terceros->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->telefono }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->email }}
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('personas.destroy', ['personas' => $p->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div class="buttons has-addons is-centered">
                                                        <a class="button is-link is-small is-outlined" href="{{ route('personas.edit', ['personas' => $p->id]) }}" title="Editar">Editar</a>
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
                                {!! $personas->render() !!}
                                <div class="is-centered">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <br>
                    <h3 class="title is-2 has-text-centered">No se encontraron Personas</h3>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
