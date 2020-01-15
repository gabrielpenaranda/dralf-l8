{{-- USUARIO --}}

@extends('admin.index')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-8 text-center">
                <h4>
                    {{ 'Usuarios' }}
                </h4>
            </div>
            <div class="col-xs-2">
                <a class="btn btn-primary waves-effect waves-light" href="{{ route('admin_usuario_create') }}">Crear Usuario</a>
            </div>
            <div class="col-xs-offset-1 col-xs-10">
                @if ($usuario != NULL)
                    <table class="table">
                        <thead>
                            <th class="text-left">Nombre</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Nivel</th>
                            <th class="text-center">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($usuario as $u)
                                <tr>
                                    <td class="text-left">
                                        {{ $u->name }}
                                    </td>
                                    <td class="text-left">
                                        {{ $u->email }}
                                    </td>
                                    @if ($u->level == 'administrador')
                                        <td class="text-left btn btn-danger pw-mini-text">
                                    @else
                                        <td class="text-left btn btn-primary pw-min-text">
                                    @endif
                                        {{ $u->level }}
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::check() && $user->level == "administrador")
                                            <form action="{{ route('admin_usuario_delete', ['usuario' => $u->id]) }}" method='POST'>
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger waves-effect waves-light" title="Eliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                                <a class="btn btn-info waves-effect waves-light" href="{{ route('admin_usuario_edit', ['usuario' => $u->id]) }}" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                                <a class="btn btn-success waves-effect waves-light" href="{{ route('admin_usuario_passwd', ['usuario' => $u->id]) }}" title="Cambiar Password"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></a>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                {!! $usuario->render() !!}
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
