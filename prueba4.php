<?php
/*** Autoload class files ***/
function __autoload($class){
    require_once('include/' . strtolower($class) . '.class.php');
}

$funcbase = new dbutils;
$rfc=$_REQUEST['rfc'];
/*** conexion a bd ***/
$mysqli = $funcbase->conecta();
if (is_object($mysqli)) {
    $sqlCommand = "SELECT idproveedores,nom_corto FROM proveedores WHERE rfc =$rfc";
    //Execute the query here now
    $query1=mysqli_query($mysqli,$sqlCommand) or die ("ERROR EN CONSULTA DE SELEC CTES. "
        .mysqli_error($mysqli));
    if($query1){
        $tempolong= mysqli_num_rows($query1);
        $tempo=mysqli_fetch_array($query1, MYSQLI_ASSOC);
        $result;
        if($tempolong!=0){
            $result=array('exito' => 0,'idprov' => $tempo['idproveedores'],'nomcorto' => $tempo['nom_corto']);
            echo $result['idprov'];
        }else{
            $result=array('exito'=>1);
        }
    }else{$result=array('exito'=>-1);}
    }
