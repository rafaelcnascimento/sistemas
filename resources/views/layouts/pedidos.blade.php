@extends('layouts.base')
@section('content')
    <div class="container">
        @foreach ($pedido->materials as $material)
            <h3>{{$material->codigo}}</h3>
        @endforeach
    </div>    
@endsection
