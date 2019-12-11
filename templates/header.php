<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href= "css/pruebas.css" />
<script src="js/fcfdiv3.js"></script>
<script src="js/jquery3/jquery-3.3.1.min.js"></script>

  </head>
  <header>
	<h2 class='header__title'><?php echo htmlspecialchars($title) ?></h2>
	<form>
		<div>
			<label for="files">Seleccione las facturas</label>
			<input id="files" name="files[]" type="file" accept=".xml" multiple/>
		</div>
		<div>
			<label for="archoc" class="btn">Generar OC</label>
			<input id="archoc" name="files[]" type="file" accept=".xml" />
			<label for="archpd" class="btn">Generar Pedido</label>
			<input id="archpd" name="files[]" type="file" accept=".xml" />
		</div>	
	</form>
</header>
  <body>

