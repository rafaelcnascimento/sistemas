@extends('layouts.base')
@section('content')

<div class="container">
    @if (count($resultados) == 0)
        <center> 
            <h3>Nenhum resultado encontrado</h3>
        </center>
    @else
        <center>
            @foreach ($resultados as $resultado)
            <div class="panel panel-primary"  style="width:50%">
                <div class="panel-heading">
                    <h3 class="panel-title">Remessa {{$resultado->id}}</h3>
                    <h3 class ="panel-title">Registrada por {{$resultado->criador->sigla}} {{$resultado->created_at->format('d/m/Y')}} as {{$resultado->created_at->format('H:i:s')}}</h3>
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
                            @foreach ($resultado->itens as $iten)   
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
                    @if (Auth::user()->sigla == $resultado->criador->sigla || Auth::user()->sigla == 'adm')
                        <form method="POST" class="form-horizontal" action="/remessa/delete/{{$resultado->id}}">
                            {{ csrf_field() }}
                            <div class="btn-group">
                                <a href="/correio/{{$resultado->id}}" class="btn btn-success">Editar</a>
                                <button onclick="return confirm_alert(this)" class="btn btn-danger"> Remover </button>
                            </div>
                        </form>            
                    @endif
                    {{--Checa os itens sem registro--}}
                    @if ($resultado->sem_registro == 1)
                        <p><strong>1 Item está sem registro</strong></p>
                    @elseif($resultado->sem_registro > 1)
                        <p><strong>{{$resultado->sem_registro}} Itens estão sem registro</strong></p>
                    @endif
                    {{--Checa se tem alguma observação--}}
                    @if($resultado->observacao)
                        <p><strong>OBS:</strong> {{$resultado->observacao}}</p>
                    @endif
                </div>
            </div>
            @endforeach 
        </center>
    @endif    
</div>    
<script type="text/javascript">
    function confirm_alert(node) {
        return confirm("Para confirmar clique em 'OK' ");
    }
</script>
@endsection
