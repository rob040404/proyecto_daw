$(document).ready(function () {
    $(".botondisquete").click(modificarCantidad);
    $(".botonpapelera").click(eliminarProducto);
    $(".botonlapiz").click(mostrarInput);
});


function modificarCantidad(e) { //lo que ocurre cuando se pulsa el disquete
    //e.preventDefault();
    //e.stopImmediatePropagation();
    //alert("Soy boton lapiz :)");

    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent(); //Este es el elemento tr que corresponde a cada producto
    let celdas=$(fila).children(); // Los elementos td que estan dentro de cada fila
    let idprod=$(celdas[0]).text().trim(); // Texto que hay en la primera celda td con el id del producto
    let campo=$(celdas[4]).children()[0]; // Accedemos a la cuarta celda (desde 0) y en su interior el primer hijo que es el input
    let disquete=$(celdas[4]).children()[2];
    let lapiz=$(celdas[4]).children()[1];
    let cantidad=$(campo).val(); // Lo que recogemos en el input, la cantidda que ha escrito el usuario
    console.log('Vamos a modificar el producto '+idprod+ ' con la cantidad '+cantidad);
    $.ajax({
        type: "POST",
        url: "gestion_de_inventario.php",
        contentType: "application/x-www-form-urlencoded",
        data: { "actualizarStock": true, "idproducto": idprod, "cantidad": cantidad },
        success: function (response) {
            //muestraPista(response.letra);
            console.log(response);
            if (response.resultado) {
                //MODIFICAR LA CANTIDAD
                alert ("Modificado!");
                $(celdas[3]).html(response.cantidad);
                $(lapiz).show();
                $(campo).hide();
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

function eliminarProducto(e){
    let fila=$(this).parent().parent();
    let celdas=$(fila).children();
    let idprod=$(celdas[0]).text().trim();
    if (!confirm("Seguro?")){
        console.log("cancelado");
        return;
    }
    console.log('Vamos a eliminar el producto '+idprod);
    $.ajax({
        type: "POST",
        url: "gestion_de_inventario.php",
        contentType: "application/x-www-form-urlencoded",
        data: { "eliminarStock": true, "idproducto": idprod},
        success: function (response) {
            console.log(response);
            if (response.resultado) {
                alert ("Eliminado!");
                $(celdas[3]).html(response.cantidad);


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

function mostrarInput(e){
    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent();
    let celdas=$(fila).children(); 
    let campo=$(celdas[4]).children()[0];
    let disquete=$(celdas[4]).children()[2];
    $(this).hide();
    $(campo).show();
    $(disquete).show();
}