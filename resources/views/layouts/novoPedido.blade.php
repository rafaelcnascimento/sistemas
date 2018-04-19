@extends('layouts.base')
@section('content')
<div class="container">
    <div class="movie-data">
        <h3>Aqui</h3>
    </div>  
    <center>
        <div class="form-group" style="margin-right: 250px">
            <label>Pesquise pelo código ou descrição: </label>
            <input type="text" class="form-controller" id="search" name="search" autofocus></input>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiais as $material)
                    <tr>
                        <td>{{$material->id}}</td>
                        <td>{{$material->codigo}}</td>
                        <td>{{$material->descricao}}</td>
                        <td>{{$material->quantidade}}</td>
                        <td><button type="button" class="btn btn-success" id="button" value="{{$material->id}}">Adicionar</button></td>
                    </tr>    
                @endforeach   
            </tbody>
        </table>
        {{ $materiais->links() }} 
        
        
    </center>
 </div>
@endsection
@section('js')
<script type="text/javascript">
    $('#search').on('keyup', function() {
        $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/pedidoAjax',
            data: {
                'search': $value
            },
            success: function(data) {
                $('tbody').html(data);
            }
        });
    })

    $(function() {
        $(document).on("click", 'button[class^="btn btn-success"]',function(){
            var value=$(this).attr("value");
            $.ajax({
                type: 'get',
                url: '/carrinhoAjax',
                data: {
                    'item': value
                },
                success: function(data) {
                    //var newDiv = $('<div"><h4><a>'+value+'</a></h4> </div>');

                    $('.movie-data').append(data);
                }
            });
        });
    });
</script>    
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
