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
else//promotor 2, supervisor 1, monitoreo 1
{
	//Gerencia
	$acceso=2;
	$usu ="SELECT TOP 1 Ruta, PassGer, Gerencia FROM supervisor WHERE Gerencia='$usuario'";
	$usu= odbc_exec($conexion, $usu);

	if($usu = odbc_fetch_object($usu))
	{
        $acceso=1;
		$dni="todos";
		$contrasenia2=$usu->PassGer;
		$nombre=$usu->Gerencia;
		$usuario2=$usuario;
		$status=2;
		$activo=1;
		echo "Usuario: ".$nombre." Password:".$contrasenia2;
	}
	else
	{
		//Ejecutivo
		$acceso=2;
		$usu ="SELECT TOP 1 Ruta, PassEje, Ejecutivo, susu1, passsusu FROM supervisor WHERE Ejecutivo='$usuario'";
		$usu= odbc_exec($conexion, $usu);

		if($usu = odbc_fetch_object($usu))
		{
	        $acceso=1;
			$dni="todos";
			$contrasenia2=$usu->PassEje;
			$nombre=$usu->Ejecutivo;
			$usuario2=$usuario;
			$status=2;
			$activo=1;
			echo "Usuario: ".$nombre." Password:".$contrasenia2;
		}
		
		else
	{
		//Ejecutivo 2
		$acceso=2;
		$usu ="SELECT TOP 1 Ruta, PassEje, Ejecutivo, susu1, passsusu FROM supervisor WHERE susu1='$usuario'";
		$usu= odbc_exec($conexion, $usu);

		if($usu = odbc_fetch_object($usu))
		{
	        $acceso=1;
			$dni="todos";
			$contrasenia2=$usu->passsusu;
			$nombre=$usu->susu1;
			$usuario2=$usuario;
			$status=2;
			$activo=1;
			echo "Usuario: ".$nombre." Password:".$contrasenia2;
		}
		
		else
		{
			//Monitoreo
			$acceso=2;
			$usu ="SELECT TOP 1 Ruta, PassMon, Monitoreo FROM supervisor WHERE Monitoreo='$usuario'";
			$usu= odbc_exec($conexion, $usu);

			if($usu = odbc_fetch_object($usu))
			{
		        $acceso=3;
				$dni="todos";
				$contrasenia2=$usu->PassMon;
				$nombre=$usu->Monitoreo;
				$usuario2=$usuario;
				$status=2;
				$activo=1;
				echo "Usuario: ".$nombre." Password:".$contrasenia2;
			}
			else
			{
				//Supervisor
				$acceso=2;
				$usu ="SELECT TOP 1 Ruta, Pass, Nombre FROM supervisor WHERE Nombre='$usuario'";
				$usu= odbc_exec($conexion, $usu);

				if($usu = odbc_fetch_object($usu))
				{
			        $acceso=2;
					$dni=$usu->Ruta;
					$contrasenia2=$usu->Pass;
					$nombre=$usu->Nombre;
					$usuario2=$usuario;
					$status=2;
					$activo=1;
					echo "Usuario: ".$nombre." Password:".$contrasenia2;
				}
			}
		}
		}
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
		setcookie("movil",0,time()+86400,"/");

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
