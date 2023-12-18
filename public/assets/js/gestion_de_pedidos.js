function guardarOrden(e)
{
    var idPedido = e.target.id.split('_')[2];
    var platos_container = document.getElementById('platos_container_' + idPedido);
    var pedido_data = [];
    for(var i = 0; i < platos_container.childNodes.length; i++)
    {
        if(platos_container.childNodes[i].childNodes[0].checked)
        {
            pedido_data.push({id_plato: platos_container.childNodes[i].childNodes[0].value.split('-')[0],
            nombre_plato: platos_container.childNodes[i].childNodes[0].value.split('-')[1],   
            unidades: platos_container.childNodes[i].childNodes[2].value});
        }
    }
    if(pedido_data.length === 0)
    {
        pedido_data = null;
    }
    $.ajax({
       type: "POST",
       url: "gestion_de_pedidos.php",
       datatype: "json",
       data: {guardar_pedido: true, idPedido: idPedido, pedido_data: pedido_data},
       success: function (response)
       {
            var platos = response.platos_seleccionados;
            var listado_platos_pedido = document.getElementById('listado_platos_pedido_' + idPedido);
            listado_platos_pedido.innerHTML = '';
            if(platos.length !== 0)
            {
                var precio_total = 0;
                for(var i = 0; i < platos.length; i++)
                {
                    var li = document.createElement('li');
                    li.innerHTML = platos[i].nombre_plato + ' - ' + platos[i].precio_plato + ' €'  + ' x ' + platos[i].unidades + 
                    '... ' + (platos[i].unidades * platos[i].precio_plato).toFixed(2) + ' €';
                    listado_platos_pedido.appendChild(li);
                    precio_total = platos[i].precio_plato * platos[i].unidades + precio_total;
                }
                listado_platos_pedido.removeAttribute('class');
                document.getElementById("precio_pedido_" + idPedido).classList.remove('invisible');
                document.getElementById("precio_pedido_" + idPedido).classList.add('precio-pedido');
                document.getElementById("precio_total_" + idPedido).innerHTML = 'Total: ' + precio_total.toFixed(2) + ' €';
                document.getElementById("btn_avanzar_container_" + idPedido).classList.remove('invisible');
                document.getElementById("btn_avanzar_container_" + idPedido).classList.add('btn-avanzar');
            }
            else
            {
                listado_platos_pedido.setAttribute('class', 'invisible');
                document.getElementById("btn_avanzar_container_" + idPedido).classList.remove('btn-avanzar');
                document.getElementById("btn_avanzar_container_" + idPedido).classList.add('invisible');
            }
            var platos_container = document.getElementById("platos_container_" + idPedido);
            var btns_acciones = document.getElementById("btns_acciones_" + idPedido);
            platos_container.classList.remove('platos-container');
            platos_container.classList.add('invisible');
            btns_acciones.classList.remove('btns-acciones');
            btns_acciones.classList.add('invisible');
            document.getElementById("anadir_plato_container_" + idPedido).classList.remove('invisible');
            document.getElementById("anadir_plato_container_" + idPedido).classList.add('anadir-plato-container');
            document.getElementById("botones_container_" + idPedido).classList.remove('invisible');
            document.getElementById("botones_container_" + idPedido).classList.add('botones-container');
       },
       error: function (xhr, ajaxOptions, thrownError) 
       {
           alert('Error Message: ' + thrownError);
       }
   });
}

function agregarQuitarPlato(checkbox)
{
    var idPedido = checkbox.id.split('_')[1];
    var indice = checkbox.id.split('_')[2];
    var unidades_plato = checkbox.value.split('-')[2];
    var plato_container = document.getElementById('plato_container_' + idPedido + '_' + indice);
    if(checkbox.checked === true)
    {
        var input = document.createElement('input');
        input.setAttribute('type', 'number');
        input.setAttribute('id', 'cantidad_plato_' + idPedido + '_' + indice);
        input.setAttribute('value', unidades_plato);
        input.setAttribute('min', '1');
        plato_container.appendChild(input);
    }
    else if(checkbox.checked === false)
    {
        var cantidad_plato = document.getElementById('cantidad_plato_' + idPedido + '_' + indice);
        if(cantidad_plato !== null)
        {
            plato_container.removeChild(cantidad_plato);
        }
    }
    document.getElementById("btn_guardar_" + idPedido).classList.remove('invisible');
    document.getElementById('btn_guardar_' + idPedido).addEventListener('click', guardarOrden);
}

function agregarQuitarPlatoListener(e)
{
    agregarQuitarPlato(e.target);
}

function cargarPlatos(idPedido)
{
    $.ajax({
        type: "POST",
        url: "gestion_de_pedidos.php",
        datatype: "json",
        data: {cargar_platos: true, "idPedido": idPedido},
        success: function (response)
        {
            var platos = response.platos;
            var platos_seleccionados = response.platos_seleccionados;
            var platos_nombre = [];
            var platos_unidades = [];
            for(var i = 0; i < platos_seleccionados.length; i++)
            {
                platos_nombre[i] = platos_seleccionados[i].nombre_plato;
                platos_unidades[platos_seleccionados[i].nombre_plato] = platos_seleccionados[i].unidades;
            }
            var div_platos_container = document.getElementById('platos_container_' + idPedido);
            for(var i = 0; i < platos.length; i++)
            {
                var div = document.createElement('div');
                div.setAttribute('class', 'plato-container');
                div.setAttribute('id', 'plato_container_' + idPedido + '_' + i);
                var checkbox = document.createElement('input');
                checkbox.setAttribute('type', 'checkbox');
                checkbox.setAttribute('id', 'checkbox_' + idPedido + '_' + i);
                checkbox.setAttribute('value', platos[i].id_plato + '-' + platos[i].nombre + '-1');
                checkbox.addEventListener('change', agregarQuitarPlatoListener);
                if(platos_nombre.includes(platos[i].nombre))
                {
                    checkbox.setAttribute('checked', 'true');
                    checkbox.setAttribute('value', platos[i].id_plato + '-' + platos[i].nombre + '-' + platos_unidades[platos[i].nombre]);
                }
                var p = document.createElement('p');
                p.setAttribute('class', 'checkbox-text');
                p.innerHTML = platos[i].nombre + ' (' + platos[i].precio + '€)';
                div.appendChild(checkbox);
                div.appendChild(p);
                div_platos_container.appendChild(div);
                agregarQuitarPlato(checkbox);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) 
        {
            alert('Error Message: ' + thrownError);
        }
    });
}

function anadirPlato(e)
{
    var idPedido = e.currentTarget.id.substring(23);
    var anadir_plato_container = document.getElementById("anadir_plato_container_" + idPedido);
    var platos_container = document.getElementById("platos_container_" + idPedido);
    var btns_acciones = document.getElementById("btns_acciones_" + idPedido);
    var botones_container = document.getElementById("botones_container_" + idPedido);
    anadir_plato_container.classList.remove('anadir-plato-container');
    anadir_plato_container.classList.add('invisible');
    platos_container.classList.remove('invisible');
    platos_container.classList.add('platos-container');
    btns_acciones.classList.remove('invisible');
    btns_acciones.classList.add('btns-acciones');
    botones_container.classList.remove('botones-container');
    botones_container.classList.add('invisible');
    document.getElementById('listado_platos_pedido_' + idPedido).setAttribute('class', 'invisible');
    document.getElementById("platos_container_" + idPedido).innerHTML = '';
    document.getElementById("precio_pedido_" + idPedido).classList.remove('precio-pedido');
    document.getElementById("precio_pedido_" + idPedido).classList.add('invisible');
    cargarPlatos(idPedido);
}

function moverEstado(e)
{
    var btn = e.target.id.split('_')[0] + '_' +e.target.id.split('_')[1];
    var input_data = null;
    if(btn === 'btn_retroceder')
    {
        input_data = {btn_retroceder: true, id_pedido: e.target.dataset.idpedido, estado_pedido: e.target.value};
    }
    else
    {
        input_data = {btn_avanzar: true, id_pedido: e.target.dataset.idpedido, estado_pedido: e.target.value};
    }
    $.ajax({
        type: "POST",
        url: "gestion_de_pedidos.php",
        datatype: "json",
        data: input_data,
        success: function (response)
        {
            var pedido = response.pedido;
            var estado_pedido = document.getElementById("estado_pedido_" + pedido.id_pedido);
            estado_pedido.value = pedido.estado_pedido;
            var listado_platos_pedido = document.getElementById('listado_platos_pedido_' + pedido.id_pedido);
            if(pedido.estado_pedido === 'Pendiente')
            {
                if(listado_platos_pedido !== null)
                {
                    listado_platos_pedido.classList.remove('invisible');
                    document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.add('anadir-plato-container');
                    listado_platos_pedido.innerHTML = '';
                }
                document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.remove('anadir-plato-container');
                document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.add('invisible');
                document.getElementById("btn_retroceder_container_" + pedido.id_pedido).classList.remove('btn-retroceder');
                document.getElementById("btn_retroceder_container_" + pedido.id_pedido).classList.add('invisible');
                document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.remove('invisible');
                document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.add('btn-avanzar');
                document.getElementById("precio_pedido_" + pedido.id_pedido).classList.remove('precio-pedido');
                document.getElementById("precio_pedido_" + pedido.id_pedido).classList.add('invisible');
            }
            else if(pedido.estado_pedido === 'Confirmado')
            {
                $.ajax({
                    type: "POST",
                    url: "gestion_de_pedidos.php",
                    datatype: "json",
                    data: {cargar_platos_guardados: true, "idPedido": pedido.id_pedido},
                    success: function (response)
                    {
                        document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.remove('invisible');
                        document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.add('anadir-plato-container');
                        if(response.platos_seleccionados.length === 0)
                        {
                            document.getElementById("precio_pedido_" + pedido.id_pedido).classList.remove('precio-pedido');
                            document.getElementById("precio_pedido_" + pedido.id_pedido).classList.add('invisible');
                            document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.remove('btn-avanzar');
                            document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.add('invisible');
                        }
                        else
                        {
                            document.getElementById("precio_pedido_" + pedido.id_pedido).classList.remove('invisible');
                            document.getElementById("precio_pedido_" + pedido.id_pedido).classList.add('precio-pedido');
                            document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.remove('invisible');
                            document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.add('btn-avanzar');
                        }
                        document.getElementById("btn_retroceder_container_" + pedido.id_pedido).classList.remove('invisible');
                        document.getElementById("btn_retroceder_container_" + pedido.id_pedido).classList.add('btn-retroceder');
                    },
                    error: function (xhr, ajaxOptions, thrownError) 
                    {
                        alert('Error Message: ' + thrownError);
                    }
                });
            }
            else
            {
                document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.remove('anadir-plato-container');
                document.getElementById("anadir_plato_container_" + pedido.id_pedido).classList.add('invisible');
                document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.remove('btn-avanzar');
                document.getElementById("btn_avanzar_container_" + pedido.id_pedido).classList.add('invisible');
            }
            if(document.getElementById('listado_platos_pedido_' + pedido.id_pedido).childElementCount === 0)
            {
                document.getElementById('listado_platos_pedido_' + pedido.id_pedido).setAttribute('class', 'invisible');
            }
            else
            {
                document.getElementById('listado_platos_pedido_' + pedido.id_pedido).removeAttribute('class');
            }
            aplicarEstiloPedidos(document.getElementById("pedido_" + pedido.id_pedido));
        },
        error: function (xhr, ajaxOptions, thrownError) 
        {
            alert('Error Message: ' + thrownError);
        }
    });
}

function incluirSombra(e)
{
    var color = null;
    if(e.target.value === 'Pendiente')
    {
        color = 'color-firebrick';
    }
    else if(e.target.value === 'Confirmado')
    {
        color = 'color-yellow';
    }
    else
    {
        color = 'green';
    }
    e.target.style.boxShadow = '0 4px 4px var(--' + color + ')';
}

function borrarSombra(e)
{
    e.target.style.boxShadow = '';
}

function aplicarEstiloPedidos(pedido)
{
    var id = pedido.id.substring(7);
    var estado = document.getElementById("estado_pedido_" + id).value;
    var btn_retroceder = document.getElementById("btn_retroceder_" + id);
    var btn_avanzar = document.getElementById("btn_avanzar_" + id);
    if(estado === 'Pendiente')
    {
        pedido.style.border= '2px solid var(--color-firebrick)';
        btn_avanzar.value = 'Confirmado';
        btn_avanzar.style.border = '2px solid var(--color-yellow)';
        btn_avanzar.addEventListener("mouseenter", incluirSombra);
        btn_avanzar.addEventListener("mouseleave", borrarSombra);
        btn_avanzar.addEventListener("click", moverEstado);
    }
    else if(estado === 'Confirmado')
    {
        pedido.style.border= '2px solid var(--color-yellow)';
        document.getElementById("anadir_plato_container_" + id).addEventListener("click", anadirPlato);
        btn_retroceder.value = 'Pendiente';
        btn_avanzar.value = 'Completado';
        btn_retroceder.style.border = '2px solid var(--color-firebrick)';
        if(btn_avanzar !== null)
        {
            btn_avanzar.style.border = '2px solid var(--green)';
            btn_avanzar.addEventListener("mouseenter", incluirSombra);
            btn_avanzar.addEventListener("mouseleave", borrarSombra);
            btn_avanzar.addEventListener("click", moverEstado);
        }
        btn_retroceder.addEventListener("mouseenter", incluirSombra);
        btn_retroceder.addEventListener("mouseleave", borrarSombra);
        btn_retroceder.addEventListener("click", moverEstado);
    }
    else
    {
        pedido.style.border= '2px solid var(--green)';
        btn_retroceder.value = 'Confirmado';
        btn_retroceder.style.border = '2px solid var(--color-yellow)';
        btn_retroceder.addEventListener("mouseenter", incluirSombra);
        btn_retroceder.addEventListener("mouseleave", borrarSombra);
        btn_retroceder.addEventListener("click", moverEstado);
    }
}

function cambioFecha(e)
{
    document.getElementById('fecha_pedido_envio').value = e.target.value;
    document.getElementById('form_envio_fecha').submit();  
}

function comprobarDobleDigito(valor)
{
    if(valor.length === 1)
    {
        valor = "0" + valor;
    }
    return valor;
}

function cargarFechaActual(fecha)
{
    var fecha_min = new Date();
    var fecha_max = new Date();
    fecha_max.setMonth(fecha_max.getMonth() + 2);
    var fecha_min_value = fecha_min.getFullYear().toString() + "-" + (fecha_min.getMonth() + 1)  + "-" + comprobarDobleDigito(fecha_min.getDate().toString());
    var fecha_max_value = fecha_max.getFullYear().toString() + "-" + comprobarDobleDigito((fecha_max.getMonth() + 1).toString())  + "-" + fecha_max.getDate().toString();
    fecha.setAttribute('min', fecha_min_value);
    fecha.setAttribute('max', fecha_max_value);
}

function onKeyDown(e) 
{   
  e.preventDefault();
}

document.addEventListener("DOMContentLoaded", function () 
{
    var fecha_pedido = document.getElementById('fecha_pedido');
    fecha_pedido.addEventListener("keydown", onKeyDown);
    cargarFechaActual(fecha_pedido);
    fecha_pedido.addEventListener('change', cambioFecha);
    var pedidos = document.getElementsByName("pedido");
    for(var i = 0; i < pedidos.length; i++)
    {
        aplicarEstiloPedidos(pedidos[i]);
    }
});