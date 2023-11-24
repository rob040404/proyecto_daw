@extends('app')
@section('titulo', 'Gestión de menús')
@section('content')
<script type="text/javascript" src="../public/assets/js/gestion_de_menus.js"></script>
<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
        
    
      <!--<div class="menu-carta">
        
        <div class="formulario_carta">
            <div class="precio">Precio:</div>
            <div class="estado">Estado:</div>
            <div class="guardar-wrapper">
              <div class="guardar">Guardar</div>
            </div>
            <div class="nueva-reserva-child"></div>
            <div class="nueva-reserva-item"></div>
            <div class="nueva-reserva-inner"></div>
            <div class="sub-categora-wrapper">
              <div class="sub-categora">Sub-categoría:</div>
            </div>
            <div class="frame-div"></div>
            <div class="ingredientes">Ingredientes:</div>
            <div class="nueva-reserva-child1"></div>
            <div class="nueva-reserva-child2"></div>
            <div class="nueva-reserva-child3"></div>
            <div class="nueva-reserva-child4"></div>
            <div class="categora">Categoría:</div>
            <div class="nueva-reserva-child5"></div>
            <div class="nombre-wrapper">
              <div class="guardar">Nombre:</div>
            </div>
            <div class="aadir-nuevo-producto">Añadir nuevo producto</div>
        </div>
      </div>-->
      <div class="botones">
        <button class="boton-anadir" type="button" name="desplegar-anadir" id="desplegar-anadir">
          <div class="texto-gm">Añadir nuevo producto</div>
        </button>
        <button class="boton-activar" type="button" name="desplegar-activar" id="desplegar-activar">
          <div class="texto-gm">
            <p class="activardesactivar">Activar/desactivar</p>
            <p class="activardesactivar">producto</p>
          </div>
        </button>
        <button class="boton-borrar" type="button" name="desplegar-borrar" id="desplegar-borrar">
          <div class="texto-gm">Borrar producto</div>
        </button>
        <button class="boton-buscar" type="button" name="desplegar-buscar" id="desplegar-buscar">
          <div class="texto-gm">Buscar por nombre</div>
        </button>
        <button class="boton-ver" type="button" name="desplegar-ver" id="desplegar-ver">
          <div class="texto-gm">Ver por categoría</div>
        </button>
      </div>
      <div class="contenedor_opciones">
        <div class="aadir-nuevo-producto">Añadir nuevo producto</div>
        <form id="formlogin" method="POST" name="formlogin" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq"><br>
                        <label for="nombre" class="texto-gm etiqueta-izq">Ingredientes:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq"><br>
                    
                </div>
                <div class="anadir-der">
                    
                        <label for="categoria" class="texto-gm elemento-form-der">Categoría:</label><br>
                        <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der"><br>
                        <label for="categoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>
                        <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der">
                        <div class="contenedor-precio-estado">
                            <div class="subcontenedor-precio">
                                <label for="nombre" class="texto-gm etiqueta-izq">Precio:</label><br>
                                <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der"><br>
                            </div>
                            <div class="subcontenedor-estado">
                                <label for="categoria" class="texto-gm elemento-form-der">Estado:</label><br>
                                <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der"><br>
                            </div>
                        </div>
                    
                </div>
            
            </div>
        </form>
      </div>
      
</div>
@endsection

