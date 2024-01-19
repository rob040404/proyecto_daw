@extends('app')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
<script type="text/javascript" src="../public/assets/js/gestion_de_menus.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('titulo', 'Administracion')
@section('content')
<div class="gestin-de-menscarta-al-puls">   
    <div class="contenedor-bot-coc">
        <div class="container-botones-izq">
            <a href="pagina_de_inventario.php">
                <button class="boton-inventario-cocinero bot" type="button" name="inventario" id="inventario">
                    <div class="texto-gm">Gesti&oacute;n de inventario</div>
                </button>
            </a>
        </div>
        <div class="container-botones-der">
            <a href="gestion_de_menus.php">
                <button class="boton-carta-cocinero bot" type="button" name="carta" id="carta">
                <div class="texto-gm" id="ver">Gesti&oacute;n de carta</div>
                </button>
            </a>
        </div>
    </div>    
</div>
@endsection