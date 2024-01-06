@extends('app')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="./assets/css/pedidos_pendientes.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
@endsection

@section('titulo', 'Pedidos')
@section('content')

<div class="pedidos">
    @if($ok=='Confirmado')
    <h1 class="mensaje">Pedido confirmado!</h1>
    @elseif ($ok=='Completado')
    <h1 class="mensaje">Pedido completado!</h1>
    @elseif ($ok=='faltaStock')
    <h1 class="mensaje">Faltan ingredientes: {{$faltan}}</h1>
    @endif
    <h1 class="h1">Pedidos pendientes</h1>
    <div class="tabla-pedidos">
        <table class="tabla">
            <tr class="th">
                <td scope="col">Código de pedido</td>
                <td scope="col">Número de mesa</td>
                <td scope="col">Estado</td>
                <td scope="col">
                    <img class="botonlapiz" src="assets/img/cook.png" alt="" width="35" height="35">
                    <img class="botonlapiz" src="assets/img/serve.png" alt="" width="40" height="35">

                </td>
            </tr>
            @foreach($pedidos as $pedido)
            <form name="pedidos" method="POST" action="pedidos_pendientes.php">
                <input type="hidden" name="id_pedido" value="{{$pedido -> getIdPedido()}}" />
                <tr>
                    <td>{{$pedido -> getIdPedido()}}</td>
                    <td>{{$pedido -> getMesa()}}</td>
                    <td>{{$pedido -> getEstadoPedido()}}</td>
                    <td>
                        @if ('Pendiente'==$pedido -> getEstadoPedido())
                        <button name="cocinar">Cocinar</button>
                        @elseif ('Confirmado'==$pedido -> getEstadoPedido())
                        <button name="servir">Servir</button>
                        @endif
                    </td>
                </tr>
            </form>
            @endforeach
        </table>
    </div>

</div>

</body>

@endsection