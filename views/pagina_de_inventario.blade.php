@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/pagina_de_inventario.css" />
@endsection
@section('titulo', 'Login')
@section('content')

<div class="inventario">
    <img class="background-icon" alt="" src="../public/assets/img/background-login@2x.png" />

    <h1 class="inventario-del-restaurante">Inventario del restaurante</h1>
    <div class="tabla-stock">
        <table class="tabla">
            <tr class="th">
                <td scope="col">Código</td>
                <td scope="col">Producto</td>
                <td scope="col">Precio</td>
                <td scope="col">Cantidad</td>
                <td scope="col">Modificar</td>
                <td scope="col">Borrar</td>
            </tr>

            @foreach($stock as $producto)
            <tr>
                <td>
                    {{$producto->getId_producto()}}
                </td>
                <td>
                    {{$producto->getNombre_producto()}}
                </td>
                <td>
                    {{$producto->getPrecio()}}
                </td>
                <td>
                    {{$producto->getCantidad()}}
                </td>
                <td>
                    <img src="assets/img/lapiz.png" alt="" width="28" height="28">
                </td>
                <td>
                    <img src="assets/img/papelera.png" alt="" width="28" height="28">
                </td>
            </tr>
            @endforeach

        </table>
    </div>
    <div class="boton-parent">
        <button class="boton">
            <div class="texto-botones">Nuevo producto</div>
        </button>
    </div>
</div>


</body>

@endsection