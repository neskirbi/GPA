<?php include "../conexion/conexion.php";
$var1=$_POST['id'];
$var2=$_POST['entrada'];
$var3=$_POST['salida'];
$query="UPDATE actividad set entrada='$var2',salida='$var3' WHERE Id_actividad='$var1'";
odbc_exec($conexion, $query);
header('Location: reportewebproducto.php');