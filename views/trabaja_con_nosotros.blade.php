@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/GestinDeMenscartaAlPulsarAadir.css"/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../public/assets/js/trabaja.js"></script>
@endsection
@section('titulo', 'Trabaja con nosotros')
@section('content')
<div class="gestin-de-menscarta-al-puls">
    
    <div class="contenedor_form_trabaja" id="contenedor_form_trabaja">
        <div class="aadir-nuevo-producto" id="encabezado-anadir">Envíanos tu información</div>
        <div class="aadir-nuevo-producto correcto-form" id="correo-correcto"></div>
        <div class="aadir-nuevo-producto incorrecto-form" id="correo-incorrecto"></div>
        <form id="form-trabaja" method="POST" action="trabaja_con_nosotros.php" name="form-trabaja" enctype="multipart/form-data" novalidate>
            <div class="contenedor-anadir">
            
                <div class="anadir-izq">
                    
                        <label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>
                        <input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-nombre"></div><br>
                        <label for="categoria" class="texto-gm etiqueta-izq" >Apellidos:</label><br>
                        <input type="text" name="apellidos" id="apellidos" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-apellidos"></div><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">Teléfono:</label><br>
                        <input type="text" name="telefono" id="telefono" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-telefono"></div><br>
                        <label for="telefono" class="texto-gm etiqueta-izq">E-mail:</label><br>
                        <input type="text" name="correo" id="correo" class="rectangulo-input elemento-form-izq" maxlength="30">
                        <div class="error-form elemento-form-izq etiqueta-izq"id="error-correo"></div><br>
                        
                        
                    
                </div>
                <div class="anadir-der">
                        <label for="mensaje" class="texto-gm etiqueta-der elemento-form-der">Mensaje:</label><br>
                        <textarea type="text" name="mensaje" id="mensaje" class="rectangulo-textarea-trabaja elemento-form-der"></textarea>
                        <div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div><br>
                        <label for="mensaje" class="texto-gm etiqueta-der elemento-form-der">Adjunta tu currículum: </label><br>
                        
                        <input type="file" accept=".pdf" class="elemento-form-der guardar bot" name="archivo" id="archivo"/>
                        <div id="error-fichero" class="error-form etiqueta-der elemento-form-der"></div>
                       <div class="contenedor-precio-estado">
                            <div class="subcontenedor-precio">
                                <button type="reset" class="guardar-wrapper-trabaja elemento-form-der bot">
                                    <div class="guardar" name="reset" id="reset">Limpiar</div>
                                </button>
                            </div>
                           
                            <div class="subcontenedor-estado">
                                
                                <button type="submit" class="guardar-wrapper-trabaja elemento-form-der bot" id="enviar-trabaja">
                                    <div class="guardar" name="enviar-trabaja" id="enviar-trabaja">Enviar</div>
                                </button>
                                
                            </div>
                        </div>
                        
                </div>
            </div>
            
            </form>
    </div>    
</div>  


@endsection

