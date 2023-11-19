@extends('app')
@section('titulo', 'Reservas')
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <div class="titulo-reservas">Reservas</div>
        <div class="botones-reserva">
          <div class="boton-nueva-reserva">
            <div><a href="#">Nueva Reserva</a></div>
          </div>
          <div class="boton-modificar">
            <div><a href="#">Modificar Reserva</a></div>
          </div>
          <div class="boton-eliminar">
            <div><a href="#">Eliminar reserva/s</a></div>
          </div>
        </div>
        <div class="listado-de-reservas">Listado de reservas</div>
        <div class="contenedor-tabla-listado-de-reservas">
            No existe ningún registro
            <table>
                <thead>
                    <tr>
                        <th>Mesa</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>4</td>
                        <td>Luis Felipe</td>
                        <td>22/11/2023 22:40</td>
                        <td>673892213</td>
                        <td>luisi@gmail.com</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection