@extends('app')
@section('titulo', 'Error base de datos')
@section('content')
<div class="home">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <h3>No se ha podido conectar a la base de datos.</h3>
    <h4>{{ $error->getMessage() }}</h4>
</div>
@endsection