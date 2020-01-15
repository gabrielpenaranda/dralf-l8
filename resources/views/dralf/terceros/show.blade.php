@extends('dralf.layouts.base')

@section('stylesheets')
  @parent
@endsection

@include('dralf.layouts._nav')

@section('content')
<div class="container">

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <br>
            <h3 class="title is-4 has-text-centered">{{ $terceros->nombre }}</h3>
        </div>
        <div class="column is-3">
            <br>
            <a class="button is-warning" href="{{ route('terceros.index') }}">Regresar</a>
        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">


            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th class="is-size-7">Tipo de Tercero</th>
                            <th> </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if ($terceros->cliente)
                                <td class="is-size-7" class="is-size-7">CLIENTE</td>
                            @endif
                            @if ($terceros->proveedor)
                                <td class="is-size-7" class="is-size-7">PROVEEDOR</td>
                            @endif
                            @if ($terceros->laboratorio)
                                <td class="is-size-7" class="is-size-7">LABORATORIO</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">


            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th class="is-size-7">RIF</th>
                            <th class="is-size-7">Razón Social</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="is-size-7">
                                {{ $terceros->rif }}
                            </td>
                            <td class="is-size-7">
                                {{ $terceros->razon_social }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">


            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th class="is-size-7">Dirección</th>
                            <th class="is-size-7" class="is-size-7">Ciudad</th>
                            <th class="is-size-7" class="is-size-7">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="is-size-7" class="is-size-7">
                                {{ $terceros->direccion }}
                            </td>
                            <td class="is-size-7" class="is-size-7">
                                {{ $terceros->ciudades->nombre }}
                            </td>
                            <td class="is-size-7" class="is-size-7">
                                {{ $terceros->ciudades->estados->nombre }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">


            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th class="is-size-7">Teléfonos</th>
                            <th class="is-size-7">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="is-size-7">
                                {{ $terceros->telefono }}
                            </td>
                            <td class="is-size-7">
                                {{ $terceros->email }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="columns is-mobile">
        <div class="column is-8 is-offset-2">


            <div class="table-container">
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th class="is-size-7">Personas</th>
                            <th> </th>
                            <th> </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($personas)
                            @foreach ($personas as $persona)
                                <tr>
                                    <td class="is-size-7">
                                        {{ $persona->apellido }}, {{ $persona->nombre }}
                                    </td>
                                    <td class="is-size-7">
                                        {{ $persona->cargo }}
                                    </td>
                                    <td class="is-size-7">
                                        @if ($persona->telefono)
                                            {{ $persona->telefono }}
                                        @endif
                                    </td>
                                    <td class="is-size-7">
                                        @if ($persona->email)
                                            {{ $persona->email }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="is-size-7">
                                    NO TIENE PERSONAS REGISTRADAS
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>


@endsection

@section('javascripts')
    @parent
@endsection
