{{-- REPORTE DE IVA --}}
@extends('dralf.layouts.base')

@section('title', 'Reporte de IVA')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.structure.min.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-xs-7 col-md-offset-2 col-md-6">
            <form action="{{ route('reportefactura.iva-show') }}" method="POST">

            {{ csrf_field() }}
        </div>
        <div class="col-xs-3 col-md-4">
            <a class="btn btn-danger" href="{{ route('reportefactura.index') }}">Regresar</a>
            <br><br>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-offset-3 col-sm-3">
            <div class="form-group">
                <label for="inicio">Fecha Inicio :</label>
                <input type="text" name="inicio" id="inicio" placeholder="  /  /  "  class="form-control" />
            </div>
        </div>

        <div class="col-xs-6 col-sm-3">
            <div class="form-inline">
                <label for="final">Fecha Final :</label>
                <input type="text" name="final" id="final"  placeholder="  /  /  "  class="form-control" />
            </div>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-9">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </div>

    </form>
</div>
</div>

@endsection

@section('javascripts')
    @parent
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.js') }}"></script>
    <script type="text/javascript">
    $( function() {
        $( "#inicio" ).datepicker({
            // minDate: -5,
            // maxDate: 0,
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>

    <script type="text/javascript">
    $( function() {
        $( "#final" ).datepicker({
            // minDate: -5,
            // maxDate: 0,
            dateFormat: 'dd-mm-yy',
            dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
            monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Deciembre" ]
         });
    } );
    </script>
@endsection
