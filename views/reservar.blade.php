@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/gestion_de_reservas.css"/>
@endsection
@section('javascript')
<script src="./assets/js/jquery/jquery-3.6.0.min.js"></script>
<script src="../public/assets/js/gestion_de_reservas.js"></script>
@endsection
@section('titulo', 'Reservar')
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <form method="post" id="form_reserva" novalidate>
            <div class="reserva-container">
                @if(isset($reserva))
                    <h1 class="titulo-confirmacion-reserva">¡SU RESERVA SE HA REALIZADO CON ÉXITO!</h1>
                @else
                    <h1 class="titulo-reserva">HAZ TU RESERVA</h1>
                @endif
                <div class="reserva-containers">
                    <div class="reserva-container1">
                        <label class="titulo-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" {!!isset($reserva) ? 'readonly value="' . $reserva -> getNombre() . '"' : ''!!}>
                        <label class="titulo-label">Telefono:</label>
                        <input type="tel" id="telefono" name="telefono" {!!isset($reserva) ? 'readonly value="' . $reserva -> getTelefono() . '"' : ''!!}>
                        <label class="titulo-label">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" {!!isset($reserva) ? 'readonly value="' . $fecha_hora[0] . '"' : ''!!}>
                        <label class="titulo-label">Personas:</label>
                        @if(!isset($reserva))
                        <select name="personas">
                        @for($i = 1; $i < 7; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        </select>
                        @else
                        <input type="text" name="personas" readonly value="{{$reserva -> getPersonas()}}">
                        @endif
                    </div>
                    <div class="reserva-container2">
                        <label class="titulo-label">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" {!!isset($reserva) ? 'readonly value="' . $reserva -> getApellidos() . '"' : ''!!}>
                        <label class="titulo-label">Correo electrónico:</label>
                        <input type="email" id="correo" name="correo" {!!isset($reserva) ? 'readonly value="' . $reserva -> getCorreo() . '"' : ''!!}>
                        <label class="titulo-label">Hora:</label>
                        @if(!isset($reserva))
                        <select id="hora" name="hora">
                        </select>
                        @else
                        <input type="time" name="hora" readonly value="{{$fecha_hora[1]}}">
                        @endif
                    </div>
                </div>
                @if(!isset($reserva))
                <div class="finalizar-container">
                    <button type="submit" class="boton-finalizar" id="btn_reservar" name="btn_reservar">¡Reservar!</button>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection