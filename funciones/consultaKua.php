<?php
//*++++++++++++++++++CERCAS+++++++++++++++//
function actividad($nombre,$fecha1,$fecha2)
{
	include "../conexion/conexion.php";
	$sql="SELECT act.id,act.imei,act.idcliente,act.hora,act.fecha from actividad as act join usuario as usu on act.imei=usu.imei and act.fecha>='$fecha1' and act.fecha<='$fecha2'";
	$sql=odbc_exec($conexion, $sql);
	while($sql_datos=odbc_fetch_array($sql))
	{
		echo"<br>";
		print_r($sql_datos);
	}
	echo "
	<tr>
	<td>".$nombre."</td>
	</tr>";
}
function mas_cercanas($lat, $lon, $usu, $fecha)
{
	//include "../conexion/conexionbit.php";
	include "../conexion/conexion.php";

	$resultado = array();
	$cont = 0;
	$sql = "SELECT distinct imei from Gps2
			where fecha='$fecha'";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$sqlu = "SELECT nombre, puesto from usuario where imei='$row->imei'";
		$sqlu = odbc_exec($conexion, $sqlu);
		if($rowu = odbc_fetch_object($sqlu))
		{
			$nombre = $rowu->nombre;
			$puesto = $rowu->puesto;
		}

		$sql1 = "SELECT imei, lat, lon, hora from Gps2
				where fecha='$fecha' and imei='$row->imei'
				order by hora desc";
		$sql1 = odbc_exec($conexion, $sql1);
		if($row1 = odbc_fetch_object($sql1))
		{
			$resultado[$cont]['imei'] = $row->imei;
			$resultado[$cont]['nombre'] = $nombre;
			$resultado[$cont]['puesto'] = $puesto;
			$resultado[$cont]['lat'] = $row1->lat;
			$resultado[$cont]['lon'] = $row1->lon;
			
			$degtorad = 0.01745329; 
		    $radtodeg = 57.29577951;

		    $lat1 = $lat;
		    $long1 = $lon;

		    $lat2 = $resultado[$cont]['lat'];
		    $long2 =  $resultado[$cont]['lon'];

		    $dlong = ($long1 - $long2); 
		    $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) 
		    + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) 
		    * cos($dlong * $degtorad));

		    $dd = acos($dvalue) * $radtodeg; 

		    $miles = ($dd * 69.16); 
		    $km = ($dd * 111.302); 

		    $m = $km*1000;
		    $m = explode(".", $m);
		    //$m = array_slice($m, 0, 1);

		    $resultado[$cont]['distancia'] = $m[0];
		    $cont++;
		}
	}

	for ($i=1; $i < count($resultado); $i++) { 
	  for ($j=0; $j < count($resultado)-$i; $j++) { 
	    if($resultado[$j]['distancia'] > $resultado[$j+1]['distancia'])
	    {
	      $aux = $resultado[$j+1];
	      $resultado[$j+1] = $resultado[$j];
	      $resultado[$j] = $aux;
	    }
	  }
	}
	
	//odbc_close($conexion);
    return $resultado;
}

function medir_distancia_metro($latl, $lonl, $latc, $lonc)
{
	$resultado = 0;

	$degtorad = 0.01745329; 
    $radtodeg = 57.29577951;

    //localizacion
    $lat1 = $latl;
    $long1 = $lonl;

    //clientes
    $lat2 = $latc;
    $long2 = $lonc;

    $dlong = ($long1 - $long2); 
    $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad)) 
    + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad) 
    * cos($dlong * $degtorad));

    $dd = acos($dvalue) * $radtodeg; 

    $miles = ($dd * 69.16); 
    $km = ($dd * 111.302); 

    $m = $km*1000;
    $m = explode(".", $m);
    //$m = array_slice($m, 0, 1);

    $resultado = $m[0];
    
    return $resultado;
}

//*++++++++++++++++++CERCAS+++++++++++++++//
//*++++++++++++++++++CONTACTO+++++++++++++++//
if(isset($_POST['nick']))
{
	include "../conexion/conexion.php";
	$nick = $_POST['nick'];
	$sql = "SELECT id_usuario from usuario where nickname='$nick'";
	$sql = odbc_exec($conexion, $sql);
	if($row = odbc_fetch_object($sql))
	{
		agregar_contacto($row->id_usuario, $_POST['contacto']);
	}
	//odbc_close($conexion);
}

function agregar_contacto($id_usuario, $contacto)
{
	include "../conexion/conexion.php";
	$cont = 0;
	$in = 0;
	$resultado = array();
	$sql1 = "SELECT top 1 id_contacto from contactos order by id_contacto desc";
	$sql1 = odbc_exec($conexion, $sql1);
	if($row = odbc_fetch_object($sql1))
	{
		$in = $row->id_contacto;
	}
	$in++;

	$sql = "INSERT INTO contactos (id_contacto, id_usuario, contacto) values ($in, $id_usuario, $contacto)";
	if(odbc_exec($conexion, $sql))
	{	
		$resultado = "ok";
	}

	//odbc_close($conexion);
	return $resultado;
}

function asistenciac()
{
   include "conexion/conexion.php";
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
			//}
			
			}
		 else
		  {
		    $sql = "INSERT INTO asistencia (id_usuario, asistencia, fecha, ucfdi, us_empresa, id_supervisor) values ('$idus', '$asi','$fecha1', '$ucf', '$idem', '$idzon')";
			if(odbc_exec($conexion, $sql))
			{	
			$resultado = "ok";
			}
		  }	
	}	
		
        $i++;
    }
    return $resultado;
}


function getUsers()
{
   include "conexion/conexion.php";
   $dnir = trim($_COOKIE['dni']);
   $dnifin = trim($dnir);
    $resultado=array();
    $sql="SELECT actas,actas_status,Id_usuario as id, us_nombre_real, ucfdi, us_apellidos as ciudad,us_direccion as mensaje, Id_ruta as ruta 
	from usuarionom where us_direccion = '$dnifin'";
	
   $result= odbc_exec($conexion, $sql);
    $i=0;
	//echo $result;   
	
   while($row= odbc_fetch_object($result))
    {
        $resultado[$i]['id']=$row->id;
        $resultado[$i]['nombre']= utf8_encode($row->us_nombre_real);
        $resultado[$i]['ciudad']=$row->ciudad;
        $resultado[$i]['mensaje']=$row->mensaje;
        $resultado[$i]['ruta']=$row->ucfdi;
		$resultado[$i]['actas']=$row->actas;
		$resultado[$i]['actas_status']=$row->actas_status;
        $i++;
    }
    return $resultado;
}

function GetUsersTodos()
{
   include "conexion/conexion.php";
   $dnir = trim($_COOKIE['dni']);
   $dnifin = trim($dnir);
    $resultado=array();
    $sql="SELECT actas,actas_status,Id_usuario as id, us_nombre_real, ucfdi, us_apellidos as ciudad,
	us_direccion as mensaje, Id_ruta as ruta 
	from usuarionom ";
	
   $result= odbc_exec($conexion, $sql);
    $i=0;
	//echo $result;   
	
   while($row= odbc_fetch_object($result))
    {
        $resultado[$i]['id']=$row->id;
        $resultado[$i]['nombre']= utf8_encode($row->us_nombre_real);
        $resultado[$i]['ciudad']=$row->ciudad;
        $resultado[$i]['mensaje']=$row->mensaje;
        $resultado[$i]['ruta']=$row->ucfdi;
		$resultado[$i]['actas']=$row->actas;
		$resultado[$i]['actas_status']=$row->actas_status;
        $i++;
    }
    return $resultado;
}

function getSupervisores(){
    include "conexion/conexion.php";
    $resultado=array();
    $sql="SELECT Id_usuario AS id,  nombre  from usuario WHERE Id_tipouser='5'";
    $result= odbc_exec($conexion, $sql);
    $i=0;
    while($row= odbc_fetch_object($result))
    {
        $resultado[$i]['id']=$row->id;
        $resultado[$i]['nombre']=$row->nombre;
        $i++;
    }
    return $resultado;
}

function consultar_sin_contacto($usu)
{
	include "../conexion/conexion.php";
	$resultado = array();
	$cont = 0;
	$sql = "SELECT id_usuario, nombre, apellidos, puesto, foto, telefono, equipo, ciudad
			from usuario
			where nickname != '$usu' and id_usuario != all (select c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu')";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{
		if($row->puesto != "monitoreo")
		{
			$resultado[$cont]['id_usuario'] = $row->id_usuario;
			$resultado[$cont]['nombre'] = $row->nombre;
			$resultado[$cont]['apellidos'] = $row->apellidos;
			$resultado[$cont]['puesto'] = $row->puesto;
			$resultado[$cont]['foto'] = $row->foto;
			$resultado[$cont]['telefono'] = $row->telefono;
			$resultado[$cont]['equipo'] = $row->equipo;
			$resultado[$cont]['ciudad'] = $row->ciudad;
			$cont++;
		}
	}

	//odbc_close($conexion);
	return $resultado;
}
//*++++++++++++++++++CONTACTO+++++++++++++++//
//*++++++++++++++++++PROMOTORES+++++++++++++++//
function consultar_usuario()
{
	include "../conexion/conexionbit.php";
	include "../conexion/conexion.php";
	$cont = 0;
	$resultado = array();
	$sql = "SELECT nombre, apellidos, puesto from usuario";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$resultado[$cont]["nombre"] = $row->nombre;
		$resultado[$cont]["apellidos"] = $row->apellidos;
		$resultado[$cont]["puesto"] = $row->puesto;
		$cont++;
	}

	//odbc_close($conexion);
	return $resultado;
}

function consultar_perfil_promotor1($fecha, $usu, $ruta, $dia, $dni)
{
	include "../conexion/conexion.php";
	if($ruta == "todo")
	{
		$ruta = "";
	}
	else
	{
		//$ruta = implode(",", $ruta);
		//$ruta = "where usu1.Id_usuario in ($ruta)";
	}
	$n_dni = "";
	if($dni != "todos")
	{
		$n_dni = "and usu1.dni='$dni'";
	}

	$cont = 0;
	$resultado = array();
	$fecha1 = date('Y-n-d', strtotime($fecha));

	$sql = "SELECT usu1.Id_tipouser, usu1.nombre, usu1.us_telefono telefono, usu1.foto fotousu, usu1.Id_movil equipo, usu1.us_login nickname, usu1.us_apellidos apellidos, usu1.us_apellidos ciudad, usu1.ruta imei, usu1.Id_usuario, usu2.imei imei2, case when usu2.imei is not null then 'Tracker' when usu2.imei is null then 'OffLine' end conectado, case when usu2.hora is not null then usu2.hora when usu2.hora is null then '00:00:00' end horas, usu2.rowNum, case when usu2.lat is not null then usu2.lat when usu2.lat is null then '0' end lat, case when usu2.lon is not null then usu2.lon when usu2.lon is null then '0' end lon, case when usu2.bateria is not null then usu2.bateria when usu2.bateria is null then '0%' end bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, v_f_ruta.sum_V_F_Ruta v_f_ruta
			from usuario usu1
			left join (select usu.Id_tipouser, usu.nombre, usu.us_apellidos, usu.Id_usuario, usu.imei, usu.hora, usu.rowNum, usu.lat, usu.lon, usu.bateria
						from (select usu.Id_tipouser, usu.nombre, usu.us_apellidos, usu.Id_usuario, g.imei, g.hora,
								ROW_NUMBER() OVER (Partition BY usu.nombre ORDER BY g.hora desc) as rowNum, g.lat, g.lon, g.bateria
								from usuario as usu
								inner join Gps as g on g.imei=usu.ruta
								where g.fecha='$fecha') as usu
						where usu.rowNum = 1) usu2 on usu2.nombre=usu1.nombre
			left join (select usu.nombre,COUNT(usu.nombre) obj_cliente
						from usuario usu
						inner join cliente cl on cl.Id_ruta=usu.Id_usuario
						where cl.$dia='1'
						group by usu.nombre) ob on ob.nombre=usu1.nombre
			left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
						from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
								from usuario usu
								inner join actividad ac on ac.Idusuario=usu.Id_usuario
								inner join cliente cl on cl.Id_cliente=ac.Idcliente
								left join (select cl.RazonSocial 
											from usuario usu
											inner join cliente cl on cl.Id_ruta=usu.Id_usuario
											where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
								where  FechaVisita='$fecha1' and usu.Id_tipouser=2) usu
						where usu.visitadas<>''
						group by usu.nombre) vis on vis.nombre=usu1.nombre
			left join (select usu.nombre, COUNT(usu.nombre) sum_V_F_Ruta
						from (select usu.nombre, case when obj.RazonSocial is null then '1' end V_F_Ruta
								from usuario usu
								inner join actividad ac on ac.Idusuario=usu.Id_usuario
								inner join cliente cl on cl.Id_cliente=ac.Idcliente
								left join (select cl.RazonSocial 
											from usuario usu
											inner join cliente cl on cl.Id_ruta=usu.Id_usuario
											where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
								where  FechaVisita='$fecha1' and usu.Id_tipouser=2) usu
						where usu.V_F_Ruta<>''
						group by usu.nombre) v_f_ruta on v_f_ruta.nombre=usu1.nombre 
			where usu1.Id_usuario<>0 and usu1.Id_usuario !='100' $n_dni
			order by CAST(usu1.Id_usuario as int) asc";
	$result = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($result))
	{
            if($row->nickname!='13'&&$row->nickname!='14'){
		$resultado[$cont]["nombre"] = $row->nombre;
		$resultado[$cont]["apellidos"] = $row->apellidos;
		$resultado[$cont]["puesto"] = "promotor";
		$resultado[$cont]["nickname"] = $row->nickname;
		$resultado[$cont]["foto"] = $row->fotousu;
		$resultado[$cont]["ciudad"] = $row->ciudad;
		$resultado[$cont]["telefono"] = $row->telefono;
		$resultado[$cont]["equipo"] = $row->equipo;
		$resultado[$cont]["imei"] = $row->imei;
		$resultado[$cont]["conectado"] = $row->conectado;
		$resultado[$cont]["fecha"] = $fecha;
		$resultado[$cont]["hora"] = $row->horas;
		$resultado[$cont]["bateria"] = $row->bateria;	
		$resultado[$cont]["obj_cliente"] = $row->obj_cliente;
		$resultado[$cont]["visitas"] = $row->visitas;
		$resultado[$cont]["v_f_ruta"] = $row->v_f_ruta;	
		$resultado[$cont]["lat"] = $row->lat/100000;	
		$resultado[$cont]["lon"] = $row->lon/100000;	
		$cont++;
            }
	}
	//odbc_close($conexion);
	return $resultado;
}

function equipos_conectados1($fecha, $usu, $pass)
{
	//include "../conexion/conexionbit.php";
	include "../conexion/conexion.php";

	$resultado = 0;
	$sql = "SELECT imei
			from usuario
			where id_usuario in (select c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu' and u.pass='$pass')";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$imei = $row->imei;
		$sqlgps = "SELECT TOP (1) imei, hora FROM Gps2 WHERE fecha='$fecha' and imei='$imei' ORDER BY hora DESC";
		$sqlgps = odbc_exec($conexion, $sqlgps);
		if($rowgps = odbc_fetch_object($sqlgps))
		{	
			$resultado++;
		}
		else
		{
			$sqlgps = "SELECT TOP (1) imei, hora FROM Gps WHERE fecha='$fecha' and imei='$imei' ORDER BY hora DESC";
			$sqlgps = odbc_exec($conexion, $sqlgps);
			if($rowgps = odbc_fetch_object($sqlgps))
			{	
				$resultado++;
			}	
		}
	}

	//odbc_close($conexion);
	return $resultado;	
}

function consultar_promotores1($usu, $pass)
{
	include "../conexion/conexion.php";
	$cont = 0;
	$resultado = "";

	$sql = "SELECT c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu' and u.pass='$pass'";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$cont++;
		$resultado = $cont;
	}

	//odbc_close($conexion);
	return $resultado;
}

function consultar_dato_personal($nickname, $fecha)
{
	include "../conexion/conexionkua.php";
	$cont = 0;
	$sql = "SELECT nombre, ruta as imei, us_apellidos as apellidos, acceso as puesto, us_login as nickname, us_apellidos as ciudad, us_telefono as telefono, Id_movil as equipo FROM usuario WHERE us_login='$nickname'";
	$sql = odbc_exec($conexion, $sql);
	if($row = odbc_fetch_object($sql))
	{
		$resultado[$cont]["nombre"] = $row->nombre;
		$resultado[$cont]["apellidos"] = $row->apellidos;
		$resultado[$cont]["puesto"] = $row->puesto;
		$resultado[$cont]["nickname"] = $row->nickname;
		$resultado[$cont]["ciudad"] = $row->ciudad;
		$resultado[$cont]["telefono"] = $row->telefono;
		$resultado[$cont]["equipo"] = $row->equipo;
		$resultado[$cont]["imei"] = $row->imei;
	}

	$imei = $resultado[$cont]["imei"];

	$sql = "SELECT lat, lon FROM Gps where imei='$imei' and fecha='$fecha' and lat!='0' order by id desc";
	$sql = odbc_exec($conexion, $sql);
	if($row = odbc_fetch_object($sql))
	{
		$resultado[$cont]["ubicacion"] = "Lat: ".($row->lat/100000).", Lon: ".($row->lon/100000);
		$resultado[$cont]["lat"] = $row->lat/100000;
		$resultado[$cont]["lon"] = $row->lon/100000;
	}
	//odbc_close($conexion);
	return $resultado;
}


//*++++++++++++++++++PROMOTORES+++++++++++++++//

//+++++++++++++++++++++USUARIO++++++++++++++++++++//
function obtener_password($usu, $conexion)
{
	//include "conexion/conexion.php";
	$resultado = "";
	$sql = "SELECT pass from usuario where nickname='$usu'";
	$sql = odbc_exec($conexion, $sql);
	if($row = odbc_fetch_object($sql))
	{	
		$resultado = $row->pass;
	}

	//odbc_close($conexion);
	return $resultado;
}

function obtener_usuario($usuario, $conexion)
{
	//include "conexion/conexion.php";
	$resultado = array();
	$cont = 0;

	//Gerencia
	$acceso=2;
	$usu ="SELECT TOP 1 Ruta, PassGer, Gerencia FROM supervisor WHERE Gerencia='$usuario'";
	$usu = odbc_exec($conexion, $usu);

	if($usu = odbc_fetch_object($usu))
	{
		$resultado[$cont]['foto'] = $row->foto;
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
		$usu ="SELECT TOP 1 Ruta, PassEje, Ejecutivo FROM supervisor WHERE Ejecutivo='$usuario'";
		$usu = odbc_exec($conexion, $usu);

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
			//Monitoreo
			$acceso=2;
			$usu ="SELECT TOP 1 Ruta, PassMon, Monitoreo FROM supervisor WHERE Monitoreo='$usuario'";
			$usu = odbc_exec($conexion, $usu);

			if($usu = odbc_fetch_object($usu))
			{
		        $acceso=1;
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
				$usu = odbc_exec($conexion, $usu);

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

	//odbc_close($conexion);
	return $resultado;
}
//+++++++++++++++++++++USUARIO++++++++++++++++++++//

//*++++++++++++++++++INDEX+++++++++++++++//
function consultar_promotores($usu, $pass)
{
	include "conexion/conexion.php";
	$cont = 0;
	$resultado = "";
	$sql = "SELECT c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu' and u.pass='$pass'";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$cont++;
		$resultado = $cont;
	}

	//odbc_close($conexion);
	return $resultado;
}

function equipos_conectados($fecha, $usu, $dni)
{
	include "conexion/conexion.php";
	$n_dni = "";

	if($dni != "todos")
	{
		$n_dni = "where dni='$dni'";
	}

	$resultado = 0;
	$sql = "SELECT ruta
			from usuario
			$n_dni";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$imei = $row->ruta;
		$sqlgps = "SELECT DISTINCT imei FROM Gps WHERE fecha='$fecha' and imei='$imei'";
		$sqlgps = odbc_exec($conexion, $sqlgps);
		if($rowgps = odbc_fetch_object($sqlgps))
		{	
			$resultado++;
		}	
		
	}

	//odbc_close($conexion);
	return $resultado;	
}

function consultar_perfil_promotor($fecha, $dni)
{
	//include "conexion/conexionbit.php";
	include "conexion/conexion.php";

	$_dias=array ("Mon" => "Lunes","Tue" => "Martes","Wed" => "Miercoles","Thu" => "Jueves","Fri" => "Viernes","Sat" => "Sabado","Sun" => "Domingo");

	$dia =  $_dias[date("D", strtotime($fecha))];
	$dia = "cl.".$dia;
	$n_dni = "";

	if($dni != "todos")
	{
		$n_dni = "and usu1.dni='$dni'";
	}

	
	$cont = 0;
	$resultado = array();
	$fecha1 = date('Y-n-d', strtotime($fecha));

	$sql = "SELECT usu1.Id_tipouser, usu1.nombre, usu1.us_telefono telefono, usu1.Id_movil equipo, usu1.us_login nickname, usu1.us_apellidos apellidos, usu1.us_apellidos ciudad, usu1.ruta imei, usu1.Id_usuario, usu2.imei imei2, case when usu2.imei is not null then 'Tracker' when usu2.imei is null then 'OffLine' end conectado, case when usu2.hora is not null then usu2.hora when usu2.hora is null then '00:00:00' end horas, usu2.rowNum, case when usu2.lat is not null then usu2.lat when usu2.lat is null then '0' end lat, case when usu2.lon is not null then usu2.lon when usu2.lon is null then '0' end lon, case when usu2.bateria is not null then usu2.bateria when usu2.bateria is null then '0%' end bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, v_f_ruta.sum_V_F_Ruta v_f_ruta
			from usuario usu1
			left join (select usu.Id_tipouser, usu.nombre, usu.us_apellidos, usu.Id_usuario, usu.imei, usu.hora, usu.rowNum, usu.lat, usu.lon, usu.bateria
						from (select usu.Id_tipouser, usu.nombre, usu.us_apellidos, usu.Id_usuario, g.imei, g.hora,
								ROW_NUMBER() OVER (Partition BY usu.nombre ORDER BY g.hora desc) as rowNum, g.lat, g.lon, g.bateria
								from usuario as usu
								inner join Gps as g on g.imei=usu.ruta
								where g.fecha='$fecha') as usu
						where usu.rowNum = 1) usu2 on usu2.nombre=usu1.nombre
			left join (select usu.nombre,COUNT(usu.nombre) obj_cliente
						from usuario usu
						inner join cliente cl on cl.Id_ruta=usu.Id_usuario
						where cl.cl_L='1'
						group by usu.nombre) ob on ob.nombre=usu1.nombre
			left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
						from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
								from usuario usu
								inner join actividad ac on ac.Idusuario=usu.Id_usuario
								inner join cliente cl on cl.Id_cliente=ac.Idcliente
								left join (select cl.RazonSocial 
											from usuario usu
											inner join cliente cl on cl.Id_ruta=usu.Id_usuario
											where cl.cl_L='1') obj on obj.RazonSocial=cl.RazonSocial
								where  FechaVisita='$fecha1' and usu.Id_tipouser=2) usu
						where usu.visitadas<>''
						group by usu.nombre) vis on vis.nombre=usu1.nombre
			left join (select usu.nombre, COUNT(usu.nombre) sum_V_F_Ruta
						from (select usu.nombre, case when obj.RazonSocial is null then '1' end V_F_Ruta
								from usuario usu
								inner join actividad ac on ac.Idusuario=usu.Id_usuario
								inner join cliente cl on cl.Id_cliente=ac.Idcliente
								left join (select cl.RazonSocial 
											from usuario usu
											inner join cliente cl on cl.Id_ruta=usu.Id_usuario
											where cl.cl_L='1') obj on obj.RazonSocial=cl.RazonSocial
								where  FechaVisita='$fecha1' and usu.Id_tipouser=2) usu
						where usu.V_F_Ruta<>'' 
						group by usu.nombre) v_f_ruta on v_f_ruta.nombre=usu1.nombre 
			where usu1.Id_usuario<>0 
			order by conectado desc, CAST(usu1.Id_usuario as int) asc";
	if($result = odbc_exec($conexion, $sql))
	{
		while($row = odbc_fetch_array($result))
		{
                    if($row['Id_usuario']!='13'&&$row['Id_usuario']!='14'){
			$resultado[$cont]["nombre"] = $row['nombre'];
			$resultado[$cont]["foto"] = "usuario.png";
			$resultado[$cont]["Id_usuario"] = $row['Id_usuario'];
			$resultado[$cont]["conectado"] = $row['conectado'];
			$resultado[$cont]["ciudad"] = $row['apellidos'];
			$resultado[$cont]["lat"] = $row['lat'];
			$resultado[$cont]["lon"] = $row['lon'];
			$resultado[$cont]["hora"] = $row['horas'];
			$resultado[$cont]["bateria"] = $row['bateria'];
			$resultado[$cont]["obj_cliente"] = $row['obj_cliente'];
			$resultado[$cont]["visitas"] = $row['visitas'];
			$resultado[$cont]["v_f_ruta"] = $row['v_f_ruta'];
			$resultado[$cont]["Id_tipouser"] = $row['Id_tipouser'];
			$cont++;		
                    }
		}
	}

	return $resultado;
}
//*++++++++++++++++++INDEX+++++++++++++++//
//*++++++++++++++++++REPORTE+++++++++++++++//

function reporte($fecha_inicio, $fecha_fin, $ruta)
{
	include "../conexion/conexionkua.php";

	$cont = 0;
	$ruta = implode(",", $ruta);
	$resultado = array();

	$fecha = $fecha_inicio;
    $fecha2 = $fecha_fin;

    $dia1 = date("Y-m-d", strtotime($fecha));
    $dia2 = date("Y-m-d", strtotime($fecha2));

    //calcular dias entre dos fechas
    $datetime1 = new DateTime($fecha);
    $datetime2 = new DateTime($fecha2);
    $interval = $datetime1->diff($datetime2);
    $dias = $interval->format('%a');


    for ($j=0; $j <= $dias; $j++) 
  	{
    	$fechasig = date("Y-m-d", strtotime('+'.$j.'day', strtotime($fecha))); 
		$sql = "SELECT usu.Id_usuario, c.Razonsocial, ac.entrada, ac.salida, ac.FechaVisita as fecha
				FROM usuario usu
				inner join actividad ac on ac.Idusuario=usu.Id_usuario
				inner join cliente c on c.idcliente=ac.Idcliente
				where usu.Id_usuario in ($ruta) and ac.FechaVisita='$fechasig'
				order by usu.Id_usuario asc, ac.entrada asc";
		$sql = odbc_exec($conexion, $sql);
		while ($row = odbc_fetch_object($sql)) 
		{
			$resultado[$cont]["ruta"] = $row->Id_usuario;
			$resultado[$cont]["nombre_cliente"] = utf8_encode($row->Razonsocial);
			$resultado[$cont]["entrada"] = $row->entrada;
			$resultado[$cont]["salida"] = $row->salida;
			$resultado[$cont]["fecha"] = $row->fecha;
			$cont++;
		}
	}

	//odbc_close($conexion);
	return $resultado;
}

function getModificaDatos($idCliente,$fecha,$conexion){
    if(empty($fecha))
    {
        $fecha = date("Y-n-d");
     }
    $query="SELECT Id_actividad,entrada,salida from actividad WHERE Idcliente='$idCliente' AND FechaVisita='$fecha'";
    $resultSet= odbc_exec($conexion, $query);
    $row= odbc_fetch_object($resultSet);
    return $row;
}

function reporteproductos($fecha, $conexion, $dia, $dni)
{
	$fecha_imei = date("Y-m-d", strtotime($fecha));
	$resultado = array();
	$cont = 0;
	$n_dni = "";
	$c_dni = "";

	if($dni != "todos")
	{
		$n_dni = "and usu.dni='$dni'";
		$c_dni = "and c.dni='$dni'";
	}
	
	$sql = "SELECT * FROM (SELECT usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, usu.us_apellidos, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_calle, cl.cl_numero, cl.cl_L, cl.cl_M, cl.cl_W, cl.cl_J, cl.cl_V, cl.cl_S, cl.cl_D, case when usu.nombre is not null then '1' end ejecucion, case when usu.nombre is not null then '1' end validar_ruta, ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, case when usu.nombre is not null then '0' end pertenece, (SELECT top 1 h.hora from historial_sesiones h inner join usuario usu_imei on usu_imei.ruta=h.imei where h.fecha='$fecha_imei' and h.id_usuario=usu.Id_usuario order by hora asc) sesion, ac.comentario
from actividad ac
inner join usuario usu on usu.Id_usuario=ac.Idusuario
inner join cliente cl on cl.Id_cliente=ac.Idcliente and usu.Id_usuario<>cl.Id_ruta
left join (select usu.Id_usuario, usu.nombre,COUNT(usu.nombre) obj_cliente
								from usuario usu
								inner join cliente cl on cl.Id_ruta=usu.Id_usuario
								where cl.$dia='1'
								group by usu.Id_usuario, usu.nombre) ob on ob.Id_usuario=usu.Id_usuario
					left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
								from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
										from usuario usu
										inner join actividad ac on ac.Idusuario=usu.Id_usuario
										inner join cliente cl on cl.Id_cliente=ac.Idcliente
										left join (select cl.RazonSocial 
													from usuario usu
													inner join cliente cl on cl.Id_ruta=usu.Id_usuario
													where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
										where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
								where usu.visitadas<>''
								group by usu.nombre) vis on vis.nombre=usu.nombre
where ac.FechaVisita='$fecha' and usu.Id_usuario!='100' $n_dni

union all

select usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre,  usu.us_apellidos, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_calle, cl.cl_numero, cl_L, cl_M, cl_W, cl_J, cl_V, cl_S, cl_D,case when ac.Idcliente = cl.Id_cliente then '1' when ac.Idcliente is null then 0 end ejecucion, case when usu.Id_usuario = ac.Idusuario then '1' when usu.Id_usuario != ac.Idusuario then '0' end validar_ruta , ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, case when usu.nombre is not null then '1' end pertenece, (SELECT top 1 h.hora from historial_sesiones h inner join usuario usu_imei on usu_imei.ruta=h.imei where h.fecha='$fecha_imei' and h.id_usuario=usu.Id_usuario order by hora asc) sesion, ac.comentario
					from cliente cl 
					left join usuario usu on usu.Id_usuario=cl.Id_ruta
					left join (select *
								from actividad
								where FechaVisita='$fecha') ac on ac.Idcliente=cl.Id_cliente and ac.Idusuario=usu.Id_ruta
					left join (select usu.Id_usuario, usu.nombre,COUNT(usu.nombre) obj_cliente
								from usuario usu
								inner join cliente cl on cl.Id_ruta=usu.Id_usuario
								where cl.$dia='1'
								group by usu.Id_usuario, usu.nombre) ob on ob.Id_usuario=usu.Id_usuario
					left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
								from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
										from usuario usu
										inner join actividad ac on ac.Idusuario=usu.Id_usuario
										inner join cliente cl on cl.Id_cliente=ac.Idcliente
										left join (select cl.RazonSocial 
													from usuario usu
													inner join cliente cl on cl.Id_ruta=usu.Id_usuario
													where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
										where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
								where usu.visitadas<>''
								group by usu.nombre) vis on vis.nombre=usu.nombre) c  full outer join rutav rv on rv.idcliente= c.Id_cliente and cast(rv.FechaVisita as date) = cast(c.FechaVisita as date)
			where c.Id_usuario<>0 and (c.$dia='1' or c.ejecucion='1') and c.Id_usuario!='100' $c_dni
			order by c.Id_usuario asc, c.ejecucion desc, c.entrada asc";
        
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			if($row->validar_ruta != 0 or $row->validar_ruta != '0')
			{
				$resultado[$cont]["FechaVisita"] = date('d/m/Y',strtotime($row->FechaVisita));
				$resultado[$cont]["ruta"] = $row->Id_usuario;
				$resultado[$cont]["nombre"] = $row->nombre;
				$resultado[$cont]["uciudad"] =  $row->us_apellidos;
				$resultado[$cont]["nombre_cliente"] = ($row->RazonSocial);
				$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
				$resultado[$cont]["determinante"] = ($row->cl_email);
				$resultado[$cont]["cadena"] = ($row->cl_calle);
				$resultado[$cont]["iddetermina"] = ($row->cl_numero);
				$resultado[$cont]["objetivo"] = ($row->objetivo);
				$resultado[$cont]["entrada"] = $row->entrada;
				$resultado[$cont]["salida"] = $row->salida;
				$resultado[$cont]["bateria"] = $row->bateria;
				$resultado[$cont]['dia'] = $row->$dia;
				$resultado[$cont]['obj_cliente'] = $row->obj_cliente;
				$resultado[$cont]['visitas'] = $row->visitas;
				$resultado[$cont]['pertenece'] = $row->pertenece;
				$resultado[$cont]['sesion'] = $row->sesion;
				$resultado[$cont]['comentario'] = utf8_decode($row->comentario);
				$resultado[$cont]["fecha"] = $row->FechaVisita;

				$fotos = array();
				$fotos[1]['boolean'] = false;
				$sql_f = "SELECT *
							from fotos_ejecucion
							where id_cliente='$row->Id_cliente' and id_usuario='$row->Id_usuario' and fecha='$fecha'
							order by id_marca asc";
				if($sql_f = odbc_exec($conexion, $sql_f))
				{
					while ($row_f = odbc_fetch_object($sql_f)) 
					{
						$fotos[1]['boolean'] = true;
						$fotos[$row_f->id_marca]['id_marca'] = $row_f->id_marca;
						$fotos[$row_f->id_marca]['fa_p1'] = $row_f->fa_p1;
						$fotos[$row_f->id_marca]['fd_p1'] = $row_f->fd_p1;
						$fotos[$row_f->id_marca]['fa_p2'] = $row_f->fa_p2;
						$fotos[$row_f->id_marca]['fd_p2'] = $row_f->fd_p2;
						$fotos[$row_f->id_marca]['f_exh1'] = $row_f->f_exh1;
						$fotos[$row_f->id_marca]['f_exh2'] = $row_f->f_exh2;
						$fotos[$row_f->id_marca]['f_exh3'] = $row_f->f_exh3;
						$fotos[$row_f->id_marca]['piezas'] = $row_f->piezas;
					}
				}
				$resultado[$cont]['fotos'] = $fotos;

				$cont++;
			}
		}
	}

	$fotos = array();
	$fotos[1]['boolean'] = false;
	$sql = "SELECT usu.dni, usu.Id_usuario, usu.nombre, usu.us_apellidos, c.Id_cliente, c.RazonSocial, c.cl_email, c.cl_calle, c.cl_numero, ac.FechaVisita, ac.entrada, ac.salida, ac.bateria, pr.dni, case when usu.dni=pr.dni then 1 when usu.dni<>pr.dni then 0 end pertenece
			from usuario usu
			left join actividad ac on ac.Idusuario=usu.Id_usuario
			left join cliente c on c.Id_cliente=ac.Idcliente
			left join (select * from usuario where Id_tipouser='2') pr on pr.Id_usuario=c.Id_ruta
			where usu.Id_tipouser='3' and ac.FechaVisita='$fecha' $n_dni
			order by usu.Id_usuario asc, ac.entrada asc";
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			$resultado[$cont]["ruta"] = $row->Id_usuario;
			$resultado[$cont]["nombre"] = $row->nombre;
			$resultado[$cont]["uciudad"] = $row->us_apellidos;
			$resultado[$cont]["nombre_cliente"] = ($row->RazonSocial);
			$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
			$resultado[$cont]["determinante"] = ($row->cl_email);
			$resultado[$cont]["cadena"] = ($row->cl_calle);
			$resultado[$cont]["iddetermina"] = ($row->cl_numero);
			
			$resultado[$cont]["entrada"] = $row->entrada;
			$resultado[$cont]["salida"] = $row->salida;
			$resultado[$cont]["bateria"] = $row->bateria;
			$resultado[$cont]['dia'] = 1;
			$resultado[$cont]['obj_cliente'] = 0;
			$resultado[$cont]['visitas'] = 0;
			$resultado[$cont]['fotos'] = $fotos;
			$resultado[$cont]['pertenece'] = $row->pertenece;
			$cont++;
			
		}
	}

	//odbc_close($conexion);
	return $resultado;
}

function reporteproductos_alen($fecha, $fecha_fin,$conexion, $dia, $dni)
{
	$fecha_imei = date("Y-m-d", strtotime($fecha));
	$resultado = array();
	$cont = 0;
	$n_dni = "";
	$c_dni = "";

	if($dni != "todos")
	{
		$n_dni = "and us.dni='$dni'";
		$c_dni = "and c.dni='$dni'";
	}
	
	$sql = "Select
                    us.nombre,
                    us.us_apellidos,
                    us.Id_usuario,
					us.nombre_completo,
                    per.semana,
                    per.Mes,
                    per.anual,
                    ac.FechaVisita,
                    ac.Idcliente,
                    rv.objetivo,
                    SUM(inv.inv2) As progreso,
                    ac.entrada,
                    ac.salida,
                    ac.bateria,
                    ac.lat,
                    ac.lon,
                    c.cl_email as cadena,
                    c.RazonSocial,
                    case when us.Id_usuario=c.Id_ruta then 1 when us.Id_usuario!=c.Id_ruta then 0 end pertenece,
                    rv.FechaVisita As chkDate,
                    inv.comentario_ejecucion as razon
                From
                    dbrutaverde.dbo.actividad ac Inner Join
                    dbrutaverde.dbo.periodo per On ac.FechaVisita = per.Dia Left Join
                    dbrutaverde.dbo.rutav rv On ac.Idcliente = rv.idcliente
                        And convert(date,rv.FechaVisita,103) = ac.FechaVisita
                        And rv.id_ruta = ac.Idusuario Left Join
                    dbrutaverde.dbo.inventario inv On inv.Id_cliente = rv.idcliente
                        And inv.Id_usuario = ac.Idusuario
                        And inv.fecha = ac.FechaVisita Inner Join
                    dbrutaverde.dbo.usuario us On us.Id_usuario = ac.Idusuario Inner Join
                    dbrutaverde.dbo.cliente c On c.Id_cliente = ac.Idcliente
                Where
                    ac.FechaVisita between '$fecha' and '$fecha_fin' and us.Id_usuario!='100' $n_dni
                Group By
                    us.nombre,
                    us.us_apellidos,
                    us.Id_usuario,
					us.nombre_completo,
                    per.semana,
                    per.Mes,
                    per.anual,
                    ac.FechaVisita,
                    ac.Idcliente,
                    rv.objetivo,
                    ac.entrada,
                    ac.salida,
                    ac.bateria,
                    ac.lat,
                    ac.lon,
                    c.cl_email,
                    c.RazonSocial, 
                    Case
				        When us.Id_usuario = c.Id_ruta
				        Then 1  
				        When us.Id_usuario != c.Id_ruta
				        Then 0
				    End,
				    rv.FechaVisita,
                    inv.comentario_ejecucion
                Order By
    ac.FechaVisita,us.Id_usuario, ac.entrada";
       // echo $sql;
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			//if($row->validar_ruta != 0 or $row->validar_ruta != '0')
			//{
                    $resultado[$cont]["Id_usuario"] = $row->Id_usuario;
                    $resultado[$cont]["FechaVisita"] = date('d/m/Y',strtotime($row->FechaVisita));
                    $resultado[$cont]["usr"] = $row->Id_usuario;
                    $resultado[$cont]["nombre"] = $row->nombre;
                    $resultado[$cont]["ruta"] = $row->Id_usuario;
                    $resultado[$cont]["uciudad"] =  $row->us_apellidos;
                    $resultado[$cont]["nombre_completo"] =  $row->nombre_completo;
                    $resultado[$cont]["nombre_cliente"] = ($row->cadena);
                    $resultado[$cont]["idCliente"] = ($row->Idcliente);
                    $resultado[$cont]["sucursal"] = $row->Idcliente;
                    $resultado[$cont]["objetivo"] = ($row->objetivo);
                    $resultado[$cont]["entrada"] = $row->entrada;
                    $resultado[$cont]["razonSocial"] = utf8_encode($row->RazonSocial);
                    $resultado[$cont]["salida"] = $row->salida;
                    $resultado[$cont]["bateria"] = $row->bateria;
                    $resultado[$cont]["cadena"] = utf8_encode($row->cadena);
                    $resultado[$cont]['progreso'] = $row->progreso;
                    $resultado[$cont]['lat'] = $row->lat;
                    $resultado[$cont]['lon'] = $row->lon;
                    $resultado[$cont]['semana'] = $row->semana;
                    $resultado[$cont]['mes'] = $row->Mes;
                    $resultado[$cont]["anual"] = $row->anual;
                    $resultado[$cont]["pertenece"] = $row->pertenece;
                    $resultado[$cont]["chkDate"] = $row->chkDate;
                    $resultado[$cont]["razon"] = $row->razon;
                

                    $fotos = array();
                    $fotos[1]['boolean'] = false;
                    $sql_f = "SELECT *
                                        from fotos_ejecucion
                                        where id_cliente='$row->Idcliente' and id_usuario='$row->Id_usuario' and fecha='$fecha'
                                        order by id_marca asc";
                    if($sql_f = odbc_exec($conexion, $sql_f))
                    {
                            while ($row_f = odbc_fetch_object($sql_f)) 
                            {
                                $fotos[1]['boolean'] = true;
                                $fotos[$row_f->id_marca]['id_marca'] = $row_f->id_marca;
                                $fotos[$row_f->id_marca]['fa_p1'] = $row_f->fa_p1;
                                $fotos[$row_f->id_marca]['fd_p1'] = $row_f->fd_p1;
                                $fotos[$row_f->id_marca]['fa_p2'] = $row_f->fa_p2;
                                $fotos[$row_f->id_marca]['fd_p2'] = $row_f->fd_p2;
                                $fotos[$row_f->id_marca]['f_exh1'] = $row_f->f_exh1;
                                $fotos[$row_f->id_marca]['f_exh2'] = $row_f->f_exh2;
                                $fotos[$row_f->id_marca]['f_exh3'] = $row_f->f_exh3;
                                $fotos[$row_f->id_marca]['piezas'] = $row_f->piezas;
                            }
                    }
                    $resultado[$cont]['fotos'] = $fotos;

                    $cont++;
                    //}
		}
	}
	return $resultado;
}


//Consultar para mostrar todas las actividades ya sea fuera de ruta, que no pertenece y que si pertenece
/*
	//Primer consulta buscamos las actividades que no pertenece la id_ruta del cliente
	//Segunda consulta buscamos las actividades que si pertenece la id_ruta del cliente
	$sql = "SELECT * FROM (SELECT usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_L, cl.cl_M, cl.cl_W, cl.cl_J, cl.cl_V, cl.cl_S, cl.cl_D, case when usu.nombre is not null then '1' end ejecucion, case when usu.nombre is not null then '1' end validar_ruta, ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas
	from actividad ac
	inner join usuario usu on usu.Id_usuario=ac.Idusuario
	inner join cliente cl on cl.Id_cliente=ac.Idcliente and usu.Id_usuario<>cl.Id_ruta
	left join (select usu.nombre,COUNT(usu.nombre) obj_cliente
									from usuario usu
									inner join cliente cl on cl.Id_ruta=usu.Id_usuario
									where cl.$dia='1'
									group by usu.nombre) ob on ob.nombre=usu.nombre
						left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
									from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
											from usuario usu
											inner join actividad ac on ac.Idusuario=usu.Id_usuario
											inner join cliente cl on cl.Id_cliente=ac.Idcliente
											left join (select cl.RazonSocial 
														from usuario usu
														inner join cliente cl on cl.Id_ruta=usu.Id_usuario
														where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
											where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
									where usu.visitadas<>''
									group by usu.nombre) vis on vis.nombre=usu.nombre
	where ac.FechaVisita='$fecha'

	union all

	select usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl_L, cl_M, cl_W, cl_J, cl_V, cl_S, cl_D,case when ac.Idcliente = cl.Id_cliente then '1' when ac.Idcliente is null then 0 end ejecucion, case when usu.Id_usuario = ac.Idusuario then '1' when usu.Id_usuario != ac.Idusuario then '0' end validar_ruta , ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas
						from cliente cl 
						left join usuario usu on usu.Id_usuario=cl.Id_ruta
						left join (select *
									from actividad
									where FechaVisita='$fecha') ac on ac.Idcliente=cl.Id_cliente and ac.Idusuario=usu.Id_ruta
						left join (select usu.nombre,COUNT(usu.nombre) obj_cliente
									from usuario usu
									inner join cliente cl on cl.Id_ruta=usu.Id_usuario
									where cl.$dia='1'
									group by usu.nombre) ob on ob.nombre=usu.nombre
						left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
									from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
											from usuario usu
											inner join actividad ac on ac.Idusuario=usu.Id_usuario
											inner join cliente cl on cl.Id_cliente=ac.Idcliente
											left join (select cl.RazonSocial 
														from usuario usu
														inner join cliente cl on cl.Id_ruta=usu.Id_usuario
														where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
											where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
									where usu.visitadas<>''
									group by usu.nombre) vis on vis.nombre=usu.nombre) c
				where c.Id_usuario<>0 and (c.$dia='1' or c.ejecucion='1') 
				order by c.Id_usuario asc, c.ejecucion desc, c.entrada asc
	";
*/



function checa_merma($fecha,$id,$conexion){


	$cons="SELECT  count(id) as num  FROM inventario where incidencia in ('14','13','11','3') and fecha = '$fecha' and Id_cliente='$id'";
	$sql=odbc_exec($conexion,$cons);
	$row=odbc_fetch_array($sql);

	if(($row['num']*1)>0)
	{ 
		return true;
	}else
	{
		return false;
	}
}

function reporteproductos_ultima_visita($conexion, $cliente)
{
	$cont = 0;
	$sql = "SELECT usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cli.Id_cliente, cli.RazonSocial, cli.cl_email, cli.cl_calle, cli.cl_numero, cli.Id_ruta, case when usu.Id_usuario=cli.Id_ruta then 1 when usu.Id_usuario!=cli.Id_ruta then 0 end pertenece, cli.entrada, cli.salida, cli.bateria, cli.FechaVisita, cli.cl_L, cli.cl_M, cli.cl_W, cli.cl_J, cli.cl_V, cli.cl_S, cli.cl_D
			FROM (select cl.cl_L, cl.cl_M, cl.cl_W, cl.cl_J, cl.cl_V, cl.cl_S, cl.cl_D, cl.idcliente, cl.cl_email, cl.cl_calle, cl.cl_numero, cl.RazonSocial, cl.Id_ruta, act.idcliente id_cliente, act.Idusuario, act.FechaVisita, ROW_NUMBER() OVER (Partition BY cl.idcliente ORDER BY act.FechaVisita desc) as rowNum, act.entrada, act.salida, act.bateria
					from cliente cl
					left join actividad act on act.idcliente=cl.idcliente
					where cl.RazonSocial like '%".$cliente."%') cli
			left join usuario usu on usu.Id_usuario=cli.Idusuario
			where cli.rowNum='1' and usu.Id_tipouser='2'
			order by cli.FechaVisita desc";

	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			$resultado[$cont]["ruta"] = $row->Id_usuario;
			$resultado[$cont]["nombre"] = $row->nombre;
			$resultado[$cont]["nombre_cliente"] = ($row->RazonSocial);
			$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
			$resultado[$cont]["determinante"] = ($row->cl_email);
			$resultado[$cont]["cadena"] = ($row->cl_calle);
			$resultado[$cont]["iddetermina"] = ($row->cl_numero);
			
			$resultado[$cont]["entrada"] = $row->entrada;
			$resultado[$cont]["salida"] = $row->salida;
			$resultado[$cont]["bateria"] = $row->bateria;
			$resultado[$cont]["fecha"] = $row->FechaVisita;
			$resultado[$cont]['cl_L'] = $row->cl_L;
			$resultado[$cont]['cl_M'] = $row->cl_M;
			$resultado[$cont]['cl_W'] = $row->cl_W;
			$resultado[$cont]['cl_J'] = $row->cl_J;
			$resultado[$cont]['cl_V'] = $row->cl_V;
			$resultado[$cont]['cl_S'] = $row->cl_S;
			$resultado[$cont]['cl_D'] = $row->cl_D;
			//$resultado[$cont]['dia'] = $row->$dia;
			//$resultado[$cont]['obj_cliente'] = $row->obj_cliente;
			//$resultado[$cont]['visitas'] = $row->visitas;
			$resultado[$cont]['pertenece'] = $row->pertenece;

			$fotos = array();
			$fotos[1]['boolean'] = false;
			$sql_f = "SELECT *
						from fotos_ejecucion
						where id_cliente='$row->Id_cliente' and id_usuario='$row->Id_usuario' and fecha='$row->FechaVisita'
						order by id_marca asc";
			if($sql_f = odbc_exec($conexion, $sql_f))
			{
				while ($row_f = odbc_fetch_object($sql_f)) 
				{
					$fotos[1]['boolean'] = true;
					$fotos[$row_f->id_marca]['id_marca'] = $row_f->id_marca;
					$fotos[$row_f->id_marca]['fa_p1'] = $row_f->fa_p1;
					$fotos[$row_f->id_marca]['fd_p1'] = $row_f->fd_p1;
					$fotos[$row_f->id_marca]['fa_p2'] = $row_f->fa_p2;
					$fotos[$row_f->id_marca]['fd_p2'] = $row_f->fd_p2;
					$fotos[$row_f->id_marca]['f_exh1'] = $row_f->f_exh1;
					$fotos[$row_f->id_marca]['f_exh2'] = $row_f->f_exh2;
					$fotos[$row_f->id_marca]['f_exh3'] = $row_f->f_exh3;
					$fotos[$row_f->id_marca]['piezas'] = $row_f->piezas;
				}
			}
			$resultado[$cont]['fotos'] = $fotos;

			$cont++;
		}
	}

	//odbc_close($conexion);
	return $resultado;
}

function reporteproductos_sup_noti($fecha, $conexion, $dia, $dni, $idpromotor)
{
	$resultado = array();
	$cont = 0;
	$n_dni = "";
	$c_dni = "";

	if($dni != "todos")
	{
		$n_dni = "and usu.dni='$dni'";
		$c_dni = "and c.dni='$dni'";
	}
	
	$id_usu = "c.Id_usuario='$idpromotor'";
	
	
	$sql = "SELECT *
			FROM (select usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_calle, cl.cl_numero, cl_L, cl_M, cl_W, cl_J, cl_V, cl_S, cl_D,case when ac.Idcliente = cl.Id_cliente then '1' when ac.Idcliente is null then 0 end ejecucion, case when usu.Id_usuario = ac.Idusuario then '1' when usu.Id_usuario != ac.Idusuario then '0' end validar_ruta , ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas
					from cliente cl 
					left join usuario usu on usu.Id_usuario=cl.Id_ruta
					left join (select *
								from actividad
								where FechaVisita='$fecha') ac on ac.Idcliente=cl.Id_cliente and ac.Idusuario=usu.Id_ruta
					left join (select usu.nombre,COUNT(usu.nombre) obj_cliente
								from usuario usu
								inner join cliente cl on cl.Id_ruta=usu.Id_usuario
								where cl.$dia='1'
								group by usu.nombre) ob on ob.nombre=usu.nombre
					left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
								from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
										from usuario usu
										inner join actividad ac on ac.Idusuario=usu.Id_usuario
										inner join cliente cl on cl.Id_cliente=ac.Idcliente
										left join (select cl.RazonSocial 
													from usuario usu
													inner join cliente cl on cl.Id_ruta=usu.Id_usuario
													where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
										where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
								where usu.visitadas<>''
								group by usu.nombre) vis on vis.nombre=usu.nombre) c
			where c.Id_usuario<>0 and (c.$dia='1' or c.ejecucion='1') and c.Id_tipouser='2' $c_dni and $id_usu
			order by c.Id_usuario asc, c.ejecucion desc, c.entrada asc";
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			if($row->validar_ruta != 0 or $row->validar_ruta != '0')
			{
				$resultado[$cont]["ruta"] = $row->Id_usuario;
				$resultado[$cont]["nombre"] = $row->nombre;
				$resultado[$cont]["nombre_cliente"] = ($row->RazonSocial);
				$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
				$resultado[$cont]["determinante"] = ($row->cl_email);
				$resultado[$cont]["cadena"] = ($row->cl_calle);
				$resultado[$cont]["iddetermina"] = ($row->cl_numero);
				
				$resultado[$cont]["entrada"] = $row->entrada;
				$resultado[$cont]["salida"] = $row->salida;
				$resultado[$cont]["bateria"] = $row->bateria;
				$resultado[$cont]['dia'] = $row->$dia;
				$resultado[$cont]['obj_cliente'] = $row->obj_cliente;
				$resultado[$cont]['visitas'] = $row->visitas;

				$fotos = array();
				$fotos[1]['boolean'] = false;
				$sql_f = "SELECT *
							from fotos_ejecucion
							where id_cliente='$row->Id_cliente' and id_usuario='$row->Id_usuario' and fecha='$fecha'
							order by id_marca asc";
				if($sql_f = odbc_exec($conexion, $sql_f))
				{
					while ($row_f = odbc_fetch_object($sql_f)) 
					{
						$fotos[1]['boolean'] = true;
						$fotos[$row_f->id_marca]['id_marca'] = $row_f->id_marca;
						$fotos[$row_f->id_marca]['fa_p1'] = $row_f->fa_p1;
						$fotos[$row_f->id_marca]['fd_p1'] = $row_f->fd_p1;
						$fotos[$row_f->id_marca]['fa_p2'] = $row_f->fa_p2;
						$fotos[$row_f->id_marca]['fd_p2'] = $row_f->fd_p2;
					}
				}
				$resultado[$cont]['fotos'] = $fotos;

				$cont++;
			}
		}
	}

	$fotos = array();
	$fotos[1]['boolean'] = false;
	$sql = "SELECT usu.dni, usu.Id_usuario, usu.nombre, c.Id_cliente, c.RazonSocial, c.cl_email, c.cl_calle, c.cl_numero, ac.FechaVisita, ac.entrada, ac.salida, ac.bateria
			from usuario usu
			left join actividad ac on ac.Idusuario=usu.Id_usuario
			left join cliente c on c.Id_cliente=ac.Idcliente			
			where usu.Id_tipouser='3' and ac.FechaVisita='$fecha' $n_dni
			order by usu.Id_usuario asc, ac.entrada asc";
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			$resultado[$cont]["ruta"] = $row->Id_usuario;
			$resultado[$cont]["nombre"] = $row->nombre;
			$resultado[$cont]["nombre_cliente"] = ($row->RazonSocial);
			$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
			$resultado[$cont]["determinante"] = ($row->cl_email);
			$resultado[$cont]["cadena"] = ($row->cl_calle);
			$resultado[$cont]["iddetermina"] = ($row->cl_numero);
			
			$resultado[$cont]["entrada"] = $row->entrada;
			$resultado[$cont]["salida"] = $row->salida;
			$resultado[$cont]["bateria"] = $row->bateria;
			$resultado[$cont]['dia'] = 0;
			$resultado[$cont]['obj_cliente'] = 0;
			$resultado[$cont]['visitas'] = 0;
			$resultado[$cont]['fotos'] = $fotos;
			$cont++;
			
		}
	}

	//odbc_close($conexion);
	return $resultado;
}

function reporteproductosvisitas($fecha, $fecha_fin, $conexion, $dia)
{
	$ususup=$_COOKIE['login'];
	$resultado = array();
	$cont = 0;
	$fecha1 = date('Y-n-d', strtotime($fecha));
	$fecha_fin1 = date('Y-n-d', strtotime($fecha_fin));

	$frecuencia = array(array(1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => ""), array(1 => "L", 2 => "M", 3 => "R", 4 => "J", 5 => "V", 6 => "S"));
	$day = array(1 => "Lunes", 2 => "Martes", 3 => "Miercoles", 4 => "Jueves", 5 => "Viernes", 6 => "Sabado", 7 => "Domingo");

	$visit_day = $day[date("N", strtotime($fecha))];
	
	$sql = "SELECT *
			FROM (select usu.area area, usu.Id_usuario, usu.nombre, usu.nombre_completo,usu.Id_tipouser, usu.sup as nombre_sup,usu.sup as supervisor, cl.cl_ciudad ciudad, cl.cl_municipio estado, usu.us_direccion, cl.Id_cliente, cl.cl_numero id_store, 'Mayoreo' chanel, cl.RazonSocial, cl.cl_ciudad, cl.cl_email, cl.Lat, cl.Lon, cl_L, cl_M, cl_W, cl_J, cl_V, cl_S, cl_D, cl.Id_ruta,case when ac.Idcliente = cl.Id_cliente then '1' when ac.Idcliente is null then 0 end ejecucion, case when usu.Id_usuario = ac.Idusuario then '1' when usu.Id_usuario != ac.Idusuario then '0' end validar_ruta , ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria
					from cliente cl, usuario usu
					left join (select *
								from actividad
								where FechaVisita between '$fecha1' and '$fecha_fin1') ac on ac.Idusuario=usu.Id_usuario) c
			        inner join (select dia, mes, semana from periodo) per on per.dia = FechaVisita
					
			where  c.ejecucion='1' and c.Id_usuario not in ('101')
			
			order by c.FechaVisita asc,c.Id_usuario asc, c.ejecucion desc,  c.entrada asc";
			
			//where  c.ejecucion='1' and c.Id_usuario not in ('100', '101')  lo cambie para mostrar el 100 rcv
        //where  c.ejecucion='1' and (c.Id_tipouser='2' or c.Id_tipouser='1') and c.nombre_sup in (SELECT Nombre from supervisor where Nombre='$ususup' or Gerencia='$ususup' or Ejecutivo='$ususup' or Monitoreo='$ususup' or susu='$ususup' or susu1='$ususup' or susu2='$ususup') <- linea usada por rcv
	//echo $sql;		
	if($sql = odbc_exec($conexion, $sql))
	{
		while ($row = odbc_fetch_object($sql)) 
		{
			if($row->validar_ruta != 0 or $row->validar_ruta != '0')
			{
				$resultado[$cont]["area"] = $row->area;
				$resultado[$cont]["ruta"] = $row->Id_usuario;
				$resultado[$cont]["nombre"] = $row->nombre;
				$resultado[$cont]["mes"] = $row->mes; //rc
				$resultado[$cont]["semana"] = $row->semana; //rc
				$resultado[$cont]["nombre_real"] = utf8_encode($row->nombre_completo);
				$resultado[$cont]["supervisor1"] = $row->supervisor;
				$resultado[$cont]["nombre_sup"] = $row->nombre_sup;
				$resultado[$cont]["ciudad"] = utf8_encode($row->ciudad);
				$resultado[$cont]["estado"] = utf8_encode($row->estado);
				$resultado[$cont]["id_store"] = $row->id_store;
				$resultado[$cont]["nombre_cliente"] = utf8_encode($row->RazonSocial);
				$resultado[$cont]["Id_cliente"] = $row->Id_cliente;
				$resultado[$cont]["determinante"] = utf8_encode($row->cl_email);
				$resultado[$cont]["supervisor"] = $row->area;
				$resultado[$cont]["entrada"] = $row->entrada;
				$resultado[$cont]["salida"] = $row->salida;
				$resultado[$cont]["bateria"] = $row->bateria;
				$resultado[$cont]["fecha"] = $row->FechaVisita;
				$resultado[$cont]["frecuencia"] = $frecuencia[$row->cl_L][1].$frecuencia[$row->cl_M][2].$frecuencia[$row->cl_W][3].$frecuencia[$row->cl_J][4].$frecuencia[$row->cl_V][5].$frecuencia[$row->cl_S][6];
				$resultado[$cont]["chanel"] = $row->chanel;
				$resultado[$cont]["lat"] = $row->Lat;
				$resultado[$cont]["lon"] = $row->Lon;

				if($row->Id_usuario == $row->Id_ruta)
				{
					if($visit_day == "Lunes")
					{
						if($row->cl_L == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Martes")
					{
						if($row->cl_M == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Miercoles")
					{
						if($row->cl_W == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Jueves")
					{
						if($row->cl_J == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Viernes")
					{
						if($row->cl_V == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Sabado")
					{
						if($row->cl_S == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
					else if($visit_day == "Domingo")
					{
						if($row->cl_D == "1")
						{
							$resultado[$cont]["estatus"] = "En ruta";
						}
						else
						{
							$resultado[$cont]["estatus"] = "Error en día";
						}
					}
				}
				else
				{
					$resultado[$cont]["estatus"] = "Visita en ruta";
				}
				$cont++;
			}
		}
	}

	//odbc_close($conexion);
	return $resultado;
}

function inventarios($id_cliente, $id_usuario, $fecha)
{
	$ch = curl_init();

	// definimos la URL a la que hacemos la petición
	//curl_setopt($ch, CURLOPT_URL,"http://192.168.1.20/Kuasmc/api/api.php");
	curl_setopt($ch, CURLOPT_URL,"http://192.168.15.9/rutaverde/api/api.php");
	// indicamos el tipo de petición: POST
	curl_setopt($ch, CURLOPT_POST, TRUE);
	// definimos cada uno de los parámetros
	curl_setopt($ch, CURLOPT_POSTFIELDS, "action=inventariosrvweb&id_cliente=".$id_cliente."&id_usuario=".$id_usuario."&fecha=".$fecha);

	// recibimos la respuesta y la guardamos en una variable
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$remote_server_output = curl_exec ($ch);
	//$remote_server_output = utf8_decode($remote_server_output);
	$datos = json_decode($remote_server_output, true);

	// cerramos la sesión cURL
	curl_close ($ch);

	return $remote_server_output;
}



//*++++++++++++++++++REPORTE+++++++++++++++//
//*++++++++++++++++++Marcas+++++++++++++++//
function nombre_marcas($conexion)
{
	//Obtener nombre de las marcas
	$nom_marcas = array();
	$sql = "SELECT ma_nommarca, Id_marca from marca order by Id_marca asc";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_array($sql)) 
	{
		$resultado[$row['Id_marca']] = $row['ma_nommarca'];
	}

	//odbc_close($conexion);
	return $resultado;
}
//*++++++++++++++++++Marcas+++++++++++++++//
//*++++++++++++++++++Notificacion+++++++++++++++//
function notificacion($fecha)
{
	if(file_exists("conexion/conexionticket.php"))
	{
		include "conexion/conexionticket.php";
	}
	else
	{
		include "../conexion/conexionticket.php";
	}

	$cont = 0;
	$res = array();
	$sql = "SELECT id_usuario, pregunta, titulo, problema, fecha from preguntas where fecha like '".$fecha."%' and programa='2'";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['usuario'] = usuario($row->id_usuario);
		$res[$cont]['titulo'] = $row->titulo;
		$res[$cont]['pregunta'] = $row->pregunta;
		$hora = split("/", $row->fecha);
		$res[$cont]['fecha'] = $hora[0];
		$res[$cont]['hora'] = $hora[1];
		$cont++;
	}
	return $res;
}
//*++++++++++++++++++Notificacion+++++++++++++++//
//*++++++++++++++++++usuario+++++++++++++++//
function usuario($id_usuario)
{
	if(file_exists("conexion/conexionkua.php"))
	{
		include "conexion/conexionkua.php";
	}
	else
	{
		include "../conexion/conexionkua.php";
	}

	$sql = "SELECT nombre from usuario where Id_usuario='$id_usuario'";
	$sql = odbc_exec($conexion, $sql);
	if ($row = odbc_fetch_object($sql)) 
	{
		return $row->nombre;		
	}
}
//*++++++++++++++++++usuario+++++++++++++++//
//*++++++++++++++++++ACTUALIZAR CLIENTES+++++++++++++++//
function actualizar_cliente($conexion, $id_cliente, $id_usuario, $RazonSocial)
{
	$res = array();
	$cont = 0;

	if(!empty($id_cliente))
	{
		$buscar = "where Id_cliente='$id_cliente'";
	}
	else if(!empty($id_usuario))
	{
		$buscar = "where Id_ruta='$id_usuario'";
	}
	else if(!empty($RazonSocial))
	{
		$buscar = "where RazonSocial like '%$RazonSocial%'";
	}

	$sql = "SELECT Id_cliente, RazonSocial, Lat, Lon, Id_ruta, cl_ultvisita,cl_email as cadena from cliente $buscar";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['id_cliente'] = $row->Id_cliente;
		$res[$cont]['RazonSocial'] = utf8_encode($row->RazonSocial);
		$res[$cont]['Lat'] = $row->Lat;
		$res[$cont]['Lon'] = $row->Lon;
		$res[$cont]['id_usuario'] = $row->Id_ruta;
		$res[$cont]['cl_ultvisita'] = $row->cl_ultvisita;
                $res[$cont]['cadena'] = $row->cadena;
		$cont++;
	}
	return $res;
}
//*++++++++++++++++++ACTUALIZAR CLIENTES+++++++++++++++//
//*++++++++++++++++++Asistencia+++++++++++++++//
function asistencia($conexion, $fecha,$fecha1) 
{
	$res = array();
	$dni = $_COOKIE['dni'];
	$cont = 0;
	
	if ($dni='todos')
	{
		$sql = " SELECT asi.id_usuario, asi.ucfdi, usu.us_nombre_real, asi.asistencia,us_nombre as supervisor, asi.id_supervisor, asi.id_motivo, m.motivo, asi.fecha
			from asistencia asi
			left join (Select * from (SELECT distinct Id_usuario, ac_entrada, ROW_NUMBER() OVER (Partition BY Id_usuario ORDER BY ac_entrada asc) rowC
										FROM actividad
										where ac_fechavisita>='$fecha' and ac_fechavisita<='$fecha1') act
						where act.rowC='1') act on act.Id_usuario=asi.id_usuario
			left join motivo m on m.id_motivo=asi.id_motivo
			inner join usuarionom usu on usu.Id_usuario=asi.id_usuario
			where asi.fecha>='$fecha' and asi.fecha<='$fecha1' 
			order by id_supervisor asc, id_usuario asc";
	}else
	{
		$sql = " SELECT asi.id_usuario, asi.ucfdi, usu.us_nombre_real, asi.asistencia,us_nombre as supervisor, asi.id_supervisor, asi.id_motivo, m.motivo, asi.fecha
			from asistencia asi
			left join (Select * from (SELECT distinct Id_usuario, ac_entrada, ROW_NUMBER() OVER (Partition BY Id_usuario ORDER BY ac_entrada asc) rowC
										FROM actividad
										where ac_fechavisita>='$fecha' and ac_fechavisita<='$fecha1') act
						where act.rowC='1') act on act.Id_usuario=asi.id_usuario
			left join motivo m on m.id_motivo=asi.id_motivo
			inner join usuarionom usu on usu.Id_usuario=asi.id_usuario
			where asi.fecha>='$fecha' and asi.fecha<='$fecha1' and dni='$dni'
			order by id_supervisor asc, id_usuario asc";
	}		
	
	
	
			
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['id_usuario'] = $row->ucfdi;
		$res[$cont]['nombre'] = $row->us_nombre_real;
		$res[$cont]['supervisor'] = $row->supervisor;
		$res[$cont]['id_supervisor'] = $row->id_supervisor;
		$res[$cont]['motivo'] = $row->motivo;
		$res[$cont]['fecha'] = $row->fecha;
		$res[$cont]['entrada'] = $row->entrada;
		$cont++;
	}
	return $res;
}

function resumen_asistencia($conexion, $fecha,$fecha1)
{
	$res = array();
	$cont = 0;
	$sql = "SELECT m.id_motivo, max(m.total) total
			from (Select id_motivo, ROW_NUMBER() over(Partition by id_motivo order by id_motivo asc) total
					from asistencia 
					where fecha>='$fecha' and fecha<='$fecha1') m
			group by m.id_motivo";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$row->id_motivo]['motivo'] = $row->total;
		$res[$row->id_motivo]['id_motivo'] = $row->id_motivo;
		$cont++;
	}
	return $res;		
}

function motivo($conexion)
{
	$res = array();
	$cont = 0;
	$sql = "SELECT * FROM motivo";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['id_motivo'] = $row->id_motivo;
		$res[$cont]['motivo'] = $row->motivo;
		$cont++;
	}
	return $res;
}




//*++++++++++++++++++Asistencia+++++++++++++++//
//*++++++++++++++++++COMPETENCIA+++++++++++++++//
function competencia($conexion, $fecha)
{
	$res = array();
	$cont = 0;
	$sql = "SELECT id_cliente, id_usuario, fecha, p1r1, p1r2, p1r3, p1r4, foto1, p2r1, p2r2, p2r3, p2r4, foto2, p3r1, p3r2, p3r3, p3r4, foto3, p4r1, p4r2, p4r3, p4r4, foto4, p5r1, p5r2, p5r3, p5r4, foto5 from competencia where fecha='$fecha'";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['id_cliente'] = $row->id_cliente;
		$res[$cont]['id_usuario'] = $row->id_usuario;
		$res[$cont]['fecha'] = $row->fecha;
		$res[$cont]['p1r1'] = $row->p1r1;
		$res[$cont]['p1r2'] = $row->p1r2;
		$res[$cont]['p1r3'] = $row->p1r3;
		$res[$cont]['p1r4'] = $row->p1r4;
		$res[$cont]['foto1'] = $row->foto1;
		$res[$cont]['p2r1'] = $row->p2r1;
		$res[$cont]['p2r2'] = $row->p2r2;
		$res[$cont]['p2r3'] = $row->p2r3;
		$res[$cont]['p2r4'] = $row->p2r4;
		$res[$cont]['foto2'] = $row->foto2;
		$res[$cont]['p3r1'] = $row->p3r1;
		$res[$cont]['p3r2'] = $row->p3r2;
		$res[$cont]['p3r3'] = $row->p3r3;
		$res[$cont]['p3r4'] = $row->p3r4;
		$res[$cont]['foto3'] = $row->foto3;
		$res[$cont]['p4r1'] = $row->p4r1;
		$res[$cont]['p4r2'] = $row->p4r2;
		$res[$cont]['p4r3'] = $row->p4r3;
		$res[$cont]['p4r4'] = $row->p4r4;
		$res[$cont]['foto4'] = $row->foto4;
		$res[$cont]['p5r1'] = $row->p5r1;
		$res[$cont]['p5r2'] = $row->p5r2;
		$res[$cont]['p5r3'] = $row->p5r3;
		$res[$cont]['p5r4'] = $row->p5r4;
		$res[$cont]['foto5'] = $row->foto5;
		$cont++;
	}
	return $res;
}

function encuesta_competencia($conexion)
{
	$res = array();
	$cont = 0;
	$sql = "SELECT numero, nombre_corto FROM  encuesta_competencia
			order by numero";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['numero'] = $row->numero;
		$res[$cont]['nombre_corto'] = utf8_decode(utf8_encode($row->nombre_corto));
		$cont++;
	}
	return $res;
}

function excel_comptenecia($conexion, $id_cliente, $id_usuario, $fecha)
{
	$res = array();
	$cont = 0;
	$sql = "SELECT id_cliente, id_usuario, fecha, p1r1, p1r2, p1r3, p1r4, foto1, p2r1, p2r2, p2r3, p2r4, foto2, p3r1, p3r2, p3r3, p3r4, foto3, p4r1, p4r2, p4r3, p4r4, foto4, p5r1, p5r2, p5r3, p5r4, foto5 
			from competencia 
			where fecha='$fecha' and id_usuario='$id_usuario' and id_cliente='$id_cliente'";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['p1r1'] = $row->p1r1;
		$res[$cont]['p1r2'] = $row->p1r2;
		$res[$cont]['p1r3'] = $row->p1r3;
		$res[$cont]['p1r4'] = $row->p1r4;
		$res[$cont]['foto1'] = $row->foto1;
		$res[$cont]['p2r1'] = $row->p2r1;
		$res[$cont]['p2r2'] = $row->p2r2;
		$res[$cont]['p2r3'] = $row->p2r3;
		$res[$cont]['p2r4'] = $row->p2r4;
		$res[$cont]['foto2'] = $row->foto2;
		$res[$cont]['p3r1'] = $row->p3r1;
		$res[$cont]['p3r2'] = $row->p3r2;
		$res[$cont]['p3r3'] = $row->p3r3;
		$res[$cont]['p3r4'] = $row->p3r4;
		$res[$cont]['foto3'] = $row->foto3;
		$res[$cont]['p4r1'] = $row->p4r1;
		$res[$cont]['p4r2'] = $row->p4r2;
		$res[$cont]['p4r3'] = $row->p4r3;
		$res[$cont]['p4r4'] = $row->p4r4;
		$res[$cont]['foto4'] = $row->foto4;
		$res[$cont]['p5r1'] = $row->p5r1;
		$res[$cont]['p5r2'] = $row->p5r2;
		$res[$cont]['p5r3'] = $row->p5r3;
		$res[$cont]['p5r4'] = $row->p5r4;
		$res[$cont]['foto5'] = $row->foto5;
		$cont++;
	}
	return $res;
}



//*++++++++++++++++++Asistencia+++++++++++++++//
//*++++++++++++++++++INDEX+++++++++++++++//
function rutas_ejecucion($conexion, $fecha, $dia)
{
	$res = 0;
	$sql = "SELECT count (distinct c.Id_usuario) ejecucion FROM (SELECT usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_calle, cl.cl_numero, cl.cl_L, cl.cl_M, cl.cl_W, cl.cl_J, cl.cl_V, cl.cl_S, cl.cl_D, case when usu.nombre is not null then '1' end ejecucion, case when usu.nombre is not null then '1' end validar_ruta, ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, case when usu.nombre is not null then '0' end pertenece
from actividad ac
inner join usuario usu on usu.Id_usuario=ac.Idusuario
inner join cliente cl on cl.Id_cliente=ac.Idcliente and usu.Id_usuario<>cl.Id_ruta
left join (select usu.Id_usuario, usu.nombre,COUNT(usu.nombre) obj_cliente
								from usuario usu
								inner join cliente cl on cl.Id_ruta=usu.Id_usuario
								where cl.$dia='1'
								group by usu.Id_usuario, usu.nombre) ob on ob.Id_usuario=usu.Id_usuario
					left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
								from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
										from usuario usu
										inner join actividad ac on ac.Idusuario=usu.Id_usuario
										inner join cliente cl on cl.Id_cliente=ac.Idcliente
										left join (select cl.RazonSocial 
													from usuario usu
													inner join cliente cl on cl.Id_ruta=usu.Id_usuario
													where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
										where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
								where usu.visitadas<>''
								group by usu.nombre) vis on vis.nombre=usu.nombre
where ac.FechaVisita='$fecha' and usu.Id_tipouser='2' 

union all

select usu.dni, usu.Id_tipouser, usu.Id_usuario, usu.nombre, cl.Id_cliente, cl.RazonSocial, cl.cl_email, cl.cl_calle, cl.cl_numero, cl_L, cl_M, cl_W, cl_J, cl_V, cl_S, cl_D,case when ac.Idcliente = cl.Id_cliente then '1' when ac.Idcliente is null then 0 end ejecucion, case when usu.Id_usuario = ac.Idusuario then '1' when usu.Id_usuario != ac.Idusuario then '0' end validar_ruta , ac.FechaVisita, ac.Idusuario, ac.entrada, ac.salida, ac.bateria, ob.obj_cliente, case when vis.sum_visitadas is not null then vis.sum_visitadas when vis.sum_visitadas is null then '0' end visitas, case when usu.nombre is not null then '1' end pertenece
					from cliente cl 
					left join usuario usu on usu.Id_usuario=cl.Id_ruta
					left join (select *
								from actividad
								where FechaVisita='$fecha') ac on ac.Idcliente=cl.Id_cliente and ac.Idusuario=usu.Id_ruta
					left join (select usu.Id_usuario, usu.nombre,COUNT(usu.nombre) obj_cliente
								from usuario usu
								inner join cliente cl on cl.Id_ruta=usu.Id_usuario
								where cl.$dia='1'
								group by usu.Id_usuario, usu.nombre) ob on ob.Id_usuario=usu.Id_usuario
					left join (select usu.nombre, COUNT(usu.nombre) sum_visitadas
								from (select usu.nombre, case when obj.RazonSocial is not null then '1' end visitadas
										from usuario usu
										inner join actividad ac on ac.Idusuario=usu.Id_usuario
										inner join cliente cl on cl.Id_cliente=ac.Idcliente
										left join (select cl.RazonSocial 
													from usuario usu
													inner join cliente cl on cl.Id_ruta=usu.Id_usuario
													where cl.$dia='1') obj on obj.RazonSocial=cl.RazonSocial
										where  FechaVisita='$fecha' and usu.Id_tipouser=2) usu
								where usu.visitadas<>''
								group by usu.nombre) vis on vis.nombre=usu.nombre) c
			where c.Id_usuario<>0 and (c.$dia='1' or c.ejecucion='1') and c.Id_tipouser='2' and c.validar_ruta='1'";
	$sql = odbc_exec($conexion, $sql);
	if ($row = odbc_fetch_object($sql)) 
	{
		$res = $row->ejecucion;
	}

	$sql = "SELECT count(distinct usu.Id_usuario) ejecucion
			from usuario usu
			left join actividad ac on ac.Idusuario=usu.Id_usuario
			left join cliente c on c.Id_cliente=ac.Idcliente
			left join (select * from usuario where Id_tipouser='2') pr on pr.Id_usuario=c.Id_ruta
			where usu.Id_tipouser='3' and ac.FechaVisita='$fecha'";
	$sql = odbc_exec($conexion, $sql);
	if ($row = odbc_fetch_object($sql)) 
	{
		$res = $row->ejecucion+$res;
	}
	return $res;
}
//*++++++++++++++++++INDEX+++++++++++++++//
//*++++++++++++++++++INCIDENCIAS+++++++++++++++//
function incidencias($conexion, $fecha)
{
	$tipo_inci = tipo_incidencia($conexion);
	$inci = "";
	$inci2 = "";
	for ($i=0; $i < count($tipo_inci); $i++) 
	{	
		$inci2 = $inci2."<option value='".$tipo_inci[$i]['id']."'>".$tipo_inci[$i]['nombre']."</option>";
	}

	$cont = 0;
	$sql = "SELECT distinct usu.Id_usuario, usu.nombre, usu.us_apellidos ciudad, usu.ruta imei, usu.us_telefono telefono, usu.id_tipouser, '0' as ejecucion
			FROM usuario usu 
			WHERE usu.Id_usuario not in (select idusuario from actividad WHERE FechaVisita='$fecha') and usu.id_usuario not in ('100', '101', '37') and usu.id_tipouser='2'";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$inci = "";
		$sql_inci = "SELECT comentario, codigoinci from incidencia where fecha='$fecha' and id_usuario='$row->Id_usuario'";
		$sql_inci = odbc_exec($conexion, $sql_inci);
		if ($row_inci = odbc_fetch_object($sql_inci)) 
		{
			$res[$cont]['comentario'] = $row_inci->comentario;
			//Mostrar el numero de codigoinci selecionado
			for ($i=0; $i < count($tipo_inci); $i++) 
			{	
				if($row_inci->codigoinci == $tipo_inci[$i]['id'])
				{
					$inci = $inci."<option value='".$tipo_inci[$i]['id']."' selected>".$tipo_inci[$i]['nombre']."</option>";
				}
				else
				{
					$inci = $inci."<option value='".$tipo_inci[$i]['id']."'>".$tipo_inci[$i]['nombre']."</option>";
				}
			}
			$res[$cont]['inci'] = $inci;
			$res[$cont]['boton'] = "success";
		}
		else
		{
			$res[$cont]['comentario'] = "";
			$res[$cont]['inci'] = $inci2;
			$res[$cont]['boton'] = "danger";
		}
		$res[$cont]['nombre'] = $row->nombre;
		$res[$cont]['id_usuario'] = $row->Id_usuario;
		$res[$cont]['ciudad'] = $row->ciudad;
		$res[$cont]['telefono'] = $row->telefono;
		$res[$cont]['imei'] = $row->imei;		
		$cont++;
	}
	return $res;
}

function tipo_incidencia($conexion)
{
	$cont = 0;
	$sql = "SELECT * FROM tipo_incidencia";
	$sql = odbc_exec($conexion, $sql);
	while ($row = odbc_fetch_object($sql)) 
	{
		$res[$cont]['id'] = $row->id;
		$res[$cont]['nombre'] = utf8_encode($row->nombre);
		$cont++;
	}
	return $res;
}
//*++++++++++++++++++INCIDENCIAS+++++++++++++++//

/*
 * Funciones adicionales
 */

function getAvance($fecha,$fecha_fin){
    include "../conexion/conexion.php";
    $query="Select
                us.nombre_completo,
                us.us_apellidos,
                ruta.FechaVisita,
                Count(ruta.idcliente) As clientes,
    us.Id_usuario
            From
                dbrutaverde.dbo.rutav ruta Inner Join
                dbrutaverde.dbo.usuario us On ruta.id_ruta = us.Id_usuario
            Where
                CONVERT (date, ruta.FechaVisita, 103) Between '$fecha' And '$fecha_fin'
            Group By
                us.nombre_completo,
                us.us_apellidos,
                ruta.FechaVisita,
                us.Id_usuario Order by us.Id_usuario";
    $result=odbc_exec($conexion,$query);
    $response=array();
    $i=0;
    while($row=odbc_fetch_object($result))
    {
        $query1="select Idcliente,FechaVisita from actividad where convert(date,FechaVisita,23) = '$row->FechaVisita' and Idusuario='$row->Id_usuario'";
       // echo "q1:".$query1;
        $result1=odbc_exec($conexion,$query1);
        $plan=0;
        $noplan=0;
        while($row1=odbc_fetch_object($result1)){
            $query2="select * from rutav where convert(date,FechaVisita,103)= '$row1->FechaVisita' and idcliente='$row1->Idcliente'";
           // echo "q2:".$query2;
            $result2=odbc_exec($conexion,$query2);
            if(odbc_num_rows($result2)>0 ){
                $plan++;
            }
            else{
                $noplan++;
            }
        }
        $response[$i]['nombre']=$row->nombre_completo;
        $response[$i]['ciudad']=$row->us_apellidos;
        $response[$i]['fecha']=$row->FechaVisita;
        $response[$i]['objetivo']=$row->clientes;
        $response[$i]['plan']=$plan;
        $response[$i]['noplan']=$noplan;
        if($noplan>0)
        {
            if($plan>0){
                $response[$i]['cumple']='Par';
            }
            else{
                 $response[$i]['cumple']='No';
            }
        }
        else if($plan>0){
             $response[$i]['cumple']='Si';
        }
        else
        {   
            $response[$i]['cumple']='No';
        }
        $i++;
    }
    return $response;
}
?>