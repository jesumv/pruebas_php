<?php
	/**
	 * esta clase se usa para operaciones de base de datos
	 */
	 	
	class dbutils  {
		function __construct() {		
		}
		
		

		public function conecta() {
	    /***esta funcion establece la conexion a sql***/
		/***variables de conexion ***/
		$mysql_hostname = "localhost";
		$mysql_user = "root";
		$mysql_password = "";
		$mysql_database = "ventasprueba";


		$mysqli = new mysqli($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
		if($mysqli->connect_errno > 0){
		    die('No se establecio conexion a la base de datos [' . $mysqli->connect_error . ']');
			return -1;
		}else{
				if(!$mysqli->set_charset("utf8")) {
    				die("Error cargando el conjunto de caracteres utf8: ". $mysqli->error);
				}else{
					return $mysqli;
				}
		
			}
    
	   }

		
	   public function checalogin($mysqli){
	       //***checa si el cliente esta registrado ***/
	       //obtiene el path absoluto
	       session_start();
	       
	       $user_check=$_SESSION['usuario'];
	       
	       $ses_sql=mysqli_query($mysqli,"select username from usuarios where username='$user_check'");
	       $row=mysqli_fetch_array($ses_sql);
	       
	       $login_session=$row['username'];
	       
	       if(!isset($login_session))
	       {
	           header("Location:/pruebas_php/logout.php");
	           
	       }
	   }
	}/*** fin de la clase ***/
	
