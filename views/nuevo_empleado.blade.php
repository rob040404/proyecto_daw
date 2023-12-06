@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/nuevo_empleado.css" />
@endsection
@section('titulo', 'Alta de nuevo usuario')
@section('content')
<div class="nuevo-empleado">
    <img class="background-icon" alt="" src="../public/assets/img/background-nuevo-producto@2x.png" />


    <h1 class="h1">Dar de alta</h1>
    @if (isset($error))
    <h3 class="h3">{{ $error }}</h3>
    @endif
    <form class="formulario" id="nuevo_empleado" name="nuevo_producto" method="post" action="nuevo_empleado.php">
        <div class="nombre">
            <label class="label" htmlfor="nombre">Nombre:</label>
            <input class="input" name="nombre" id="nombre" type="text" />
        </div>
        <div class="apellidos">
            <label class="label" htmlfor="apellidos">Apellidos:</label>
            <input type="text" class="input" name="apellidos" id="apellidos" />
        </div>
        <div class="contrasena">
            <label class="label" htmlfor="contrasena">Contraseña:</label>
            <input type="password" class=" input" name="contrasena" id="contrasena" />
        </div>
        <div class="rol">
            <label class="label" htmlfor="rol">Puesto:</label>
            <select class="input" name="rol" id="rol" />
            <option value="null">--</option>
            <option value="admin">Admin</option>
            <option value="cocinero">Cocinero</option>
            <option value="camarero">Camarero</option>
            </select>
        </div>
        <div class="email">
            <label class="label" htmlfor="email">Correo electrónico:</label>
            <input type="email" class="input" name="email" id="email" />
        </div>
        <input type="submit" class="boton" name="alta" id="alta" value="Añadir" />
    </form>
</div>
@endsection