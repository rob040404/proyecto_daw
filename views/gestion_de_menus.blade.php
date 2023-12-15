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
    
    <div class="contenedor_opciones" id="contenedor_opciones"></div>
    <div class="contenedor_opciones2" id="contenedor_opciones2">
        <!--<div class="aadir-nuevo-producto" id="encabezado-anadir"><p>Añadir nuevo producto</p></div>
        <form id="formanadir" method="POST" name="formanadir" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="nombre" class="texto-gm etiqueta-izq">Descripción:</label><br>
                        <textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea elemento-form-izq"></textarea><br>
                        
                </div>
                <div class="anadir-der">
                    
                        <label for="categoria" class="texto-gm elemento-form-der" >Categoría:</label><br>
                        <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der" maxlength="30"><br>
                        <label for="categoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>
                        <input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der" maxlength="30"><br>
                        <div class="contenedor-precio-estado">
                            <div class="subcontenedor-precio">
                                <label for="nombre" class="texto-gm etiqueta-izq elemento-form-der">Precio:</label><br>
                                <input type="text" name="categoria" id="categoria" class="rectangulo-pequeno elemento-form-der" maxlength="8"><br>
                                
                            </div>
                            <div class="subcontenedor-estado">
                                <label for="categoria" class="texto-gm elemento-form-der">Estado:</label><br>
                                <select type="text" name="categoria" id="categoria" class="rectangulo-pequeno elemento-form-der">
                                     <option value="activado">Activado</option>
                                     <option value="desactivado">Desactivado</option>
                                </select>
                                <br><br>
                                
                            </div>
                        </div> 
                </div>
                <div class="encabezado-selec-ing" id="encabezado-titulo-ing"><p>Seleccionar ingredientes y unidades</p></div>
                <div class="conteiner-ingredientes">
                    <p> 
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    </p>
                    <p>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds: <input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    </p>
                    <p>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    </p>
                    <p>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    </p>
                    <p>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    <label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>
                    </p>
                    
                </div>
            </div>
            <div class="aadir-nuevo-producto">
               
                <label for="nombre" class="texto-gm "><h4>Otros:</h4></label><br>
                <textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea-otros"></textarea><br>
                
            </div>
            <div class="container-botones-form">
                <button type="button" class="guardar-wrapper-anadir ">
                    <div class="guardar" name="guardar" id="guardar">Guardar</div>
                </button>
                <button type="reset" class="guardar-wrapper-anadir">
                    <div class="guardar" name="reset" id="reset">Reset</div>
                </button>
            </div>
        </form>

    </div>-->
      
</div>
@endsection

