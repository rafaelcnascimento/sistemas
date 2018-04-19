@extends('layouts.base')
@section('content')
<div class="container">
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
                        <td><a class="btn btn-primary" href="/material/{{$material->id}}">Editar</a></td>
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
</script>    
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
