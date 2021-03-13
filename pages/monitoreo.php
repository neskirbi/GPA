<?php
date_default_timezone_set('America/Mexico_City');
error_reporting(E_ALL);
ini_set('display_errors', '1');
 $user=$_COOKIE["login"];

include"../conexion/conexion.php";
include "../funciones/consultaKua.php";
$dias=array(1=>'cl_L',2=>'cl_M',3=>'cl_W',4=>'cl_J',5=>'cl_V',6=>'cl_S',7=>'cl_D');

function objetivo($fecha,$fecha2,$id)
{
	
	
    global $dias;
    global $conexion;
    $diasac=array();
    $fechares=$fecha;
    if ($fecha==$fecha2) {
    	$dia=$dias[date('N',strtotime($fechares))];

	    $consulta="SELECT count(Id_cliente) as objetivo from cliente where $dia='1' and Id_ruta='$id'";

	    $sql=odbc_exec($conexion, $consulta);
	    $sql=odbc_fetch_array($sql);

	    $res=$sql['objetivo'];
    }else{
    	while ($fechares!=$fecha2) { 

		    $dia=$dias[date('N',strtotime($fechares))];
			
		    $consulta="SELECT count(Id_cliente) as objetivo from cliente where $dia='1' and Id_ruta='$id'";

		    $sql=odbc_exec($conexion, $consulta);
		    $sql=odbc_fetch_array($sql);

		    $diasac[]=$sql['objetivo'];
		    $fechares=strtotime ( '+1day' , strtotime ( $fechares ) ) ;
		    $fechares=date('Y-n-d',$fechares);
	    }
	    $res=array_sum($diasac);
    }
    
    
    return $res;
}



$fecha=$_REQUEST['fecha'];
$fecha2=$_REQUEST['fecha2'];

?>

<table class="table table-bordered table-striped" id="tablaAvance" name="tablaAvance">
    <thead>
        <tr>
            <th rowspan="2" style="text-align:center">Operador</th>
            <th rowspan="2" style="text-align:center">Ciudad</th>
            <th rowspan="2" style="text-align:center">Fecha</th>
            <th rowspan="2" style="text-align:center">Cumple plan</th>
            <th colspan="3" style="text-align:center">Tiendas</th>
        </tr>
        <tr >
            <th style="text-align:center;">Objetivo</th>
            <th style="text-align:center">En plan</th>
            <th style="text-align:center">Fuera de plan</th>
        </tr>
    </thead>
    <tbody>
        <?php
           $array=array();
           $array=getAvance($fecha,$fecha2);
           for($i=0;$i<count($array);$i++){
               if($array[$i]['cumple']=='No'){
                   $mod=" class='btn btn-danger btn-sm'";
               }
               else if($array[$i]['cumple']=='Par'){
                   $mod=" class='btn btn-warning btn-sm'";
               }
               else{
                   $mod=" class='btn btn-success btn-sm'";
               }
               echo "<tr><td >".$array[$i]['nombre']."</td>";
               echo "<td >".$array[$i]['ciudad']."</td>";
               echo "<td align='center'>".$array[$i]['fecha']."</td>";
               echo "<td align='center'><button $mod>".$array[$i]['cumple']."</button></td>";
               echo "<td align='center'>".$array[$i]['objetivo']."</td>";
               echo "<td align='center'> ".$array[$i]['plan']."</td>";
               echo "<td align='center'>".$array[$i]['noplan']."</td></tr>";
           }
        ?>
    </tbody>
</table>
