@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
@section('titulo', 'Contacto')
@endsection
@section('content')
<div class="gestin-de-menscarta-al-puls">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <div class="contenedor_form_trabaja" id="contenedor_form_trabaja">
        <div class="aadir-nuevo-producto" id="encabezado-anadir">Envíanos un crorreo</div>
        <form id="formanadir" method="POST" name="formanadir" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="categoria" class="texto-gm etiqueta-izq" >Apellidos:</label><br>
                        <input type="text" name="apellidos" id="apellidos" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">Teléfono:</label><br>
                        <input type="text" name="telefono" id="telefono" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">E-mail:</label><br>
                        <input type="text" name="correo" id="correo" class="rectangulo-input elemento-form-izq" maxlength="30"><br>
                        
                        
                    
                </div>
                <div class="anadir-der">
                        <label for="telefono" class="texto-gm etiqueta-der elemento-form-der">Asunto:</label><br>
                        <input type="text" name="correo" id="correo" class="rectangulo-input elemento-form-der" maxlength="30"><br>
                        <label for="mensaje" class="texto-gm etiqueta-der elemento-form-der">Mensaje:</label><br>
                        <textarea type="text" name="mensaje" id="mensaje" class="rectangulo-textarea-contacto elemento-form-der"></textarea><br><!-- comment -->
                        
                        
                        
                       <div class="contenedor-precio-estado">
                            <div class="subcontenedor-precio">
                                <button type="reset" class="guardar-wrapper-contacto elemento-form-der">
                                    <div class="guardar" name="reset" id="reset">Limpiar</div>
                                </button>
                            </div>
                           
                            <div class="subcontenedor-estado">
                                
                                <button type="button" class="guardar-wrapper-contacto elemento-form-der">
                                    <div class="guardar" name="guardar" id="enviar-trabajo">Enviar</div>
                                </button>
                            </div>
                        </div>
                        
                </div>
            </div>
            
            </form>
    </div>    
</div>  
@endsection

