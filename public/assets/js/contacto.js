window.onload=iniciar;
console.log("¡¡js contacto funciona!!");

function iniciar(){
    $('#enviar-contacto').click(comprobar);
}


function comprobar(){
    var nombre= $('#nombre').val();
    var apellidos= $('#apellidos').val();
    var telefono= $('#telefono').val();
    var correo= $('#correo').val();
    var asunto= $('#asunto').val();
    var mensaje= $('#mensaje').val();
    
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
                
            }
        });
    }
    
}

function limpiar_div_error(){
    $('.error-form').html("");
}