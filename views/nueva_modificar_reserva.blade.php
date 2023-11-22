@extends('app')
@section('titulo', $opcion)
@section('content')
<div class="reservas-container">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png"/>
    <div class="reservas-contenido">
        <a class="boton-volver" href="reservas.php"><- Volver</a>
        <h1 class="titulo-reservas">Reservas</h1>
        <h1 class="titulo-reservas">{{$opcion}}</h1>
        <form method="post" action="#">
            <div class="nueva-reserva-container">
                <div class="form-containers">
                    <div class="form-container1">
                        <label>Nombre:</label>
                        <input type="text">
                        <label class="titulo-form">Telefono:</label>
                        <input type="tel">
                        <label class="titulo-form">Nº Comensales:</label>
                        <input type="number">
                    </div>
                    <div class="form-container2">
                        <label>Fecha:</label>
                        <input type="text">
                        <label class="titulo-form">Correo electronico:</label>
                        <input type="email">
                        <input class="boton-guardar" type="submit" value='Confirmar la reserva'>
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