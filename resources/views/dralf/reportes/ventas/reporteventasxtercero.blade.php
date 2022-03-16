@extends('dralf.layouts.base')

@section('title')
{{ $titulo }}
@endsection

@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('css/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.structure.min.css') }}">
@endsection

@section('content')

<div class="container">

    <div class="columns is-mobile">
        <div class="column is-6 is-offset-3">
            <br>
            <h3 class="title is-4 has-text-centered">Reporte de Ventas x Tercero</h3>
            <br>
        </div>
    </div>

    <form action="{{ route('reportes.generareporteventasxtercero') }}" method="POST">

        {{ csrf_field() }}

        <div class="columns is-mobile">
            <div class="column is-3 is-offset-3">
                <div class="field">
                    <div class="control">
                        <label for="fecha_desde"
                            class="is-size-7 has-text-weight-bold">Desde:</label>
                        <input type="text" name="fecha_desde" id="datepicker"
                            class="input is-small" />
                    </div>
                </div>
            </div>
            <div class="column is-3">
                <div class="field">
                    <div class="control">
                        <label for="fecha_hasta"
                            class="is-size-7 has-text-weight-bold">Hasta:</label>
                        <input type="text" name="fecha_hasta" id="datepicker1"
                            class="input is-small" />
                    </div>
                </div>
            </div>

            <div class="column is-4">
                <div class="field">
                    <div class="control">
                        <label for="tercero" class="is-size-7 has-text-weight-bold">Tercero:
                        </label> <br>
                        <select name="tercero" class="is-size-7">
                            @foreach ($terceros as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>

        <div class="columns is-mobile">
            <div class="column is-6 is-offset-3">
                <button type="submit" class="button is-success">Enviar</button>
            </div>
        </div>
        <br>

    </form>
</div>

@endsection

@section('javascripts')
@parent
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker({
            //minDate: -5,
            maxDate: "+0D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre",
                "Deciembre"
            ],
            beforeShow: function (input, inst) {
                var rect = input.getBoundingClientRect();
                setTimeout(function () {
                    inst.dpDiv.css({
                        top: rect.top + 40,
                        left: rect.left + 0
                    });
                }, 0);
            }
        });
    });

</script>
<script type="text/javascript">
    $(function () {
        $("#datepicker1").datepicker({
            //minDate: +0,
            maxDate: "+0D",
            dateFormat: 'dd-mm-yy',
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre",
                "Deciembre"
            ],
            beforeShow: function (input, inst) {
                var rect = input.getBoundingClientRect();
                setTimeout(function () {
                    inst.dpDiv.css({
                        top: rect.top + 40,
                        left: rect.left + 0
                    });
                }, 0);
            }
        });
    });

</script>
@endsection
