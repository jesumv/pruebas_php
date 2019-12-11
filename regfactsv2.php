<?php
require_once('include/helpers.php');
render('header', array('title' => 'CARGA MASIVA DE GASTOS XML'));
?>
<div id="dtabla">

</div>
<!-- dialogo aviso -->
		<div class="dialog-container">
			<div class="dialog">
				<div class="dialog-title" id="titulod">AVISO</div>
					<div class="dialog-body"></div>
					<div class="dialog-buttons">
						<button id="okbut" class="button">OK</button>
					</div>
			</div>
		</div>
		
		<div class="loader">
    			<svg viewBox="0 0 32 32" width="32" height="32">
      			<circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
    			</svg>
  		</div>
<button type='button' id='enviar' style='width:15%;margin:auto'>ENVIAR FACTURAS</button>
<?php
render('footer2');
?>