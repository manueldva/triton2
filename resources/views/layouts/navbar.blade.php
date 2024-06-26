<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
  >
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
          <i class="bx bx-search fs-4 lh-0"></i>
          <input
            type="text"
            class="form-control border-0 shadow-none"
            placeholder="Buscar..."
            aria-label="Buscar..."
          />
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Place this tag where you want the button to render. -->
        <!--<li class="nav-item lh-1 me-3">
          <a
            class="github-button"
            href="https://github.com/themeselection/sneat-html-admin-template-free"
            data-icon="octicon-star"
            data-size="large"
            data-show-count="true"
            aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
            >Star</a
          >
        </li>-->
        @if(Auth::user()->root == 1)
          <div class="mb-3">
              <br>
              
              <form action="{{ route('users.updateEmpresa') }}" method="POST">
                @csrf
                <select class="form-select" id="allempresa_id" name="allempresa_id" aria-label="Default select example">
                    @foreach($empresas as $id => $descripcion)
                        <option value="{{ $id }}" @if ($id == Auth::user()->empresa->id) selected @endif>{{ $descripcion }}</option>
                    @endforeach
                </select>
            </form>

              
          </div>
        @endif
        &nbsp;
        &nbsp;
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              @isset(Auth::user()->photo)
                  <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="Foto del usuario" style="width: 40px; height: 40px; object-fit: cover;" class="rounded-circle" />
              @else
                  <!-- Puedes poner una imagen predeterminada o dejarlo en blanco según prefieras -->
                  <img src="{{ asset('admin_assets/img/avatars/1.png') }}" alt="Foto por defecto" style="width: 40px; height: 40px; object-fit: cover;" class="rounded-circle" />
              @endisset
          </div>

          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex">
                  <div class="flex-shrink-0 me-3">
                    <div class="avatar avatar-online">
                        @isset(Auth::user()->photo)
                            <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="Foto del usuario" style="width: 40px; height: 40px; object-fit: cover;" class="rounded-circle" />
                        @else
                            <!-- Puedes poner una imagen predeterminada o dejarlo en blanco según prefieras -->
                            <img src="{{ asset('admin_assets/img/avatars/1.png') }}" alt="Foto por defecto" style="width: 40px; height: 40px; object-fit: cover;" class="rounded-circle" />
                        @endisset
                    </div>

                  </div>
                  <div class="flex-grow-1">
                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <!--
            <li>
              <a class="dropdown-item" href="#">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">Mi Perfil</span>
              </a>
            </li>
            -->
            <li>
              <a class="dropdown-item"href="{{ route('empresas.edit', Auth::user()->empresa->id)}}">
                <i class="bx bx-cog me-2"></i>
                <span class="align-middle">Config.</span>
              </a>
            </li>
            <!--<li>
              <a class="dropdown-item" href="#">
                <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                  <span class="flex-grow-1 align-middle">Facturación</span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                </span>
              </a>
            </li>-->
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Cerrar sesión</span>
              </a>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>
  </nav>


