@extends('layouts.base')
@section('content')
    <div class="container">
            <form method="POST" class="form-horizontal" action="/material" style="margin-left: 20%;">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-sm-3" for="codigo">Código do material:</label>
                    <div class="col-sm-3"> 
                        <input type="text" class="form-control" id="codigo" name="codigo" autofocus>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-3" for="descricao">Descrição:</label>
                    <div class="col-sm-3"> 
                        <textarea class="form-control" rows="5" id="descricao" name="descricao"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="quantidade">Quantidade</label>
                    <div class="col-sm-3"> 
                        <input type="text" class="form-control" id="quantidade" name="quantidade" value="0">
                        <button type="submit" class="btn btn-primary" style="margin-top: 25px">
                            Adicionar
                        </button>
                    </div>
                </div> 
            </form>
    </div>    
@endsection
