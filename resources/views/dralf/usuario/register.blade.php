@extends('admin.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <h4>Registro de Usuario</h4>
        </div>
        <div class="col-xs-2">
            <a class="btn btn-danger waves-effect waves-light" href="{{ route('admin_usuario') }}">Regresar</a>
        </div>
        <div class="col-xs-offset-2 col-xs-8">
            <form class="form-horizontal" method="POST" action="{{ route('admin_usuario_create') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre y Apellido</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Dirección de E-Mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                <label for="level" class="col-md-4 control-label">Nivel de Acceso:</label>
                <div class="col-md-6">
                    <select name="level" class="form-control">
                        <option value="usuario">Usuario</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascripts')
    @parent
@show
