/**
 * @author jmv
 */
$(document).on("submit", "#board_login", function(){
  if(validate()){
		$.post('php/ajax_login.php', $(this).serialize(), function(data){
			if(data == 0){
				alert("Nombre de usuario o contraseña incorrectos");
			} else if (data ==1){
				window.open('nuevapag.php', '_self');	
			}else{window.open('prueba1.html', '_self')}
		});
	}
})
;

function validate(){
		if($("#username").val() === ''){
			alert("Debe proporcionar un usuario");
			$("#username").focus();
			return false;
		}
		if($("#password").val() === ''){
			alert("Debe Proporcionar su contraseña");
			$("#password").focus();
			return false;
		}
		return true;
}