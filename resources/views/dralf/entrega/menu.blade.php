{{-- ENTREGA --}}

@extends('dralf.layouts.base')

@section('stylesheets')
    @parent
@endsection


@section('content')
    <div class="container">
        <div class="columns is-mobile">
            <div class="column is-offset-1 is-10">
                <h4 class="has-text-centered title is-4">
                    <br>
                    {{ 'Registro de Entrega' }}
                </h4>
            </div>
            {{--<div class="col-xs-2">
                <a class="btn btn-primary" href="{{ route('entregas.create') }}">Crear Entrega</a>--}}
            </div>
            <br>
            <div class="column is-offset-1 is-10">
                <a class="button is-primary" href="{{ route('entregas.index') }}"title="Crear Entrega">Crear Entrega</a>
                <a class="button is-link" href="{{ route('entregas.delivery') }}" title="Relacionar Producto">Relacionar Productos</a>
                <a class="button is-warning" href="{{ route('entregas.show_delivery') }}" title="Ver entregas">Ver Entregas</a>
            </div>
        </div>
    </div>
@endsection

  @section('javascripts')
      @parent
  @endsection
{{-- {{ route('entregas.delivery') }} --}}