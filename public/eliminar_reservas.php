<?php
require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;

$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';

$blade= new BladeOne($views, $cache);
echo $blade->run('eliminar_reservas');