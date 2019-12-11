<?php
require_once('include/helpers.php');
render('conectabd');
render('headerv2',array('title' => 'REGISTRO DE ORDEN DE COMPRA'));
?>
<div data-role="page" id="ocv3pag">
     <div data-role="header">
        <a href="portalmov.php" data-ajax="false" class="ui-btn-left ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-home">Inicio</a>
        <?php echo'<h1>'.htmlspecialchars($title).'</h1>'?>;
        <a href="logout.php" data-ajax="false" class="ui-btn-right ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-left ui-icon-delete">Cerrar</a>
    </div>
</div>	