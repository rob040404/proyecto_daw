@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<script type="text/javascript" src="../public/assets/js/gestion_de_menus.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <div class="contenedor_opciones2" id="contenedor_opciones2">
        <?php if(isset($activarDesactivarOn) && $activarDesactivarOn): ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Cambiar estado<th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$respuesta->nombre</td>
                    <td>$respuesta->ingredientes</td>
                    <td>$respuesta->categoria</td>
                    <td>$respuesta->subcategoria</td>
                    <td>$respuesta->precio</td>
                    <td>$respuesta->estado</td>
                    <td>
                        '<button type="button" class="guardar-wrapper">'+
                            '<div class="guardar" name="buscar-por-categoria" id="buscar-por-categoria">Buscar</div>'+
                        '</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php endif ?>
    </div>
    
      
</div>
@endsection

