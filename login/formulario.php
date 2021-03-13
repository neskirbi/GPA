<?php

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$usuario=$_POST['name'];
$contrasenia=$_POST['pass'];
$contrasenia2=$_POST['pass2'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo2'];
$face=$_POST['face'];

$nocar=strlen($contrasenia2)*strlen($usuario)*strlen($correo);

if($nocar > 0 ){
	
	if($contrasenia===$contrasenia2)
	{
	require("coneccion/conect.php");
//busqueda de usuario	
$buscar=$usuario;

$result = mysql_query("SELECT * FROM registrados WHERE nombre LIKE '%$buscar' ORDER BY nombre", $link); 
$row = mysql_fetch_array($result);


//busqueda de correo
$buscar2=$correo;

$result2 = mysql_query("SELECT * FROM registrados WHERE correo LIKE '%$buscar2' ORDER BY correo", $link); 
$row2 = mysql_fetch_array($result2);




$usuario2=$row[1];
$correo2=$row2[3];


if($usuario2!=$usuario){

if($correo2!=$correo){
mysql_query("INSERT INTO registrados VALUES('','$usuario','$contrasenia','$correo','1')");
	echo "Datos guardados exitosamente";


header('Refresh: 5; URL=http://davis.comeze.com/default.php?correo='.$correo.'&usuario='.$usuario);

    
}else{
	

echo 'Este correo ya fue ingresado anteriormente: ';
echo "$correo";
}




}else{
	echo 'Este usuario ya ha sido registrado, introdusca otro';
}
	
	
	
	
	mysql_close($link);
	
	}else{
		echo'Las contrase&ntilde;as no coinciden';
		}
		
	}else {
		echo'Debe rellenar los campos marcados con (*).';
		}

?>
