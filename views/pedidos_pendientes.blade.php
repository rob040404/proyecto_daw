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
    <h2 class="mensaje">Pedido confirmado!</h2>
    @elseif ($ok=='Completado')
    <h2 class="mensaje">Pedido completado!</h2>
    @elseif ($ok=='faltaStock')
    <h2 class="mensaje">Faltan ingredientes: {{$faltan}}</h2>
    @elseif($ok=="NoHayPlatosPedidos")
    <h2 class="mensaje">El pedido no tiene platos asociados</h2>
    @endif
    <h1 class="h1">Pedidos pendientes</h1>
    <div class="tabla-pedidos">
        <table class="tabla">
            <tr class="th">
                <td scope="col">Código de pedido</td>
                <td scope="col">Número de mesa</td>
                <td scope="col">Fecha y hora</td>
                <td scope="col">Atendido por</td>
                <td scope="col">Estado</td>
                <td scope="col">
                    <img class="botonlapiz" src="assets/img/cook.png" alt="" width="35" height="35">
                </td>
            </tr>
            @foreach($pedidos as $pedido)
            <form name="pedidos" method="POST" action="pedidos_pendientes.php">
                <input type="hidden" name="id_pedido" value="{{$pedido -> getIdPedido()}}" />
                <tr>
                    <td>{{$pedido -> getIdPedido()}}</td>
                    <td>{{$pedido -> getMesa()}}</td>
                    <td>{{$pedido -> getFechaHoraPedido()}}</td>
                    <td>{{$pedido -> getNombreEmpleado()}}</td>
                    <td>{{$pedido -> getEstadoPedido()}}</td>
                    <td>
                        @if ('Pendiente'==$pedido -> getEstadoPedido())
                        <button class="boton-cocinar" name="cocinar">Cocinar</button>
                        @elseif ('Confirmado'==$pedido -> getEstadoPedido())
                        <button class="boton-servir" name="servir">Servir</button>
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