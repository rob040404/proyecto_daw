@extends('app')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="./assets/css/pedidos_pendientes.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
@endsection

@section('titulo', 'Pedidos')
@section('content')

<div class="pedidos">

    <h1 class="h1">Pedidos pendientes</h1>
    <div class="tabla-pedidos">
        <table class="tabla">
            <tr class="th">
                <td scope="col">Código de reserva</td>
                <td scope="col">Número de mesa</td>
                <td scope="col">Estado</td>
                <td scope="col">
                    <img class="botonlapiz" src="assets/img/cook.png" alt="" width="35" height="35">
                </td>
            </tr>
            @foreach($reservas as $reserva)
            <form name="reservas" method="POST" action="pedidos_pendientes.php">
                <input type="hidden" name="id_reserva" value="{{$reserva -> getId_reserva()}}" />
                <tr>
                    <td>{{$reserva -> getId_reserva()}}</td>
                    <td>{{$reserva -> getMesa()}}</td>
                    <td>{{$reserva -> getEstado()}}</td>
                    <td>
                        @if ('Aceptada'==$reserva -> getEstado())
                        <button name="cocinar">Cocinar</button>
                        @elseif ('en_preparacion'==$reserva -> getEstado())
                        <button>Servir</button>
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