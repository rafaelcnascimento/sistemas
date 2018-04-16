@extends('layouts.base')
@section('content')
    <div class="container">
        <form method="POST" class="form-horizontal" action="/material/{{$material->id}}" style="margin-left: 20%;">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-3" for="codigo">Código do material:</label>
                <div class="col-sm-3"> 
                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{$material->codigo}}" autofocus>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-sm-3" for="descricao">Descrição:</label>
                <div class="col-sm-3"> 
                    <textarea class="form-control" rows="5" id="descricao" name="descricao">{{$material->descricao}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="quantidade">Quantidade</label>
                <div class="col-sm-3"> 
                    <input type="text" class="form-control" id="quantidade" name="quantidade" value="{{$material->quantidade}}">
                    <button type="submit" class="btn btn-primary" style="margin-top: 25px">
                        Salvar
                    </button>
                </div>
            </div> 
        </form>
        <form method="POST" class="form-horizontal" action="/material/delete/{{$material->id}}" style="margin-left:42%;">
            {{ csrf_field() }}
            <div class="form-group">
                <button onclick="return confirm_alert(this)" class="btn btn-danger">Remover</button>
            </div> 
        </form>    
    </div>
    {{--Confirma a exclusão do material--}}
    <script type="text/javascript">
        function confirm_alert(node) {
            return confirm("Para confirmar clique em 'OK' ");
        }
    </script>    
@endsection
