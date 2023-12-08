$(document).ready(function () {
    $(".botondisquete").click(modificarUsuario);
    $(".botonpapelera").click(eliminarUsuario);
    $(".botonlapiz").click(mostrarInput);
});

function mostrarInput(e){
    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent();
    let celdas=$(fila).children(); 
    //let campo=$(celdas[4]).children()[0];
    for (let i = 1; i <= 5; i++) {
        let campo=$(celdas[i]).children()[0];
        //$(campo).toggleClass(...);
        //$(...).removeAttr("disabled");
        $(campo).removeClass('input-interior-disabled').addClass('input-interior-enabled');
        $(campo).removeAttr('disabled');
    }
    let disquete=$(celdas[6]).children()[1];
    $(this).hide();
    //$(campo).show();
    $(disquete).show();
}

function modificarUsuario(){
    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent(); //Este es el elemento tr que corresponde a cada producto
    let celdas=$(fila).children(); // Los elementos td que estan dentro de cada fila
    let idusuario=$(celdas[0]).text().trim(); // Texto que hay en la primera celda td con el id del producto
    let nombre = $($(celdas[1]).children()[0]).val(); //Obtenemos el texto que hay dentro de cada campo.
    let apellidos = $($(celdas[2]).children()[0]).val();
    let contrasena = $($(celdas[3]).children()[0]).val();
    let puesto = $($(celdas[4]).children()[0]).val();
    let email = $($(celdas[5]).children()[0]).val();
    let disquete=$(celdas[6]).children()[1];
    let lapiz=$(celdas[6]).children()[0];
    console.log('Vamos a modificar el usuario '+idusuario + ' con los valores: '+ nombre, apellidos, contrasena, puesto, email);
    $.ajax({
        type: "POST",
        url: "gestion_de_personal.php",
        contentType: "application/x-www-form-urlencoded",
        data: { "actualizarDatos": true, "iduser": idusuario, "nombre": nombre, "apellidos": apellidos,
                "contrasena": contrasena, "puesto": puesto, "email": email },
        success: function (response) {
            //muestraPista(response.letra);
            console.log(response);
            if (response.resultado) {
                alert ("Modificado!");
                for (let i = 1; i <= 5; i++) {
                let campo=$(celdas[i]).children()[0];
                //$(campo).toggleClass(...);
                //$(...).removeAttr("disabled");
                $(campo).removeClass('input-interior-enabled').addClass('input-interior-disabled');
                $(campo).prop('disabled', true);
            }
            $(lapiz).show();
            $(disquete).hide();
            } else {
                alert("Error: "+response.mensaje);
                
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function eliminarUsuario(){
    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent(); //Este es el elemento tr que corresponde a cada producto
    let celdas=$(fila).children(); // Los elementos td que estan dentro de cada fila
    let idusuario=$(celdas[0]).text().trim(); // Texto que hay en la primera celda td con el id del producto
    //let disquete=$(celdas[6]).children()[1];
    //let lapiz=$(celdas[6]).children()[0];
    if (!confirm("Seguro?")){
        console.log("cancelado");
        return;
    }
    console.log('Vamos a borrar el usuario '+idusuario);
    $.ajax({
        type: "POST",
        url: "gestion_de_personal.php",
        contentType: "application/x-www-form-urlencoded",
        data: { "borrarUsuario": true, "iduser": idusuario},
        success: function (response) {
            //muestraPista(response.letra);
            console.log(response);
            if (response.resultado) {
                alert ("Eliminado!");
                //tiene que desaparecer la fila entera. BUSCAR EL METODO
                $(fila).remove();
            } else {
                alert("Error: "+response.mensaje);
                //los admin no se pueden borrar
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}