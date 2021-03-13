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
	
	odbc_close($conexion);
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
	odbc_close($conexion);
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

	odbc_close($conexion);
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

	odbc_close($conexion);
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

	odbc_close($conexion);
	return $resultado;
}

function consultar_perfil_promotor1($fecha, $usu, $pass)
{
	//include "../conexion/conexionbit.php";
	include "../conexion/conexion.php";
	$cont = 0;
	$resultado = array();
	$sql = "SELECT nombre, imei, apellidos, puesto, nickname, foto, ciudad, telefono, equipo
			from usuario
			where id_usuario in (select c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu' and u.pass='$pass')";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$resultado[$cont]["nombre"] = $row->nombre;
		$resultado[$cont]["apellidos"] = $row->apellidos;
		$resultado[$cont]["puesto"] = $row->puesto;
		$resultado[$cont]["nickname"] = $row->nickname;
		$resultado[$cont]["foto"] = $row->foto;
		$resultado[$cont]["ciudad"] = $row->ciudad;
		$resultado[$cont]["telefono"] = $row->telefono;
		$resultado[$cont]["equipo"] = $row->equipo;
		$sqlgps = "SELECT imei, lat FROM Gps2 WHERE fecha='$fecha' and imei='$row->imei' and lat!='0' ORDER BY id DESC";
		$sqlgps = odbc_exec($conexion, $sqlgps);
		if($rowgps = odbc_fetch_object($sqlgps))
		{
			if($rowgps->lat == 0)
			{
				$resultado[$cont]["conectado"] = "Apagado";
			}
			else
			{
				$resultado[$cont]["conectado"] = "En linea";
			}
		}
		else
		{
			$sqlgps = "SELECT imei, lat FROM Gps WHERE fecha='$fecha' and imei='$row->imei' and lat!='0' ORDER BY id DESC";
			$sqlgps = odbc_exec($conexion, $sqlgps);
			if($rowgps = odbc_fetch_object($sqlgps))
			{
				if($rowgps->lat == 0)
				{
					$resultado[$cont]["conectado"] = "Apagado";
				}
				else
				{
					$resultado[$cont]["conectado"] = "En linea";
				}
			}
			else
			{
				$resultado[$cont]["conectado"] = "Apagado";
			}
		}
		$cont++;
	}

	odbc_close($conexion);
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

	odbc_close($conexion);
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

	odbc_close($conexion);
	return $resultado;
}

function consultar_dato_personal($nickname, $fecha)
{
	include "../conexion/conexion.php";
	$cont = 0;
	$sql = "SELECT * FROM usuario WHERE nickname='$nickname'";
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
	else
	{
		$sql = "SELECT lat, lon FROM Gps2 where imei='$imei' and fecha='$fecha' and lat!='0' order by id desc";
		$sql = odbc_exec($conexion, $sql);
		if($row = odbc_fetch_object($sql))
		{
			$resultado[$cont]["ubicacion"] = "Lat: ".($row->lat).", Lon: ".($row->lon);
		}	
	}
	odbc_close($conexion);
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

	odbc_close($conexion);
	return $resultado;
}

function obtener_usuario($usu, $conexion)
{
	//include "conexion/conexion.php";
	$resultado = array();
	$cont = 0;
	$sql = "SELECT pass, foto from usuario where nickname='$usu'";
	$sql = odbc_exec($conexion, $sql);
	if($row = odbc_fetch_object($sql))
	{	
		$resultado[$cont]['pass'] = $row->pass;
		$resultado[$cont]['foto'] = $row->foto;
	}

	odbc_close($conexion);
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

	odbc_close($conexion);
	return $resultado;
}

function equipos_conectados($fecha, $usu, $pass)
{
	//include "../conexion/conexionbit.php";
	include "conexion/conexion.php";

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
		$sqlgps = "SELECT DISTINCT imei FROM Gps2 WHERE fecha='$fecha' and imei='$imei'";
		$sqlgps = odbc_exec($conexion, $sqlgps);
		if($rowgps = odbc_fetch_object($sqlgps))
		{	
			$resultado++;
		}
		else
		{
			$sqlgps = "SELECT DISTINCT imei FROM Gps WHERE fecha='$fecha' and imei='$imei'";
			$sqlgps = odbc_exec($conexion, $sqlgps);
			if($rowgps = odbc_fetch_object($sqlgps))
			{	
				$resultado++;
			}	
		}
	}

	odbc_close($conexion);
	return $resultado;	
}

function consultar_perfil_promotor($fecha, $usu, $pass)
{
	//include "conexion/conexionbit.php";
	include "conexion/conexion.php";
	$cont = 0;
	$resultado = array();
	$sql = "SELECT nombre, imei, foto
			from usuario
			where id_usuario in (select c.contacto
			from usuario u
			join contactos c on c.id_usuario=u.id_usuario
			where u.nickname='$usu')";
	$sql = odbc_exec($conexion, $sql);
	while($row = odbc_fetch_object($sql))
	{	
		$resultado[$cont]["nombre"] = $row->nombre;
		$resultado[$cont]["foto"] = $row->foto;
		$sqlgps = "SELECT imei FROM Gps2 WHERE fecha='$fecha' and imei='$row->imei'";
		$sqlgps = odbc_exec($conexion, $sqlgps);
		if(odbc_fetch_object($sqlgps))
		{
			$resultado[$cont]["conectado"] = "En linea";
			/*while($rowgps = odbc_fetch_object($sqlgps))
			{	
				if($rowgps->imei == $row->imei)
				{
					$resultado[$cont]["conectado"] = "En linea";
				}
				else
				{
					$resultado[$cont]["conectado"] = "Apagado";
				}
			}*/
		}
		else
		{
			$sqlgps = "SELECT imei FROM Gps WHERE fecha='$fecha' and imei='$row->imei'";
			$sqlgps = odbc_exec($conexion, $sqlgps);
			if(odbc_fetch_object($sqlgps))
			{
				$resultado[$cont]["conectado"] = "En linea";
			}
			else
			{
				$resultado[$cont]["conectado"] = "Apagado";
			}
		}
		$cont++;
	}

	odbc_close($conexion);
	return $resultado;
}
//*++++++++++++++++++INDEX+++++++++++++++//

?>