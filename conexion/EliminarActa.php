<?php
include "conexion.php";

$id=$_POST['id'];
$numero=$_POST['numero'];
$name=$_POST['name'];


$dir="../documents/";

$filepath = $dir.$name; 
unlink($filepath);


$query="SELECT actas,actas_status,actas_comentarios from  usuarionom WHERE  Id_usuario='$id'";
$result=odbc_exec($conexion,$query);
$row= odbc_fetch_object($result);

$actas=json_decode($row->actas,true);
$actas_status=json_decode($row->actas_status,true);
$actas_comentarios=json_decode($row->actas_comentarios,true);
 

unset($actas[$numero]);
unset($actas_status[$numero]);
unset($actas_comentarios[$numero]);

$query="UPDATE usuarionom SET 
actas='".json_encode($actas)."',
actas_status='".json_encode($actas_status)."',
actas_comentarios='".json_encode($actas_comentarios)."' WHERE  Id_usuario='$id'";



if(odbc_exec($conexion,$query)){
    echo "ok";
}else{
    echo "Error:Error de consulta.";   
}

?>

