@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<script type="text/javascript" src="../public/assets/js/contacto.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@section('titulo', 'Contacto')
@endsection
@section('content')
<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <div class="contenedor_form_trabaja" id="contenedor_form_trabaja">
        <div class="aadir-nuevo-producto" id="encabezado-anadir">Envíanos un correo</div>
        <form id="formanadir" method="POST" name="formanadir" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq" >Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30" autocapitalize="words">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-nombre"></div><br>
                        <label for="categoria" class="texto-gm etiqueta-izq" >Apellidos:</label><br>
                        <input type="text" name="apellidos" id="apellidos" class="rectangulo-input elemento-form-izq" maxlength="30" autocapitalize="words">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-apellidos"></div><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">Teléfono:</label><br>
                        <input type="tel" name="telefono" id="telefono" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-telefono"></div><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">E-mail:</label><br>
                        <input type="email" name="correo" id="correo" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-correo"></div><br>
                        
                        
                    
                </div>
                <div class="anadir-der">
                        <label for="telefono" class="texto-gm etiqueta-der elemento-form-der">Asunto:</label><br>
                        <input type="text" name="asunto" id="asunto" class="rectangulo-input elemento-form-der" maxlength="30">
                        <div id="error-asunto" class="error-form etiqueta-der elemento-form-der"></div><br>
                        <label for="mensaje" class="texto-gm etiqueta-der elemento-form-der">Mensaje:</label><br>
                        <textarea type="text" rows="8" cols="80" name="mensaje" id="mensaje" class="rectangulo-textarea-contacto elemento-form-der"></textarea>
                        <div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div><br>
                        
                        
                        
                       <div class="contenedor-precio-estado">
                            <div class="subcontenedor-precio">
                                <button type="reset" class="guardar-wrapper-contacto elemento-form-der">
                                    <div class="guardar" name="reset" id="reset">Limpiar</div>
                                </button>
                            </div>
                           
                            <div class="subcontenedor-estado">
                                
                                <button type="button" id="enviar-contacto" class="guardar-wrapper-contacto elemento-form-der">
                                    <div class="guardar" name="enviar-contacto" >Enviar</div>
                                </button>
                            </div>
                        </div>
                        
                </div>
            </div>
            
            </form>
    </div>    
</div>  
@endsection

