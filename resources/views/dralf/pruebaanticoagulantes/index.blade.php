{{-- PRUEBA ANTICOAGULANTE --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                <h4 class="title is-4 has-text-centered">
                    {{ 'Registro de Pruebas Anticoagulantes' }}
                </h4>
            </div>
            <div class="column is-3">
                <a class="button is-primary" href="{{ route('pruebaanticoagulantes.create') }}">Crear Prueba</a>
                <br>
            </div>
        </div>
        <div class="columns is-mobile">
            <div class="column is-12">
                @if ($pruebaanticoagulantes != NULL)
                    {{-- @if ($pruebaanticoagulantes->lotes->productos->tipoproductos->prueba == 'ANTICOAGULANTE') --}}
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <th class="has-text-left">Número Lote</th>
                                <th class="has-text-left">Producto</th>
                                <th class="has-text-left">Fecha Prod.</th>
                                <th class="has-text-left">Fecha Venc.</th>
                                <th class="has-text-centered">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($pruebaanticoagulantes as $p)
                                    <tr>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->lotes->numero }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ $p->lotes->productos->nombre }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ date('d-m-Y', strtotime($p->lotes->fecha_produccion)) }}
                                        </td>
                                        <td class="is-size-7 has-text-left">
                                            {{ date('d-m-Y', strtotime($p->lotes->fecha_vencimiento)) }}
                                        </td>
                                        <td>
                                            @if (Auth::check())
                                                <form action="{{ route('pruebaanticoagulantes.destroy', ['pruebaanticoagulantes' => $p->id]) }}" method='POST'>
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                     <div class="buttons has-addons is-centered">
                                                        <a class="button is-primary is-small is-outlined" href="{{ route('pruebaanticoagulantes.show', ['pruebaanticoagulantes' => $p->id]) }}" title="Editar">Ver</a>
                                                        @if (!$p->lotes->certificado)
                                                        <a class="button is-link is-small is-outlined" href="{{ route('pruebaanticoagulantes.edit', ['pruebaanticoagulantes' => $p->id]) }}" title="Editar">Editar</a>
                                                        <button class="button is-danger is-small is-outlined confirmation" title="Eliminar">Eliminar</button>
                                                        @endif
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
                            <div class="column is-12">
                                {!! $pruebaanticoagulantes->render() !!}
                            </div>
                        </div>
                    </div>
                    {{-- @endif   --}}
                @endif
            </div>
        </div>
    </div>
@endsection

  @section('javascripts')
      @parent
  @endsection
