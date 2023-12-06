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
            <a href="pagina_de_inventario.php"><button class="boton-inventario-cocinero" type="button" name="inventario" id="inventario">
            <div class="texto-gm">Gestión de inventario</div>
            </button></a>
        </div>
        <div class="container-botones-der">
            <a href="gestion_de_menus.php"><button class="boton-carta-cocinero" type="button" name="carta" id="carta">
            <div class="texto-gm" id="ver">Gestión de carta</div>
            </button></a>
        </div>
    </div>
          
</div>
@endsection

