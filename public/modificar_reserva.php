<?php
require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;

$views = __DIR__.'/../views';
$cache = __DIR__.'/../cache';

$opcion = "Modificar Reserva";
$blade = new BladeOne($views, $cache);
echo $blade -> run('nueva_modificar_reserva', compact('opcion'));