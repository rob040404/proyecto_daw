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
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir">Activar/desactivar producto</div><br><br>'+
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
function form_modificar(){
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
    var contenido='<p><br><br><br></p>'+
            '<div class="aadir-nuevo-producto" id="encabezado-anadir"><p>Añadir nuevo producto</p></div>'+
        '<form id="formanadir" method="POST" name="formanadir" novalidate>'+
            '<div class="contenedor-anadir">'+
            
               ' <div class="anadir-izq">'+
                    
                        '<label for="nombre" class="texto-gm etiqueta-izq">Nombre:</label><br>'+
                        '<input type="text" name="nombre" id="nombre" class="rectangulo-input elemento-form-izq" maxlength="30"><br>'+
                        '<label for="nombre" class="texto-gm etiqueta-izq">Descripción:</label><br>'+
                        '<textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea elemento-form-izq"></textarea><br>'+
                        
                '</div>'+
                '<div class="anadir-der">'+
                    
                        '<label for="categoria" class="texto-gm elemento-form-der" >Categoría:</label><br>'+
                        '<input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der" maxlength="30"><br>'+
                        '<label for="categoria" class="texto-gm elemento-form-der">Sub-categoría:</label><br>'+
                        '<input type="text" name="categoria" id="categoria" class="rectangulo-input elemento-form-der" maxlength="30"><br>'+
                        '<div class="contenedor-precio-estado">'+
                            '<div class="subcontenedor-precio">'+
                                '<label for="nombre" class="texto-gm etiqueta-izq elemento-form-der">Precio:</label><br>'+
                                '<input type="text" name="categoria" id="categoria" class="rectangulo-pequeno elemento-form-der" maxlength="8"><br>'+
                                
                           ' </div>'+
                            '<div class="subcontenedor-estado">'+
                                '<label for="categoria" class="texto-gm elemento-form-der">Estado:</label><br>'+
                                '<select type="text" name="categoria" id="categoria" class="rectangulo-pequeno elemento-form-der">'+
                                     '<option value="activado">Activado</option>'+
                                     '<option value="desactivado">Desactivado</option>'+
                                '</select>'+
                                '<br><br>'+
                                
                            '</div>'+
                       ' </div> '+
               ' </div>'+
                '<div class="conteiner-ingredientes">'+
                   ' <p>'+ 
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '</p>'+
                    '<p>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '<label for="nombre" class="texto-gm etiqueta-izq check">Lechuga: <input type="checkbox" name="cb-autos" value="gusta" class="box"></label>'+
                    '</p>'+
                    
                '</div>'+
            '</div>'+
            '<div class="aadir-nuevo-producto">'+
               
                '<label for="nombre" class="texto-gm "><h4>Otros:</h4></label><br>'+
                '<textarea type="text" name="descripcion" id="descripcion" class="rectangulo-textarea-otros"></textarea><br>'+
                
            '</div>'+
            '<div class="container-botones-form">'+
                '<button type="button" class="guardar-wrapper-anadir ">'+
                    '<div class="guardar" name="guardar" id="guardar">Guardar</div>'+
                '</button>'+
                '<button type="reset" class="guardar-wrapper-anadir">'+
                    '<div class="guardar" name="reset" id="reset">Reset</div>'+
                '</button>'+
           ' </div>'+
        '</form>';

        document.getElementById("contenedor_opciones2").innerHTML=contenido;
}
