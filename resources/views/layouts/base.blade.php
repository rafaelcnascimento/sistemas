<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Titulo -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
</head>

<style type="text/css">
    .dropdown-menu {
        width: 245px !important;
        text-align: center;
    }
</style>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="/home"><img src="{{ asset('imagens/jfrs.jpg') }}" width="51" height="50"></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/trocarSenha">Alterar senha</a></li>
        </ul>    
        {{--Checa se o usuario esta no sistema de Correio --}}
        @if (\Request::is(['correio*','correio/*'])) 
           @include('layouts.cabecalhoCorreio')
        @endif
        {{--Checa se o usuario esta no sistema de Materiais --}}
       @if (\Request::is(['material*','material/*'])) 
          @include('layouts.cabecalhoMaterial')
       @endif
       {{--/remessa--}}
        
    </div>
</nav>
  
    @yield('content')

<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @yield('js')

</body>
</html>
