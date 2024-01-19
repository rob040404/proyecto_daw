@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/nuevo_producto.css" />
@endsection
@section('titulo', 'Nuevo producto')
@section('content')
<div class="nuevo-producto">
    <img class="background-icon" alt="" src="../public/assets/img/background-nuevo-producto@2x.png" />
    <h1 class="h1">Crear nuevo producto</h1>
    @if (isset($error))
    <h1 class="h1">{{ $error }}</h1>
    @endif
    <form class="formulario" id="nuevo_producto" name="nuevo_producto" method="post" action="nuevo_producto.php">
        <div class="nombre">
            <label class="label" htmlfor="nombre_producto">Nombre del producto:</label>
            <input class="input" name="nombre_producto" id="nombre_producto" type="text" />
        </div>
        <div class="precio">
            <label class="label" htmlfor="precio">Precio (eur):</label>
            <input type="number" step="0.01" class="input" name="precio" id="precio" />
        </div>
        <div class="precio">
            <label class="label" htmlfor="cantidad">Cantidad:</label>
            <input type="number" step="0.01" class=" input" name="cantidad" id="cantidad" />
        </div>
        <input type="submit" class="boton" name="anadir" id="anadir" value="Añadir" />
    </form>
</div>
@endsection