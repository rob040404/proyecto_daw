@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<script type="text/javascript" src="../public/assets/js/gestion_de_menus.js"></script>
@endsection
@section('titulo', 'Gestión de carta')

@section('content')

<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
      
      <div class="botones">
          <a href="#modificar"><button class="boton-anadir" type="button" name="desplegar-anadir" id="desplegar-anadir" >
            <div class="texto-gm">Añadir nuevo producto</div>
          </button></a>
        <a href="#modificar"><button class="boton-activar" type="button" name="desplegar-activar" id="desplegar-activar">
          <div class="texto-gm">
            <p class="activardesactivar">Activar/desactivar</p>
            <p class="activardesactivar">producto</p>
          </div>
            </button></a>
        <a href="#modificar"><button class="boton-borrar" type="button" name="desplegar-borrar" id="desplegar-borrar">
          <div class="texto-gm">Borrar producto</div>
            </button></a>
        <a href="#modificar"><button class="boton-buscar" type="button" name="desplegar-modificar" id="desplegar-modificar">
          <div class="texto-gm" id="modificar">Modificar producto</div>
            </button></a>
        <a href="#modificar"><button class="boton-ver" type="button" name="desplegar-ver" id="desplegar-ver">
            <div class="texto-gm" id="ver">Buscar producto/s</div>
            </button></a>
      </div>
    
    <div class="contenedor_opciones" id="contenedor_opciones">
        
    </div>
      
</div>
@endsection

