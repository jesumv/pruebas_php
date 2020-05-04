<?php 
/**
     * headerv2.php
     *
     * La parte superior de las paginas
     * con subtitulo,menu y boton de accion 
     *
     * JMV
     * 
     */
?>
<!DOCTYPE html>
<html lang="es">
  	<head>
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Vannetti Cucina</title>
	<link rel="stylesheet" type="text/css" href="css/plantv2.css">
   	<link rel="stylesheet" type="text/CSS" href="css/dropdown_two.css" />
    <script src="js/jquery-2.2.4.min.js"/></script>
	<meta name="author" content="jmv">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" href="img/logomin.gif" />  
	<link rel="apple-touch-icon" href="img/logomin.gif"/>
	<script type="text/javascript">
	
	</script>
  	</head>
  	<header>	
  		<div class="header">
    	<h1 class="header__title">Bienvenido(a), <?php echo $nombre  ?></h1>
    	</div> 
    	<div class="titulo">
        	<h2><?php echo htmlspecialchars($title) ?></h2>
        </div> 
 <?php render('menu')?>       		
  
        
 <?php 
    if(isset($tboton)){
        //queda para cuando se estilize el boton y se le pueda agregar el selector de archivos
        //echo "<button type='button' id='btnaccion' class='headerButton'>".htmlspecialchars($tboton)."</button>";
        echo'<div class="botones">'.entrainp('elija archivo','facteleg','xml','cajainput').'</div>';
    }
    if(isset($tboton2)){
        //si se envia titulo para un segundo boton       
       echo " <button class='boton2' id='botreg'>Registrar Pedido</button>";
    }
    ?>
    
    	</header>
  	<body>
