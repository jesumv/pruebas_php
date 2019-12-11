
</body>
<footer></footer>
<script type="text/javascript">
(function(){
	'use strict';
	function haztabla(){
		}
	function creapag(e,callback,callback2){	
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
	                   		datos=leeXMLpago(contents);
	                   		//si el tipo de comprobante es pago, ignora el renglon
	                   		if(datos.tipoc=="P" && datos.exito===0){
	                   			const tbl= document.getElementById('tabla');
	                   			var longp=datos.pagos.length;
	                   			var fechap=datos.fecha;
	                   			for(var i=0;i<longp;i++){
	                   				var reng= document.createElement('tr');
		                   				for(var j=0;j<6;j++){
			                   				var celda=document.createElement('td');
			                   				var valor;
    			                   				switch(j){
        			                   				case 0:
            			                   				valor=datos["fecha"];
            			                   				break;
        			                   				case 1:
            			                   				valor=datos["folior"];
            			                   				break;
        			                   				case 2:
            			                   				valor=datos.pagos[i]["folio"];
            			                   				break;
        			                   				case 3:
            			                   				valor=datos.pagos[i]["import"];
            			                   				break;
        			                   				case 4:
            			                   				valor=datos.pagos[i]["saldoant"];
            			                   				break;
        			                   				case 5:
            			                   				valor=datos.pagos[i]["saldoact"];
            			                   				break;
        			                   				default:
        			                   				valor="prueba";
    			                   				}
    			                   				celda.innerHTML=valor;
    			                   				reng.appendChild(celda);   			                				
			                   				}
		                   						tbl.appendChild(reng);
		                   			}
	                   		}else{alert("datos incorrectos")}			                   		
	                				};
	           	 		})(f);

	            r.readAsText(f);
	        } 
	}
	var evt = document.getElementById('files');
	evt.addEventListener('change', function(e){creapag(e,leeXMLpago,haztabla)},false);

})();
</script>
</html>