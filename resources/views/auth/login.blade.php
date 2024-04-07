<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Acceso</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin_assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('admin_assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('admin_assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin_assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <!--<svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#696cff" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#696cff" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>-->
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                     width="128.000000pt" height="128.000000pt" viewBox="0 0 128.000000 128.000000"
                     preserveAspectRatio="xMidYMid meet">

                    <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)"
                    fill="#000000" stroke="none">
                    <path d="M615 1255 c-42 -7 -77 -9 -87 -4 -45 24 -73 11 -160 -73 -48 -46 -91
                    -93 -98 -105 -9 -20 -19 -23 -63 -23 -32 0 -61 -6 -76 -16 -25 -18 -51 -71
                    -51 -105 0 -13 -12 -52 -27 -88 -51 -126 -42 -348 18 -451 14 -23 17 -36 9
                    -38 -27 -9 -50 -47 -50 -83 0 -31 6 -43 37 -69 31 -25 44 -30 72 -26 18 3 44
                    12 58 21 30 20 63 73 56 91 -7 19 8 17 33 -4 17 -13 23 -31 26 -75 6 -73 42
                    -120 123 -162 151 -77 324 0 325 143 0 75 -34 124 -110 158 -21 9 -7 11 75 12
                    60 0 120 7 150 16 36 11 52 12 60 4 7 -7 6 -12 -3 -15 -25 -9 -83 -66 -99 -96
                    -20 -40 -13 -114 17 -162 33 -53 95 -79 186 -80 61 0 77 4 120 30 66 41 106
                    108 112 184 2 33 -1 67 -7 80 -10 17 -9 25 4 37 33 33 8 58 -73 71 -31 5 -32
                    7 -26 39 8 43 -9 45 -33 4 -16 -28 -21 -30 -83 -30 -36 0 -79 -4 -96 -9 l-31
                    -9 5 49 c3 33 1 49 -7 49 -6 0 -11 -9 -11 -21 0 -40 -32 -91 -66 -105 -20 -8
                    -69 -14 -119 -14 -79 0 -85 1 -85 20 0 24 -35 40 -85 40 -29 0 -40 8 -75 51
                    -80 102 -100 253 -52 391 11 32 17 60 12 63 -27 16 -64 -109 -64 -215 0 -101
                    19 -165 73 -242 l38 -55 -66 -16 c-36 -9 -75 -19 -87 -22 -18 -6 -24 2 -47 65
                    -14 39 -34 108 -43 153 -20 92 -22 97 -33 78 -5 -7 -2 -45 6 -84 18 -86 17
                    -73 15 -219 -2 -113 -3 -119 -29 -148 -40 -44 -93 -51 -127 -17 -30 31 -33 67
                    -8 90 27 24 49 21 56 -8 8 -32 26 -33 26 -1 0 13 -16 43 -35 66 -43 52 -64
                    120 -72 230 -12 193 49 320 195 406 18 10 44 37 57 59 24 42 75 95 75 79 0 -5
                    -18 -33 -40 -63 -59 -78 -52 -121 21 -121 38 0 72 29 143 123 16 20 36 37 46
                    37 10 0 28 9 41 19 22 18 23 22 12 52 -7 18 -11 34 -10 35 1 2 42 11 90 20 75
                    15 98 15 153 5 90 -16 162 -45 207 -82 38 -31 41 -49 7 -49 -10 0 -32 -11 -49
                    -25 -22 -20 -36 -24 -56 -19 -19 5 -35 1 -55 -15 -19 -14 -31 -17 -36 -10 -26
                    43 -188 64 -260 34 -56 -23 -97 -56 -85 -68 6 -6 19 -2 37 12 64 50 168 61
                    252 25 l37 -15 -40 -16 c-22 -8 -65 -14 -96 -13 -50 1 -60 -2 -98 -34 -24 -20
                    -47 -36 -51 -36 -5 0 -9 -8 -9 -17 0 -10 -3 -33 -7 -51 -8 -39 16 -72 52 -72
                    30 0 78 42 109 94 31 52 71 92 110 106 l30 11 -27 -23 c-15 -13 -55 -68 -88
                    -123 -73 -118 -94 -143 -137 -161 -69 -30 -110 18 -98 115 5 42 4 52 -7 49
                    -33 -11 -27 -150 9 -176 74 -54 154 -6 245 147 28 47 63 99 77 114 25 27 25
                    27 33 6 8 -20 14 -21 89 -17 65 3 83 7 95 22 18 26 32 13 88 -82 86 -148 99
                    -149 79 -5 -7 54 -15 104 -18 110 -2 7 5 17 15 23 23 12 26 42 7 59 -8 6 -19
                    30 -26 53 -37 122 -91 168 -141 118 -18 -18 -23 -19 -48 -6 -71 36 -224 45
                    -357 21z m489 -177 c9 -12 16 -25 16 -28 0 -7 -111 -10 -122 -4 -12 7 11 34
                    37 44 34 14 53 11 69 -12z m-153 -43 c0 -5 -12 -11 -26 -13 -18 -2 -25 1 -25
                    13 0 12 7 15 25 13 14 -2 26 -7 26 -13z m-751 -22 c-14 -9 -40 -30 -57 -46
                    -32 -30 -33 -30 -33 -9 0 34 43 72 82 72 l32 0 -24 -17z m880 -3 c0 -5 -4 -10
                    -10 -10 -5 0 -10 5 -10 10 0 6 5 10 10 10 6 0 10 -4 10 -10z m57 -36 c7 -20
                    -11 -38 -32 -31 -13 6 -13 10 -3 27 15 24 27 26 35 4z m-467 -4 c0 -5 -4 -10
                    -9 -10 -6 0 -13 5 -16 10 -3 6 1 10 9 10 9 0 16 -4 16 -10z m-14 -68 c-26 -26
                    -66 7 -52 43 5 14 10 13 36 -7 26 -19 28 -24 16 -36z m504 -44 c0 -16 -3 -19
                    -11 -11 -6 6 -8 16 -5 22 11 17 16 13 16 -11z m-881 -502 c-25 -27 -30 -19
                    -22 44 l6 55 18 -40 c16 -38 16 -41 -2 -59z"/>
                    <path d="M912 820 c-35 -32 -54 -79 -60 -143 -6 -76 12 -71 21 5 10 80 70 122
                    121 85 13 -10 16 -20 12 -35 -7 -21 -9 -21 -37 -6 -34 17 -69 11 -69 -13 0
                    -10 6 -13 16 -9 8 3 33 0 55 -7 34 -10 39 -16 40 -42 l1 -30 9 35 c11 46 14
                    110 5 136 -7 22 -44 44 -75 44 -9 0 -27 -9 -39 -20z"/>
                    </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Triton</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Bienvenido a Triton! 👋</h4>
              <p class="mb-4">Inicie sesión en su cuenta y comience la aventura</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('login.action') }}" method="POST">
                @csrf
                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                  </div>
                @endif
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Introduce tu correo electrónico"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="#">
                      <small>¿Has olvidado tu contraseña?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <!--<div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Recordarme </label>
                  </div>
                </div>-->
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Iniciar sesión</button>
                </div>
              </form>

              <p class="text-center">
                <span>Nuevo en nuestra plataforma?</span>
                <a href="{{ route('register') }}">
                  <span>Crea una cuenta</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin_assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('admin_assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
