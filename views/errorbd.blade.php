@extends('app')
@section('titulo', 'Error base de datos')
@section('estilos')
<meta name="viewport" content="initial-scale=1, width=device-width" />
<link rel="stylesheet" href="../public/assets/css/error.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
@endsection
@section('content')
<div class="error">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <div class="mensaje">
        <h3>No se ha podido conectar a la base de datos.</h3>
        <h4>{{ $error->getMessage() }}</h4>
    </div>
</div>
@endsection