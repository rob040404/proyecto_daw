@extends('app')
@section('titulo', 'Eliminar Reservas')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/reservas.css"/>
<link rel="stylesheet" href="../public/assets/css/nueva_reserva.css"/>
<link rel="stylesheet" href="../public/assets/css/eliminar_reservas.css"/>
@endsection
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <a class="boton-volver" href="reservas.php"><- Volver</a>
        <h1 class="titulo-reservas">Reservas</h1>
        <h1 class="titulo-reservas">Eliminar reserva/s</h1>
        <form method="post" action="#">
            <div class="borrar-reserva-container">
                <div class="form-containers">
                    <div class="form-container1">
                        <label>Mesa:</label>
                        <input type="text">
                    </div>
                    <div class="form-container2">
                        <input class="boton-eliminar-reserva" type="submit" value="Eliminar reserva">
                    </div>
                    <div>
                        <input class="boton-eliminar-reserva" type="submit" value="Eliminar todas las reservas">
                    </div>
                </div>
            </div>
        </form>
        <h1 class="listado-de-reservas">Listado de reservas</h1>
        <div class="contenedor-tabla-listado-de-reservas">
            <form method="post">
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
            </form>
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