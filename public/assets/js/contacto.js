window.onload=iniciar;
console.log("¡¡js contacto funciona!!");

function iniciar(){
    $('#enviar-contacto').click(comprobar);
    puntero();
}

function comprobar(){
    var nombre= $('#nombre').val();
    var apellidos= $('#apellidos').val();
    var telefono= $('#telefono').val();
    var correo= $('#correo').val();
    var asunto= $('#asunto').val();
    var mensaje= $('#mensaje').val();
    mensaje= mensaje.replace(/\r?\n/g, "<br>");
    asunto=eliminar_acentos(asunto);
    var error_validacion=false;
    var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    limpiar_div_error();
    if(!nombre){
        $('#error-nombre').html('Campo obligatorio');
        error_validacion=true;
    }else if(nombre.length<2){
        $('#error-nombre').html('El nombre debe tener 2 o más caractéres');
        error_validacion=true;
    }
    if(!apellidos){
        $('#error-apellidos').html('Campo obligatorio');
        error_validacion=true;
    }else if(apellidos.length<2){
        $('#error-apellidos').html('El apellido debe tener 2 o más caractéres');
        error_validacion=true;
    }
    if(!telefono){
        $('#error-telefono').html('Campo obligatorio');
        error_validacion=true;
    }
    if(!correo){
        $('#error-correo').html('Campo obligatorio');
        error_validacion=true;
    }else if(!validEmail.test(correo)){
        $('#error-correo').html('E-mail no válido');
        error_validacion=true;
    }
    if(!asunto){
        $('#error-asunto').html('Campo obligatorio');
        error_validacion=true;
    }
    if(!mensaje){
        $('#error-mensaje').html('Campo obligatorio');
        error_validacion=true;
    }
    if(error_validacion===false){
        $.ajax({
            type: "POST",
            url: "contacto.php",
            data: {nom: nombre, ap: apellidos, tel: telefono, cor: correo, as:asunto, men: mensaje},
            datatype: 'json',
            success: function(response){
                if(response.errores){
                    $('#correo-incorrecto').html('No se ha podido enviar el correo.<br>Puedes escribirnos desde tu propio correo a "crunchy.restaurante@gmail.com"');
                }else{
                    limpiarInputs();
                    $('#correo-correcto').html('¡Correo enviado correctamente! <br>Te atenderemos lo antes posible.');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Error Message: ' + thrownError);
            }
        });
    }
}

function limpiar_div_error(){
    $('.error-form').html("");
}

function limpiarInputs(){
    document.getElementById('nombre').value=""; 
    document.getElementById('apellidos').value=""; 
    document.getElementById('correo').value=""; 
    document.getElementById('telefono').value=""; 
    document.getElementById('asunto').value="";
    document.getElementById('mensaje').value="";
}

function puntero(){
    var bot=document.getElementsByClassName('bot');
    for(let i=0; i<bot.length; i++){
       bot[i].style.cursor='pointer';
    }
    
}

function eliminar_acentos(cadena){
    var chars={
        "á":"a", "é":"e", "í":"i", "ó":"o", "ú":"u",
        "à":"a", "è":"e", "ì":"i", "ò":"o", "ù":"u", "ñ":"n",
        "Á":"A", "É":"E", "Í":"I", "Ó":"O", "Ú":"U",
        "À":"A", "È":"E", "Ì":"I", "Ò":"O", "Ù":"U", "Ñ":"N"};
    var expr=/[áàéèíìóòúùñ]/ig;
    var res=cadena.replace(expr,function(e){return chars[e];});
    return res;
}