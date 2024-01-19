@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/gestion_de_pedidos.css"/>
@endsection
@section('javascript')
<script src="./assets/js/jquery/jquery-3.6.0.min.js"></script>
<script src="../public/assets/js/gestion_de_pedidos.js"></script>
@endsection
@section('titulo', 'Gestión de pedidos')
@section('content')
<div id="pedidos_container" class="pedidos-container">
    <div class="pedidos-contenido">
        <h1 class="titulo-pedidos">Gestión de pedidos</h1>
        <div class="fecha-pedido">
            <input type="date" id="fecha_pedido" value="{{$fecha_pedido}}">
        </div>
        @if(!is_null($pedidos))
            <div class="leyenda">
                <div class="estado-container">
                    <img src="assets/img/icons8-emoji-circulo-rojo-48.png" width="35" height="35">
                    <p class="estado-pedido">Pediente</p>
                </div>
                <div class="estado-container">
                    <img src="assets/img/icons8-emoji-circulo-amarillo-48.png" width="35" height="35">
                    <p class="estado-pedido">Confirmado</p>
                </div>
                <div class="estado-container">
                    <img src="assets/img/icons8-emoji-circulo-verde-48.png" width="35" height="35">
                    <p class="estado-pedido">Completado</p>
                </div>
            </div>
            @foreach($pedidos as $pedido)
            <div class="pedido-container" id="pedido_{{$pedido -> getIdPedido()}}" name="pedido">
                <div class="cabecera-pedido-container">
                    <div class="cabecera-pedido-item">
                        <img src="assets/img/user-icon.png" width="35" height="35">
                        <p>{{$pedido -> getNombreEmpleado()}}</p>
                    </div>
                    <div class="cabecera-pedido-item">
                        <img src="assets/img/table-icon.png" width="35" height="35">
                        <p>{{$pedido -> getMesa()}}</p>
                    </div>
                    <div class="cabecera-pedido-item">
                        <img src="assets/img/clock-icon.png" width="35" height="35">
                        <p>{{substr(explode(' ', $pedido -> getFechaHoraPedido())[1],0,5)}}</p>
                    </div>
                </div>
                <input type="hidden" id="estado_pedido_{{$pedido -> getIdPedido()}}" value="{{$pedido -> getEstadoPedido()}}">
                <div class="invisible" id="platos_container_{{$pedido -> getIdPedido()}}"></div>
                <div class="invisible" id="btns_acciones_{{$pedido -> getIdPedido()}}">
                    <button class="btn-acciones" id="btn_guardar_{{$pedido -> getIdPedido()}}">Guardar</button>
                </div>
                @set($precio_total = 0)
                <ul id="listado_platos_pedido_{{$pedido -> getIdPedido()}}" @php if(($pedido -> getEstadoPedido() == 'Confirmado' && is_null($pedido -> getDetallesPedido())) || $pedido -> getEstadoPedido() == 'Pendiente'){echo 'class=invisible';}@endphp>
                    @if(!is_null($pedido -> getDetallesPedido()))
                        @php $categoria = '' @endphp
                        @foreach($pedido -> getDetallesPedido() as $detalles_pedido)
                            @if($detalles_pedido -> getCategoriaPlato() != $categoria)
                                <p class="categoria-platos">{{strtoupper($detalles_pedido -> getCategoriaPlato()) . ($detalles_pedido -> getCategoriaPlato() == 'principal' ? 'ES': 'S')}}</p>
                                @php $categoria = $detalles_pedido -> getCategoriaPlato() @endphp
                            @endif
                            <li>{{$detalles_pedido -> getNombrePlato()}} - {{$detalles_pedido -> getPrecioPlato()}} € x {{$detalles_pedido -> getUnidades()}}... {{number_format($detalles_pedido -> getUnidades() * $detalles_pedido -> getPrecioPlato(), 2) . ' €'}}</li>
                            @php $precio_total = number_format($detalles_pedido -> getUnidades() * $detalles_pedido -> getPrecioPlato() + $precio_total, 2) @endphp
                        @endforeach
                    @endif
                </ul>
                <div class="{{$pedido -> getEstadoPedido() != 'Confirmado' ? 'invisible' : 'anadir-plato-container'}}" id="anadir_plato_container_{{$pedido -> getIdPedido()}}">
                    <button class="btn-anadir-plato">Editar Orden</button>
                </div>
                <div class="{{$precio_total == 0 ? 'invisible' : 'precio-pedido'}}" id="precio_pedido_{{$pedido -> getIdPedido()}}">
                    <p id="precio_total_{{$pedido -> getIdPedido()}}">Total: {{$precio_total}} €</p>
                </div>
                @if($pedido -> getEstadoPedido() != 'Completado')
                    <div id="botones_container_{{$pedido -> getIdPedido()}}" class="botones-container">
                        <div class="{{$pedido -> getEstadoPedido() == 'Pendiente' ? 'invisible' : 'btn-retroceder'}}" id="btn_retroceder_container_{{$pedido -> getIdPedido()}}">
                            <button class="btn-cambio-estado" id="btn_retroceder_{{$pedido -> getIdPedido()}}"  data-idPedido="{{$pedido -> getIdPedido()}}"><-</button>
                        </div>
                        <div class="{{($pedido -> getEstadoPedido() == 'Confirmado' && is_null($pedido -> getDetallesPedido())) ? 'invisible' : 'btn-avanzar'}}" id="btn_avanzar_container_{{$pedido -> getIdPedido()}}">
                            <button class="btn-cambio-estado" id="btn_avanzar_{{$pedido -> getIdPedido()}}"  data-idPedido="{{$pedido -> getIdPedido()}}">-></button>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        @else
            <h2 class="texto-advertencia">No existe ningun pedido registrado, asegurese de haber realizado una reserva previamente</h2>
        @endif
        <form method="post" id="form_envio_fecha">
            <input type="hidden" id="fecha_pedido_envio" name="fecha_pedido">
        </form>
    </div>
</div>
@endsection