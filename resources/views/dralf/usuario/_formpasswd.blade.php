{{-- ESTADO --}}
<div class="container">
    <div class="row">
        <div class="col-xs-offset-2 col-xs-6">
            <h4>Cambio de Contraseña</h4>
            <form action="{{ route('admin_usuario_updatepasswd', ['usuario' => $usuario->id]) }}" method="POST">
            {{ method_field('PUT') }}

            {{ csrf_field() }}
        </div>
        <div class="col-xs-2">
            <a class="btn btn-danger waves-effect waves-light" href="{{ route('admin_usuario') }}">Regresar</a>
        </div>


        <div class="col-xs-offset-2 col-xs-8">

            <div class="form-group">
                <label for="passwd">Introduzca su contraseña actual:</label>
                <input id="passwd" type="password" class="form-control" name="passwd" required>
                
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Registrar
                    </button>
            </div>

            </form>
        </div>
    </div>
</div>
