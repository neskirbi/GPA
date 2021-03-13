<?php
include "conexion.php";

$fecha1 = date("Y-n-d");

$mensaje=filter_input(INPUT_POST,'mensaje');
$id=filter_input(INPUT_POST,'id');
//$query="UPDATE usuario SET us_direccion='$mensaje', acceso='1' WHERE  Id_usuario='$id'";

echo "ID enviado " .$id ;
echo "Mensa " .$mensaje;

$idem = $id .$fecha1;

if ($mensaje=="Asistencia")
{
	$query="UPDATE asistencia SET asistencia='true' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "Asistencia confirmada";
		}
	   else
		{
			echo "Asistencia no confirmada";
		}
}
if ($mensaje=="Falta")
{
	$query="UPDATE asistencia SET asistencia='false', id_motivo='1' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "Falta confirmada";
		}
	   else
		{
			echo "Falta no confirmada";
		}
}

if ($mensaje=="Incapacidad")
{
	$query="UPDATE asistencia SET asistencia='false', id_motivo='2' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "Incapachidad confirmada";
		}
	   else
		{
			echo "Incapacidad no confirmada";
		}
}

if ($mensaje=="Vacaciones")
{
	$query="UPDATE asistencia SET asistencia='false', id_motivo='3' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "Vacaciones confirmadas";
		}
	   else
		{
			echo "Vacaciones no confirmadas";
		}
}

if ($mensaje=="Permiso con Sueldo")
{
	$query="UPDATE asistencia SET asistencia='True', id_motivo='5' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "confirmado";
		}
	   else
		{
			echo "no confirmado";
		}
}

if ($mensaje=="Baja")
{
	$query="UPDATE asistencia SET asistencia='False', id_motivo='6' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "confirmada";
		}
	   else
		{
			echo "no confirmada";
		}
}

if ($mensaje=="Permiso sin Sueldo")
{
	$query="UPDATE asistencia SET asistencia='False', id_motivo='7' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "confirmado";
		}
	   else
		{
			echo "no confirmado";
		}
}


if ($mensaje=="Retardo")
{
	$query="UPDATE asistencia SET asistencia='true', id_motivo='4' WHERE  us_empresa='$idem'";
	if(odbc_exec($conexion,$query))
		{
			echo "confirmados";
		}
	   else
		{
			echo "no confirmados";
		}
}

