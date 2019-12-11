
</body>
<footer></footer>
<script type="text/javascript">
(function(){
	'use strict';
	var app=[];
	function addcabezal(){
		var dbody = document.getElementById('dtabla');
		var tbl = document.createElement('table');
		tbl.setAttribute("id", "lista");
		var reng0 = document.createElement('tr');
		var reng1 = document.createElement('tr');
		reng0.setAttribute("id", "re0");
		reng1.setAttribute("id", "re1");
		for(var i=0; i<15; i++){
			var celda = document.createElement('th');
			celda.setAttribute("id", "cl"+i);
			reng0.appendChild(celda);
		}
		tbl.appendChild(reng0);
		var celda = [];
		for(var i=0; i<15; i++){
			celda[i] = document.createElement('td');
			celda[i].setAttribute("id", "2cl"+i);
			reng1.appendChild(celda[i]);
		}
		celda[0].innerHTML = "No.";
		celda[1].innerHTML = "FECHA";
		celda[2].innerHTML = "RAZON SOCIAL";
		celda[3].innerHTML = "RFC";
		celda[4].innerHTML = "SERIE";
		celda[5].innerHTML = "FOLIO";
		celda[6].innerHTML = "CONCEPTO";
		celda[7].innerHTML = "SUBTOTAL";
		celda[8].innerHTML = "IVA";
		celda[9].innerHTML = "TOTAL";
		celda[10].innerHTML = "ACTOS AL 0";
		celda[11].innerHTML = "ACTOS AL 16";
		celda[12].innerHTML = "ACTOS EXEN";
		celda[13].innerHTML = "Arch.";
		celda[14].innerHTML = "D Mens";
		tbl.appendChild(reng1);
		dbody.appendChild(tbl)
		var feld = document.createElement("input");
		feld.setAttribute("type","checkbox");
		feld.id="cktodas"
		var celmar = document.getElementById('cl14');
		var etiq = document.createElement("Label");
        etiq.htmlFor = "cktodas";
        etiq.setAttribute("for","cktodas");
        etiq.innerHTML="Elige todas";
    	celmar.appendChild(etiq);
		celmar.appendChild(feld);
	}

	function actosal(conceptos){
		//esta funcion extrae los datos de impuestos de cada cada concepto y 
		//los suma a la categoria correspondiente. 16 o 0
		var longconc = conceptos.length;
		var resul =[];
		resul['exen']=0;
		resul['al0']=0;
		resul['al16']=0;

		for(var i=0;i<longconc;i++){
				var imp=conceptos[i].children;
				var elem=imp[0].children[0].children[0].attributes;
				var base=elem.getNamedItem('Base').nodeValue;
				var imp=elem.getNamedItem('Impuesto').nodeValue;
				var tipo=elem.getNamedItem('TipoFactor').nodeValue;
				var tasa=elem.getNamedItem('TasaOCuota').nodeValue;
				var monto=parseFloat(base);
			//separar condiciones
				//si es iva se procesa
				if(imp=='002'){
					//si es exento
						if(tipo=='Exento'){
							resul['exen']=resul['exen']+monto;
							}else{
								//si si lleva iva
								if(tasa=='0.160000'){
									resul['al16']=resul['al16']+monto;
									}else{
										resul['al0']=resul['al0']+monto;
										}
								}
					
					}
			}

		return resul;					
		}

	function llenareng(fecha,rfc,nombre,concep,stotal,total,narch,iva=null,serie = null,folio = null,
			al16=null,al0=null,exen=null){
		//llena un renglon de la tabla
		var tabla = document.getElementById("lista");
		var no = document.getElementsByTagName("tr").length-1;
		var row;
		var cell1;
		var cell2;
		var cell3;
		var cell4;
		var cell5;
		var cell6;
		var cell7;
		var cell8;
		var cell9;
		var cell10;
		var cell11;
		var cell12;
		var cell13;
		var cell14;
		var cell15;
		var totm =parseFloat(stotal).toFixed(2);
		var totm2 =parseFloat(total).toFixed(2);
		var ivam;
		if(iva!=""){ivam =parseFloat(iva).toFixed(2)}else{ivam="0.00"};
			row = tabla.insertRow();
			cell1 = row.insertCell(0);
			cell2 = row.insertCell(1);
			cell3 = row.insertCell(2);
			cell4 = row.insertCell(3);
			cell5 = row.insertCell(4);
			cell6 = row.insertCell(5);
			cell7 = row.insertCell(6);
			cell8 = row.insertCell(7);
			cell9 = row.insertCell(8);
			cell10 = row.insertCell(9);
			cell11 = row.insertCell(10);
			cell12 = row.insertCell(11);
			cell13 = row.insertCell(12);
			cell14 = row.insertCell(13);
			cell15 = row.insertCell(14);
			cell1.innerHTML = no;
			cell2.innerHTML = fecha;
			cell3.innerHTML = nombre;
			cell4.innerHTML = rfc; 
			cell5.innerHTML = serie;
			cell6.innerHTML = folio;
			cell7.innerHTML = concep;
			cell8.innerHTML = totm;
			cell9.innerHTML = ivam;
			cell10.innerHTML = totm2;
			cell11.innerHTML = al0.toFixed(2);
			cell12.innerHTML = al16.toFixed(2);
			cell13.innerHTML = exen;
			cell14.innerHTML = narch;
			var feld = document.createElement("input");
			feld.setAttribute("type","checkbox");
			feld.setAttribute("class","cdmens"); 
			cell15.appendChild(feld);			
	};
	
	function listafacturas(e,callback){
		//obtiene arreglo de elementos de caja de lista y los lee como xml
		var files = e.target.files; // FileList object
		var resul;
		var datos;
			for (var i=0, f; f=files[i]; i++) {
		          var r = new FileReader();
	            		r.onload = (function(f) {
	                		return function(e) {
	                			var arch= f.name;
	                    		var contents = e.target.result;
	                   		datos=callback(contents);
	                   		//si el tipo de comprobante es pago, ignora el renglon
	                   		if(datos.tipoc=="I"){
		                   		//se extraen los datos de actos al 16 y 0
		                   		var actos= actosal(datos.conceptos);
		                   		//excepcion para galeon por error en impuesto
		                   		if(datos.rfc=="CARR680604116"){actos.al0=datos.stotal};
	                   			llenareng(datos.fecha,datos.rfc,datos.nombre,datos.conceptoc,
				                datos.stotal,datos.total,arch,datos.iva,datos.serie,datos.folio,
				                actos.al16,actos.al0,actos.exen);

	                   		}			                   		
	                				};
	           	 		})(f);

	            r.readAsText(f);
	        } 
      	
		}
	
	function sacadato(arreglo){
		var arrtemp=[];
		//obtiene los valores del array de elementos
		for(var i=1; i<14;i++){
			arrtemp.push(arreglo.item(i).innerHTML);
		}
		return arrtemp;
	}

	function envialista(){
		//esta funcion recolecta la informacion y la envia a la bd
		//coleccion de renglones
		var nofac = document.getElementsByTagName("tr");
		var nodos;
		var opr;
		var longi = nofac.length;
		//arreglo de resultados
		var result1=[];
		for(var i=2; i<longi;i++){		
			 nodos = nofac.item(i).childNodes;
			opr =nodos.item(14).childNodes;
			if(opr.item(0).checked==true){
					result1.push(sacadato(nodos));				
			}
		}
		var arrmod= JSON.stringify(result1);
		$.post('php/enviafacts.php', { 'result1':arrmod }, function(data){
			app.toggleAddDialog.visible=true;
			})
			.done(function(){
				alert("Facturas en BD Mes OK");
			})
			.fail(function(){
				alert("PROBLEMA EN INSERCION FACTURAS");
			});
			
	}

	function marcatodas(){
		//esta funcion marca todos los check de dmensual
	var todas = document.getElementsByClassName('cdmens');
		for (var i = 0; i < todas.length; ++i) {
		    var item = todas[i];  
		    item.checked = true;
		}	
	}

	//oculta el dialogo de aviso
	  document.getElementById('okbut').addEventListener('click', function() {
		    // oculta el dialogo
		    app.toggleAddDialog(false);
		  });

		 app = {
				    isLoading: true,
				    spinner: document.querySelector('.loader'),
				    addDialog: document.querySelector('.dialog-container'),
				    dmensaje: document.querySelector('.dialog-body')
				  };
		// Muestra aviso de acciones
		  app.toggleAddDialog = function(visible,mensaje=null) {
		    if (visible) {
		      app.addDialog.classList.add('dialog-container--visible');
		      app.dmensaje.innerHTML= mensaje;
		    } else {
		      app.addDialog.classList.remove('dialog-container--visible');
		    }
		  };
		  if (app.isLoading) {
		      app.spinner.setAttribute('hidden', true);
		      app.isLoading = false;
	    }  
	
	addcabezal();	
	var evt = document.getElementById('files');
	evt.addEventListener('change', function(e){listafacturas(e,leeXMLing)},false);
	document.getElementById('enviar').addEventListener('click',envialista);
	var cktodas = document.getElementById('cktodas');
	 cktodas.addEventListener('change', function(){
		 if(this.checked){marcatodas()}
	 });
	
})();
</script>
</html>