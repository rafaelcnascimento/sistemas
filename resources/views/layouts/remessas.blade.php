@extends('layouts.base')
@section('content')
    <div class="container">
        <center>
            <a href="/remessa"> 
                <button class="btn btn-success" style="margin-bottom: 20px">
                    Adicionar Remessa
                </button>
            </a>
        @foreach ($remessas as $remessa)
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
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
                @if (Auth::user()->sigla == $remessa->criador->sigla || Auth::user()->sigla == 'dvv')
                    <form method="POST" class="form-horizontal" action="/remessa/delete/{{$remessa->id}}">
                        {{ csrf_field() }}
                        <div class="btn-group">
                            <a href="/correio/{{$remessa->id}}" class="btn btn-success">Editar</a>
                            <button onclick="return confirm_alert(this)" class="btn btn-danger"> Remover </button>
                        </div>
                    </form>            
                @endif
                {{--Checa os itens sem registro--}}
                @if ($remessa->sem_registro == 1)
                    <p><strong>1 Item está sem registro</strong></p>
                @elseif($remessa->sem_registro > 1)
                    <p><strong>{{$remessa->sem_registro}} Itens estão sem registro</strong></p>
                @endif
                {{--Checa se tem alguma observação--}}
                @if($remessa->observacao)
                    <p><strong>OBS:</strong> {{$remessa->observacao}}</p>
                @endif
            </div>
        </div>
        @endforeach 
        {{ $remessas->links()}}   
        </center>
    </div>
    {{--Confirma a exclusão da remessa--}}
    <script type="text/javascript">
        function confirm_alert(node) {
            return confirm("Para confirmar clique em 'OK' ");
        }
    </script>
@endsection


