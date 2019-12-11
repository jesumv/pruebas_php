<?php
require_once('include/helpers.php');
render('conectabd');
//$nombre=utf8_decode($_SESSION['nombre']);
$nombre= 'prueba';
render('headerv2', array('title' => 'ELABORACION DE LISTAS DE PRECIOS','nombre'=>$nombre));
render('menu');

?>