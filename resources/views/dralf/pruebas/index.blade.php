{{-- PRODUCTO --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h4>
                    {{ 'Registro de Pruebas' }}
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <a class="btn btn-primary" href="{{ route('pruebas.create') }}">Crear Prueba</a>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @if ($prueba != NULL)
                    <table class="table table-striped">
                        <thead>
                            <th class="text-left">Número Lote</th>
                            <th class="text-left">Producto</th>
                            <th class="text-left">Fecha Prod.</th>
                            <th class="text-left">Fecha Venc.</th>
                            <th class="text-center">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($prueba as $p)
                                <tr>
                                <td class="text-left">
                                        {{ $p->lote->numero_lote }}
                                    </td>
                                    <td class="text-left">
                                        {{ $p->lote->producto->nombre_producto }}
                                    </td>
                                    <td class="text-left">
                                        {{ date('d-m-Y', strtotime($p->lote->fecha_produccion_lote)) }}
                                    </td>
                                    <td class="text-left">
                                        {{ date('d-m-Y', strtotime($p->lote->fecha_vencimiento_lote)) }}
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::check())
                                            <form action="{{ route('pruebas.destroy', ['prueba' => $p->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger btn-sm" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                <a class="btn btn-info btn-sm" href="{{ route('pruebas.edit', ['prueba' => $p->id]) }}" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                <a class="btn btn-warning btn-sm" href="{{ route('pruebas.show', ['prueba' => $p->id]) }}" title="Ver"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                            </form>
                                        @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $prueba->render() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

  @section('javascripts')
      @parent
  @endsection
