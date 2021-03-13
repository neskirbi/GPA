<?php
include "conexion.php";

$dni=filter_input(INPUT_POST,'dni');
$link=filter_input(INPUT_POST,'link');
$numero= filter_input(INPUT_POST, 'numero');
$idCall=filter_input(INPUT_POST,'idCall');
$query="UPDATE usuario SET rutsup='$link', telcon='$numero',idcon='$idCall' WHERE dni='$dni' ";

if(odbc_exec($conexion,$query))
{
    echo "guardado";
}
else
{
    echo "no guardado";
}