<?php
  function __autoload($class){
	  require('include/' . strtolower($class) . '.class.php');
    }
    
    $funcbase = new dbutils;
/*** conexion a bd ***/
    $mysqli = $funcbase->conecta();
    if (is_object($mysqli)) {

    } else {
        //die ("<h1>'No se establecio la conexion a bd'</h1>");
    }
    	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRUEBAS GASTOS</title>
   <link rel="stylesheet" type="text/css" href="css/inline.css">
   <link rel="stylesheet" type="text/css" href="css/plant1.css">
   <link rel="stylesheet" type="text/CSS" href="css/dropdown_two.css" />
   <link rel="shortcut icon" href="img/logomin.gif" />  
   <link rel="apple-touch-icon" href="img/logomin.gif">
   <script src="js/jquery3/jquery-3.0.0.min.js"></script>
   <script src="js/fcfdi.js"></script>
   
   <script>
   	'use strict';
   	(function() {
		//bandera que indica si se ha modificado un campo manualmente
		var bandera = 0;
		var app=[];
		var app2=[];
		var ctas=[];
		var obj1;

		//DEFINICION DE FUNCIONES VARIAS
		function ivaaux(){
				//calcula el iva de auxiliares
			var iva=document.getElementById("miva");
			var llevaiva= document.getElementById("smpago").value;
			//solo si el met pago es transferencia
			if(llevaiva=="03"){
				var monto= document.getElementById("mprop").value;
				iva.value = monto *0.16;
				}else{iva.value=""}		
			}
		function mconcep(){
			aparece();
			var metodo = document.getElementById("smpago").focus();
			}
		
			function aparece(){                              
	 			//elige elementos auxiliares a presentar
	 			var concep = document.getElementById("concepg").value;
	 			var metodo = document.getElementById("smpago").value;
 				var etiq =document.getElementById("ladic");
 				var propi=document.getElementById("mprop");
				var etiq2 =document.getElementById("lefec");
				var efec =document.getElementById("efec");
				var etiq3 =document.getElementById("liva");
				var miva= document.getElementById("miva");
				var estaoc=etiq.classList.contains("ocult");
	 			//si se elige alim  y no es transferencia lleva propina
				if(concep=="alim viaje" && estaoc==true){
					etiq.innerHTML="Propina?:";
					etiq.classList.remove("ocult");
					propi.value="";	
					propi.classList.toggle("ocult");
					etiq2.classList.toggle("ocult");	
					efec.classList.toggle("ocult");	
				//si se elige transferencia lleva comision
					}else if(metodo=="03"){
						etiq.innerHTML="Comisión?:";
						propi.value="5";
						ivaaux();
						if(estaoc==true){
							etiq.classList.toggle("ocult");					
							propi.classList.toggle("ocult");
							etiq3.classList.toggle("ocult");
							miva.classList.toggle("ocult");
							}else{

								}											
					}else if(metodo!="03" && concep!="alim viaje"){
						//sie el metodo de pago es distinto, se ocultan las casillas
								etiq.classList.add("ocult");
    							propi.value="";					
    							propi.classList.add("ocult");
    							etiq2.classList.add("ocult");
    							efec.classList.add("ocult");
    							etiq3.classList.add("ocult");
    							miva.classList.add("ocult");
    				}				
				}
			
		function modmpago(){
			//esta funcion modifica elementos al cambiar el metodo de pago
			//elige la cuenta a afectar segun el metodo de pago
			cuentasi();
			aparece();
			}
		function cuentasi(){
			//esta funcion pone el numero de cuenta default
			var cuenta = document.getElementById("cuenta");
			var elec = document.getElementById("smpago").value;
			switch(elec){
			case "02":
			case "03":
				cuenta.value='8145';
			break;
			case "04":
				cuenta.value='8886';
			break;
			case "28":
			cuenta.value='2730';
			break;
			}
			cuenta.focus();
		}

		function resetea(){
			  //limpia la forma
			document.getElementById('avisor').innerHTML="";
			document.getElementById('rgasto').reset();
			document.getElementById("mensaje").value = "";
			var mensac = document.getElementById("mensd");
			mensac.setAttribute('class', 'ocult');
		  }

	$(document).ready(function() {
	 			
	    		var evt = document.getElementById('arch');
	 			  //evt.addEventListener('change', function(e){listafacturas(e,leeXML)},false);	 			  
	    		 	var app = {
	 			    isLoading: true,
	 			    spinner: document.querySelector('.loader'),
	 			    container: document.querySelector('.main'),
	 			    addDialog: document.querySelector('#dialogog'),
	 			  };


	 			  /*****************************************************************************
	 		   *
	 		   * Metodos para actualizar/refrescar la IU
	 		   *
	 		   ****************************************************************************/

	 		   //preparacion de fecha = hoy por defecto
	 		   Date.prototype.toDateInputValue = (function() {
	 			    var local = new Date(this);
	 			    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
	 			    return local.toJSON().slice(0,10);
	 			});

	 			
	 		   // Toggles the visibility of dialog.	  	 
	 			  app.toggleAddDialog = function(visible) {
	 			    if (visible) {
	 			      app.addDialog.classList.add('dialog-container--visible');
	 			    } else {
	 			      app.addDialog.classList.remove('dialog-container--visible');
	 			    }
	 			  }; 
 			   			  	 			  	   
	 			    if (app.isLoading) {
	 							      app.spinner.setAttribute('hidden', true);
	 							      app.container.removeAttribute('hidden');
	 							      app.isLoading = false;
	 						    }
	 			    
	 			//metodos de los elementos de la pagina

	 			function valida(elemen){
	 		   		var fecha=document.getElementById(elemen).value;
	 		   	    //corregir funcion fecha
	 		   	    var fechac=isValidDate(fecha)
	 		   		if(!fechac){return -1;}else{return 0;}
	 		   	}
	 			function muestrad(){
	 				    var adics=document.getElementsByClassName("adic");
	 				    var longi=adics.length;
	 				    for(var i=0;i<longi;i++){
		 				    	adics[i].classList.add("ocult");
		 				    }
    	    				app.toggleAddDialog(true)
    	    				document.getElementById('fgas').focus();
	    			}
	    			function cancela(){
	    				app.toggleAddDialog(false)
	    				resetea();
	    			}

   					function pdeduc(){
   	   					//obtener el porcentaje de deduccion
   	   					var resul;
   							var deducheck= document.getElementsByName('factorded');
   							var dlongi = deducheck.length;
   							for(var i=0; i<dlongi; i++){
									if(deducheck[i].checked = true){
											resul= deducheck[i].value;
											return resul;
										}
   	   							}
   	   					}	

   					function propefec(){
   	   					//obtiene si el check efectivo se pulso
							var resul= document.getElementById("efec").checked;
							return resul;
   	   					}
	    			function enviagas(){
	    				//envio de gasto a la base de datos
	    				//recoleccion de variables
	    				var fecha = document.getElementById('fgas').value;
	    				var monto =	document.getElementById('montog').value;
	    				var iva =	document.getElementById('ivag').value;
	    				var fact =	document.getElementById('nfact').value;
	    				var arch =	document.getElementById('arch').value;
	    				var catg =	document.getElementById('catg').value;
	    				var concepg = document.getElementById('concepg').value;
	    				var metpago = document.getElementById('smpago').value;
	    				var cuenta = document.getElementById('cuenta').value;
	    				var folio = document.getElementById('folio').value;
	    				//obtener porcentaje de deduccion
	    				var pordeduc= pdeduc();
	    				var mprop= document.getElementById('mprop').value;
	    				var efec=propefec();
	    				var ivaaux= document.getElementById('miva').value;
	    				var tipo= "g";
	    				//envio a bd
	    					$.post( "php/enviaotros.php",
	 							{	tipo:tipo,
	 								fecha:fecha,
	 								monto:monto,
	 								iva:iva,
	 								fact:fact,
	 								arch:arch,
	 								catg:catg,
	 								concep:concepg,
	 								metpago:metpago,
	 								cuenta:cuenta,
	 								folio:folio,
	 								pordeduc:pordeduc,
	 								mprop:mprop,
	 								efec:efec,
	 								ivaaux:ivaaux,
	 								orig:"",
	 								dest:""								
	 							 }, null, "json" )
	 							 .done(function(data) {
	 	    							var resul= data.resul;
	 	    							//document.getElementById('rgasto').reset();
	 									//app.toggleAddDialog(false);
	 									//location.reload(true);
	 	    						})
	 	    						.fail(function(xhr, textStatus,errorThrown ) {		
	 	    							//document.write("ERROR EN REGISTRO:"+errorThrown);
	 								});	
	    				
	    			}
	    			

	    			function regg(){
	    				//funcion al apretar el boton de registrar gasto
	    				var aqui= document.getElementById('avisor');
	 					aqui.innerHTML="";
	    				var fech1=document.getElementById("fgas").id;
	    				var valgas=valida(fech1);
	    				switch(valgas){
	    					case -1:
	    					aqui.innerHTML="POR FAVOR INTRODUZCA FECHA VALIDA (AAAA/MM/DD)";
	    					break;
	    					default:
	    					enviagas();
	    					
	    				}
	    			}


	
	    		 function calciva(){
	 				var valor=document.getElementById("montog").value;
	 				var ivac=valor*.16;
	 				var civa=document.getElementById("ivag");
	 				civa.value= ivac.toFixed(2);
	 				calctotal();
	 				civa.focus();
	 				bandera = 1;
	 			}

	    		function calctotal(){
	 				var base = document.getElementById("montog").value;
	 				var iva = document.getElementById("ivag").value;
	 				var total = Number(base) + Number(iva);
	 				var ctotal = document.getElementById("totalg");
	 				ctotal.value = total.toFixed(2);
	 				document.getElementById("catg").focus();
	 			}
		
				function cgasto(){
					//acciones de acuerdo a la clase de gasto
					//si deducible mostrar check factor deduc
					var cgasto= this.value;
					var cfded= document.getElementById("fded")
					if(cgasto<"06"){
						if(cfded.classList.contains("ocult")){cfded.classList.toggle("ocult")};
						}else{
							if(!cfded.classList.contains("ocult")){cfded.classList.toggle("ocult")};	
							}
					}

	 		//escuchas
	 		//boton muestra
	 			document.getElementById("muestra").addEventListener('click',muestrad,false)
	 			//boton registro gast
	 			document.getElementById("reggasto").addEventListener('click',regg,false)
	 			//boton cancela
	 			document.getElementById("butAddCancel").addEventListener('click',cancela,false)
	 			//calculo de iva
	 			document.getElementById("montog").addEventListener('change',calciva,false)
	 			//calculo de total
	 			document.getElementById("ivag").addEventListener('change',calctotal,false)
	 			//clase de gasto
	 			document.getElementById("catg").addEventListener('change',cgasto,false)
	 			//metodo de pago
	 			document.getElementById("smpago").addEventListener('change',modmpago,false)
	 			//concepto
					document.getElementById("concepg").addEventListener('change',mconcep,false)
				//propina
				document.getElementById("mprop").addEventListener('change',ivaaux,false)
	    		 });
		        	  
   	})();
   </script>
<script src="js/fauxcx.js"></script>
</head>
	<body>
	    <header class="header">
		    <div>
		    	<h1 class="header__title">Bienvenido(a), Prueba</h1>
		    </div>
	    </header>
		<main class="main">

				 <br>
				 <h2>PRUEBAS GASTOS</h2>
				  <br>

			<button type="button" id="muestra">MOSTRAR DIALOGO</button>	   
		 </main>	  
		 <!-- caja dialogo registro pago -->	 
		  <div class="dialog-container" id="dialogog" >
		    <div class="dialog">
		    	<div class="dialog-title" id="titulod">REGISTRO DE GASTO</div>
		    	 	<div id="mensd" class="rengn ocult">
		    			<label>MENSAJES: </label>
		    			<textarea name="mensaje"  id="mensaje" rows="4" cols="50"></textarea>
		    		</div>
			    	<div class="dialog-body">
			    		<form id="rgasto" method ="post" action="#" onsubmit="return false;">
			    			<div class="rengn">
						    	<label>Archivo XML: </label><input type="file" name="arch"  id="arch" accept=".xml"/>
						    	<label>Factura: </label><input type="text" name="nfact"  id="nfact" class="cajamfc"/>
						    	<label>Fecha: </label><input type="date" name="fgas"  id="fgas" class="cajacfc"/>
					    	</div>
			    			<div class="rengn">
    			    			<label>Subtotal:</label><input type="text" name="montog" id="montog" class="cajacfc"/>
    			    			<label>Iva:</label><input type="text" name="ivag" id="ivag" size="10" class="cajacfc"/>
    			    			<label>TOTAL:</label><input type="text" name="totalg" id="totalg" class="cajacfc"/>
			    			</div>

			    			<div	 class="rengn">
			    			<label>Concepto Orig: </label><input type="text" name="concepo"  id="concepo" class="cajalfc"/>
			    			</div>
			    			<div class="rengn">
			    				<label>Categoría: </label>
			    				<select id="catg" name="catg">
									<option value="0">Seleccione la clase de gasto</option>
									<option value="601">Gastos Generales</option>
									<option value="602">Gastos de Venta</option>
									<option value="603">Gastos de Administración</option>
									<option value="701.1">Comisiones Bancarias</option>
									<option value="601.83">Generales No Deduc</option>
									<option value="602.83">Ventas No Deduc</option>
									<option value="603.81">Admon No Deduc</option>
									<option value="703">Otros Gastos Deducibles</option>
		         				</select>
		         				<label>Concepto: </label><input type="text" name="concepg"  id="concepg" class="cajam" maxlength="20"/>		
		         				<div class="rengn">
    		         				<span id="fded" class= "ocult" >
    		         					<label>%deduc: </label>
    		         					<input type="radio" name="factorded" value=1 checked > Al 100%
        			    				<input type="radio" name="factorded"value =.08> Al 8.75%
    		         				</span>
		         				</div>
		         				
		         				
			    			</div>

			    			<label>Metodo de Pago: </label>
			    			<div class="rengn">
			    				<select id="smpago" name="smpago">
									<option value="0">Seleccione el medio de pago</option>
									<option value="01">Efectivo</option>
									<option value="02">Cheque</option>
									<option value="03">Transferencia</option>
									<option value="13">Cargo a cuenta</option>
									<option value="04">Tarjetas de Credito</option>
									<option value="28">Tarjetas de Débito</option>
									<option value="99">Otros</option>
		         				</select>
		         				<label>Cuenta: </label><input type="text" name="cuenta"  id="cuenta" class="cajac" maxlength="4" />
		         				<label>Folio Op: </label><input type="text" name="folio"  id="folio" class="cajac" />
			    			</div>
			    			<div>
			    				<label id="ladic" class="adic"> </label><input type="number" name="mprop"  id="mprop" class="cajac adic" />
			    				<label id="lefec" class="adic" >Efectivo? </label><input type="checkbox" name="efec"  id="efec" class="cajac adic" />
			    				<label id="liva" class="adic">IVA </label><input type="number" name="miva"  id="miva" class="cajac adic" />
			    			</div>
			    			<div class="rengn">
			    				<h4 id="avisor"></h4>
			    			</div>
			    			<div class="dialog-buttons">
			    				<button type="submit" id="reggasto" class="button a">Registrar</button>
						      	<button type="submit" id="butAddCancel" class="button b" >Cancelar</button>
						    </div>
			    		</form>
			    	</div>
		    </div>
		  </div>
		  	  
      <div class="loader">
        <svg viewBox="0 0 32 32" width="32" height="32">
          <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
        </svg>
      </div>
      	<footer>
  		</footer>
	</body>
</html>
