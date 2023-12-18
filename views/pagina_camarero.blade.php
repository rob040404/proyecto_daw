@extends('app')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
@endsection
@section('titulo', 'Administracion')
@section('content')

<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <div class="contenedor-bot-coc">
        
        <div class="container-botones-izq">
            <a href="gestion_de_pedidos.php"><button class="boton-pedidos-camarero" type="button" name="pedidos" id="pedidos">
            <div class="texto-gm">Pedidos pendientes</div>
            </button></a>
        </div>
        <div class="container-botones-der">
            <a href="reservas.php"><button class="boton-reservas-camarero" type="button" name="reservas" id="reservas">
            <div class="texto-gm" id="ver">Reservas de mesas</div>
            </button></a>
        </div>
    </div>
          
</div>
@endsection



