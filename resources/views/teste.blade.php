<!DOCTYPE html>
<html>
<head>
  <title>aaaa</title>
</head>
<body>
  @foreach ($pedidos->materials as $pedido)
    <h3>{{$pedido->id}}</h3><br>
  @endforeach
</body>
</html>
