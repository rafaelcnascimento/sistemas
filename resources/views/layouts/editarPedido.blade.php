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
                            <td><input type="text"  name="quantidade[]" value="{{$material->pivot->atendido}}" style="width:50px; margin-left:25px"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group" style="margin-left: 30%;">
                <label class="control-label col-sm-2" for="recebido_por">Recebido por:</label> 
                <div class="col-sm-3">
                    <input type="text" class="form-control"  name="recebido_por" value="{{$pedido->recebido_por}}">
                    @if(!is_null($pedido->recebido_at))
                        {{$pedido->recebido_at->format('d/m/Y')}} as {{$pedido->recebido_at->format('H:i:s')}}
                    @endif
                </div>
            </div>
            <div class="form-group">
                    <label for="situation_id">Modificação situação:</label>
                    <select class="form-control" name="situation_id" style="width: 200px; margin-left: 40px">
                        <option selected value= "0">Selectione</option>
                        <option value="1">Pedido efetuado</option>
                        <option value="2">Parcialmente Atendido</option>
                        <option value="3">Totalmente Atendido</option>
                        <option value="4">Negado</option>
                    </select>  
            </div>
            <div class="form-group" style="margin-left: 250px">
                <label class="control-label col-sm-3" for="observacao">Observação:</label>
                <div class="col-sm-3"> 
                    <textarea class="form-control" rows="5" id="observacao" name="observacao">{{$pedido->observacao}}</textarea>
                </div>
            </div>

            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success" style="margin-right: 180px">Salvar</button>
                </div>
            </div>
        </form>            
    </div>
</center>

@endsection
