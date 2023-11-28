@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
@endsection
@section('titulo', 'Trabaja con nosotros')
@section('content')
<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <div class="contenedor_form_trabaja" id="contenedor_form_trabaja">
        <div class="aadir-nuevo-producto" id="encabezado-anadir">Añadir nuevo producto</div>
        <form id="formanadir" method="POST" name="formanadir" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="categoria" class="texto-gm elemento-form-izq" >Apellidos:</label><br>
                        <input type="text" name="apellidos" id="apellidos" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="telefono" class="texto-gm elemento-form-izq">Teléfono:</label><br>
                        <input type="text" name="telefono" id="telefono" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        
                        <button type="button" class="guardar-wrapper elemento-form-izq">
                            <div class="guardar" name="guardar" id="guardar">Guardar</div>
                        </button>
                    
                </div>
                <div class="anadir-der">
                        <label for="mensaje" class="texto-gm etiqueta-der">Mensaje:</label><br>
                        <textarea type="text" name="mensaje" id="mensaje" class="rectangulo-textarea elemento-form-der"></textarea><br>
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
                                <br>
                            </div>
                        </div>
                        <button type="reset" class="guardar-wrapper elemento-form-der">
                            <div class="guardar" name="reset" id="reset">Reset</div>
                        </button>
                </div>
            </div>
            
            </form>
    </div>    
</div>   
@endsection

