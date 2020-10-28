<?php


?>
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>PRUEBA LECTURA XML</title>
		<style type="text/css">
		table,th,td{
		border: 1px solid black;
		}
		</style>
    	<script src="js/fcfdiv3.js"></script>
    	<script type="text/javascript">
    	'use strict';

    	function addfila(tabla,celdas,conten){
        	//añade una fila a la tabla
    		let tablae = document.getElementById(tabla);
    		let celda;
    		let i = 0;
    		const nreng = document.getElementsByTagName("tr").length;
    		var rengt2= document.createElement('tr');
    		rengt2.setAttribute("id", "re"+(nreng));
    		do{celda= document.createElement('td');
    			celda.setAttribute("id","cel"+i);
        		celda.innerHTML=conten.attributes[i].value;
    			rengt2.appendChild(celda);
    			i++;
        		}while(i < celdas);
    		tablae.appendChild(rengt2);
        	}

    	function tconcep(conceptos){
				let longi = conceptos.length;
				for(var i= 0;i<longi;i++){
					addfila("concep",8,conceptos[i]);
					}
				

        	}
    	
		function encabezado(datos){
			let nfact= document.getElementById('nfact');
    		nfact.innerHTML=datos.seriefolio;
    		let nemisor = document.getElementById('nemisor');
    		nemisor.innerHTML=datos.nombre;
    		let rfc = document.getElementById('rfc');
    		rfc.innerHTML=datos.rfc;
    		let fecha=document.getElementById('fecha');
    		fecha.innerHTML=datos.fecha;
    		let forma=document.getElementById('fpago');
    		forma.innerHTML=datos.fpago;
    		let metodo=document.getElementById('mpago');
    		metodo.innerHTML=datos.metpago;
    		let uso=document.getElementById('uso');
    		uso.innerHTML=datos.uso;
    		let recep=document.getElementById('nrecep');
    		recep.innerHTML= datos.nombrerecep;
    		let rfcr=document.getElementById('rfcr');
    		rfcr.innerHTML= datos.rfcrecep;
			}
    	function presentafact(datos){
        		encabezado(datos);
        		tconcep(datos.conceptos);
        	}
     	function cfdi(e,callback,callback2){
     		var files = e.target.files; // FileList object
			var resulta;
			var f=files[0];
			var r = new FileReader();
		      	r.onload = (function(f){
		      		 return function(e){
		      			var contents=e.target.result;
						 resulta=callback(contents); 
						 if(resulta.exito===0){
							 callback2(resulta);
						 }else{alert("falla en lectura")};
		      		 };
		    	})(f);
				r.readAsText(f);
     	}
    	</script>
    </head>
    <header class="cabezal">
         	<h1>FACTURA</h1><br/>
    </header>  
    <body>
  		<input class='headerButton' id='archxml' name='archxml'  type='file' accept='.xml' />";
  		<div id='encab'>
      		<table id='efact'>
          		
              		<tr id='fl1'><th>EMISOR</th><th id='nemisor'></th><th>RFC</th><th id='rfc'></th></tr>
              		<tr id='fl2'><th>NUMERO</th><th id='nfact'></th><th>FECHA</th><th id='fecha'></th></tr>
              		<tr id='fl3'><th>FORMA DE PAGO</th><th id='fpago'></th><th>METODO PAGO</th><th id='mpago'></th></tr>
              		<tr id='fl5'><th>USO CFDI</th><th id='uso'></th></tr>
            </table> 
            
            <table id='recep'>
            		<tr><th>RECEPTOR</th><th id='nrecep'></th></tr>
            		<tr><th>RFC</th><th id='rfcr'></th></tr>
            </table>       		
  		</div>
  		<div id='tconcep'>
      		<table id='concep'>
      		<tr><th>CANTIDAD</th><th>UNIDAD</th><th>CODIGO</th><th>DESCRIPCION</th><th>VALOR UNITARIO</th>
      		<th>DESCUENTOS</th><th>IMPUESTOS</th><th>IMPORTE</th></tr>
          	</table>
  		</div>

    </body>
    <footer>
    <script type="text/javascript">
    (function(){
     	
     	 var gped = document.getElementById('archxml');
		  	gped.addEventListener('change', function(e){cfdi(e,leeXMLing,presentafact)},false);
     	
	 })();
    </script>
    </footer>
</html>