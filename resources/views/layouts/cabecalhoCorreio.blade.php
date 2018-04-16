<ul class="nav navbar-nav">
    <li><a href="/material">Sistema de Controle de Materiais</a></li>
    <li><a href="/correio">Lista de remessas</a></li>
    <li><a href="/remessa">Nova remessa</a></li>
</ul>
<ul class="nav navbar-nav navbar-right" style="margin-right: 10px">   
    <li>
        <a href="/correio/registrar">Buscar entre datas:</a>
    </li> 
        <li>
            <form method="POST" action="/correio/busca">
                {{ csrf_field() }}
            <input type="text"  style="margin-top: 7px;" class="form-control" id="busca_inicio" name="busca_inicio" placeholder="DD/MM/AAAA">
        </li>
        <li>
            <input type="text"  style="margin-top: 7px" class="form-control" id="busca_fim"  name="busca_fim" placeholder="DD/MM/AAAA">
        </li> 
        <li>
           <button type="submit" class="btn btn-primary" style="margin-top: 6px">
               <span class="glyphicon glyphicon-search"></span>
            </button>
        </li>
        </form>
   <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
         </form>
    </li>
</ul>   
