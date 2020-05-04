<?php
require_once('include/helpers.php');
render('conectabd');
$nombre=$_SESSION['nombre'];
render('headerv2', array('title' => 'ELABORACION DE LISTAS DE PRECIOS','nombre'=>$nombre,'tboton'=>'elegir factura'));
render('parte1');
?>

	</body>
	<footer></footer>
</html>