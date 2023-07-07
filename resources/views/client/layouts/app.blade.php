<!DOCTYPE html>
<!-- Breadcrumb-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>App Itil</title>
  <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css')}}">
  <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css')}}">
  <!-- Main styles for this application-->
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('css/home.css')}}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="../css/examples.css" rel="stylesheet">
  <link href="{{ asset('vendors/@coreui/chartjs/css/coreui-chartjs.css')}}" rel="stylesheet">

  <!-- Scripts -->
  <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
</head>

<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    <h3>OPTICTIMES</h3>
    <!-- <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="../assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="../assets/brand/coreui.svg#signet"></use>
      </svg> -->

  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <li class="nav-item"><a class="nav-link" href="/client/home">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer')}}"></use>
        </svg> Dashboard</a></li>
    <!-- <li class="nav-title">USUARIOS</li> -->
    <li class="nav-item"><a class="nav-link" href="/client/prod">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
        </svg> Products</a></li>

    <li class="nav-item"><a class="nav-link" href="{{ route('purchases.index') }}">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-drop')}}"></use>
        </svg> Compras</a></li>

    <li class="nav-item"><a class="nav-link" href="{{ route('client.tickets') }}">
        <svg class="nav-icon">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-pencil')}}"></use>
        </svg> Tickets</a></li>
  </ul>
  <!-- <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button> -->
</div>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
  <header class="header header-sticky mb-4">
    <div class="container-fluid">
      <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
          <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
        </svg>
      </button><a class="header-brand d-md-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="{{ asset('assets/brand/coreui.svg#full')}}"></use>
        </svg></a>
      <ul class="header-nav ms-3">
        <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md"><img class="avatar-img" src="{{ asset('assets/img/avatars/2.jpg')}}" alt="user@email.com"></div>
          </a>
          <div class="dropdown-menu dropdown-menu-end pt-0 text-center">
            <div class="dropdown-header bg-light py-2">
              <div class="fw-semibold"><svg class="icon me-2">
                  <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                </svg>Usuario activo</div>
              <strong class="fw-semibold">{{auth()->user()->name}}</strong>
            </div>

            <div class="dropdown-divider m-0"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <svg class="icon me-2">
                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
              </svg> Cerrar sesion</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
    
  </header>
  <div class="container">
    @yield('content')

  </div>

  <!-- CoreUI and necessary plugins-->
  <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
  <script src="{{ asset('vendors/simplebar/js/simplebar.min.js')}}"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="{{ asset('vendors/chart.js/js/chart.min.js')}}"></script>
  <script src="{{ asset('vendors/@coreui/chartjs/js/coreui-chartjs.js')}}"></script>
  <script src="{{ asset('vendors/@coreui/utils/js/coreui-utils.js')}}"></script>
  <script src="{{ asset('js/main.js')}}"></script>
  </body>

</html>