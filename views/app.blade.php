<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1, width=device-width" />
        <link rel="stylesheet" href="../public/assets/css/global.css" />
        <link rel="stylesheet" href="../public/assets/css/index.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Irish Grover:wght@400&display=swap" />
        <link rel="icon" type="image/jpg" href="assets/img/favicon.png"/>
        @yield('estilos')
        @yield('javascript')
        <title>@yield('titulo')</title>
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="header-default">
                <div class="login" id="loginContainer">
                    @if (isset($sesion_abierta))
                    @if ($sesion_abierta)
                    <a href="index.php" class="user-icon"> <img src="assets/img/user-icon.png" alt="" width="35" height="35"> </a>
                    <div class="login1" id="loginText"><a href="index.php?logout=1">Logout</a></div>
                    @else
                    <div class="login1" id="loginText"><a href="login.php">Empleados</a></div>
                    @endif
                    @endif
                </div>
                <div class="botones-der">
                    <div class="contacto">
                        <img class="sign-3-icon" alt="" src="../public/assets/img/sign-3@2x.png" />
                        <div class="contacto1 menu"><a href="contacto.php">CONTACTO</a></div>
                    </div>
                    <div class="contacto">
                        <img class="sign-3-icon" alt="" src="../public/assets/img/sign-3@2x.png" />
                        <div class="trabajo1 menu"><a href="trabaja_con_nosotros.php">EMPLEO</a></div>
                    </div>
                </div>
                <div class="botones-izq">
                    <div class="contacto">
                        <img class="sign-3-icon" alt="" src="../public/assets/img/sign-3@2x.png" />
                        <div class="reservar1 menu"><a href="reservar.php">RESERVAR</a></div>
                    </div>
                    <div class="contacto ">
                        <img class="sign-3-icon" alt="" src="../public/assets/img/sign-3@2x.png" />
                        <div class="carta1 menu"><a href="carta.php">CARTA</a></div>
                    </div>
                </div>
                <div class="logo">
                    <div class="frame-calavera">
                        <a href="principal.php"><img class="calavera-icon" alt="" src="../public/assets/img/calavera@2x.png" /></a>
                    </div>
                </div>
                <div class="header">
                    <div class="crunchy-rancho1"><a href="principal.php">CRUNCHY RANCHO</a></div>
                </div>
            </div>
        </header>
        <!-- Termina Header -->
        <!-- Contenido -->
        <main>
            @yield('content')
        </main>
        <!-- Termina Contenido -->
        <!-- Footer -->
        <footer>
            <div class="footer-default">
                <div class="footer">
                    <div class="bajo"></div>
                    <div class="back">
                        <div class="desc-footer">
                            <div class="crunchy-rancho">Crunchy Rancho</div>
                            <div class="desde-tacos-tradicionales">
                                Desde tacos tradicionales hasta enchiladas con sabor casero.
                                Descubre la verdadera pasión por la comida mexicana en cada
                                bocado.
                            </div>
                        </div>
                        <div class="mapa">
                            <div class="crunchy-rancho"><a href="reservar.php">Reservar</a></div>
                            <div class="crunchy-rancho"><a href="carta.php">Carta</a></div>
                            <div class="crunchy-rancho"><a href="contacto.php">Contacto</a></div>
                            <div class="crunchy-rancho"><a href="trabaja_con_nosotros.php">Trabaja con nosotros</a></div>
                        </div>
                        <div class="direccion">
                            <div class="crunchy-rancho">Donde estamos:</div>
                            <div class="crunchy-rancho">
                                <p class="calle-ficcin-nmero">Calle Ficción, número 123</p>
                                <p class="calle-ficcin-nmero">
                                    ciudad Imaginaria, País Inexistente
                                </p>
                            </div>
                        </div>
                        <img class="taco-footer-2" alt="" src="../public/assets/img/taco-footer-2.svg" />
                        <img class="taco-footer-1" alt="" src="../public/assets/img/taco-footer-2.svg" />
                    </div>
                </div>
            </div>
        </footer>
        <!-- Termina Footer -->
    </body>
</html>