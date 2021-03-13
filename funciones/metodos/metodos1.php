<?php
//Solofunciones de php
//date_default_timezone_set('America/Mexico_City');

function dias(){
  $_dias=array (1 => "cl_L",2 => "cl_M",3 => "cl_W",4 => "cl_J",5 => "cl_V",6 => "cl_S",7 => "cl_D");
  return $_dias;
}

function meses(){
  $_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");
  return $_meses;
}

function dias_sem(){
  $_dias=array (1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado",7 => "Domingo");
  return $_dias;
}

function semana_nom($dia){
  $_dias=array (1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado",7 => "Domingo");
  return $_dias[$dia];
}

function meses_nom($mes){
  $_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");
  return $_meses[$mes];
}

function clientes_hoy($fecha,$usuario,$conexion)
{
  $_clientes=array();
  $_dias=dias();
  $fecha_comp=explode("-" ,$fecha);
  
  $num_dia=date("N", strtotime($fecha));
  
    $sql1="SELECT Id_cliente FROM cliente where ".$_dias[$num_dia]."='1' and Id_ruta='".$usuario."'  order by cl_razonsocial";
    $sql1=odbc_exec($conexion, $sql1);
    while($sql1_obj=odbc_fetch_object($sql1))
    {
      $_clientes[]=utf8_encode($sql1_obj->Id_cliente);
      
    }
    
    
return $_clientes;
}

function incidencia($fecha,$usuario,$conexion)
{
  $com="";
  $inci= "SELECT ruta,comentario,codigoinci FROM incidencia WHERE fecha='".$fecha."' and ruta='".$usuario."'";
  $inci = odbc_exec($conexion, $inci);
  $inci1 = odbc_fetch_object($inci);
  $inci = odbc_num_rows($inci);

  
  if ($inci==1) {
  $com=$inci1->comentario;                 
  }
  return $com;
}



function ids_cliente_visita($fecha,$usuario,$conexion)
{
   $_visitas=array();
   
  $sql="SELECT Idcliente from actividad where FechaVisita='".$fecha."' and Idusuario='".$usuario."' order by entrada asc";
  $sql=odbc_exec($conexion, $sql);
  while($sql_datos=odbc_fetch_object($sql))
  {
      $_visitas[]=utf8_encode($sql_datos->Idcliente);

  }
  return $_visitas;
}


function id_visitas_hoy($fecha,$usuario,$conexion)
{
   $_visitas=array();
   
  $sql="SELECT Id_actividad from actividad where FechaVisita='".$fecha."' and Idusuario='".$usuario."' order by entrada asc";
  $sql=odbc_exec($conexion, $sql);
  while($sql_datos=odbc_fetch_object($sql))
  {
      $_visitas[]=utf8_encode($sql_datos->Id_actividad);
  }
  return $_visitas;
    

}

function Detalle($id_actividad,$conexion)
{
  
   $tab_detalle=array();
   $sql="select * from actividad where Id_actividad='".$id_actividad."' order by ac_entrada asc";
  $sql=odbc_exec($conexion, $sql);
  while($sql_datos=odbc_fetch_object($sql))
  {
    $cliente="select * from cliente where Id_cliente='".$sql_datos->Id_cliente."'";
    $cliente=odbc_exec($conexion, $cliente);
    $cliente_datos=odbc_fetch_object($cliente);

    @$sqln = "SELECT nombre FROM Ntiendas WHERE cl_entrecalle='$cliente_datos->cl_entrecalle'";
    $sqln = odbc_exec($conexion, $sqln);
    $sqln = odbc_fetch_object($sqln);




    $tab_detalle[0]=$sql_datos->ac_fechavisita;
    @$tab_detalle[1]=utf8_encode($cliente_datos->cl_razonsocial);
    $tab_detalle[2]=$sql_datos->ac_entrada;
    $tab_detalle[3]=$sql_datos->ac_salida;
    $tab_detalle[4]=restatime($sql_datos->ac_salida,$sql_datos->ac_entrada);
    @$tab_detalle[5]=utf8_encode($sqln->nombre);
    
    

  }
  
  return $tab_detalle;
}

function horas_sum($arre)
{
  $tsuma="00:00:00";

  for ($i=0; $i <count($arre) ; $i++) 
  { 
    if ($arre[$i]!='0' ) 
    {
      $tsuma=sumatime($tsuma,$arre[$i]);
    }else
    {
      $tsuma=sumatime($tsuma,"00:00:00");     
  }
    }
    
    return $tsuma;
} 

function cliente_nombres($id_cliente,$conexion)
{
  $_cliente=array();
  for($i=0;$i<count($id_cliente);$i++)
  {
  $cliente="select cl_razonsocial from cliente where Id_cliente='".$id_cliente[$i]."'";
    $cliente=odbc_exec($conexion, $cliente);
    $cliente_datos=odbc_fetch_object($cliente);
    @$_cliente[]=utf8_encode($cliente_datos->cl_razonsocial);
  }
  return $_cliente;
}
function tip_inci($usu,$fecha,$conexion){

  

      $inci="";
      $sql="SELECT codigoinci from incidencia where ruta='$usu' and fecha='$fecha'";
      $sql=odbc_exec($conexion, $sql);
      $sql=odbc_fetch_object($sql);
    
      switch (@$sql->codigoinci) {
    
        case '1':
        $inci="Vacaciones";
        
        break;
  
         case '2':
         $inci='Baja';
         
         break;
         case '3':
         $inci="Incapacidad";
         
         break;
         case '4':
         $inci="Permiso";
         
         break;
         case '5':
         $inci="Falta";
         
         break;
         case '6':
         $inci="Robo";
         
         break;
         case '7':
         $inci="Daño";
         
         break;
         case '8':
         $inci="Extravio";
         
         break;
         case '9':
         $inci="Incidencias";
         
         break;
         case '10':
         $inci="Trabajo sin aplicacion";
         
        break;

        case '11':
         $inci="Eqsinrecup";
         
        break;

        case '12':
         $inci="PromSinEquipo";
         
        break;

        case '13':
         $inci="Vacante";
         
        break;
    
  
}

return $inci;
}


function dia_hoy2($fecha){

  $fechd=date("N",strtotime ( $fecha ) );
  $_dias=dias_sem();
  
  return $_dias[$fechd];
}



function dnis($usu,$conexion)
{
  
  $sql="SELECT  *  FROM Supervisor WHERE Gerencia='$usu' or Ejecutivo='$usu' or Monitoreo='$usu' or Nombre='$usu' or susu='$usu'  or susu1='$usu'  or susu2='$usu' order by Ruta asc ";
  $sql=odbc_exec($conexion, $sql);
  return $sql;
}

function inci_prom($id,$fecha,$conexion)
{
  
  $sql="SELECT  count(Ruta) as rut  FROM incidencia WHERE ruta='$id' and fecha='$fecha'";
  $sql=odbc_exec($conexion, $sql);
  $sql=odbc_fetch_object($sql);
  return $sql->rut;
}


function sumatime($hora1,$hora2)
{

$hora1=explode(':',$hora1);
$hora2=explode(':',$hora2);

  if (($hora1[2]+$hora2[2])>59) {
     
     
     $hora1[1]=sprintf("%02d",$hora1[1]+$hora2[1]+($hora1[2]+$hora2[2])/60);
     
      $hora1[2]=sprintf("%02d",($hora1[2]+$hora2[2])%60);
     
  
  if ($hora1[1]>59) {
     $hora1[0]=sprintf("%02d",$hora1[0]+$hora2[0]+($hora1[1]/60));
    
    $hora1[1]=sprintf("%02d",($hora1[1])%60);
        
  }
  else{

      $hora1[0]=sprintf("%02d",$hora1[0]+$hora2[0]);

  }
   
  }else{
    $hora1[2]=sprintf("%02d",$hora1[2]+$hora2[2]);
    $hora1[1]=sprintf("%02d",$hora1[1]+$hora2[1]); 
    if ($hora1[1]>59)
    {
   $hora1[0]=sprintf("%02d",$hora1[0]+$hora2[0]+($hora1[1]/60));
    
   $hora1[1]=sprintf("%02d",($hora1[1])%60);
       
  }else{

      $hora1[0]=sprintf("%02d",$hora1[0]+$hora2[0]);

  }

  }


return implode(":",$hora1);
}


function fotos_actividad($id_actividad,$conexion)
{
  $fotos=array();
  $img = "SELECT  jtia.Id_clavefoto,fot.fo_nomfoto from  jtia as jtia join fotos as fot on fot.Id_clavefoto=jtia.Id_clavefoto where   jtia.Id_actividad='$id_actividad'  ";
  $img = odbc_exec($conexion, $img);  
  while($img1 = odbc_fetch_object($img))
  {  
    $fotos[]=$img1->fo_nomfoto;  
  }
  return $fotos;
}

function formatea_fecha($fecha)
{
  $_dias=dias_sem();
  $_meses=meses();
  $fecha_string=$_dias[date("N", strtotime($fecha))]." ".date("d", strtotime($fecha))." de ".$_meses[date("n", strtotime($fecha))]." del ".date("Y", strtotime($fecha));
  return $fecha_string;
}

function divhoras($hora,$entre)
{
  $reshor=0;
  $resmin=0;

  $hora;
  if ($entre==0) 
  {
    $res="00:00:00";
    goto a;
  }



  $hora=explode(':',$hora);
  //echo("<br>");
  if ($hora[0]%$entre>0) 
  {
    $reshor=((($hora[0]%$entre)/$entre)*60);
  }
  if ($hora[1]%$entre>0) {
    $resmin=((($hora[1]%$entre)/$entre)*60);
  }
  $hora[0]=sprintf("%02d",($hora[0]/$entre));
  //echo("<br>");
   $hora[1]=sprintf("%02d",($hora[1]/$entre)+$reshor);
  //echo("<br>");
   $hora[2]=sprintf("%02d",($hora[2]/$entre)+$resmin);
  //echo("<br>");
  //echo implode(':',$hora);
  $res=implode(':',$hora);
  a:
  return $res;
}


function letra($numero)
{
    $letra="";
    $abc2 = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $l1=0;
    $l2=0;


    for ($i2=0; $i2 < $numero+1 ; $i2++) { 
                    
        //echo "<br>"."r".$i2;

        if($l2>26){
            $l2=1;
            $l1++;
        }
        if($l1>26){
            $l1=1;
            
        }
        $letra=$abc2[$l1].$abc2[$l2];
        $l2++;

    }
    return $letra;
}

function ciudades($conexion)
{
  $ciudades=array();
  $sql="SELECT distinct cl_ciudad from clientev order by cl_ciudad asc";
  $sql=odbc_exec($conexion, $sql);
  while ($sql1=odbc_fetch_object($sql))
  {
    $ciudades[]=$sql1->cl_ciudad;
  }
  return $ciudades;
}

function idcliente_actividad_solouno($conexion,$fecha1,$fecha2)
{
  $idclientes=array();
  
  $sql="SELECT  distinct Id_cliente from actividad where ac_fechavisita>='".$fecha1."' and ac_fechavisita<='".$fecha2."' ";
  $sql=odbc_exec($conexion, $sql);
  while ($sql1=odbc_fetch_object($sql))
  {
    $idclientes[]=$sql1->Id_cliente;
    
  }
  
  
  return $idclientes;
}

function clientesycadena($conexion)
{
  $idclientes=array();
  $cadenas=cadenas($conexion);
  $cadena=array();
  
  for($i=0;$i<count($cadenas);$i++)
  {
    $sql="SELECT Id_cliente from cliente where cl_entrecalle='".$cadenas[$i]."' ";
    $sql=odbc_exec($conexion, $sql);
    while ($sql1=odbc_fetch_object($sql))
    {
      $idclientes[]=$sql1->Id_cliente;
      $cadena[]=$cadenas[$i];
      
    }
  }
  $todo[0]=$idclientes;
  $todo[1]=$cadena;
  return $todo;
}

function cadenas($conexion)
{
  $cadenas=array();
  
  $sql="SELECT  distinct cl_entrecalle from Ntiendas  ";
  $sql=odbc_exec($conexion, $sql);
  while ($sql1=odbc_fetch_object($sql))
  {
    $cadenas[]=$sql1->cl_entrecalle;
    
  }
  
  
  return $cadenas;
}


function clientes_visitas_hoy($fecha,$usuario,$conexion, $id_cliente)
{
  $_clientes=array();
  $_dias=dias();
  $fecha_comp=explode("-" ,$fecha);
  $fecha2=$fecha_comp[2]."/".$fecha_comp[1]."/".$fecha_comp[0];
  $num_dia=date("N", strtotime($fecha));
  $respuesta = false;

  $sql = "SELECT * from periodos where dia='".$fecha2."'";  
  $sql = odbc_exec($conexion, $sql);
  $cont = 1;
  //echo"<table border ='1px'>";
  while($sql_obj=odbc_fetch_object($sql))
  {
    $sql1 = "SELECT Id_cliente FROM cliente where ((cl_email='".$sql_obj->fbise."' or cl_email='".$sql_obj->fsem."' or cl_email='".$sql_obj->fmen."') and Id_fechainsert <'".$fecha."' and ".$_dias[$num_dia]."='1' and Id_ruta='".$usuario."' ) and Id_cliente='$id_cliente' order by cl_razonsocial";
    $sql1 = odbc_exec($conexion, $sql1);
    if($sql1_obj=odbc_fetch_object($sql1))
    {
      $respuesta = true;
    }
    else
    {
      $respuesta = false;
    }    
  }
//echo "</table>";
return $respuesta;
}



function getDia($fecha)
{
  $dia = null;
  $n_dia = date("N", strtotime($fecha));
  $dia_sql = array (1 => "L", 2 => "M", 3 => "W", 4 => "J", 5 => "V", 6 => "S", 7 => "D");
  $dia = "cl_".$dia_sql[$n_dia];
  return $dia;        
}

function restatime($hora_e,$hora_s)
{
  if ($hora_e==0) {
   $hora_e=$hora_s;
  }
  else if($hora_e==null)
  {
    return 0;
  }
  if ($hora_s==0) {
   $hora_s=$hora_e;
  }
  else if($hora_s==null)
  {
    return 0;
  }
  
  $hora1 = $hora_s;//Entrada
  $hora2 = $hora_e;//Salida

  $h_e = explode(":", $hora1);
  //echo("1<br>");
  $h_s = explode(":", $hora2);
  //echo("2<br>");

  if(empty($h_s[2]))
  {
    $h_s[2] = "00";
  }
  if(empty($h_e[2]))
  {
    $h_e[2] = "00";
  }

  //echo $h_s[2]." - ".$h_e[2].";";
  if($h_s[2]-$h_e[2] < 0)
  {
    if($h_s[0] > 0 or $h_s[1] > 0)
    {
      $h_s[2] = $h_s[2] + 60;
      if($h_s[1]-1>0)
      {
        $h_s[1] = $h_s[1] - 1;

      }else{

        $h_s[0] = $h_s[0] - 1;
        $h_s[1] = $h_s[1] + 59;
      }
    }
  }
  
  if(@$h_s[1]-@$h_e[1] < 0)
  {
    if($h_s[0] > 0)
    {
      $h_s[0] = $h_s[0] - 1;
      $h_s[1] = $h_s[1] + 60; 
    }
  }


  @$h_s[2] = sprintf("%02d",$h_s[2] - $h_e[2]);
  @$h_s[1] = sprintf("%02d",$h_s[1] - $h_e[1]);
  $h_s[0] = sprintf("%02d",(double)$h_s[0] - (double)$h_e[0]);

if ($h_s[0]<0) {
   $h_s = explode(":", $hora1);
    //(echo("1<br>");
    $h_e = explode(":", $hora2);
    //echo("cambio<br>");
    
}
$res=implode(":",$h_s);

 return $res;



  
}
?>