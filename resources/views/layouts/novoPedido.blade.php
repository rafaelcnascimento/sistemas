@extends('layouts.base')
@section('content')

@if (strpos(Request::fullUrl() , '?') == false)
    @php
        $id_carrinho = Session::get('cart');
    @endphp
    @else
        @php
            $id_carrinho = Session::get('cart');
            $id_carrinho--;
            session([ 'cart' => $id_carrinho ]);
        @endphp
@endif

<div class="container-fluid">
    <h1>{{Session::get('teste')}}</h1>
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
                                @if (strpos(Request::fullUrl() , '?') == true)
                                    @foreach ($carrinhos as $carrinho)
                                        <tr id="row{{$carrinho->id_material}}">
                                            <td>{{$carrinho->codigo}}</td>
                                            <td>{{$carrinho->quantidade}}</td>
                                            <td>
                                               <div id="{{$carrinho->id_material}}" class="glyphicon glyphicon-remove" style="cursor:pointer; margin-left:25px;"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif    
                            </tbody>
                        </table>
                    </div>
                </div>
                <form method="POST" action="/pedido">
                    {{ csrf_field() }}
                    <div class="panel panel-primary">
                        <div class="panel-heading">Observação</div>
                            <div class="panel-body">
                                <textarea rows="4" cols="56" name="observacao"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="float:right; margin-right: 330px">
                          Adicionar pedido
                    </button>
                </form>
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

   $(".glyphicon").on("click", function () {
        var id = $(this).attr('id');
        var tr = $(this).closest('tr');
        var carrinho = {{Session::get('cart')}};
        

        $.ajax({
            type: 'get',
            url: '/removeAjax',
            data: {
                'item': id,
                'carrinho':carrinho,
            },
            success: function(data) {
                tr.remove();
            }
        });
        
   });
    
    $(function() {
        $(document).on("click", 'button[class^="btn btn-success"]',function(){
            var value=$(this).attr("value");
            var qtd = $('#qtd' + value).val();
            var cod = $(this).attr("codigo");
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
                    'id_carrinho':carrinho,
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
