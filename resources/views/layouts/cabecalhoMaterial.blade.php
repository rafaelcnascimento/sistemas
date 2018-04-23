<ul class="nav navbar-nav">
    <li><a href="/correio">Sistema de Controle de Remessas</a></li>
    <li><a href="/material/lista">Lista de materiais</a></li>
    <li><a href="/material/novoMaterial">Incluir material</a></li>
    <li><a href="/material">Lista de pedidos</a></li>
    <li><a href="/material/novoPedido">Novo pedido</a></li>
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
