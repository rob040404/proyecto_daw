<?php

require_once '../vendor/autoload.php';

session_start();
if (isset($_GET['logout'])) {
    // Destruyo la sesión
    session_unset();
    session_destroy();
    setcookie(session_name(), '', 0, '/');
} elseif (isset($_SESSION['empleado'])) {
    $empleado = $_SESSION['empleado'];
    error_log($empleado->getRol());
    if ($empleado->getRol() == 'admin') {
        header('Location: pagina_de_administracion.php');
        exit;
    } else if ($empleado->getRol() == 'cocinero') {
        header('Location: pagina_cocinero.php');
        exit;
    } else if ($empleado->getRol() == 'camarero') {
        header('Location: pagina_camarero.php');
        exit;
    }
}
header('Location: principal.php');
