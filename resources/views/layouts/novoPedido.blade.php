@extends('layouts.base')
@section('content')
<div class="container-fluid">
    <h1>{{Session::get('cart')}}</h1>
    <div class="row">
        <div class="col-sm-9">
            <div class="form-group" style="margin-right: 250px">
                <label style="margin-left:40%">Pesquise pelo código ou descrição: </label>
                <input type="text" class="form-controller" id="search" name="search" autofocus></input>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Descrição</th>
                        <th>Qtd. Atual</th>
                        <th>Qtd. Pedido</th>
                        <th>Adicionar</th>
                    </tr>
                </thead>
                <tbody class="resultado"> 
                    @foreach ($materiais as $material)
                        <tr>
                            <td>{{$material->id}}</td>
                            <td>{{$material->codigo}}</td>
                            <td>{{$material->descricao}}</td>
                            <td>{{$material->quantidade}}</td>
                            <td><input type="text"  id="qtd{{$material->id}}" style="width: 50px"></td>
                            <td><button type="button" class="btn btn-success" id="{{$material->id}}" value="{{$material->id}}">Adicionar</button></td>
                        </tr>    
                    @endforeach   
                </tbody>
            </table>
        </div>
        <div class="col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Carrinho</div>
                    <div class="panel-body">
                        <table id="teste" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Qtd</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody class="cart"> 
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>    
    <center>
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
                $('.resultado').html(data);
            }
        });
    })

    function myFunction(id) 
    {
          var row = document.getElementById("row"+id);
          row.parentNode.removeChild(row);
    }
    
    $(function() {
        $(document).on("click", 'button[class^="btn btn-success"]',function(){
            var value=$(this).attr("value");
            var qtd = $('#qtd' + value).val();
            var carrinho = {{Session::get('cart')}};
            
            if (qtd == '') {
                alert("Informe a quantidade");
                return false;
            }

            if (Number.isInteger(qtd)) {
                alert("aaaaaaaaaaaa");
                return false;
            }
            
            $.ajax({
                type: 'get',
                url: '/carrinhoAjax',
                data: {
                    'item': value,
                    'quantidade':qtd,
                    'id_carrinho':carrinho
                },
                success: function(data) {
                    $('.cart').append(data);
                }
            });
        });
    });
   
</script>    
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
