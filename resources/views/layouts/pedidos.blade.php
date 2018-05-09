@extends('layouts.base')
@section('content')
   <div class="container">
       <center>
           <a href="/material/novoPedido"> 
               <button class="btn btn-success" style="margin-bottom: 20px">
                   Adicionar pedido
               </button>
           </a>
       @foreach ($pedidos as $pedido)
       <div class="panel panel-primary"  style="width:50%">
           <div class="panel-heading">
               <h3 class="panel-title">Pedido {{$pedido->id}}</h3>
               <h3 class ="panel-title">Registrada por {{$pedido->criador->sigla}} {{$pedido->created_at->format('d/m/Y')}} as {{$pedido->created_at->format('H:i:s')}}</h3>
           </div>
           <div class="panel-body">
               <table class="table table-striped" >
                   <thead>
                       <tr>
                           <th>Codigo</th>
                           <th>Descrição</th>
                           <th>Qtd. Solicitada</th>
                           <th>Qtd. Atendida</th>
                       </tr>
                   </thead>
                   <tbody>
                      
                   </tbody>
               </table>
               @if (Auth::user()->sigla == $pedido->criador->sigla || Auth::user()->sigla == 'dvv')
                   <form method="POST" class="form-horizontal" action="/pedido/delete/{{$pedido->id}}">
                       {{ csrf_field() }}
                       <div class="btn-group">
                           <a href="/correio/{{$pedido->id}}" class="btn btn-success">Editar</a>
                           <button onclick="return confirm_alert(this)" class="btn btn-danger"> Remover </button>
                       </div>
                   </form>            
               @endif
               {{--Checa se tem alguma observação--}}
               @if($pedido->observacao)
                   <p><strong>OBS:</strong> {{$pedido->observacao}}</p>
               @endif
           </div>
       </div>
       @endforeach 
       {{ $pedidos->links()}}   
       </center>
   </div>
   {{--Confirma a exclusão da pedido--}}
   <script type="text/javascript">
       function confirm_alert(node) {
           return confirm("Para confirmar clique em 'OK' ");
       }
   </script>
@endsection
