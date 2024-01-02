@extends('app')
@section('estilos')
<link rel="stylesheet" href="../public/assets/css/carta.css"/>
@endsection
@section('titulo', 'Carta')

@section('content')
<div class="gestin-de-menscarta-al-puls">
    <!--<img class="background-icon-carta" alt="" src="../public/assets/img/background@2x.png" />-->
    <div class="contenido-carta">
        <div class="descripcion-carta">
            <h1>NUESTRA CARTA</h1>
            ¡Nuestro restaurante mexicano es como un viaje express a México, sin
            necesidad de pasaporte ni maletas! Te servimos tacos que hacen vibrar
            tus papilas gustativas y margaritas que hacen vibrar tu felicidad. ¡Ven
            a disfrutar de una fiesta de sabor con mariachis en tu plato!"
         </div>

        <div class="borde-amarillo-carta">
            <h1 class="encabezado-entrantes">ENTRANTES</h1>
            <h3 class="encabezado-entrantes">ENCHILADAS</h3>
            @php
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='enchiladas' && $entrante->estado==='activado'){
                        echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                            '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-entrantes">FLAUTAS</h3>
            @php
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='flautas' && $entrante->estado==='activado'){
                        echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                            '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-entrantes">NACHOS</h3>
            @php
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='nachos' && $entrante->estado==='activado'){
                        echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                            '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-entrantes">QUESOS</h3>
            @php
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='quesos' && $entrante->estado==='activado'){
                        echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                            '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                    }
                }
            @endphp
            
            @php
                $otroExiste=false;
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='otro' && $entrante->estado==='activado'){
                        $otroExiste=true;       
                    }
                }
                if($otroExiste===true){
                    echo '<h3 class="encabezado-entrantes">OTROS</h3>';
                    foreach($entrantes as $entrante){
                        if($entrante->subcategoria==='otro' && $entrante->estado==='activado'){
                            echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                                '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                        }
                    }
                }
                
                
            @endphp 
           
            
        </div>
        <div class="borde-rojo-carta">
            <h1 class="encabezado-principales">PRINCIPALES</h1>
            <h3 class="encabezado-principales">TACOS</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='tacos' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-principales">FAJITAS</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='fajitas' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-principales">ENSALADAS</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='ensaladas' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-principales">QUESADILLAS</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='quesadillas' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-principales">GRINGAS</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='gringas' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-principales">DE CUCHARA</h3>
            @php
                foreach($principales as $principal){
                    if($principal->subcategoria==='cuchara' && $principal->estado==='activado'){
                        echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                            '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                    }
                }
            @endphp
            @php
                $otroExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='otro' && $principal->estado==='activado'){
                        $otroExiste=true;       
                    }
                }
                if($otroExiste===true){
                    echo '<h3 class="encabezado-principales">OTROS</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='otro' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
                
                
            @endphp 
            
            
        </div>
        <div class="borde-azul-carta">
            <h1 class="encabezado-postres">POSTRES</h1>
            <h3 class="encabezado-postres">TARTAS</h3>
            @php
                foreach($postres as $postre){
                    if($postre->subcategoria==='tartas' && $postre->estado==='activado'){
                        echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                            '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-postres">SORBETES</h3>
            @php
                foreach($postres as $postre){
                    if($postre->subcategoria==='sorbetes' && $postre->estado==='activado'){
                        echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                            '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-postres">HELADOS</h3>
            @php
                foreach($postres as $postre){
                    if($postre->subcategoria==='helados' && $postre->estado==='activado'){
                        echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                            '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                    }
                }
            @endphp
            @php
                $otroExiste=false;
                foreach($postres as $postre){
                    if($postre->subcategoria==='otro' && $postre->estado==='activado'){
                        $otroExiste=true;       
                    }
                }
                if($otroExiste===true){
                    echo '<h3 class="encabezado-postres">OTROS</h3>';
                    foreach($postres as $postre){
                        if($postre->subcategoria==='otro' && $postre->estado==='activado'){
                            echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                                '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                        }
                    }
                }
                
                
            @endphp 
            
        </div>
        <div class="borde-verde-carta">
            <h1 class="encabezado-bebidas">BEBIDAS</h1>
            <h3 class="encabezado-bebidas">REFRESCOS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='refrescos' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">ZUMOS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='zumos' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">LIMONADAS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='limonadas' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">CAFÉS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cafes' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">CERVEZAS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cervezas' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">VINOS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='vinos' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">TEQUILAS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='tequilas' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">GINEBRA</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='ginebra' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">RON</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='ron' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">WHISKY</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='whisky' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">MARGARITAS</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='margaritas' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">MEZCALES</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='mezcales' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            <h3 class="encabezado-bebidas">COCTELES</h3>
            @php
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cocteles' && $bebida->estado==='activado'){
                        echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                            '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                    }
                }
            @endphp
            @php
                $otroExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='otro' && $bebida->estado==='activado'){
                        $otroExiste=true;       
                    }
                }
                if($otroExiste===true){
                    echo '<h3 class="encabezado-bebidas">OTROS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebidas->subcategoria==='otro' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-postres">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br>'.$bebida->precio.'€<br>';           
                        }
                    }
                }
                
                
            @endphp 
        </div>
        
        @php
            $otroExiste=false;
            if(!empty($otros)){
                foreach($otros as $otro){
                    if($otro->estado==='activado'){
                        $otroExiste=true;
                    }
                }
                
                if($otroExiste===true){
                    echo '<div class="borde-rosa-carta">';
                    echo    '<h1 class="encabezado-otros">OTROS</h1>';
                            foreach($otros as $otro){
                                if($otro->estado==='activado'){
                                    echo '<p><h4 class="nombre-otros">'.strtoupper($otro->nombre).
                                         '</h4>'.$otro->ingredientes.'<br>'.$otro->precio.'€<br>'; 
                                }
                            }
                    echo '</div>';
                    
                }
            }
            
        @endphp
        
        
        
    <div class="contenido">
      
</div>
@endsection


