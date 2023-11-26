@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/Login.css" />
@endsection
@section('titulo', 'Login')
@section('content')
<div class="login2">
    <div class="login-child"></div>
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    {{ $test }}
    <form name="formulario" id="formulario" method="POST" action="login.php">
        <div class="login-wrapper">
            <div class="contrasea">Login</div>
        </div>
        <div class="contrasea-wrapper">
            <div class="contrasea">Contraseña</div>
        </div>
        <div class="form-login">
            <input type="text" name="usuario" id="usuario" class="login-input" placeholder="Email de usuario" />
        </div>
        <div class="form-pass">
            <input type="password" name="password" id="password" placeholder="Contraseña" />
        </div>
        <div class="confirmar-wrapper">
            <div class="boton-confirmar">Confirmar</div>
            <input type="submit" class="confirmar-wrapper" name="confirmar" id="confirmar" value="Confirmar" />
        </div>
    </form>
</div>
@endsection