@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/login2.css" />
@endsection
@section('titulo', 'Login')
@section('content')

<div class="grupo-formulario">
    <img class="background-icon" alt="" src="../public/assets/img/background-login@2x.png" />
    <form name="formulario" id="formulario" method="POST" action="login.php">
        <div class="grupo-login">
            <div class="tag-login">
                <label for="usuario" class="login">Login</label>
            </div>
            <input type="email" class="input-login" name="usuario" id="usuario" placeholder="Email del usuario" />
        </div>
        <div class="grupo-login">
            <div class="tag-password">
                <label for="password" class="login">Contraseña</label>
            </div>
            <input class="input-password" name="password" id="password" placeholder="Contraseña" type="password" />
        </div>
        <br>
        <input type="submit" class="boton-confirmar" name="confirmar" id="confirmar" value="Confirmar" />
    </form>
</div>

@endsection