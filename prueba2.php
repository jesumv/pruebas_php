<?php require_once('include/helpers.php');?>

<?php render('header', array('title' => 'PORTAL DE PRUEBAS VANNETTI')); ?>
<main>
<div id="factura" >
	<div id="t0" ><table id="efactura" ></table></div>
	<div id="t1" ><table id="rfactura" ></table></div>
	<br>
	<div id="t2" ><table id="cfactura"></table></div>
	<br>
	<div id="t3"><table id="pfactura"></table></div>
</div>
<div id="pie" class="adicional">   
</div>

<div id="pedido">
</div>

<div class='dialog-container'> 
		<div id="aviso" class='dialog'>
			<div class="dialog-title">AVISO:</div>
			<div class="dialog-body" id="errmens"></div>
			<div class="dialog-buttons">
        		<button id="butok" class="button">OK</button>
      		</div>
		</div>
</div>
</main>	

<?php render('footer'); ?>