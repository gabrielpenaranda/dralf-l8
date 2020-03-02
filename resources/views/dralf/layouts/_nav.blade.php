{{-- <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand pw-logo" href="{{ url('/dralf') }}">
                <img src="{{ asset('img/logo-100.png') }}" alt="LabDrAlf">
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Base <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="">Tipo de Persona</a></li>
                        <li class="dropdown-item"><a href="">Unidad de Medida</a></li>
                        <li class="dropdown-item"><a href="{{ route('ciudades.index') }}">Ciudad</a></li>
                        <li class="dropdown-item"><a href="{{ route('estados.index') }}">Estado</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Terceros <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('terceros.index') }}">Terceros</a></li>
                        <li class="dropdown-item"><a href="">Personas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inventario <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('productos.index') }}">Productos</a></li>
                        <li class="dropdown-item"><a href="">Materia Prima</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Producción <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="{{ route('lotes.index') }}">Lotes</a></li>
                        <li class="dropdown-item"><a href="{{ route('pruebas.index') }}">Pruebas</a></li>
                        <li class="dropdown-item"><a href="">Formulas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ventas <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-item"><a href="{{ route('facturas.index', ['modulo' => 'factura']) }}">Facturas</a></li>
                            <li class="dropdown-item"><a href="{{ route('notaentrega.index', ['modulo' => 'notaentrega']) }}">Notas de Entrega</a></li>
                            <li class="dropdown-item"><a href="{{ route('reportefactura.index') }} ">Reportes</a></li>
                        </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cobros <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-item"><a href="{{ route('cobros.index', ['modulo' => 'nocancel']) }}">Registro</a></li>
                        <li class="dropdown-item"><a href="{{ route('cobros.facturas-canceladas', ['modulo' => 'cancel']) }}">Facturas Canceladas</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}

<nav class="navbar is-dark is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="{{ url('/dralf') }}">
      <img src="{{ asset('img/logo-100.png') }}" alt="LabDrAlf" width="112" height="28">
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Base
        </a>

        <div class="navbar-dropdown">
          @can('tipopersonas.index')
          <a class="navbar-item" href="{{ route('tipopersonas.index') }}">
            Tipo de persona
          </a>
          @endcan
          <hr class="navbar-divider">
          @can('unidadmedidas.index')
          <a class="navbar-item" href="{{ route('unidadmedidas.index') }}">
            Unidad de medida
          </a>
          @endcan
          @can('tipoproductos.index')
          <a class="navbar-item" href="{{ route('tipoproductos.index') }}">
            Tipo de producto
          </a>
          @endcan
          <hr class="navbar-divider">
          @can('ciudades.index')
          <a class="navbar-item" href="{{ route('ciudades.index') }}">
            Ciudad
          </a>
          @endcan
          @can('estados.index')
          <a class="navbar-item" href="{{ route('estados.index') }}">
            Estado
          </a>
          @endcan
           <hr class="navbar-divider">
           <a class="navbar-item" href="{{ route('divisas.edit', ['divisas' => 1]) }}">
            Divisa (Actualización Precios)
          </a>
        </div>
      </div>

       <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Terceros
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('terceros.index') }}">
            Terceros
          </a>
          <a class="navbar-item" href="{{ route('personas.index') }}">
            Personas
          </a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Inventario
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('productos.index') }}">
            Productos
          </a>
          {{-- <a class="navbar-item" href="{{ route('materiaprimas.index') }}">
            Materia Prima
          </a> --}}
          <hr class="navbar-divider">
          <a class="navbar-item" href="{{ route('entregas.index') }}">
            Entregas
          </a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Producción
        </a>

        <div class="navbar-dropdown">
          {{-- <a class="navbar-item" href="#">
            Formulas
          </a>
          <hr class="navbar-divider"> --}}
          <a class="navbar-item" href="{{ route('lotes.index') }}">
            Lotes
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="{{ route('pruebaanticoagulantes.index') }}">
            Pruebas anticuagulantes
          </a>
          <a class="navbar-item" href="{{ route('pruebadiluentes.index') }}">
            Pruebas diluentes
          </a>
          <a class="navbar-item" href="{{ route('pruebalisantes.index') }}">
            Pruebas lisantes
          </a>
          <a class="navbar-item" href="{{ route('pruebarinses.index') }}">
            Pruebas rinses
          </a>
        </div>
      </div>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Ventas
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="{{ route('facturas.index', ['modulo' => 'factura']) }}">
            Facturas
          </a>
          <a class="navbar-item" href="{{ route('facturas.index', ['modulo' => 'notaentrega']) }}">
            Notas de Entrega
          </a>
          <hr class="navbar-divider">
          <span class="navbar-item is-size-5 has-text-weight-bold">Reportes</span>
          <a class="navbar-item" href="{{ route('reportes.reporteventas') }}">
            Ventas General
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteventasxproducto') }}">
            Ventas x Producto
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteventasxproductog') }}">
            Ventas x Producto (General)
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteiva') }}">
            IVA Cobrado
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteventasxtercero') }}">
            Ventas x Tercero
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteventasxtercerog') }}">
            Ventas x Tercero (General)
          </a>
          <a class="navbar-item" href="{{ route('reportes.reporteventasxtp') }}">
            Ventas de Producto x Tercero
          </a>
          {{-- <a class="navbar-item" href="{{ route('reportes.reporteventasxtpg') }}">
            Ventas de Producto x Tercero (General)
          </a> --}}
        </div>
      </div>

      {{-- <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link is-arrowless">
         Cobros
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="#">
            Registro
          </a>
          <a class="navbar-item" href="#">
            Canceladas
          </a>
        </div>
      </div> --}}

    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-danger" href="{{ route('logout') }}" onclick="event.preventDefault();       document.getElementById('logout-form').submit();">
            <strong>Salir</strong>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>
    </div>
  </div>
</nav>
