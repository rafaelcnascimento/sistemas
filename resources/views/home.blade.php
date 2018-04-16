@extends('layouts.base')

@section('content')
    <div class="container">
      <center>
          </br>
          </br>
          </br>
          </br>
          <h3>Qual sistema deseja acessar?</h3>
          </br>
          <a href="/correio" class="btn btn-primary" role="button">Sistema de Controle de Remessas</a>
          <div class="btn-group">
            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sistema de Controle de Materiais <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="">Santo Ângelo</a></li>
                <li><a href="">Passo Fundo</a></li>
                <li><a href="">Bento Gonçalves</a></li>
                <li><a href="">Caxias do Sul</a></li>
                <li><a href="">Lajeado</a></li>
                <li><a href="">Canoas</a></li>
            </ul>
          </div>
      </center>
    </div>
@endsection

