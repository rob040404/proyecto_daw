@extends('app')
@section('titulo', 'Error')
@section('content')
<div class="home">
    <img class="background-icon" alt="" src="../public/assets/img/background@2x.png" />
    <h3>Se ha producido un error inesperado, estamos trabajando para resolverlo...</h3>
    <h4>{{ $exception->getMessage() }}</h4>
</div>
@endsection