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
            ¡Bienvenidos al auténtico sabor de México! En nuestro restaurante, te invitamos a deleitar tu paladar con una exquisita 
            selección de platos tradicionales mexicanos, elaborados con ingredientes frescos y sabores vibrantes que te transportarán 
            directamente a las calles de México. Desde los clásicos tacos y enchiladas hasta nuestros famosos guacamoles y margaritas, 
            cada bocado es una experiencia única llena de autenticidad y pasión por la cocina mexicana. ¡Disfruta de una aventura culinaria 
            que celebra la riqueza y diversidad de la gastronomía de México en cada plato!
         </div>
        <div class="borde-amarillo-carta">
            <h1 class="encabezado-entrantes">ENTRANTES</h1>
            @php
                $enchiladasExiste=false;
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='enchiladas' && $entrante->estado==='activado'){
                        $enchiladasExiste=true;       
                    }
                }
                if($enchiladasExiste===true){
                    echo '<h3 class="encabezado-entrantes">ENCHILADAS</h3>';
                    foreach($entrantes as $entrante){
                        if($entrante->subcategoria==='enchiladas' && $entrante->estado==='activado'){
                            echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                                '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                        }
                    }
                } 
            @endphp
            @php
                $flautasExiste=false;
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='flautas' && $entrante->estado==='activado'){
                        $flautasExiste=true;       
                    }
                } 
                if($flautasExiste===true){
                    echo '<h3 class="encabezado-entrantes">FLAUTAS</h3>';
                    foreach($entrantes as $entrante){
                        if($entrante->subcategoria==='flautas' && $entrante->estado==='activado'){
                            echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                                '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                        }
                    }
                } 
            @endphp
            @php
                $nachosExiste=false;
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='nachos' && $entrante->estado==='activado'){
                        $nachosExiste=true;       
                    }
                }
                if($nachosExiste===true){
                    echo '<h3 class="encabezado-entrantes">NACHOS</h3>';
                    foreach($entrantes as $entrante){
                        if($entrante->subcategoria==='nachos' && $entrante->estado==='activado'){
                            echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                                '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $quesosExiste=false;
                foreach($entrantes as $entrante){
                    if($entrante->subcategoria==='quesos' && $entrante->estado==='activado'){
                        $quesosExiste=true;       
                    }
                }
                
                if($quesosExiste===true){
                echo '<h3 class="encabezado-entrantes">QUESOS FUNDIDOS</h3><p><u>SE ACOMPAÑAS DE PICO DE GALLO Y TRES TORTITAS DE TRIGO O MAÍZ</u></p>';
                    foreach($entrantes as $entrante){
                        if($entrante->subcategoria==='quesos' && $entrante->estado==='activado'){
                            echo '<p><h4 class="nombre-entrante">'.strtoupper($entrante->nombre).
                                '</h4>'.$entrante->ingredientes.'<br>'.$entrante->precio.'€<br>';           
                        }
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
            @php
                $tacosExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='tacos' && $principal->estado==='activado'){
                        $tacosExiste=true;       
                    }
                }
                if($tacosExiste===true){
                    echo '<h3 class="encabezado-principales">TACOS</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='tacos' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $fajitasExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='fajitas' && $principal->estado==='activado'){
                        $fajitasExiste=true;       
                    }
                }
                if($fajitasExiste===true){
                    echo '<h3 class="encabezado-principales">FAJITAS</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='fajitas' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $ensaladasExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='ensaladas' && $principal->estado==='activado'){
                        $ensaladasExiste=true;       
                    }
                }
                
                if($ensaladasExiste===true){
                    echo '<h3 class="encabezado-principales">ENSALADAS</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='ensaladas' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $quesadillasExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='quesadillas' && $principal->estado==='activado'){
                        $quesadillasExiste=true;       
                    }
                } 
                if($quesadillasExiste===true){
                echo '<h3 class="encabezado-principales">QUESADILLAS</h3><p><u>UNA TORTITA RELLENA DE QUESO FUNDIDO Y...</u></p>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='quesadillas' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $gringasExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='gringas' && $principal->estado==='activado'){
                        $gringasExiste=true;       
                    }
                }
                if($gringasExiste===true){
                    echo '<h3 class="encabezado-principales">GRINGAS</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='gringas' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $cucharaExiste=false;
                foreach($principales as $principal){
                    if($principal->subcategoria==='cuchara' && $principal->estado==='activado'){
                        $cucharaExiste=true;       
                    }
                }
                
                if($cucharaExiste===true){
                    echo '<h3 class="encabezado-principales">DE CUCHARA</h3>';
                    foreach($principales as $principal){
                        if($principal->subcategoria==='cuchara' && $principal->estado==='activado'){
                            echo '<p><h4 class="nombre-principales">'.strtoupper($principal->nombre).
                                '</h4>'.$principal->ingredientes.'<br>'.$principal->precio.'€<br>';           
                        }
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
            @php
                $platoExiste=false;
                foreach($postres as $postre){
                    if($postre->subcategoria==='tartas' && $postre->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-postres">TARTAS</h3>';
                    foreach($postres as $postre){
                        if($postre->subcategoria==='tartas' && $postre->estado==='activado'){
                            echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                                '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($postres as $postre){
                    if($postre->subcategoria==='sorbetes' && $postre->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-postres">SORBETES</h3>';
                    foreach($postres as $postre){
                        if($postre->subcategoria==='sorbetes' && $postre->estado==='activado'){
                            echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                                '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                        }
                    }
                }
            @endphp
            @php
            
                $platoExiste=false;
                foreach($postres as $postre){
                    if($postre->subcategoria==='helados' && $postre->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-postres">HELADOS</h3>';
                    foreach($postres as $postre){
                        if($postre->subcategoria==='helados' && $postre->estado==='activado'){
                            echo '<p><h4 class="nombre-postres">'.strtoupper($postre->nombre).
                                '</h4>'.$postre->ingredientes.'<br>'.$postre->precio.'€<br>';           
                        }
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
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='refrescos' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">REFRESCOS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='refrescos' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='zumos' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }   
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">ZUMOS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='zumos' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='limonadas' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">LIMONADAS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='limonadas' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cafes' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">CAFES</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='cafes' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cervezas' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">CERVEZAS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='cervezas' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='vinos' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">VINOS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='vinos' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='tequilas' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">ZUMOS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='tequilas' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='ginebra' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">GINEBRA</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='ginebra' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }    
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='ron' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">RON</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='ron' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }    
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='whisky' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">WHISKY</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='whisky' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }    
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='margaritas' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">MARGARITAS</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='margaritas' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='mezcales' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">MEZCALES</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='mezcales' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
                    }
                }
            @endphp
            @php
                $platoExiste=false;
                foreach($bebidas as $bebida){
                    if($bebida->subcategoria==='cocteles' && $bebida->estado==='activado'){
                        $platoExiste=true;       
                    }
                }
                if($platoExiste===true){
                    echo '<h3 class="encabezado-bebidas">COCTELES</h3>';
                    foreach($bebidas as $bebida){
                        if($bebida->subcategoria==='cocteles' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
                        }
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
                        if($bebida->subcategoria==='otro' && $bebida->estado==='activado'){
                            echo '<p><h4 class="nombre-bebidas">'.strtoupper($bebida->nombre).
                                '</h4>'.$bebida->ingredientes.'<br><u>'.$bebida->precio.'€</u><br>';           
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