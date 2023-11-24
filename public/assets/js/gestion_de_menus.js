window.onload=iniciar;
console.log("¡¡js destion_de_menus funciona!!");

function iniciar(){
    document.getElementById('desplegar-activar').addEventListener('click', alerta);
    document.getElementById('desplegar-anadir').addEventListener('click', form_anadir);
}


function alerta(){
    alert('Has pulsado el botón Activar')
}

function form_anadir(){
    var contenido=""
}