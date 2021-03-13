<?php
$_TEMP = array();


$_TEMP["server"] = $base; //server de base de datos
//$_TEMP["database"] = 'bitacora'; //nombre de la base de datos
$_TEMP["username"] = '';
$_TEMP["password"] = '';

$connection_string = $_TEMP["server"];
@$conexionacc = odbc_connect($connection_string, $_TEMP["username"], $_TEMP["password"]);


unset($_TEMP);

?>
