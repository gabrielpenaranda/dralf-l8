{{-- ESTADO --}}
<div class="container">
    <div class="row">
        <div class="col-xs-offset-2 col-xs-6">
            @if ($usuario->exists)
                <h4>Edición de Usuario</h4>
                <form action="{{ route('admin_usuario_update', ['usuario' => $usuario->id]) }}" method="POST">
                {{ method_field('PUT') }}
            @else
                <h4>Nuevo Usuario</h4>
                <form action="{{ route('admin_usuario_store') }}" method="POST">
            @endif

            {{ csrf_field() }}
        </div>
        <div class="col-xs-2">
            <a class="btn btn-danger waves-effect waves-light" href="{{ route('admin_usuario') }}">Regresar</a>
        </div>


        <div class="col-xs-offset-2 col-xs-8">
            @if ($usuario->exists)
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Nombre y Apellido</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                    <label for="level" class="col-md-4 control-label">Nivel de Acceso:</label>
                        <select name="level" class="form-control">
                            @if ($usuario->level == 'usuario')
                                <option value="usuario" selected>Usuario</option>
                                <option value="administrador">Administrador</option>
                            @else
                                <option value="usuario">Usuario</option>
                                <option value="administrador" selected>Administrador</option>
                            @endif
                        </select>
                </div>
            @else
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre y Apellido</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name || old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Dirección de E-Mail</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email || old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                <label for="level" class="col-md-4 control-label">Nivel de Acceso:</label>
                    <select name="level" class="form-control">
                        <option value="usuario">Usuario</option>
                        <option value="administrador">Administrador</option>
                    </select>
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
            @endif
            <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Registrar
                    </button>
            </div>

            </form>
        </div>
    </div>
</div>
