window.onload=iniciar;
console.log("¡¡js destion_de_menus funciona!!");

function iniciar(){
    puntero();
    document.getElementById('desplegar-activar').addEventListener('click', operacion_activar);
    document.getElementById('desplegar-anadir').addEventListener('click', obtener_stock);
    document.getElementById('desplegar-borrar').addEventListener('click', operacion_borrar);
    document.getElementById('desplegar-ver').addEventListener('click', operacion_ver);
    document.getElementById('desplegar-modificar').addEventListener('click', operacion_modificar);
}

function alerta(){
    window.alert('Funciona');
}

//Funciones para saber qué tipo de operación se va a realizar
function operacion_activar(){
    var titulo='Activar/desactivar plato';
    form_buscar('activar', titulo);
}

function operacion_ver(){
    var titulo='Ver plato/s';
    form_buscar('ver', titulo);
}

function operacion_borrar(){
    var titulo='Borrar plato/s';
    form_buscar('borrar', titulo);
}

function operacion_modificar(){
    var titulo='Modificar plato';
    form_buscar('modificar', titulo);
}

function busqueda_categoria(){
    var categoria=true;
    ajax_buscar(categoria);
}

function busqueda_nombre(){
    var categoria=false;
    ajax_buscar(categoria);
}

//Función para buscar plato/s a través del mismo formulario, pero teniendo en cuenta para qué: modificar, borrar, cambiar estado, ver platos
function form_buscar(operacion, titulo){
    limpiar_containers();
    var contenido='<p><br><br><br></p>'+
        '<div class="aadir-nuevo-producto" id="encabezado-anadir">'+titulo+'</div><br><br>'+
        '<form id="formactivardesactivar" method="POST" name="formactivardesactivar" novalidate>'+
            '<div class="contenedor_borrar">'+
                '<label for="nombre" class="texto-gm">Buscar por Nombre:</label><br>'+
                '<input type="text" name="nombreBuscar" id="nombreBuscar" class="rectangulo-input-centro" maxlength="30"><br><br>'+
                '<div class="aadir-nuevo-producto incorrecto-form" id="intro-incorrecta"></div><br>'+
                '<button type="button" class="guardar-wrapper bot" name="buscar-por-nombre" id="buscar-por-nombre">'+
                    '<div class="guardar" >Buscar</div>'+
                '</button><br><br>'+
                '<div class="aadir-nuevo-producto correcto-form" id="intro-correcta"></div><br>'+
                '<label for="nombre" class="texto-gm">Buscar por Categorías:</label><br>'+
                '<select type="text" name="categoria-buscar" id="categoria-buscar" class="rectangulo-borrar categoria-borrar bot">'+
                    '<option value="todos" selected>Todas</option>'+
                    '<option value="entrante">Entrante</option>'+
                    '<option value="principal">Principal</option>'+
                    '<option value="postre">Postre</option>'+
                    '<option value="bebida">Bebida</option>'+
                    '<option value="otro">Otro</option>'+
                '</select><br><br>'+
                '<button type="button" class="guardar-wrapper  bot" name="buscar-por-categoria" id="buscar-por-categoria">'+
                    '<div class="guardar" >Buscar</div>'+
                '</button><br><br>'+
                '<input type="hidden" id="operacion" name="operacion" value="'+operacion+'"/>'+
            '</div>'+
        '</form>';
    //Imprimimos el formulario en el contenedor opciones y al pulsarse el botón buscar se activa el ajax buscar y conecta con el servidor
    document.getElementById('contenedor_opciones').innerHTML=contenido;
    puntero();
    document.getElementById('buscar-por-nombre').addEventListener('click', busqueda_nombre);
    document.getElementById('buscar-por-categoria').addEventListener('click', busqueda_categoria);
}

/*
 * Función para pasar los datos del formulario al servidor. Para que el sevidor busque en la BD el plato correspondiente y dvuelva sus valores

 * @param {type} por_categoria, se le pasa si se está buscando el plato por nombre o por categoría
 * 
 */
function ajax_buscar(por_categoria){
    var nom= $('#nombreBuscar').val();
    var operacion= $('#operacion').val();
    var categoria= $('#categoria-buscar').val();
    var error=false;
    nom=nom.toLowerCase();
    if(!nom && !por_categoria){
        $('#intro-incorrecta').html('Introduce un nombre');
        error=true;
    }
    if(error===false){
        $.ajax({
            type: 'POST',
            url: 'gestion_de_menus.php',
            data: {nombreBuscar:nom, operacion: operacion, por_categoria:por_categoria, categoria: categoria},
            datatype: 'json',
            success: function(response){
                if(response.error){ //Si no se encuentra el plato desde el servidor, el error es true
                     $('#intro-correcta').html('');
                     $('#intro-incorrecta').html('');
                     $('#intro-incorrecta').html('No se ha encontrado ningún plato con ese nombre');
                }else if(response.operacion==='activar'){ //la operación es activar/desactivar plato
                     $('#intro-incorrecta').html('');
                     $('#intro-correcta').html(response.fila); //Imprimimos tabla de una fila o varias con los datos del platos, con botón cambiar-estado
                     puntero();
                     //En esa fila, al pulsar 'cambiar-estado', vamos a ejecutar el ajax siguiente
                     document.getElementById('cambiar-estado').addEventListener('click', ajax_cambiar_estado);
                     $('.boton-cambiar').click(ajax_cambiar_por_tabla);
                }else if(response.operacion==='ver'){ //operación es ver platos
                     $('#intro-incorrecta').html('');
                     $('#intro-correcta').html(response.fila); //Imprimimos tabla de una fila o varia con los datos del plato, sin ningún botón
                }else if(response.operacion==='borrar'){ //la operación es borrar
                     $('#intro-incorrecta').html('');
                     $('#intro-correcta').html(response.fila);//Imprimimos tabla de una fila o varias con los datos del plato, con botón borrar
                     puntero();
                     //Al pulsar el botón 'borrar-plato' activamos el ajax siguiente, solo en caso de que se haya buscado por nombre (una fila)
                     document.getElementById('borrar-plato').addEventListener('click', ajax_borrar_plato);
                     //En caso de que se haya buscado por categoría (se ha impreso tabla de varias filas
                     $('.boton-borrar1').click(ajax_borrar_por_tabla);
                }else if(response.operacion==='modificar' && !response.fila){//Sin error y la operación es modificar y busqueda por nombre
                     $('#intro-incorrecta').html('');
                     /**
                      * Llamamos la función form_modificar para imprimir el formulario para la modificación con los campos rellenos con los datos
                      * de los platos que en ese momento constan en la BD
                      */
                    var form= form_modificar(response.id_plato, response.nom, response.des, response.pre, response.ingredientes)
                    document.getElementById('contenedor_opciones').innerHTML=form;
                     //Controlamos que las opciones 'selected' sean las que están en la BD actualmente, en Categoría y en Estado
                     if(response.cat==='entrante'){
                            document.getElementById('entrante').setAttribute('selected', 'selected');
                        }else if(response.cat==='principal'){
                            document.getElementById('principal').setAttribute('selected', 'selected');
                        }else if(response.cat==='postre'){
                            document.getElementById('postre').setAttribute('selected', 'selected');
                        }else if(response.cat==='bebida'){
                            document.getElementById('bebida').setAttribute('selected', 'selected');
                        }else if(response.cat==='otro'){
                            document.getElementById('otro_cat').setAttribute('selected', 'selected');
                     }
                     if(response.es==='activado'){
                         document.getElementById('activado').setAttribute('selected', 'selected');
                     }else if(response.es==='desactivado'){
                         document.getElementById('desactivado').setAttribute('selected', 'selected');
                     }
                     
                     //Función para obtener las subselección de subcategorías según la categoría seleccionada
                     obtener_categoria(); 
                     var options=document.getElementsByTagName('option');
                     //Bucle para establecer como 'selected', la subcategoría que coincide con lo que nos ha pasado la BD
                     for(let i=0; i<options.length; i++){
                         if(options[i].value===response.sub){
                             options[i].setAttribute('selected', 'selected');
                         }
                     }
                    //En caso de que el plato tenga asociados ingredientes en la tabla restar
                    if(response.arrayCantidadesIng && response.arrayNombresIng){
                        var boxes=document.getElementsByClassName('box');
                        var uds=document.getElementsByClassName('rectangulo-unidades');
                        //Buscamos qué ingredientes del plato coinciden en la lista de todos los ingredientes, para dejarlos seleccionado en el form
                        for(let i=0; i<boxes.length; i++){
                            for(let j=0; j<response.arrayNombresIng.length; j++){
                                if(boxes[i].id===response.arrayNombresIng[j]){
                                    boxes[i].setAttribute('checked', 'checked');
                                    uds[i].value=response.arrayCantidadesIng[j];
                                }
                            }
                        }
                    }
                    document.getElementById('cancelar').addEventListener('click', function(){$('#contenedor_opciones').html('');});
                    /**
                     * Una vez bien impreso el formulario de modificación, al dar al botón 'mod', activamos el ajax para modificar el plato 
                     * con los nuevos datos
                     */
                    document.getElementById('mod').addEventListener('click', ajax_modificar);
                    document.getElementById('categoria').addEventListener('change', obtener_categoria); //Al cambiar de categoría, cambia las subcategorías
                    puntero();
                }else if(response.operacion==='modificar' && response.fila){ //operación modificar y se ha seleccionado el plato por la tabla
                    $('#intro-correcta').html(response.fila);
                    puntero();
                    $('.boton-modificar').click(function(e){
                        const idModPorTabla= e.target.dataset.id;
                        
                        var nombre= $(`#nombre${idModPorTabla}`).html();
                        var descripcion=$(`#descripcion${idModPorTabla}`).html();
                        var categoria= $(`#categoria${idModPorTabla}`).html();
                        var subcategoria= $(`#subcategoria${idModPorTabla}`).html();
                        var precio= $(`#precio${idModPorTabla}`).html();
                        var estado=$(`#estado${idModPorTabla}`).html();
                        $.ajax({
                            type: 'POST',
                            url: 'gestion_de_menus.php',
                            data: {obtenerIngredientes: 'si', id_plato: idModPorTabla},
                            datatype: 'json',
                            success: function(response){
                                if(response.ingredientes){
                                    var form= form_modificar(idModPorTabla, nombre, descripcion, precio, response.ingredientes);
                                    document.getElementById('contenedor_opciones').innerHTML=form;
                                    //Controlamos que las opciones 'selected' sean las que están en la BD actualmente, en Categoría y en Estado
                                    if(categoria==='entrante'){
                                           document.getElementById('entrante').setAttribute('selected', 'selected');
                                       }else if(categoria==='principal'){
                                           document.getElementById('principal').setAttribute('selected', 'selected');
                                       }else if(categoria==='postre'){
                                           document.getElementById('postre').setAttribute('selected', 'selected');
                                       }else if(categoria==='bebida'){
                                           document.getElementById('bebida').setAttribute('selected', 'selected');
                                       }else if(categoria==='otro'){
                                           document.getElementById('otro_cat').setAttribute('selected', 'selected');
                                    }
                                    if(estado==='activado'){
                                        document.getElementById('activado').setAttribute('selected', 'selected');
                                    }else if(estado==='desactivado'){
                                        document.getElementById('desactivado').setAttribute('selected', 'selected');
                                    }                                   
                                    //Función para obtener las subselección de subcategorías según la categoría seleccionada
                                    obtener_categoria(); 
                                    var options=document.getElementsByTagName('option');
                                    //Bucle para establecer como 'selected', la subcategoría que coincide con lo que nos ha pasado la BD
                                    for(let i=0; i<options.length; i++){
                                        if(options[i].value===subcategoria){
                                            options[i].setAttribute('selected', 'selected');
                                        }
                                    }
                                   if(response.arrayCantidadesIng && response.arrayNombresIng){
                                        var boxes=document.getElementsByClassName('box');
                                        var uds=document.getElementsByClassName('rectangulo-unidades');
                                        for(let i=0; i<boxes.length; i++){
                                             for(let j=0; j<response.arrayNombresIng.length; j++){
                                                 if(boxes[i].id===response.arrayNombresIng[j]){
                                                     boxes[i].setAttribute('checked', 'checked');
                                                     uds[i].value=response.arrayCantidadesIng[j];
                                                 }
                                             }
                                         }
                                   }                                  
                                    document.getElementById('cancelar').addEventListener('click', function(){$('#contenedor_opciones').html('');});
                                    /**
                                     * Una vez bien impreso el formulario de modificación, al dar al botón 'mod', activamos el ajax para modificar el plato 
                                     * con los nuevos datos
                                     */
                                    document.getElementById('mod').addEventListener('click', ajax_modificar);
                                    document.getElementById('categoria').addEventListener('change', obtener_categoria); //Al cambiar de categoría, cambia las subcategorías
                                }
                            }
                        });
                    });  
                }
            }
        });
    }
}

//Función con ajax para la modificación de un plato
function ajax_modificar(){
    //Obtenemos valores de los campos
    var id_plato=$('#id_plato').val();
    var nom= $('#nombre').val();
    var des=$('#descripcion').val();
    var cat=$('#categoria').val();
    var sub= $('#subcategoria').val();
    var pre=$('#precio').val();
    var es=$('#estado').val();
    //Obtener ingredientes
    var arrayIngredientes= obtener_ingredientes();
    if(arrayIngredientes.length===0){
        arrayIngredientes='vacio';
    }
    nom= nom.toLowerCase();
    pre=pre.trim(pre);
    pre=pre.replace(',','.');
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
            data: {id_platoMod: id_plato,
                   nombreMod: nom, 
                   descripcionMod: des,
                   categoriaMod: cat,
                   subcategoriaMod: sub,
                   precioMod: pre,
                   estadoMod: es,
                   ingredientesMod: arrayIngredientes
            },
            datatype: 'json',
            success: function (response){  
                if(response.inexistente){//Si el plato puesto no existe, aunque en teoría no debe darse ese caso
                    //$('#ing-incorrectos').html('');
                    $('#contenedor_opciones').html('');
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('');
                    $('#intro-incorrecta').html('Este plato no existe');
                }else if(response.errores){//Si no se ha hecho la inserción
                    //$('#ing-incorrectos').html('');
                    $('#contenedor_opciones').html('');
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('');
                    $('#intro-incorrecta').html('No se ha podido modificar el plato');
                }else{
                    //$('#ing-incorrectos').html('');
                    $('#contenedor_opciones').html(form_buscar('modificar', 'Modificar plato'));
                    $('#intro-incorrecta').html('');
                    $('#intro-correcta').html('Plato actualizado con éxito');
                    limpiar_campos_anadir();
                }
                if(!response.errores && !response.error && response.errorIngredientes){
                    $('#intro-incorrecta').html('Pero no se han guardado los ingredientes');
                }
            }
        });
    }
}

//Función con ajax para borrar un plato
function ajax_borrar_plato(){
    var nom=$('#nombre').html();
    if(nom){
        $.ajax({
            type: 'POST',
            url: 'gestion_de_menus.php',
            data: {nombreBorrar:nom},
            datatype: 'json',
            success: function(response){
                if(!response.error){
                   $('#intro-correcta').html('Plato eliminado con éxito');
                }
            }
        });
    }
}

/*
 * Función para borrar un plato de la BD, cuando se ha buscado por tabla
 * @param {type} e, recoge el elemento causante del evento
 * 
 */
function ajax_borrar_por_tabla(e){
    const idBorrarPorTabla= e.target.dataset.id;
    $.ajax({
        type: 'POST',
        url: 'gestion_de_menus.php',
        data: {idBorrarPorTabla:idBorrarPorTabla},
        datatype: 'json',
        success: function(response){
             if(!response.error){
                 $(`#nombre${idBorrarPorTabla}`).html('');
                 $(`#descripcion${idBorrarPorTabla}`).html('');
                 $(`#categoria${idBorrarPorTabla}`).html('');
                 $(`#subcategoria${idBorrarPorTabla}`).html('');
                 $(`#precio${idBorrarPorTabla}`).html('');
                 $(`#estado${idBorrarPorTabla}`).html('');
                 $(`#accion${idBorrarPorTabla}`).html('');
                }   
        }
    });
}

//Función de ajax para cambiar el estado de un plato (activado/desactivado)
function ajax_cambiar_estado(){
    var est= $('#estado').html();
    var nom= $('#nombre').html();
    if(est){
        $.ajax({
            type: 'POST',
            url: 'gestion_de_menus.php',
            data: {estadoCambiar: est, nombreCambiar:nom },
            datatype: 'json',
            success: function(response){
                if(!response.error){
                    $('#estado').html(response.estadoNuevo);
                }
            }
        });
    }
}

/*
 * Función para cambiar el estado de un plato, cuando se ha buscado por tabla
 * @param {type} e, recoge el elemento causante del evento
 * 
 */
function ajax_cambiar_por_tabla(e){
    const idCambiarPorTabla= e.target.dataset.id;
    const estado=$(`#estado${idCambiarPorTabla}`).html(); 
    $.ajax({
        type: 'POST',
        url: 'gestion_de_menus.php',
        data: {idCambiarPorTabla:idCambiarPorTabla},
        datatype: 'json',
        success: function(response){
             if(!response.error){
                    $(`#estado${idCambiarPorTabla}`).html(response.estadoNuevo);
                }   
        }
    });
}

/**
 * Función para imprimir un formulario con los datos de un plato antes de ser modificado, y con él, poder modificarlos
 * @param {type} id_plato
 * @param {type} nom
 * @param {type} des
 * @param {type} pre
 * @returns {String}
 * 
 */
function form_modificar(id_plato, nom, des, pre, ingredientes){
    var contenido='<p><br><br><br></p>'+
        '<div class="aadir-nuevo-producto" id="encabezado-anadir"><p>Modificar plato</p></div>'+
        '<form id="formanadir" method="POST" name="formanadir" novalidate>'+
            '<div class="contenedor-anadir">'+
               ' <div class="anadir-izq">'+
                    '<label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>'+
                    '<input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30" value="'+nom+'">'+
                    '<div class="error-form elemento-form-izq etiqueta-izq"id="error-nombre"></div><br>'+
                    '<label for="descripcion" class="texto-gm etiqueta-izq">Descripción:</label><br>'+
                    '<textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea elemento-form-izq">'+des+'</textarea>'+
                    '<input type="hidden" id="id_plato" name="id_plato" value="'+id_plato+'"/>'+
                '</div>'+
                '<div class="anadir-der">'+
                    '<label for="categoria" class="texto-gm elemento-form-der" >Categoría:</label><br>'+
                    '<select type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der bot">'+
                        '<option value="no">Seleccionar una opción</option>'+
                        '<option value="entrante" id="entrante">Entrante</option>'+
                        '<option value="principal" id="principal">Principal</option>'+
                        '<option value="postre" id="postre">Postre</option>'+
                        '<option value="bebida" id="bebida">Bebida</option>'+
                        '<option value="otro" id="otro_cat">Otro</option>'+
                    '</select>'+
                    '<div id="error-categoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>'+
                    '<div id="sub-container">'+
                    '</div>'+
                    '<div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div><br>'+
                    '<div class="contenedor-precio-estado">'+
                        '<div class="subcontenedor-precio">'+
                            '<label for="precio" class="texto-gm etiqueta-izq elemento-form-der">Precio:</label><br>'+
                            '<input type="text" name="precio" id="precio" class="rectangulo-pequeno elemento-form-der" maxlength="8" value="'+pre+'">'+
                            '<div id="error-precio" class="error-form etiqueta-der elemento-form-der"></div><br>'+  
                       ' </div>'+
                        '<div class="subcontenedor-estado">'+
                            '<label for="estado" class="texto-gm elemento-form-der">Estado:</label><br>'+
                            '<select type="text" name="estado" id="estado" class="rectangulo-pequeno elemento-form-der bot">'+
                                 '<option value="activado" id="activado">Activado</option>'+
                                 '<option value="desactivado" id="desactivado">Desactivado</option>'+
                            '</select>'+
                            '<br><div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div>'+
                            '<br><br>'+
                        '</div>'+
                   ' </div> '+
               ' </div>'+
               '<div class="encabezado-selec-ing" id="encabezado-titulo-ing"><p>Seleccionar ingredientes y unidades</p></div><br>'+
                '<div class="conteiner-ingredientes">';
                for(let i=0; i<ingredientes.length; i++){
                    if(i===0 || i===25 || i===50 || i===75|| i===100 || i===125){
                        contenido+=' <p>';
                    }
                    contenido+='<label for="nombre" class="texto-gm etiqueta-izq check">'+ingredientes[i] +'<input type="checkbox" id="'+ingredientes[i] +'" name="'+ingredientes[i] +'" value="'+ingredientes[i] +'" class="box bot">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label><br>';
                }        
            contenido+= '</div>'+
            '<div class="aadir-nuevo-producto incorrecto-form" id="ing-incorrectos"></div><br>'+
            '</div>'+
            '<div class="aadir-nuevo-producto correcto-form" id="intro-correcta2"></div><br>'+
            '<div class="aadir-nuevo-producto incorrecto-form" id="intro-incorrecta2"></div><br>'+
            '<div class="container-botones-form">'+
                '<button type="button" href="#modificar" class="guardar-wrapper-anadir bot" name="mod" id="mod">'+
                    '<div class="guardar" >Modificar</div>'+
                '</button>'+
                '<button type="button" class="guardar-wrapper-anadir bot" name="cancelar" id="cancelar">'+
                    '<div class="guardar">Cancelar</div>'+
                '</button>'+
           ' </div>'+
        '</form>';
    return contenido;    
}

//Función para impirmir un formulario a través del cual se van  introducir platos en la BD
function form_anadir(ingredientes){
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
                        '<select type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der bot">'+
                            '<option value="no" class="bot" selected>Seleccionar una opción</option>'+
                            '<option value="entrante" class="bot">Entrante</option>'+
                            '<option value="principal" class="bot">Principal</option>'+
                            '<option value="postre" class="bot">Postre</option>'+
                            '<option value="bebida" class="bot">Bebida</option>'+
                            '<option value="otro" class="bot">Otro</option>'+
                        '</select>'+
                        '<div id="error-categoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>'+
                        '<div id="sub-container">'+
                        '</div>'+
                        '<div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div><br>'+
                        '<div class="contenedor-precio-estado">'+
                            '<div class="subcontenedor-precio">'+
                                '<label for="precio" class="texto-gm etiqueta-izq elemento-form-der">Precio:</label><br>'+
                                '<input type="text" name="precio" id="precio" class="rectangulo-pequeno elemento-form-der" maxlength="8">'+
                                '<div id="error-precio" class="error-form etiqueta-der elemento-form-der"></div><br>'+  
                           ' </div>'+
                            '<div class="subcontenedor-estado">'+
                                '<label for="estado" class="texto-gm elemento-form-der">Estado:</label><br>'+
                                '<select type="text" name="estado" id="estado" class="rectangulo-pequeno elemento-form-der bot">'+
                                     '<option value="activado" class="bot">Activado</option>'+
                                     '<option value="desactivado" class="bot">Desactivado</option>'+
                                '</select>'+
                                '<br><div id="error-mensaje" class="error-form etiqueta-der elemento-form-der"></div>'+
                                '<br><br>'+
                            '</div>'+
                       ' </div> '+
            ' </div>'+
            '<div class="encabezado-selec-ing" id="encabezado-titulo-ing"><p>Seleccionar ingredientes y unidades:</p></div><br>'+
            '<div class="conteiner-ingredientes">';
            for(let i=0; i<ingredientes.length; i++){
                if(i===0 || i===25 || i===50 || i===75|| i===100 || i===125){
                    contenido+=' <p>';
                }
                contenido+='<label for="nombre" class="texto-gm etiqueta-izq check">'+ingredientes[i] +'<input type="checkbox" id="'+ingredientes[i] +'" name="'+ingredientes[i] +'" value="'+ingredientes[i] +'" class="box bot">Uds:<input type="number" name="categoria" id="categoria" class="rectangulo-unidades" maxlength="8"></label><br>';
            }        
            contenido+= '</div>'+
            '<div class="aadir-nuevo-producto incorrecto-form" id="ing-incorrectos"></div><br>'+
            '</div>'+
            '<div class="aadir-nuevo-producto correcto-form" id="intro-correcta"></div><br>'+
            '<div class="aadir-nuevo-producto incorrecto-form" id="intro-incorrecta"></div><br>'+
            '<div class="container-botones-form">'+
                '<button type="button" href="#modificar" class="guardar-wrapper-anadir bot" name="guardar" id="guardar">'+
                    '<div class="guardar" >Guardar</div>'+
                '</button>'+
                '<button type="button" class="guardar-wrapper-anadir bot" name="limpiar" id="limpiar">'+
                    '<div class="guardar">Limpiar</div>'+
                '</button>'+
           ' </div>'+
        '</form>';
        document.getElementById("contenedor_opciones2").innerHTML=contenido;
        document.getElementById('guardar').addEventListener('click', ajax_anadir);
        document.getElementById('limpiar').addEventListener('click', limpiar_campos_anadir);
        document.getElementById('categoria').addEventListener('change', obtener_categoria);
        puntero();
}

//Función con ajax para obtener los ingredientes disponibles en stock y que salgan el el formulario añadir
function obtener_stock(){
    $.ajax({
        type: 'POST',
        url: 'gestion_de_menus.php',
        data: {obtenerStock: 'obtenerStock'},
        datatype: 'json',
        success: function(response){
            if(response.ingredientes){
                form_anadir(response.ingredientes);
            }
        }
    });
}

//Función para obtener los ingredientes seleccionados para el plato a añadir, y sus cantidades en unidades
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
            }
        }
    }
    if(!errorUds){
        return arrayIngredientes;
    }else{
        return false;
    }
}

//Función con ajax para añadir un plato a la BD
function ajax_anadir(){
    var nom= $('#nombre').val();
    var des=$('#descripcion').val();
    var cat=$('#categoria').val();
    var sub= $('#subcategoria').val();
    var pre=$('#precio').val();
    var es=$('#estado').val();
    //Obtener ingredientes
    var arrayIngredientes= obtener_ingredientes();
    if(arrayIngredientes.length===0){
        arrayIngredientes='vacio';
    }
    nom= nom.toLowerCase();
    pre=pre.trim(pre);
    pre=pre.replace(',','.');
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

//Función para que en los formularios de añadir o modificar plato, aparezcan las subcategorías según la categoría seleccionada
function obtener_categoria(){
    var cat=$('#categoria').val();
    var sub_principal='<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der bot">'+
                                '<option value="no" class="bot" selected>Seleccionar una opción</option>'+
                                '<option value="tacos" class="bot">Tacos</option>'+
                                '<option value="fajitas" class="bot">Fajitas</option>'+
                                '<option value="ensaladas" class="bot">Ensaladas</option>'+
                                '<option value="quesadillas" class="bot">Quesadillas</option>'+
                                '<option value="gringas" class="bot">Gringas</option>'+
                                '<option value="cuchara" class="bot">De cuchara</option>'+
                                '<option value="otro" class="bot">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
    var sub_entrante= '<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der bot">'+
                                '<option value="no" class="bot" selected>Seleccionar una opción</option>'+
                                '<option value="nachos" class="bot">Nachos</option>'+
                                '<option value="flautas" class="bot">Flautas</option>'+
                                '<option value="quesos" class="bot">Quesos</option>'+
                                '<option value="enchiladas" class="bot">Enchiladas</option>'+
                                '<option value="otro" class="bot">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
    var sub_postre= '<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der bot">'+
                                '<option value="no" class="bot" selected>Seleccionar una opción</option>'+
                                '<option value="tartas" class="bot">Tartas</option>'+
                                '<option value="sorbetes" class="bot">Sorbetes</option>'+
                                '<option value="helados" class="bot">Helados</option>'+
                                '<option value="otro" class="bot">Otro</option>'+
                            '</select>'+
                            '<div id="error-subcategoria" class="error-form etiqueta-der elemento-form-der"></div><br><br>';
    var sub_bebida='<label for="subcategoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                            '<select type="text" name="subcategoria" id="subcategoria" class="rectangulo-input elemento-form-der bot">'+
                                '<option value="no" class="bot" selected>Seleccionar una opción</option>'+
                                '<optgroup label="Sin alcohol">'+
                                    '<option value="zumos" class="bot">Zumos</option>'+
                                    '<option value="refrescos" class="bot">Refrescos</option>'+
                                    '<option value="limonadas" class="bot">Limonadas</option>'+
                                    '<option value="cafes" class="bot">Cafés</option>'+
                                '</optgroup>'+
                                '<optgroup label="Alcoholicas">'+
                                    '<option value="cervezas" class="bot">Cervezas</option>'+
                                    '<option value="vinos" class="bot">Vinos</option>'+
                                    '<option value="tequilas" class="bot">Tequilas</option>'+
                                    '<option value="ginebra" class="bot">Ginebra</option>'+
                                    '<option value="ron" class="bot">Ron</option>'+
                                    '<option value="whisky" class="bot">Whisky</option>'+
                                '</optgroup>'+
                                '<optgroup label="Cocteles">'+   
                                    '<option value="margaritas" class="bot">Margaritas</option>'+
                                    '<option value="mezcales" class="bot">Mezcales</option>'+
                                    '<option value="cocteles" class="bot">Otros Cócteles</option>'+
                                '</optgroup>'+
                                '<optgroup label="Otros">'+ 
                                    '<option value="otro" class="bot">Otro</option>'+
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
    puntero();
}

//Función para que se ponga el cursor de la manita a las hora de ponerlo sobre un elemento.
function puntero(){
    var bot=document.getElementsByClassName('bot');
    for(let i=0; i<bot.length; i++){
       bot[i].style.cursor='pointer';
    }
}