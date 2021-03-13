<?php
include("../conexion/conexion.php");
if(isset($_COOKIE["login"]))
{
	echo("<script>alert('Ya has iniciado sesion anteriormente');</script>");
	header("location:../index.php");
}


else{


echo $usuario=$_POST['usuario'];
echo $contrasenia=$_POST['contrasenia'];

$status = 0;

if($usuario=="Usuario" OR $contrasenia=="Contraseña")
{
	$status=6;
}//si los texbox tienen cadena busca enla base de datos
else
{
	$acceso=2;
	$usu ="SELECT puesto, pass, nombre FROM usuario WHERE  puesto='monitoreo' and nickname='$usuario'";
	$usu= odbc_exec($conexion, $usu);

	if(!$usu = odbc_fetch_object($usu))
	{
		$usu ="SELECT puesto, pass, nombre FROM usuario WHERE puesto='supervisor' and nickname='$usuario'";
		$usu= odbc_exec($conexion, $usu);
		if(!$usu = odbc_fetch_object($usu))
		{
			$usu ="SELECT puesto, pass, nombre FROM usuario WHERE puesto='promotor' and nickname='$usuario'";
			$usu= odbc_exec($conexion, $usu);
			if(!$usu = odbc_fetch_object($usu))
			{
			}
			else
			{
				//PROMOTOR
				$acceso=1;
				$dni=$usu->Ruta;
				$contrasenia2=$usu->pass;
				$nombre=$usu->nombre;
				$usuario2=$usuario;
				$status=2;
				$activo=2;
				$puesto=$usu->puesto;
				$nickname = $usuario;
				echo "Usuario: ".$nombre." Password:".$contrasenia2;
			}
		}
		else
		{
			//SUPERVISOR
			$acceso=1;
			$dni=$usu->Ruta;
			$contrasenia2=$usu->pass;
			$nombre=$usu->nombre;
			$usuario2=$usuario;
			$status=2;
			$activo=1;
			$puesto=$usu->puesto;
			$nickname = $usuario;
			echo "Usuario: ".$nombre." Password:".$contrasenia2;
		}
	}
	else
	{
		//MONITOREO
        $acceso=1;
		$dni=$usu->Ruta;
		$contrasenia2=$usu->pass;
		$nombre=$usu->nombre;
		$usuario2=$usuario;
		$status=2;
		$activo=1;
		$puesto=$usu->puesto;
		$nickname = $usuario;
		echo "Usuario: ".$nombre." Password:".$contrasenia2;
	}

//echo $status."aqui<br>";


//$para=$row['correo'];
//$status=$row['status'];
//$codigo=$row['codigo'];

//mysql_close($link);

if($status!=0)
{
	if ($usuario==$usuario2 && $contrasenia==$contrasenia2)
	{
		$correcto=1;
	}
	else
	{
		$status=5;
	}
}


}

switch($status)
{

	case 0:


		break;

	case 1:
	///include('mail.php');



	break;

	case 2:

		//se crea una cookie usuario e id
		setcookie("ref",$acceso,time()+86400,"/");
		setcookie("login",$nombre,time()+86400,"/");
		setcookie("dni",$dni,time()+86400,"/");
		setcookie("activo",$activo,time()+86400,"/");
		setcookie("puesto",$puesto,time()+86400,"/");
		setcookie("nickname",$nickname,time()+86400,"/");

		header("Location:../index.php");
		break;
		
		
	case 3:
		echo("<script>alert('Baja temporal');</script>");
		break;

	case 4;
		echo("<script>alert('Usuario dado de baja por reporte de abuso');</script>");
		break;

	case 5;
		echo("<script>alert('Verifique Contraseña y nombre de Usuario');</script>");
	header("location:../index.php");
		break;
	case 6;

		echo("<script>alert('Introdusca Usuario y Contraseña');</script>");
		break;




}//llave switch
	
}
?>
