<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="menu-item @if($segment == 'dashboard') active @endif">
    <a  href="{{ route('dashboard') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-home-circle"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
  </li>
  @if(Auth::user()->root == 1)
    <li class="menu-item @if($segment == 'empresas') active @endif">
      <a  href="{{ route('empresas') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-buildings"></i>
        <div data-i18n="Analytics">Empresas</div>
      </a>
    </li>
  @endif
  <li class="menu-item @if($segment == 'users') active @endif">
    <a  href="{{ route('users') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="users">Usuarios</div>
    </a>
  </li>
  <li class="menu-item @if(substr($segment, -1)=='c') open @endif" >
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-cog"></i>
      <div data-i18n="config">Complementos</div>
      <!--<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>-->
    </a>
    <ul class="menu-sub">
      <li class="menu-item @if($segment == 'categorias_c') active @endif">
        <a  href="{{ route('categorias') }}" class="menu-link">
          <div data-i18n="categorias">Categorias</div>
        </a>
      </li>

      <li class="menu-item @if($segment == 'subcategorias_c') active @endif">
        <a  href="{{ route('subcategorias') }}" class="menu-link">
          <div data-i18n="categorias">Sub Categorias</div>
        </a>
      </li>

      <li class="menu-item @if($segment == 'proveedores_c') active @endif">
        <a  href="{{ route('proveedores') }}" class="menu-link">
          <div data-i18n="categorias">Proveedores</div>
        </a>
      </li>
     
    </ul>
  </li>

</ul>