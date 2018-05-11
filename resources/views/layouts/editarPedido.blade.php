@extends('layouts.base')
@section('content')
<center>
    <div class="container">
        <form method="POST" class="form-horizontal" action="/pedido/editar/{{$pedido->id}}">
        {{ csrf_field() }}
            @switch($pedido->situation_id)   
                @case(1)
                    <div class="panel panel-primary"  style="width:50%">
                    @break
                @case(2)
                    <div class="panel panel-info"  style="width:50%">
                    @break
                @case(3)
                    <div class="panel panel-success"  style="width:50%">
                    @break
                @case(4)
                    <div class="panel panel-danger"  style="width:50%">
                    @break          
            @endswitch  
                <div class="panel-heading">
                    <h3 class="panel-title">Pedido {{$pedido->id}}</h3>
                    <h3 class="panel-title">Registrada por {{$pedido->criador->sigla}} {{$pedido->created_at->format('d/m/Y')}} as {{$pedido->created_at->format('H:i:s')}}</h3>
                    <h3 class="panel-title">{{$pedido->situacao->nome}}</h3>
                </div>
            </div>
            <table class="table table-striped" style="width: 500px">
                <thead>
                    <tr>
                        <th  class="col-md-2" >Codigo</th>
                        <th  class="col-md-4" >Descrição</th>
                        <th>Qtd. Solicitada</th>
                        <th>Qtd. Atendida</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->materials as $material)
                        <tr>
                            <td>{{$material->codigo}}</td>
                            <td>{{$material->descricao}}</td>
                            <td>{{$material->pivot->quantidade}}</td>
                            <td>{{$material->pivot->atendido}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(!is_null($pedido->recebedor_id))
                <p>Recebidor por: <b>{{$pedido->recebedor->sigla}}</b></p>
            @endif
            <br>
            <label for="observacao">Observação:</label>
            <input type="text" name="oberservacao" value="{{$pedido->observacao}}">     
        </form>
    </div>
</center>

@endsection
