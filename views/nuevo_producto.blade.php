@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/nuevo_producto.css" />
@endsection
@section('titulo', 'Nuevo producto')
@section('content')
<div class="nuevo-producto">
    <img class="background-icon" alt="" src="../public/assets/img/background-nuevo-producto@2x.png" />


    <h1 class="h1">Crear nuevo producto</h1>
    <form class="formulario" id="nuevo-producto" name="nuevo-producto">
        <div class="nombre">
            <label class="label" htmlfor="nombre-producto">Nombre del producto:</label>
            <input class="input" name="nombre-producto" id="nombre-producto" type="text" />
        </div>
        <div class="precio">
            <label class="label" htmlfor="precio">Precio (eur):</label>
            <input type="number" class="input" name="precio" id="precio" type="text" />
        </div>
        <div class="precio">
            <label class="label" htmlfor="cantidad">Cantidad:</label>
            <input type="number" class=" input" name="cantidad" id="cantidad" type="text" />
        </div>
        <input type="submit" class="boton" name="anadir" id="anadir" value="Añadir" />

    </form>
</div>
@endsection