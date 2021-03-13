<?php
$_TEMP = array();


$_TEMP["server"] = 'D5CLQ382\SQLEXPRESS'; //server de base de datos
$_TEMP["database"] = 'dbventasjti'; //nombre de la base de datos
$_TEMP["username"] = 'claudio';
$_TEMP["password"] = 'cpromo*';

$connection_string = 'DRIVER={SQL SERVER};SERVER='. $_TEMP["server"] . ';DATABASE=' . $_TEMP["database"];
$conexion = odbc_connect($connection_string, $_TEMP["username"], $_TEMP["password"]);
if(!$conexion){
        @die("<h2 style='text-align:center'>Imposible conectarse a la base de datsos!!! </h2>".mysqli_error($conexion));
    }
    if (@mysqli_connect_errno()) {
        @die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

unset($_TEMP);

?>
ok...
<?='lkj';?>	