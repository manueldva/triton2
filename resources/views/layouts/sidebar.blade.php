<ul class="menu-inner py-1">
  <!-- Dashboard -->
  @if(Auth::user()->getPermiso('Dashboard') == 1)
    <li class="menu-item @if($segment == 'dashboard') active @endif">
      <a  href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
  @endif
  @if(Auth::user()->root == 1)
    <li class="menu-item @if($segment == 'empresas') active @endif">
      <a  href="{{ route('empresas') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-buildings"></i>
        <div data-i18n="Analytics">Empresa</div>
      </a>
    </li>
  @endif
  @if(Auth::user()->getPermiso('Cliente') == 1)
    <li class="menu-item @if($segment == 'clientes') active @endif">
      <a  href="{{ route('clientes') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Analytics">Cliente</div>
      </a>
    </li>
  @endif
  <!--<li class="menu-item @if($segment == 'users') active @endif">
    <a  href="{{ route('users') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="users">Usuario</div>
    </a>
  </li>-->
  @if(Auth::user()->getPermiso('Seguridad') == 1)
    <li class="menu-item @if(substr($segment, -2)=='_s')  open @endif" >
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="config">Seguridad</div>
        <!--<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>-->
      </a>
      @if(Auth::user()->getPermiso('Usuario') == 1)
        <ul class="menu-sub">
          <li class="menu-item @if($segment == 'users_s') active @endif">
            <a  href="{{ route('users') }}" class="menu-link">
              <div data-i18n="users">Usuario </div>
            </a>
          </li>
        </ul>
      @endif
      @if(Auth::user()->getPermiso('Tipo Usuario') == 1)
        <ul class="menu-sub">
          <li class="menu-item @if($segment == 'tipousers_s') active @endif">
            <a  href="{{ route('tipousers') }}" class="menu-link">
              <div data-i18n="tipousers">Tipo Usuario </div>
            </a>
          </li>
        </ul>
      @endif
      @if(Auth::user()->root == 1)
        <ul class="menu-sub">
          <li class="menu-item @if($segment == 'modules_s') active @endif">
            <a  href="{{ route('modules') }}" class="menu-link">
              <div data-i18n="tipousers">Modulos </div>
            </a>
          </li>
        </ul>
      @endif
    </li>
  @endif
  @if(Auth::user()->getPermiso('Complementos') == 1)
    <li class="menu-item @if(substr($segment, -1)=='c') open @endif" >
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div data-i18n="config">Complementos</div>
        <!--<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>-->
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if($segment == 'categorias_c') active @endif">
          <a  href="{{ route('categorias') }}" class="menu-link">
            <div data-i18n="categorias">Categoria</div>
          </a>
        </li>
        <li class="menu-item @if($segment == 'tipomembresias_c') active @endif">
          <a  href="{{ route('tipomembresias') }}" class="menu-link">
            <div data-i18n="categorias">T. Membresia</div>
          </a>
        </li>
        <li class="menu-item @if($segment == 'tipocontactos_c') active @endif">
          <a  href="{{ route('tipocontactos') }}" class="menu-link">
            <div data-i18n="categorias">T. Contacto</div>
          </a>
        </li>
       
      </ul>
    </li>
  @endif
</ul>