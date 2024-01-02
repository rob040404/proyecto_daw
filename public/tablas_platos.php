<?php

function tabla($registro, $operacion){
    $contenido='<table class="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>';
    
    
                    if($operacion==='ver'|| $operacion==='borrar'){
    $contenido.=        '<th>Descripción</th>';
                    }
                    
                    
    $contenido.=    '<th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Precio</th>
                    <th>Estado</th>';
    
                    if($operacion==='activar'){
    $contenido.=   '<th>Cambiar estado</th>';                   
                    }else if($operacion==='borrar'){
    $contenido.=    '<th>Eliminar plato</th>';     
                    }
    
    
    $contenido.='</tr>
            </thead>
            <tbody>
                <tr>
                    <td id="nombre">'.$registro->nombre.'</td>';
    
    
                    if($operacion==='ver'|| $operacion==='borrar'){
    $contenido.=        '<td id="descripcion">'.$registro->ingredientes.'</td>';
                    }
                    
                    
                    
    $contenido.=                '<td id="categoria">'.$registro->categoria.'</td>
                    <td id="subcategoria">'.$registro->subcategoria.'</td>
                    <td id="precio">'.$registro->precio.'</td>
                    <td id="estado">'.$registro->estado.'</td>';
    
    
                    if($operacion==='activar'){
    $contenido.=        '<td>
                            <button type="button" class="boton-tabla" name="cambiar-estado" id="cambiar-estado">
                                <div class="guardar" >Cambiar</div>
                            </button>
                        </td>';
                    }else if($operacion==='borrar'){
    $contenido.=        '<td>
                            <button type="button" class="boton-tabla" name="borrar-plato" id="borrar-plato">
                                <div class="guardar" >Borrar</div>
                            </button>
                        </td>';
                    }
                    
                    
                    
    $contenido.=       '</tr>
                    </tbody>
                </table>';
    
    return $contenido;
}

function tabla_larga($registro, $operacion){
     $contenido='<table class="tabla">
            <thead>
                <tr>
                    <th>Nombre</th>';
    
    
                    if($operacion==='ver'|| $operacion==='borrar' || $operacion==='modificar'){
    $contenido.=        '<th>Descripción</th>';
                    }
                    
                    
    $contenido.=    '<th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Precio</th>
                    <th>Estado</th>';
    
                    if($operacion==='activar'){
    $contenido.=   '<th>Cambiar estado</th>';                   
                    }else if($operacion==='borrar'){
    $contenido.=    '<th>Eliminar plato</th>';     
                    }
                    
    $contenido.='</tr>
            </thead>
             <tbody>
                <tr>';
    //Bucle
    foreach ($registro as $reg){
    $contenido.= '<td id="nombre'.$reg->id_plato.'">'.$reg->nombre.'</td>';
    
      if($operacion==='ver'|| $operacion==='borrar' || $operacion==='modificar'){
    $contenido.=       '<td id="descripcion'.$reg->id_plato.'">'.$reg->ingredientes.'</td>';
      }
      
    $contenido.=       '<td id="categoria'.$reg->id_plato.'">'.$reg->categoria.'</td>
                        <td id="subcategoria'.$reg->id_plato.'">'.$reg->subcategoria.'</td>
                        <td id="precio'.$reg->id_plato.'">'.$reg->precio.'</td>
                        <td id="estado'.$reg->id_plato.'">'.$reg->estado.'</td>';
    
    
                    if($operacion==='activar'){
    $contenido.=        '<td id="accion'.$reg->id_plato.'">
                            <button type="button" class="guardar-wrapper boton-tabla boton-cambiar bot" name="cambiar-estado" data-id="'.$reg->id_plato.'">
                                <div class="guardar" data-id="'.$reg->id_plato.'" >Cambiar</div>
                            </button>
                        </td>';
                    }else if($operacion==='borrar'){
    $contenido.=        '<td id="accion'.$reg->id_plato.'">
                            <button type="button" class="guardar-wrapper boton-tabla boton-borrar1 bot" name="cambiar-estado" data-id="'.$reg->id_plato.'">
                                <div class="guardar" data-id="'.$reg->id_plato.'" >Borrar</div>
                            </button>
                        </td>';
                    }else if($operacion==='modificar'){
    $contenido.=        '<td id="accion'.$reg->id_plato.'">
                            <button type="button" class="boton-tabla boton-modificar bot" name="mod-plato" data-id="'.$reg->id_plato.'">
                                <div class="guardar" data-id="'.$reg->id_plato.'">Modificar</div>
                            </button>
                        </td>';
                    }
    $contenido.= '</tr>';

    }
    //Fin de bucle                
    $contenido.=   '</tbody>
                </table>
            <input type="hidden" id="cambiar-estado"><input type="hidden" id="borrar-plato">';
    
    return $contenido;
              
}
