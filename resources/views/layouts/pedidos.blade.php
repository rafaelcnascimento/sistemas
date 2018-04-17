@extends('layouts.base')
@section('content')
    <div class="container">
        @foreach ($pedidos as $pedido)
            <h3>{{$pedido->materials}}</h3>
        @endforeach
    </div>    
@endsection
