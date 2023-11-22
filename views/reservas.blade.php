@extends('app')
@section('titulo', 'Reservas')
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <a class="boton-volver" href="login.php"><- Volver</a>
        <h1 class="titulo-reservas">Reservas</h1>
        <div class="botones-reservas">
          <div class="boton-nueva-reserva">
              <div><a href="../public/nueva_reserva.php">Nueva Reserva</a></div>
          </div>
          <div class="boton-modificar">
            <div><a href="../public/modificar_reserva.php">Modificar Reserva</a></div>
          </div>
          <div class="boton-eliminar">
            <div><a href="../public/eliminar_reservas.php">Eliminar reserva/s</a></div>
          </div>
        </div>
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