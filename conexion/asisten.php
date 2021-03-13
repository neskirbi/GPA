<?php
include "conexion.php";


//echo "Confirmado";

   $dnir = trim($_COOKIE['dni']);
   $dnifin = trim($dnir);
    $resultado=array();
	$sql="SELECT Id_usuario as id, us_nombre_real, ucfdi, us_telefono, us_apellidos as ciudad,us_direccion as mensaje, Id_ruta as ruta from usuarionom where us_direccion = '$dnifin'";
	$result= odbc_exec($conexion, $sql);
    $i=0;
	//echo $result;   
	$fecha1 = date("Y-n-d");
	
   while($row= odbc_fetch_object($result))
   {
    $asi="True";
	$idus = $row->id;
	$ucf = $row->ucfdi;
	$idem = $idus .$fecha1;
	$idzon = $row->us_telefono;
	
	$sql2 = "SELECT  Id_usuario from asistencia where us_empresa='$idem'";
	  $result2= odbc_exec($conexion, $sql2);
	if(odbc_exec($conexion, $sql2))
	{	

		while($row= odbc_fetch_object($result2))
		{		$idb = $row->Id_usuario;
	      //echo "row" .$idb;
		}
			
		if (isset($idb))
		 {
			// $sql = "UPDATE asistencia set id_usuario='$idus', asistencia='$asi', fecha='$fecha1', ucfdi='$ucf', us_empresa='$idem', id_supervisor='$idzon' where us_empresa='$idem'";
           	//if(odbc_exec($conexion, $sql))
			//	{	
			$resultado = "ok";
			//echo "Asistencia cargada previamente, verifica en asistencia";
			//}
		 }
		 else
		  {
		    $sql = "INSERT INTO asistencia (id_usuario, asistencia, fecha, ucfdi, us_empresa, id_supervisor) values ('$idus', '$asi','$fecha1', '$ucf', '$idem', '$idzon')";
			if(odbc_exec($conexion, $sql))
			   {	
				$resultado = "ok";
				echo "Asistencia Confirmada";
			   }
		  }	
	}	
		     $i++;
   }