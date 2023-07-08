<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ITIL APP</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>
    .container{
        margin-top:120px;
    }
</style>

</head>

<body>
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">OPTICTIMES</h2>
                            <p class="text-white-50 mb-5">Acceso a la aplicación</p>



                            @if (Route::has('login'))
                            <div class="d-flex flex-column px-3">
                                @auth
                                <a href="{{ url('/home') }}">Home</a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-primary my-3">Iniciar Sesion</a>

                                @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-secondary">Registrarse</a>
                                @endif
                                @endauth
                            </div>
                            @endif


                        </div>
                    </div>

                </div>
            </div>
        </div>
</body>

</html>