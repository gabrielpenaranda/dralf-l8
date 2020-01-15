{{-- ENTREGA --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10 text-center">
                <h4>
                    {{ 'Registro de Entrega' }}
                </h4>
            </div>
            {{--<div class="col-xs-2">
                <a class="btn btn-primary" href="{{ route('entregas.create') }}">Crear Entrega</a>--}}
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10 text-center">
                <a class="btn btn-primary" href="{{ route('entregas.index') }}"title="Crear Entrega"><span class="glyphicon glyphicon-ok"></span> Crear Entrega</a>
                <a class="btn btn-success" href="{{ route('entregas.delivery') }}" title="Relacionar Producto"><span class="glyphicon glyphicon-plus"></span> Relacionar Productos</a>
                <a class="btn btn-warning" href="{{ route('entregas.show_delivery') }}" title="Ver entregas"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Entregas</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                
            </div>
        </div>
    </div>
@endsection

  @section('javascripts')
      @parent
  @endsection
{{-- {{ route('entregas.delivery') }} --}}