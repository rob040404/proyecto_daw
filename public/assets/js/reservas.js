function onKeyDown(e) 
{   
  e.preventDefault();
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
    var fecha_max_value = fecha_max.getFullYear().toString() + "-" + comprobarDobleDigito((fecha_max.getMonth() + 1).toString())  + "-" + fecha_max.getDate().toString();;
    fecha.value =  fecha_min_value;
    fecha.setAttribute('min', fecha_min_value);
    fecha.setAttribute('max', fecha_max_value);
}

function cargarHorario(input_data)
{
    var pagina = window.document.title === 'Reservar' ? 'reservar.php' : 'reservas.php';
    $.ajax({
        type: "POST",
        url: pagina,
        datatype: "json",
        data: input_data,
        success: function (response)
        {
            var horas_disponibles = response.horas_disponibles;
            var select = document.getElementById('hora');
            select.innerHTML = '';
            for(var i = 0; i < horas_disponibles.length; i++)
            {
                var option = document.createElement('option');
                if(input_data.fecha_editar !== null)
                {
                    if(input_data.fecha === input_data.fecha_editar.split(' ')[0] && horas_disponibles[i] === input_data.fecha_editar.split(' ')[1].slice(10, 16))
                    {
                        option.setAttribute('selected', true);
                    }
                    else if(horas_disponibles[i] === input_data.fecha_editar.split(' ')[1].substring(-4, 5))
                    {
                        option.setAttribute('selected', true);
                    }
                }
                option.setAttribute('value', horas_disponibles[i]);
                option.innerHTML = horas_disponibles[i];
                select.appendChild(option);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) 
        {
            alert('Error Message: ' + thrownError);
        }
    });
}

function actualizarCampos()
{
    document.getElementById("id_usuario").value = '1'; 
    document.getElementById("mesa").value = '1'; 
    document.getElementById("nombre").value = ''; 
    document.getElementById("apellidos").value = '';
    document.getElementById("correo").value = ''; 
    document.getElementById("telefono").value = '';
    cargarFechaActual(document.getElementById("fecha"));
    var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, "mesa": document.getElementById("mesa").value,
    "fecha_editar": document.getElementById("opcion").innerHTML === 'Nueva reserva' ? null : document.getElementById('fecha_editar').value};
    cargarHorario(input_data);
}

function actualizarSelect(reservas)
{
    if(reservas === null)
    {
        document.getElementById("form_borrado").innerHTML = '';
        document.getElementById("div_reservas").innerHTML = '';
    }
    else
    {
        var selectEliminar = document.getElementById("id_reserva");
        selectEliminar.innerHTML = '';
        for(var i = 0 ; i < reservas.length; i++)
        {
            var option = document.createElement('option');
            option.value = reservas[i].id_reserva;
            option.innerHTML = reservas[i].id_reserva;
            selectEliminar.appendChild(option);
        }
    }
}

function cargarReserva()
{
    $.ajax({
        type: "POST",
        url: "reservas.php",
        datatype: "json",
        data: {"buscar_reserva": true, "id_reserva": document.getElementById("id_reserva").value},
        success: function (response)
        {
            var reserva = response.reserva;
            document.getElementById("id_reserva").value = reserva.id_reserva;
            document.getElementById("id_usuario").value = reserva.id_usuario;
            document.getElementById("mesa").value = reserva.mesa;
            document.getElementById("nombre").value = reserva.nombre;
            document.getElementById("apellidos").value = reserva.apellidos;
            document.getElementById("correo").value = reserva.correo;
            document.getElementById("telefono").value = reserva.telefono;
            var fecha_hora = reserva.fecha_hora_reserva.split(' ');
            document.getElementById("fecha").value = fecha_hora[0];
            document.getElementById("personas").value = reserva.personas;
            document.getElementById('fecha_editar').value = reserva.fecha_hora_reserva;
            var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, 
            "mesa": document.getElementById("mesa").value, "fecha_editar": document.getElementById('fecha_editar').value};
            cargarHorario(input_data);
        },
        error: function (xhr, ajaxOptions, thrownError) 
        {
            alert('Error Message: ' + thrownError);
        }
    });
}

function eliminarReserva(e)
{
    e.preventDefault();
    e.stopImmediatePropagation();
    cargarReservas();
}

function volverHome(e)
{
    document.getElementById(e.target.id).style.boxShadow = '';
    document.getElementById(e.target.id).removeAttribute('value');
    window.location = "reservas.php";
}

function camposVacios(campos)
{
    var vacio = false;
    var keys = ['nombre', 'apellidos', 'telefono', 'correo']; 
    for(var i = 0; i < campos.length && !vacio; i++)
    {
        if(campos[i].length === 0)
        {
            vacio = true;
            document.getElementById(keys[i]).setCustomValidity('Completa este campo');
            document.getElementById(keys[i]).reportValidity();
        }
    }
    return vacio;
}

function comprobarTelefono(telefono)
{
    var patron = /^[0-9]+$/;
    if(patron.test(telefono.toString())) 
    {
        return true;
    }
    else
    {
        document.getElementById('telefono').setCustomValidity('Formato de telefono no válido');
        document.getElementById('telefono').reportValidity();
        return false;
    }
}

function comprobarCorreo(correo)
{
    var patron = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    if(patron.test(correo)) 
    {
        return true;
    }
    else
    {
        document.getElementById('correo').setCustomValidity('Formato de correo no válido');
        document.getElementById('correo').reportValidity();
        return false;
    }
}

function validarForm(e) 
{
    e.preventDefault();
    e.stopImmediatePropagation();
    document.getElementById('nombre').setCustomValidity("");
    document.getElementById('apellidos').setCustomValidity("");
    document.getElementById('telefono').setCustomValidity("");
    document.getElementById('correo').setCustomValidity("");
    var campos = [document.getElementById('nombre').value.trim(), document.getElementById('apellidos').value.trim(),  
    document.getElementById('correo').value.trim(), document.getElementById('telefono').value.trim()];
    if(!camposVacios(campos) && comprobarCorreo(campos[2]) && comprobarTelefono(campos[3]))
    {  
        var pagina = window.document.title;
        if(pagina === 'Reservar')
        {
            e.target.submit();
        }
        else
        {
            cargarReservas();
        }
    }
}

function generarTabla()
{
    var div_reservas = document.getElementById("div_reservas");
    div_reservas.innerHTML = '';
    var h1 = document.createElement("h1");
    h1.setAttribute('class', 'listado-de-reservas');
    h1.innerHTML = 'Listado de reservas';
    div_reservas.appendChild(h1);
    var table = document.createElement("table");
    var thead = document.createElement("thead");
    var tr_cabecera = document.createElement("tr");
    var campos_cabecera = ['Código', 'Empleado' ,'Mesa', 'Fecha', 'Cliente', 'Personas', 'Teléfono', 'Correo'];
    for(var i = 0; i < campos_cabecera.length; i++)
    {
       var th = document.createElement("th");
       th.innerHTML = campos_cabecera[i];
       tr_cabecera.appendChild(th);
    }
    thead.appendChild(tr_cabecera);
    table.appendChild(thead);
    var tbody = document.createElement("tbody");
    table.appendChild(tbody);
    div_reservas.appendChild(table);
}

function cargarReservas()
{
    var input_data;
    if(document.getElementById('opcion').innerHTML === 'Nueva reserva')
    {
        input_data = {"nueva_reserva": true, "id_usuario": document.getElementById("id_usuario").value, 
        "mesa": document.getElementById("mesa").value, "nombre": document.getElementById("nombre").value,
        "apellidos": document.getElementById("apellidos").value, "correo": document.getElementById("correo").value,
        "telefono": document.getElementById("telefono").value, "fecha": document.getElementById("fecha").value, 
        "hora": document.getElementById("hora").value, "personas": document.getElementById("personas").value};
    }
    else if(document.getElementById('opcion').innerHTML === 'Modificar reserva')
    {
        input_data = {"modificar_reserva": true, "id_reserva": document.getElementById('id_reserva').value, "id_usuario": document.getElementById("id_usuario").value, 
        "mesa": document.getElementById("mesa").value, "nombre": document.getElementById("nombre").value,
        "apellidos": document.getElementById("apellidos").value, "correo": document.getElementById("correo").value,
        "telefono": document.getElementById("telefono").value, "fecha": document.getElementById("fecha").value, 
        "hora": document.getElementById("hora").value, "personas": document.getElementById("personas").value};
    }
    else
    {
        input_data = {"eliminar_reserva": true, "id_reserva": document.getElementById("id_reserva").value};
    }
    $.ajax({
        type: "POST",
        url: "reservas.php",
        datatype: "json",
        data: input_data,
        success: function (response)
        {
            var reservas = response.reservas;
            if(reservas === null)
            {
                document.getElementById('btn_nueva_reserva').disabled = true;
                document.getElementById('btn_modificar_reserva').disabled = true;
                document.getElementById('btn_eliminar_reserva/s').disabled = true;
                actualizarSelect(reservas);
                notificacion('NO EXISTEN MAS RESERVAS', 'red');
                setTimeout(function(){
                    window.location = "reservas.php";
                }, 2000);
            }
            else
            {
                generarTabla();
                var tbody = document.getElementsByTagName('tbody')[0];
                tbody.innerHTML = '';
                for(var i = 0; i < reservas.length; i++)
                {
                    var tr = document.createElement('tr');
                    var reserva = reservas[i];
                    for(var clave in reserva)
                    {
                        var td = document.createElement('td');
                        td.innerHTML = reserva[clave];
                        tr.appendChild(td);
                    }
                    tbody.appendChild(tr);
                }
                if(document.getElementById('opcion').innerHTML === 'Nueva reserva')
                {
                    notificacion('RESERVA GUARDADA CON EXITO', 'blue');
                    actualizarCampos();
                    if(reservas.length === 1)
                    {
                        document.getElementById('btn_modificar_reserva').classList.remove('boton-invisible');
                        document.getElementById('btn_eliminar_reserva/s').classList.remove('boton-invisible');
                    }
                }
                else if(document.getElementById('opcion').innerHTML === 'Modificar reserva')
                {
                    notificacion('RESERVA MODIFICADA CON EXITO', '#C7DB00');
                }
                else
                {
                    notificacion('RESERVA ELIMINADA CON EXITO', 'red');
                    actualizarSelect(reservas);
                }
            }
        },
        error: function (xhr, ajaxOptions, thrownError) 
        {
            alert('Error Message: ' + thrownError);
        }
    });
}

function notificacion(mensaje, color)
{
    var containerNotification = document.getElementById("containerNotification");
    containerNotification.innerHTML = mensaje;
    containerNotification.setAttribute('style', 'display:block;background-color:' + color + ';');
    setTimeout(function()
    {
        $("#containerNotification").fadeOut();
    },2000);
}

document.addEventListener("DOMContentLoaded", function () 
{
    var pagina = window.document.title;
    var btn = document.getElementById('btn_reservar');
    if(pagina === 'Reservar' && document.getElementById('btn_reservar') !== null)
    {
        cargarFechaActual(document.getElementById("fecha"));
        document.getElementById('form_reserva').addEventListener("submit", validarForm);
        var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, "mesa": null, "fecha_editar": null};
        cargarHorario(input_data);
        $("#fecha").change(function()
        {
            var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, "mesa": null, "fecha_editar": null};
            cargarHorario(input_data);
        });
    }
    else if(pagina === 'Gestión de reservas')
    {
        if(document.getElementById("opcion") !== null)
        {
            var opcion = document.getElementById("opcion").innerHTML;
            if(opcion === 'Nueva reserva' || opcion === 'Modificar reserva')
            {
                const registroForm = document.getElementById('form_reserva');
                var fecha = document.getElementById('fecha');
                var hora = document.getElementById('hora');
                var mesa = document.getElementById('mesa').value;
                fecha.addEventListener("keydown", onKeyDown);
                hora.addEventListener("keydown", onKeyDown);
                registroForm.addEventListener("submit", validarForm);
                cargarFechaActual(fecha);
                $("#fecha").change(function()
                {
                    var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, 
                    "mesa": document.getElementById('mesa').value, "fecha_editar": opcion === 'Nueva reserva' ? null : document.getElementById('fecha_editar').value};
                    cargarHorario(input_data);
                });
                $("#mesa").change(function()
                {
                    var input_data = {"cargar_horarios": true, "fecha": document.getElementById("fecha").value, 
                    "mesa": document.getElementById('mesa').value, "fecha_editar": opcion === 'Nueva reserva' ? null : document.getElementById('fecha_editar').value};
                    cargarHorario(input_data);
                });
                var btn = '';
                var sombra = '';
                if(opcion === 'Nueva reserva')
                {
                    btn = 'btn_nueva_reserva';
                    sombra = 'var(--blue)';
                    var input_data = {"cargar_horarios": true, "fecha": fecha.value, "mesa": mesa, 
                    "fecha_editar": opcion === 'Nueva reserva' ? null : document.getElementById('fecha_editar').value};
                    cargarHorario(input_data);
                }
                else if(opcion === 'Modificar reserva')
                {
                    btn = 'btn_modificar_reserva';
                    sombra = 'var(--color-yellow';
                    cargarReserva();
                    $("#id_reserva").change(function()
                    {
                        cargarReserva();
                    });
                }
            }
            else
            {
                btn = 'btn_eliminar_reserva/s';
                sombra = 'var(--color-firebrick)';
                document.getElementById('eliminar_reserva').addEventListener("click", eliminarReserva);
            }
            document.getElementById(btn).addEventListener("click", volverHome);
            document.getElementById(btn).style.boxShadow = '0 4px 4px ' + sombra;
        }
        else if(document.getElementById("reservas_eliminadas") !== null)
        {
            notificacion('TODAS LAS RESERVAS ELIMINADAS CON EXITO', 'red');
        }
    }
});