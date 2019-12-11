<?php
/*** Autoload class files ***/ 
    function __autoload($class){
      require('../include/' . strtolower($class) . '.class.php');
    }
	
    $funcbase = new dbutils;
/*** conexion a bd ***/
    $resul=0;
    $mysqli = $funcbase->conecta();
    if (is_object($mysqli)) {
    //recoleccion de variables
        $datos = json_decode($_POST['result1'], true); 
    $longi = count($datos);

        foreach ($datos as $valor){
            $fecha= $valor[0];
            $nombre=$valor[1];
            $rfc = $valor[2];
            $serie = $valor[3];
            $folio = $valor[4];
            $concep = $valor[5];
            $subt =$valor[6];
            $iva=$valor[7];
            $tot = $valor[8];
            $al0=$valor[9];
            $al16=$valor[10];
            $exen=$valor[11];
            $arch=$valor[12];

            if($al16==0){$al16='NULL';};
            if($al0==0){$al0='NULL';};
            if($exen==0){$exen='NULL';};
           try {
                $mysqli->autocommit(false);
                $mysqli->query("INSERT INTO factrec (serie, folio,concepto,archivo,fecha,rfc,subtotal,iva,total,actosal16,actosal0,actosexen)
					VALUES ('$serie','$folio','$concep','$arch','$fecha','$rfc',$subt,$iva,$tot,$al16,$al0,$exen)")or die (mysqli_error($mysqli));
                //efectuar la operacion
                $mysqli->commit();
                $resul=0;
            } catch (Exception $e) {
                //error en las operaciones de bd
               $mysqli->rollback();
               die("error en alta facts: ".$e);
            }
            
        };

										
			/* cerrar la conexion */
			mysqli_close($mysqli);  
			
			
	} else {
	    $resul = -1;
        die ("<h1>'No se establecio la conexion a bd'</h1>");
    }
    //salida de respuesta
    $jsondata['resul'] =$resul;
    echo json_encode($jsondata); 