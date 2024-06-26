@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<script type="text/javascript" src="../public/assets/js/gestion_de_menus.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('titulo', 'Gestión de carta')
@section('content')
<div class="gestin-de-menscarta-al-puls">
    <div class="botones">
        <a href="#modificar">
            <button class="boton-anadir bot" type="button" name="desplegar-anadir" id="desplegar-anadir" >
                <div class="texto-gm">Añadir nuevo plato</div>
            </button>
        </a>
        <a href="#modificar">
            <button class="boton-activar bot" type="button" name="desplegar-activar" id="desplegar-activar">
                <div class="texto-gm">
                    <p class="activardesactivar">Activar/desactivar</p>
                    <p class="activardesactivar">plato</p>
                </div>
            </button>
        </a>
        <a href="#modificar">
            <button class="boton-borrar bot" type="button" name="desplegar-borrar" id="desplegar-borrar">
                <div class="texto-gm">Borrar plato</div>
            </button>
        </a>
        <a href="#modificar">
            <button class="boton-buscar bot" type="button" name="desplegar-modificar" id="desplegar-modificar">
                <div class="texto-gm" id="modificar">Modificar plato</div>
            </button>
        </a>
        <a href="#modificar">
            <button class="boton-ver bot" type="button" name="desplegar-ver" id="desplegar-ver">
                <div class="texto-gm" id="ver">Ver platos</div>
            </button>
        </a>
    </div>
    <div class="contenedor_opciones" id="contenedor_opciones"></div>
    <div class="contenedor_opciones2" id="contenedor_opciones2"></div>
</div>
@endsection