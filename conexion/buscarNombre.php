<?php
include "conexion.php";

$id=filter_input(INPUT_POST,'id');
$query="SELECT RazonSocial FROM cliente WHERE Id_cliente='$id'";
$result= odbc_exec($conexion, $query);
while(odbc_fetch_row($result))
{
    echo "Cliente: ".odbc_result($result,1);
}
