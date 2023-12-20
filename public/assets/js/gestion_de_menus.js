window.onload=iniciar;
console.log("¡¡js destion_de_menus funciona!!");

function iniciar(){
    document.getElementById('desplegar-activar').addEventListener('click', form_activar_desactivar);
    document.getElementById('desplegar-anadir').addEventListener('click', form_anadir);
    
    document.getElementById('desplegar-borrar').addEventListener('click', form_borrar);
    document.getElementById('desplegar-ver').addEventListener('click', form_ver);
    document.getElementById('desplegar-modificar').addEventListener('click', form_modificar);
}


function alerta(){
    alert('Has pulsado el botón Activar');
}
function form_activar_desactivar(){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir">Activar/desactivar producto</div><br><br>'+
        '<form id="formactivardesactivar" method="POST" name="formactivardesactivar" novalidate>'+
            '<div class="contenedor_borrar">'+
                '<label for="nombre" class="texto-gm">Buscar por Nombre:</label><br>'+
                '<input type="text" name="nombreActivar" id="nombreActivar" class="rectangulo-input-centro" maxlength="30"><br><br>'+
                '<div class="aadir-nuevo-producto incorrecto-form" id="intro-incorrecta"></div><br>'+
                '<button type="button" class="guardar-wrapper" name="buscar-por-nombre" id="buscar-por-nombre">'+
                    '<div class="guardar" >Buscar</div>'+
                '</button><br><br>'+
                '<div class="aadir-nuevo-producto correcto-form" id="intro-correcta"></div><br>'+
                
                
                '<label for="nombre" class="texto-gm">Buscar por Categorías:</label><br>'+
                '<select type="text" name="categoria-borrar" id="categoria-borrar" class="rectangulo-borrar categoria-borrar">'+
                    '<option value="todos">Todos</option>'+
                    '<option value="entrante">Entrante</option>'+
                    '<option value="principal">Principal</option>'+
                    '<option value="postre">Postre</option>'+
                    '<option value="bebida">Bebida</option>'+
                '</select><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="buscar-por-categoria" id="buscar-por-categoria">Buscar</div>'+
                '</button><br><br>'+
            '</div>'+
        '</form>';
    document.getElementById('contenedor_opciones').innerHTML=contenido;
    document.getElementById('buscar-por-nombre').addEventListener('click', ajax_activar);
}
function ajax_activar(){
    var nom= $('#nombreActivar').val();
    var error=false;
    nom=nom.toLowerCase();
    
   
    if(!nom){
        $('#intro-incorrecta').html('Introduce un nombre');
        error=true;
    }
    
    if(error===false){
        $.ajax({
            type: 'POST',
            url: 'gestion_de_menus.php',
            data: {nombreActivar:nom},
            datatype: 'json',
            success: function(response){
                if(response.error){
                     $('#intro-incorrecta').html('');
                     $('#intro-incorrecta').html('No se ha encontrado ningún plato con ese nombre');
                }
            }
            
            
        });
    }
    
    
    
}

function form_modificar(){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-modificar">Buscar productos</div><br><br>'+
        '<form id="formactivardesactivar" method="POST" name="formmodificar" novalidate>'+
            '<div class="contenedor_borrar">'+
                '<label for="nombre" class="texto-gm">Buscar por Nombre:</label><br>'+
                '<input type="text" name="nombreBorrar" id="nombreBorrar" class="rectangulo-input-centro" maxlength="30"><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="guardar" id="buscar-por-nombre">Buscar</div>'+
                '</button><br><br>'+
                '<label for="nombre" class="texto-gm">Buscar por Categorías:</label><br>'+
                '<select type="text" name="categoria-borrar" id="categoria-borrar" class="rectangulo-borrar categoria-borrar">'+
                    '<option value="todos">Todos</option>'+
                    '<option value="entrante">Entrante</option>'+
                    '<option value="principal">Principal</option>'+
                    '<option value="postre">Postre</option>'+
                    '<option value="bebida">Bebida</option>'+
                '</select><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="buscar-por-categoria" id="buscar-por-categoria">Buscar</div>'+
                '</button><br><br>'+
            '</div>'+
        '</form>';
    document.getElementById('contenedor_opciones').innerHTML=contenido;
}
function form_ver(){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir">Buscar productos</div><br><br>'+
        '<form id="formactivardesactivar" method="POST" name="formactivardesactivar" novalidate>'+
            '<div class="contenedor_borrar">'+
                '<label for="nombre" class="texto-gm">Buscar por Nombre:</label><br>'+
                '<input type="text" name="nombreBorrar" id="nombreBorrar" class="rectangulo-input-centro" maxlength="30"><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="guardar" id="buscar-por-nombre">Buscar</div>'+
                '</button><br><br>'+
                '<label for="nombre" class="texto-gm">Buscar por Categorías:</label><br>'+
                '<select type="text" name="categoria-borrar" id="categoria-borrar" class="rectangulo-borrar categoria-borrar">'+
                    '<option value="todos">Todos</option>'+
                    '<option value="entrante">Entrante</option>'+
                    '<option value="principal">Principal</option>'+
                    '<option value="postre">Postre</option>'+
                    '<option value="bebida">Bebida</option>'+
                '</select><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="buscar-por-categoria" id="buscar-por-categoria">Buscar</div>'+
                '</button><br><br>'+
            '</div>'+
        '</form>';
    document.getElementById('contenedor_opciones').innerHTML=contenido;
}
function form_borrar(){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir">Borrar producto</div><br><br>'+
        '<form id="formanadir" method="POST" name="formanadir" novalidate>'+
            '<div class="contenedor_borrar">'+
                '<label for="nombre" class="texto-gm">Buscar por Nombre:</label><br>'+
                '<input type="text" name="nombreBorrar" id="nombreBorrar" class="rectangulo-input-centro" maxlength="30"><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="guardar" id="borrar-por-nombre">Borrar</div>'+
                '</button><br><br>'+
                '<label for="nombre" class="texto-gm">Buscar por Categorías:</label><br>'+
                '<select type="text" name="categoria-borrar" id="categoria-borrar" class="rectangulo-borrar categoria-borrar">'+
                    '<option value="todos">Todos</option>'+
                    '<option value="entrante">Entrante</option>'+
                    '<option value="principal">Principal</option>'+
                    '<option value="postre">Postre</option>'+
                    '<option value="bebida">Bebida</option>'+
                '</select><br><br>'+
                '<button type="button" class="guardar-wrapper">'+
                    '<div class="guardar" name="buscar" id="buscar">Buscar</div>'+
                '</button><br><br>'+
            '</div>'+
        '</form>';
    document.getElementById('contenedor_opciones').innerHTML=contenido;
}

function form_anadir(){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir"><p>Añadir nuevo producto</p></div>'+
            
        '<form id="formanadir" method="POST" name="formanadir" novalidate>'+
            '<div class="contenedor-anadir">'+
            
               ' <div class="anadir-izq">'+
                    
                        '<label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>'+
                        '<input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30">'+
                        '<div class="error-form elemento-form-izq etiqueta-izq"id="error-nombre"></div><br>'+
                        '<label for="descripcion" class="texto-gm etiqueta-izq">Descripción:</label><br>'+
                        '<textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea elemento-form-izq"></textarea>'+
                        '<div class="error-form elemento-form-izq etiqueta-izq"id="error-descripcion"></div><br>'+
                        
                '</div>'+
                '<div class="anadir-der">'+
                    
                        '<label for="categoria" class="texto-gm elemento-form-der" >Categoría:</label><br>'+
                        //'<input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der" maxlength="30"><br>+
                        '<select type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der">'+
                            '<option value="no" selected>Seleccionar una opción</option>'+
                            '<option value="entrante">Entrante</option>'+
                            '<option value="principal">Principal</option>'+
                            '<option value="postre">Postre</option>'+
                            '<option value="bebida">Bebida</option>'+
                            '<option value="otro">Otro</option>'+
                        '</select>'+
                        '<div id="error-categoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>'+
                        
                        '<div id="sub-container">'+
                            
                        '</div>'+
                        
            //'<input type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der" maxlength="30">'+
                        '<div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div><br>'+
                        '<div class="contenedor-precio-estado">'+
                            '<div class="subcontenedor-precio">'+
                                '<label for="precio" class="texto-gm etiqueta-izq elemento-form-der">Precio:</label><br>'+
                                '<input type="text" name="precio" id="precio" class="rectangulo-pequeno elemento-form-der" maxlength="8">'+
                                '<div id="error-precio" class="error-form etiqueta-der elemento-form-der"></div><br>'+
                                
                           ' </div>'+
                            '<div class="subcontenedor-estado">'+
                                '<label for="estado" class="texto-gm elemento-form-der">Estado:</label><br>'+
                                '<select type="text" name="estado" id="estado" class="rectangulo-pequeno elemento-form-der">'+
                                     '<option value="activado">Activado</option>'+
                                     '<option value="desactivado">Desactivado</option>'+
                                '</select>'+
                                '<br><div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div>'+
                                '<br><br>'+
                                
                            '</div>'+
                       ' </div> '+
               ' </div>'+
               '<div class="encabezado-selec-ing" id="encabezado-titulo-ing"><p>Seleccionar ingredientes y unidades</p></div><br>'+
               
                '<div class="conteiner-ingredientes">'+
                
                   ' <p>'+ 
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" id=lechuga name="lechuga" value="Lechuga" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Pollo: <input type="checkbox" id="pollo" name="pollo" value="Pollo" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Tortita: <input type="checkbox" id="tortita" name="tortita" value="Tortita" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label>'+
                    '</p>'+
                    
                '</div>'+
                '<div class="aadir-nuevo-producto incorrecto-form" id="ing-incorrectos"></div><br>'+
            '</div>'+
            //'<div class="aadir-nuevo-producto">'+
               
                //'<label for="nombre" class="texto-gm "><h4>Otros:</h4></label><br>'+
                //'<textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea-otros"></textarea><br>'+
                
            //'</div>'+
            '<div class="aadir-nuevo-producto correcto-form" id="intro-correcta"></div><br>'+
            '<div class="aadir-nuevo-producto incorrecto-form" id="intro-incorrecta"></div><br>'+
            '<div class="container-botones-form">'+
                '<button type="button" href="#modificar" class="guardar-wrapper-anadir name="guardar" id="guardar"">'+
                    '<div class="guardar" >Guardar</div>'+
                '</button>'+
                '<button type="button" class="guardar-wrapper-anadir" name="limpiar" id="limpiar">'+
                    '<div class="guardar">Limpiar</div>'+
                '</button>'+
           ' </div>'+
        '</form>';

        document.getElementById("contenedor_opciones2").innerHTML=contenido;
        document.getElementById('guardar').addEventListener('click', ajax_anadir);
        document.getElementById('limpiar').addEventListener('click', limpiar_campos_anadir);
        document.getElementById('categoria').addEventListener('change', obtener_categoria);
        
        
}
function obtener_ingredientes(){
    var arrayIngredientes= new Array();
    var errorUds=false;
    var boxes=document.getElementsByClassName('box');
    var uds=document.getElementsByClassName('rectangulo-unidades');
    var patron_uds= /^[0-9]{1,2}\.{0,1}[0-9]{0,3}$/;
    for(let i=0; i<boxes.length; i++){
        if(boxes[i].checked && uds[i]){
            if(!patron_uds.test(uds[i].value.trim())){
                errorUds=true;
                break;
            }else{
                arrayIngredientes.push(new Array(boxes[i].value, uds[i].value));
                //arrayIngredientes[boxes[i].value]=uds[i].value;
            }
        }
    }
    
    
    var longitudArray=arrayIngredientes.length;
    if(!errorUds){
        return arrayIngredientes;
    }else{
        return false;
    }
}
function ajax_anadir(){
    
    var nom= $('#nombre').val();
    var des=$('#descripcion').val();
    var cat=$('#categoria').val();
    var sub= $('#subcategoria').val();
    var pre=$('#precio').val();
    var es=$('#estado').val();
    
    //Obtener ingredientes
    var arrayIngredientes= obtener_ingredientes();
    
    nom= nom.toLowerCase();
    pre=pre.trim(pre);
    pre=pre.replace(',','.');
    //pre=parseFloat(pre);
    var patron_precio= /^[0-9]{1,2}\.[0-9]{2}$/;
    
    limpiar_div_error();
    var error_validacion=false;
        if(!nom){
            $('#error-nombre').html('Campo obligatorio');
            error_validacion=true;
        }else if(nom.length<2){
            $('#error-nombre').html('El nombre debe tener 2 o más caractéres');
            error_validacion=true;
        }
        if(!des && cat!=='bebida'){
            $('#error-descripcion').html('Campo obligatorio');
            error_validacion=true;
        }else if(cat!=='bebida' && des.length<10){
            $('#error-descripcion').html('Escribe una descripción de al menos 10 caracteres');
            error_validacion=true;
        }
        if(cat==='no'){
            $('#error-categoria').html('Debes seleccionar una de las opciones');
            error_validacion=true;
        }
        if(sub==='no'){
           $('#error-subcategoria').html('Debes seleccionar una de las opciones');
            error_validacion=true; 
        }
        if(!pre){
            $('#error-precio').html('El formato debe ser de este tipo 10.99 Hasta 99.99');
            error_validacion=true;
        }else if(!patron_precio.test(pre)){
            $('#error-precio').html('El formato debe ser de este tipo 10.99 Hasta 99.99');
            error_validacion=true;
        }
        
        if(arrayIngredientes===false){
            $('#ing-incorrectos').html('Si seleccionas un ingrediente pon la cantidad: Número de 0 a 99, con hasta 3 decimales. ¡SIN ESPACIOS EN BLANCO!');
            error_validacion=true;
        }
    if(error_validacion===false){
        $.ajax({
            type: 'POST',
            url: 'gestion_de_menus.php',
            data: {nombre: nom, 
                   descripcion: des,
                   categoria: cat,
                   subcategoria: sub,
                   precio: pre,
                   estado: es,
                   ingredientes: arrayIngredientes
            },
            datatype: 'json',
            success: function (response){
                
                if(response.existe){
                    $('#ing-incorrectos').html('');
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('');
                    $('#intro-incorrecta').html('Este plato ya existe');
                }else if(response.errores){
                    $('#ing-incorrectos').html('');
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('');
                    $('#intro-incorrecta').html('No se ha podido introducir el plato');
                }else{
                    $('#ing-incorrectos').html('');
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('Plato introducido con éxito');
                    limpiar_campos_anadir();
                }
                
                if(!response.errores && !response.error && response.errorIngredientes){
                    $('#intro-incorrecta').html('Pero no se han guardado los ingredientes');
                }
            
            
            }
        });
    }
}

function limpiar_containers(){
    document.getElementById("contenedor_opciones").innerHTML="";
    document.getElementById("contenedor_opciones2").innerHTML="";
}
function limpiar_div_error(){
    $('.error-form').html("");
}

function limpiar_campos_anadir(){
    document.getElementById("formanadir").reset();
}

function obtener_categoria(){
    var cat=$('#categoria').val();
    var sub_principal='<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der">'+
                                '<option value="no" selected>Seleccionar una opción</option>'+
                                '<option value="tacos">Tacos</option>'+
                                '<option value="fajitas">Fajitas</option>'+
                                '<option value="ensaladas">Ensaladas</option>'+
                                '<option value="quesadillas">Quesadillas</option>'+
                                '<option value="gringas">Gringas</option>'+
                                '<option value="cuchara">De cuchara</option>'+
                                '<option value="otro">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
    var sub_entrante= '<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der">'+
                                '<option value="no" selected>Seleccionar una opción</option>'+
                                '<option value="nachos">Nachos</option>'+
                                '<option value="flautas">Flautas</option>'+
                                '<option value="quesos">Quesos</option>'+
                                '<option value="enchiladas">Enchiladas</option>'+
                                '<option value="otro">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
    var sub_postre= '<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der">'+
                                '<option value="no" selected>Seleccionar una opción</option>'+
                                '<option value="nachos">Tartas</option>'+
                                '<option value="sorbetes">Sorbetes</option>'+
                                '<option value="helados">Helados</option>'+
                                '<option value="otro">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
            
    var sub_bebida='<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der">'+
                                '<option value="no" selected>Seleccionar una opción</option>'+
                                '<optgroup label="Sin alcohol">'+
                                    '<option value="zumos">Zumos</option>'+
                                    '<option value="refrescos">Refrescos</option>'+
                                    '<option value="limonadas">Limonadas</option>'+
                                    '<option value="cafe">Cafés</option>'+
                                '</optgroup>'+
                                '<optgroup label="Alcoholicas">'+
                                    '<option value="cervezas">Cervezas</option>'+
                                    '<option value="vinos">Vinos</option>'+
                                    '<option value="tequilas">Tequilas</option>'+
                                    '<option value="ginebra">Ginebra</option>'+
                                    '<option value="ron">Ron</option>'+
                                    '<option value="whisky">Whisky</option>'+
                                '</optgroup>'+
                                '<optgroup label="Cocteles">'+   
                                    '<option value="margaritas">Margaritas</option>'+
                                    '<option value="mezcales">Mezcales</option>'+
                                    '<option value="cocteles">Otros Cócteles</option>'+
                                '</optgroup>'+
                                '<optgroup label="Otros">'+ 
                                    '<option value="otro">Otro</option>'+
                                '</optgroup>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
            
    if(cat==="entrante"){
        document.getElementById('sub-container').innerHTML=sub_entrante;
    }else if(cat==='principal'){
        document.getElementById('sub-container').innerHTML=sub_principal;
    }else if(cat==="postre"){
        document.getElementById('sub-container').innerHTML=sub_postre;
    }else if(cat==="bebida"){
        document.getElementById('sub-container').innerHTML=sub_bebida;
    }
    
    
    
}

