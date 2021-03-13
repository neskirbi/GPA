<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php
include"conexion.php";
echo"<br>".$cons="SELECT * from  usuario  ";
$cons=odbc_exec($conexion,$cons);
while($cons2=odbc_fetch_object($cons))
{

	echo"<br>".$cons2->nombre;
	echo"<br>".$cons2->idusuario;
	echo"<br>".$cons2->dni;
	echo"<br>";

	echo"<br>".$cons22="SELECT * from  cliente where RutaVenta='$cons2->idusuario' ";
	$cons22=odbc_exec($conexion,$cons22);
	while($cons222=odbc_fetch_object($cons22))
	{
		echo"<br>".$cons222->RazonSocial;
		echo"<br>".$cons222->RutaVenta;
	}
echo"<br>";echo"<br>";echo"<br>";
}
	

	
?>
	
</body>
</html>