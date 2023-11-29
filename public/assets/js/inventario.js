$(document).ready(function () {
    $(".botonlapiz").click(modificarCantidad);
    $(".botonpapelera").click(eliminarProducto);
});


function modificarCantidad(e) {
    //e.preventDefault();
    //e.stopImmediatePropagation();
    //alert("Soy boton lapiz :)");

    //this -> lapiz=document.getElementsByClassName('botonlapiz')[0];
    let fila=$(this).parent().parent();
    let celdas=$(fila).children();
    let idprod=$(celdas[0]).text().trim();
    let campo=$(celdas[4]).children()[0];
    let cantidad=$(campo).val();
    console.log('Vamos a modificar el producto '+idprod+ ' con la cantidad '+cantidad);
    /*$.ajax({
        type: "POST",
        url: "juego.php",
        dataType: "json",
        data: { botonpista: true },
        success: function (response) {
            muestraPista(response.letra);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });*/

}

function eliminarProducto(e){
    let fila=$(this).parent().parent();
    let celdas=$(fila).children();
    let idprod=$(celdas[0]).text().trim();
    console.log('Vamos a eliminar el producto '+idprod);
}