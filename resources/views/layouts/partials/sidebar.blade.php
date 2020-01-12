@php
  $empresa = \App\Empresa::find(1);
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link">
    <img src="{{ asset('storage/'.$empresa->logo) }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ $empresa->name }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('storage/users/'.Auth::user()->url) }}" class="img-circle" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('user.show', [Auth::id()]) }}" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        @can('ventas.read')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/venta" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Listado ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pedido" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Listado pedidos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/venta/exitosas" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Exitosas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/venta/canceladas" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Canceladas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/venta/pendientes" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Pendientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/mesas" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Mesas</p>
                </a>
              </li>
              @can('clientes.read')
                <li class="nav-item">
                  <a href="/cliente" class="nav-link">
                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Clientes
                    </p>
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endcan
        {{-- @can('ventas.read') --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/compra" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Listado compras</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/compra/exitosas" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Exitosas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/compra/canceladas" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Canceladas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/proovedor" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Proovedores
                  </p>
                </a>
              </li>
            </ul>
          </li>
        {{-- @endcan --}}
        @can('cobros.read')
        <li class="nav-item">
          <a href="/cobro" class="nav-link">
            <i class="nav-icon fas fa-cash-register"></i>
            <p>
              Cobros
            </p>
          </a>
        </li>
        @endcan
        @can('cortes.read')
        <li class="nav-item">
          <a href="/cortes" class="nav-link">
            <i class="nav-icon fas fa-closed-captioning"></i>
            <p>
              Cortes
            </p>
          </a>
        </li>
        @endcan

        {{-- @can('cortes.read') --}}
        <li class="nav-item">
          <a href="/credito" class="nav-link">
            <i class="nav-icon fas fa-copyright"></i>
            <p>
              Créditos
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/ingreso" class="nav-link">
            <i class="nav-icon fas fa-arrow-up"></i>
            <p>
              Ingresos extra
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/gasto" class="nav-link">
            <i class="nav-icon fas fa-arrow-down"></i>
            <p>
              Gastos
            </p>
          </a>
        </li>
        {{-- @endcan --}}
        {{-- @can('cortes.read') --}}
        
        {{-- @endcan --}}
        {{-- @canany(['cliente.read']) --}}
        @can('inventario.read')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-boxes nav-icon"></i>
            <p>
              Inventario
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('unidad.read')
            <li class="nav-item">
              <a href="/unidad" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-underline nav-icon"></i>
                <p>Unidades</p>
              </a>
            </li>
            @endcan
            @can('inventario.read')
            <li class="nav-item">
              <a href="/inventario" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-boxes nav-icon"></i>
                <p>Inventario</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        @can('producto.read')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fab fa-product-hunt nav-icon"></i>
            <p>
              Productos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/producto" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fab fa-product-hunt nav-icon"></i>
                <p>Productos</p>
              </a>
            </li>
              <li class="nav-item">
                <a href="/categoria" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Categorías</p>
                </a>
              </li>
          </ul>
        </li>
        @endcan
        {{-- @endcanany --}}
        @can('avanzado.read')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Avanzado
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/empresa" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-users nav-icon"></i>
                <p>Empresa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/user" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-users nav-icon"></i>
                <p>Usuarios</p>
              </a>
            </li>
            @can('roles.read')
            <li class="nav-item">
              <a href="/roles" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-user-tag nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Configuración
              <i class="right fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('configuracion.read')
              <li class="nav-item">
                <a href="{{ route('user.show', [Auth::id()]) }}" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-user nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>
            @endcan
            @can('configuracion.edit')
              <li class="nav-item">
                <a href="{{ route('user.edit', [Auth::id()]) }}" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-cog nav-icon"></i>
                  <p>Configuración</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/pass/{{ Auth::id() }}" class="nav-link">
                  <i class="fas fa-chevron-circle-right nav-icon"></i>
                  <i class="fas fa-key nav-icon"></i>
                  <p>Cambiar password</p>
                </a>
              </li>
            @endcan
            <li class="nav-item">
              <a href="{{ url('/logout') }}" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Cerrar Sesión</p>
              </a>
            </li>
          </ul>
        </li>
        @can('reportes.read')
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-week"></i>
            <p>
              Reportes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/reportes/ventas" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-user nav-icon"></i>
                <p>Consulta ventas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/reportes/compras" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-user nav-icon"></i>
                <p>Consulta compras</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/reportes/graphs" class="nav-link">
                <i class="fas fa-chevron-circle-right nav-icon"></i>
                <i class="fas fa-cog nav-icon"></i>
                <p>Gráficas</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="nav-item">
          <a href="/excel" class="nav-link">
            <i class="fas fa-cog nav-icon"></i>
            <p>Reportes Excel</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>