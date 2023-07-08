<!DOCTYPE html>
<!-- Breadcrumb-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Optictimes</title>
  <!-- Vendors styles-->
  <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css')}}">
  <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css')}}">
  <!-- Main styles for this application-->
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
    <h5><a class="navbar-brand" href="/support/home">OPTICTIMES</a></h5>

    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="/support/home">
      <i class='bx bxs-dashboard mx-2'></i>Dashboard</a></li>
      <!-- <li class="nav-title">USUARIOS</li> -->
      
      <li class="nav-item"><a class="nav-link" href="{{ route('support.tickets') }}">
      <i class='bx bx-support mx-2'></i> Tickets</a></li>

   

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
    <script src="{{ asset('js/main.js')}}"></script>
</body>

</html>