@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/gestion_de_reservas.css"/>
@endsection
@section('javascript')
<script src="./assets/js/jquery/jquery-3.6.0.min.js"></script>
<script src="../public/assets/js/gestion_de_reservas.js"></script>
@endsection
@section('titulo', 'Gestión de reservas')
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <!--<a class="boton-volver" href="pagina_de_administracion.php"><- Volver</a>-->
        <h1 class="titulo-reservas">Gestión de reservas</h1>
        <form method="post">
            <div class="botones-reservas">
                <button class="boton-nueva-reserva" type="submit" id="btn_nueva_reserva" name="btn_nueva_reserva" value="Nueva reserva">Nueva reserva</button>
                <button class="boton-modificar {{!isset($reservas) ? 'boton-invisible' : ''}}" type="submit" id="btn_modificar_reserva" name="btn_modificar_reserva" value="Modificar reserva">Modificar reserva</button>
                <button class="boton-eliminar {{!isset($reservas) ? 'boton-invisible' : ''}}" type="submit" id="btn_eliminar_reserva/s" name="btn_eliminar_reserva/s" value="Eliminar reserva/s">Eliminar reserva/s</button>
            </div>
        </form>  
        @if(isset($opcion))
        <div style="visibility: hidden;" id="opcion">{{$opcion}}</div>
        <h1 class="titulo-reservas">{{$opcion}}</h1>
            @if($opcion == 'Modificar reserva' || $opcion == 'Nueva reserva')
            @if($opcion == 'Modificar reserva')
            <div class="busqueda-reserva-container">
                <label class="titulo-label">Código de reseva:</label>
                <select id="id_reserva" name="id_reserva">
                    @foreach($reservas as $reserva)
                        @if(isset($reserva_editar) && $reserva -> getIdReserva() == $reserva_editar -> getIdReserva())
                        <option selected value="{{$reserva -> getIdReserva()}}">{{$reserva -> getIdReserva()}}</option>
                        @else
                        <option value="{{$reserva -> getIdReserva()}}">{{$reserva -> getIdReserva()}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @endif
            <form method="post" id="form_reserva" novalidate>
                <div class="reserva-container">
                    <div class="reserva-containers">
                        <div class="reserva-container1">
                            <label>Empleado:</label>
                            <select id="id_usuario" name="id_usuario">
                            @foreach($usuarios as $usuario)
                                @if($usuario -> getRol() == 'admin' || $usuario -> getRol() == 'camarero')
                                    @if(isset($reserva_editar) && $usuario -> getId_Usuario() == $reserva_editar -> getIdUsuario())
                                    <option selected value="{{$usuario -> getId_Usuario()}}">{{$usuario -> getNombre()}}</option>
                                    @else
                                    <option value="{{$usuario -> getId_Usuario()}}">{{$usuario -> getNombre()}}</option>
                                    @endif
                                @endif
                            @endforeach
                            </select>
                            <label class="titulo-label">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" value='{{isset($reserva_editar) ? $reserva_editar -> getNombre() : ''}}'>
                            <label class="titulo-label">Teléfono:</label>
                            <input type="tel" id="telefono" name="telefono" value='{{isset($reserva_editar) ? $reserva_editar -> getTelefono() : ''}}' maxlength="15">
                            <label class="titulo-label">Fecha:</label>
                            <input type="date" id="fecha" name="fecha" value='{{isset($fecha_hora) ? $fecha_hora[0] : ''}}'>
                            <label class="titulo-label">Personas:</label>
                            <select id="personas" name="personas">
                            @for($i = 1; $i < 6; $i++)
                                @if(isset($reserva_editar) && $reserva_editar -> getPersonas() == $i)
                                <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                            </select>
                        </div>
                        <div class="reserva-container2">
                            <label>Mesa:</label>
                            <select id="mesa" name="mesa">
                            @for($i = 1; $i < 11; $i++)
                                @if(isset($reserva_editar) && $i == $reserva_editar -> getMesa())
                                <option selected value="{{$i}}">{{$i}}</option>
                                @else
                                <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                            </select>
                            <label class="titulo-label">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" value='{{isset($reserva_editar) ? $reserva_editar -> getApellidos() : ''}}'>
                            <label class="titulo-label">Correo electrónico:</label>
                            <input type="email" id="correo" name="correo" value='{{isset($reserva_editar) ? $reserva_editar -> getCorreo() : ''}}'>
                            <label class="titulo-label">Horas Disponibles:</label>
                            <select id="hora" name="hora">
                            </select>
                        </div>
                        @if($opcion == 'Modificar reserva')
                            <input type="hidden" id="fecha_editar">
                        @endif
                    </div>
                    <div class="finalizar-container">
                        <button type="submit" class="boton-finalizar" id="btn_reserva" name="btn_reserva">Confirmar reserva</button>
                    </div>
                </div>
            </form>
            @endif
            @if($opcion == 'Eliminar reserva/s')
                <form method="post" id="form_borrado">
                    <div class="borrado-reservas-container">
                        <div class="reserva-containers">
                            <div class="reserva-container1">
                                <label>Código de la reserva:</label>
                                <select id="id_reserva" name="id_reserva">
                                @foreach($reservas as $reserva)
                                    <option value="{{$reserva -> getIdReserva()}}">{{$reserva -> getIdReserva()}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="reserva-container2">
                                <input class="boton-eliminar-reserva" type="submit" id="eliminar_reserva" name="eliminar_reserva" value="Eliminar reserva">
                            </div>
                            <div>
                                <input class="boton-eliminar-reserva" type="submit" id="eliminar_reservas" name="eliminar_reservas" value="Eliminar todas las reservas">
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        @endif
        @if(isset($reservas_eliminadas))
            <div style="display: none" id="reservas_eliminadas"></div>
        @endif
        <div class="notification-container" id="containerNotification"></div>
        <div class="listado-de-reservas-container" id="div_reservas">
            <!--<form method="post">
                <div class="paginacion">
                    <div class="pagina_anterior">
                        <button class="link_paginacion" type="submit"><- Page 1</button>
                    </div>
                    <div class="pagina_actual">
                        <p>Page 1</p>
                    </div>
                    <div class="pagina_siguiente">
                        <button class="link_paginacion" type="submit">Page 3 -></button>
                    </div>
                </div>
            </form>-->
            @if($reservas)
            <h1 class="listado-de-reservas">Listado de reservas</h1>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Empleado</th>
                        <th>Mesa</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Personas</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                    <tr>
                        <td>{{$reserva -> getIdReserva()}}</td>
                        <td>{{$reserva -> getNombreEmpleado()}}</td>
                        <td>{{$reserva -> getMesa()}}</td>
                        <td>{{$reserva -> getFechaHoraReserva()}}</td>
                        <td>{{$reserva -> getNombre()}} {{$reserva -> getApellidos()}}</td>
                        <td>{{$reserva -> getPersonas()}}</td>
                        <td>{{$reserva -> getTelefono()}}</td>
                        <td>{{$reserva -> getCorreo()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection