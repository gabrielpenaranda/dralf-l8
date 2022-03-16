{{-- ENTREGA --}}

@extends('dralf.layouts.base')

@section('stylesheets')
@parent
@endsection


@section('content')
<div class="container">
    <div class="columns is-mobile">
        <div class="column is-offset-1 is-8">
            <h4 class="has-text-centered title is-4">
                {{ 'Registro de Entrega' }}
            </h4>
        </div>
        <div class="column-2">
            <a class="button is-danger" href="{{ route('entregas.menu') }}">Regresar</a>
        </div>
        <br>
    </div>
    <div class="columns is-mobile">
        <div class="column is-offset-2 is-18">
            @if ($facturas != NULL)
            <div class="table-container">
                <table class="table is-striped">
                    <thead>
                        <th class="has-text-left">Número</th>
                        <th class="has-text-left">Documento</th>
                        <th class="has-text-left">Fecha</th>
                        <th class="has-text-left">Cliente</th>
                        <th class="has-text-left">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($facturas as $f)
                        <tr>
                            <td class="has-text-left">
                                {{ $f->numero }}
                            </td>
                            <td class="has-text-rigth">
                                @if ($f->documento == "factura")
                                {{ "Factura" }}
                                @else
                                {{ "Nota de Entrega" }}
                                @endif
                            </td>
                            <td class="has-text-left">
                                {{ date("d-m-Y", strtotime($f->fecha)) }}
                            </td>
                            <td class="has-text-left">
                                {{ $f->terceros->nombre }}
                            </td>
                            <td class="has-text-centered">
                                @if (Auth::check())
                                {{-- <form action="{{ route('facturas.destroy', ['factura' => $f->id]) }}"
                                method='POST'>
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger" title="Eliminar"><span
                                        class="glyphicon glyphicon-trash"
                                        aria-hidden="true"></span></button> --}}
                                <a class="button is-success"
                                    href="{{ route('entregas.create', ['facturas' => $f->id, 'modulo' => $f->documento]) }}"
                                    title="Agregar entrega">Agregar Entrega</a>
                                {{-- <a class="btn btn-warning" href="{{ route('entregas.show', ['factura' => $f->id]) }}"
                                title="Ver factura"><span class="glyphicon glyphicon-eye-open"
                                    aria-hidden="true"></span></a> --}}
                                {{-- </form> --}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="container">
                <div class="columns is-mobile">
                    <div class="column col-12">
                        {!! $facturas->render() !!}
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
