<?php
include "conexion.php";

$mensaje=filter_input(INPUT_POST,'mensaje');
$query="UPDATE usuario SET us_direccion='$mensaje', acceso='1' ";
if(odbc_exec($conexion,$query))
{
    echo "enviado";
}
else
{
    echo "no enviado";
}

