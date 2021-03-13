<?php
include("../conexion/conexion.php");
if(isset($_COOKIE["login"]))
{
	echo("<script>alert('Ya has iniciado sesion anteriormente');</script>");
	header("location:../principalapp.php");
}


else{


$usuario=$_POST['usuario'];
$contrasenia=$_POST['contrasenia'];



if($usuario=="Usuario" OR $contrasenia=="Contraseña")


	{
		$status=6;
	}//si los texbox tienen cadena busca enla base de datos


else{
		$acceso=2;
		echo "<br>".$usu ="SELECT * FROM supervisor WHERE id= '$usuario'   order by Ruta asc";
		$usu= odbc_exec($conexion, $usu);

		if(!$usu = odbc_fetch_object($usu))
		{
			echo "<br>".$usu ="SELECT * FROM supervisor WHERE Gerencia= '$usuario'  order by Ruta asc ";
			$usu= odbc_exec($conexion, $usu);
			if(!$usu = odbc_fetch_object($usu))
				{

					echo "<br>".$usu ="SELECT * FROM supervisor WHERE Ejecutivo= '$usuario'  order by Ruta asc ";
					$usu= odbc_exec($conexion, $usu);
					if(!$usu = odbc_fetch_object($usu))
						{
							echo "<br>".$usu ="SELECT * FROM supervisor WHERE Monitoreo= '$usuario'   order by Ruta asc";
							$usu= odbc_exec($conexion, $usu);
							if($usu = odbc_fetch_object($usu))
								{
									$acceso=1;
									$dni=$usu->Ruta;
									$contrasenia2=$usu->PassMon;
									$nombre=$usu->Monitoreo;
									$usuario2=$usuario;
									$status=2;
									$activo=0;
								}else{$status=5;}
						}else{
						        $acceso=2;
								$dni=$usu->Ruta;
								$contrasenia2=$usu->PassEje;
								$nombre=$usu->Ejecutivo;
								$usuario2=$usuario;
								$status=2;
								$activo=0;

							 }
				}else{
				        $acceso=2;
						$dni=$usu->Ruta;
						$contrasenia2=$usu->PassGer;
						$nombre=$usu->Gerencia;
						$usuario2=$usuario;
						$status=2;
						$activo=0;

					  }

		}else{
		        $acceso=3;
				$dni=$usu->Ruta;
				$contrasenia2=$usu->Pass;
				$nombre=$usu->Nombre;
				$usuario2=$usuario;
				$status=2;
				$activo=1;

			  }





//$para=$row['correo'];
//$status=$row['status'];
//$codigo=$row['codigo'];

//mysql_close($link);



if($status!=0)
{
if ($usuario==$usuario2 AND $contrasenia==$contrasenia2)
{
$correcto=1;


}else{
$status=5;
}
}


}

switch($status)
{

case 0:


break;

case 1:
include('mail.php');



break;

case 2:


//$usname = encrypt($usuario2, $key);
//$suid = encrypt(1, $key);
/*
require("coneccion/conect.php");
$fech=date("Y-m-d");
$sql =mysql_query("UPDATE registrados SET ultimases = '$fech', conectado = '1' WHERE id = $row[0]  ", $link);
*/

	//se crea una cookie usuario e id
     setcookie("ref",$acceso,time()+86400,"/");
	 setcookie("login",$nombre,time()+86400,"/");
     setcookie("dni",$dni,time()+86400,"/");
     setcookie("activo",$activo,time()+86400,"/");


header("location:../principalapp.php");
        ?>
        
	
	<?php
break;
	
	
case 3:
	echo("<script>alert('Baja temporal');</script>");
	break;

case 4;
	echo("<script>alert('Usuario dado de baja por reporte de abuso');</script>");
	break;

case 5;
	echo("<script>alert('Verifique Contraseña y nombre de Usuario');</script>");
header("location:loginuserapp.php");
	break;
case 6;

	echo("<script>alert('Introdusca Usuario y Contraseña');</script>");
	break;




}//llave switch
	
}
?>
