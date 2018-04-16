@extends('layouts.base')
@section('content')
   <center>
       <div class="container">
            <div style="margin-left: 20%">
               <form method="POST" class="form-horizontal" action="/item">
                   {{ csrf_field() }}
                   {{--Input invisivel contendo o id da remessa que é usado para armazenar os seus itens--}}
                   <input type="hidden" name="remessa_id" id="remessa_id" value="{{$remessa->id}}">

                   <div class="form-group">
                       <label class="control-label col-sm-3" for="codigo_rastreio">Código de Rastreio:</label>
                       <div class="col-sm-3"> 
                           <input type="text" class="form-control" id="codigo_rastreio" name="codigo_rastreio" autofocus>
                       </div>
                   </div> 
                   <div class="checkbox" style="margin-right: 25%">
                         <label><input type="checkbox" name="AR" value="1" @if(Session::get('AR') == 1) checked @endif>AR</label>
                         <label><input type="checkbox" name="MP" value="1" @if(Session::get('MP') == 1) checked @endif>MP</label>
                         <label><input type="checkbox" name="SEDEX" value="1" @if(Session::get('SEDEX') == 1) checked @endif>SEDEX</label>
                    </div>
                    <div class="checkbox" style="margin-right: 25%">
                          <label><input type="checkbox" name="fixar" value="1" @if(Session::get('fixo') == 1) checked @endif>Fixar</label>
                     </div>                     
                    <div class="form-group" style="margin-right: 25%; margin-top: 25px">
                          <button type="submit" class="btn btn-primary">
                                Adicionar
                          </button>
                    </div>      
                    <div class="form-group">
                       <label class="control-label col-sm-3" for="sem_registro">Itens sem registro:</label>
                       <div class="col-sm-3"> 
                           <input type="text" class="form-control" id="sem_registro" name="sem_registro" value="{{$remessa->sem_registro}}">
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-sm-3" for="observacao">Observação:</label>
                       <div class="col-sm-3"> 
                           <textarea class="form-control" rows="5" id="observacao" name="observacao">{{$remessa->observacao}}</textarea>
                           <button type="submit" class="btn btn-primary" style="margin-top: 25px">
                               Salvar
                           </button>
                       </div>
                    </div>
               </form> 
              </div>      
              @if (count($remessa->itens))
                    <div class="panel panel-primary"  style="width:50%">
                        <div class="panel-heading">
                            <h3 class="panel-title">Remessa {{$remessa->id}}</h3>
                            <h3 class ="panel-title">Registrada por {{$remessa->criador->sigla}} {{$remessa->created_at->format('d/m/Y')}} as {{$remessa->created_at->format('H:i:s')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código de Rastreio</th>
                                        <th>AR</th>
                                        <th>MP</th>
                                        <th>Sedex</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($remessa->itens as $iten)   
                                    <tr>
                                        <td>{{$iten->id}}</td>
                                        <td><strong>{{$iten->codigo_rastreio}}</strong></td>
                                        @if ($iten->AR == 1)
                                            <td><span class="glyphicon glyphicon-ok"></span></td>
                                        @else
                                            <td></td>    
                                        @endif
                                        @if ($iten->MP == 1)
                                            <td><span class="glyphicon glyphicon-ok"></span></td>
                                        @else
                                            <td></td>    
                                        @endif
                                        @if ($iten->SEDEX == 1)
                                            <td><span class="glyphicon glyphicon-ok"></span></td>
                                        @else
                                            <td></td>    
                                        @endif
                                        <td><a href="/item/remover/{{$iten->id}}"><span class="glyphicon glyphicon-remove" style="margin-left: 25px"></span></a></td>
                                    </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </center>
                </div>
           @endif
        </div>   
   </center>
@endsection
