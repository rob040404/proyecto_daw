$(document).ready(iniciar); 


function iniciar(){
    document.getElementById('form-trabaja').addEventListener('submit', comprobar);
    puntero();
}


function comprobar(event){
    event.preventDefault();
    event.stopImmediatePropagation();
    const form= event.target;
    var nombre= $('#nombre').val();
    var apellidos= $('#apellidos').val();
    var telefono= $('#telefono').val();
    var correo= $('#correo').val();
    var fichero= $('#archivo').val();
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
        if(!mensaje){
            $('#error-mensaje').html('Campo obligatorio');
            error_validacion=true;
        }
        if(!fichero){
            $('#error-fichero').html('Campo obligatorio');
            error_validacion=true;
        }
    
    if(error_validacion===false){
        $.ajax({
            type: "POST",
            url: "trabaja_con_nosotros.php",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
              $("#err").fadeOut();
            },
            success: function(response){
                
                if(response.errores){
                    $('#correo-incorrecto').html('No se ha podido enviar el correo.<br>Puedes escribirnos desde tu propio correo a "crunchy.restaurante@gmail.com"');
                }else{
                    limpiarInputs();
                    $('#correo-correcto').html('¡Correo enviado correctamente! <br>Te atenderemos lo antes posible.');
                }
            },
        
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
    
    document.getElementById('mensaje').value="";
}

function puntero(){
    var bot=document.getElementsByClassName('bot');
    for(let i=0; i<bot.length; i++){
       bot[i].style.cursor='pointer';
    }
    
}
