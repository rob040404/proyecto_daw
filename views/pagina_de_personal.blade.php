@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/pagina_de_personal.css" />
@endsection
@section('javascript')
<script src="./assets/js/jquery/jquery-3.6.0.min.js"></script>
<script src="./assets/js/personal.js"></script>
@endsection
@section('titulo', 'Personal')
@section('content')
<div class="personal">
    <h1 class="h1">Personal del restaurante</h1>
    <table class="tabla">
        <tr class="th">
            <td scope="col">Código</td>
            <td scope="col">Nombre</td>
            <td scope="col">Apellidos</td>
            <td scope="col">Contraseña</td>
            <td scope="col">Puesto</td>
            <td scope="col">Email</td>
            <td scope="col">Modificar</td>
            <td scope="col">Borrar</td>
        </tr>
        @foreach($empleado as $empleado)
        <tr>
            <td>
                {{$empleado->getId_usuario()}}
            </td>
            <td>
                <input class="input-interior-disabled" type="text" value="{{$empleado->getNombre()}}" disabled>
            </td>
            <td>
                <input class="input-interior-disabled" type="text" value="{{$empleado->getApellidos()}}" disabled>
            </td>
            <td>
                <input class="input-interior-disabled" type="password" value="{{$empleado->getContrasena()}}" disabled>
            </td>
            <td>
                <input class="input-interior-disabled" type="text" value="{{$empleado->getRol()}}" disabled>
            </td>
            <td>
                <input class="input-interior-disabled" type="text" value="{{$empleado->getEmail()}}" disabled>
            </td>
            <td>
                <img class="botonlapiz" src="assets/img/lapiz.png" alt="" width="28" height="28">
                <img class="botondisquete" src="assets/img/save-icon.png" alt="" width="28" height="28">
            </td>
            <td>
                <img class="botonpapelera" src="assets/img/papelera.png" alt="" width="28" height="28">
            </td>
        </tr>
        @endforeach
    </table>
    <a href="nuevo_empleado.php">
        <button class="boton">
            <div class="texto-botones">Alta empleado</div>
        </button>
    </a>
</div>
@endsection