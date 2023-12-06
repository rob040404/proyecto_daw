@extends('app')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="../public/assets/css/pagina_de_administracion.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
@endsection
@section('titulo', 'Administracion')
@section('content')
<div class="admin">
    <img class="background-icon" alt="" src="../public/assets/img/background_admin@2x.png" />

    <div class="logout-wrapper">
        <div class="logout" id="logoutText">Logout</div>
    </div>
    <div class="botones">
        <div class="boton-pedidos">
            <div class="texto-botones">Pedidos pendientes</div>
        </div>
        <div class="boton-reservas">
            <div class="texto-botones">Reservas de mesas</div>
        </div>
        <a href="pagina_de_inventario.php">
            <div class="boton-inventario">
                <div class="texto-botones">Gestión de inventario</div>
            </div>
        </a>
        <a href="pagina_de_personal.php">
            <div class="boton-personal">
                <div class="texto-botones">Administracion de personal</div>
            </div>
        </a>
        <div class="boton-carta">
            <div class="texto-botones">Gestión de carta</div>
        </div>
    </div>
</div>
@endsection