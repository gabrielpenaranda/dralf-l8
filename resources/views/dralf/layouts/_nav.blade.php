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
          @can('unidadmedidas.index')
          <a class="navbar-item" href="{{ route('unidadmedidas.index') }}">
            Unidad de medida
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
            @can('tipopersonas.index')
                <a class="navbar-item" href="{{ route('tipopersonas.index') }}">
                    Tipo de persona
                </a>
            @endcan
            <hr class="navbar-divider">
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
            @can('tipoproductos.index')
            <a class="navbar-item" href="{{ route('tipoproductos.index') }}">
              Tipo de producto
            </a>
            @endcan
            <hr class="navbar-divider">
              <a class="navbar-item" href="{{ route('depositos.index') }}">
                Depositos
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" href="{{ route('productos.index') }}">
                  Productos
              </a>
              <a class="navbar-item" href="{{ route('materiaprimas.index') }}">
                Materia Prima
              </a>
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
