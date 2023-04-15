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
            margin-top:250px;
        }
        .login{
            background: #fff;
        }
    </style>
  
    </head>
    <body>
        <div class="container d-flex justify-content-center">
            <div class="login col-lg-3 border p-5">
            @if (Route::has('login'))
                <div class="d-flex flex-column">
                    <b>ACCESO A LA APP ITIL</b>
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
    </body>
</html>
