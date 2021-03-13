<?php
include 'conexion.php';
$dni=filter_input(INPUT_POST,'dni');

$query="UPDATE usuario set cfecha='', chora='',rutsup='',tipocon='',telcon='',idcon='' WHERE dni='$dni'";
if(odbc_exec($conexion,$query))
{
    echo "borrada";
}
else
{
    echo "no borrada";
}

