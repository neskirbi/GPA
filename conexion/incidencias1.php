<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">    
 
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  
  <link rel="stylesheet" type="text/css" href="../css/bootstrap2.css">
  <link rel="stylesheet" type="text/css" href="../css/cssapp.css">
  <script src="../js/funcionesjs.js"></script>
  <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <!--<script>setTimeout('document.location.reload()',10000); </script>-->
  <style type="text/css">
  body
{
      background-color: #760000;
}
  .areat{

    width: 100%;
  
  }


</style>


  <?php
  
      ini_set('memory_limit', '1024M');
      ini_set('max_execution_time', 300);
      include("../reporteweb/funciones.php");
     

    if(isset($_POST['fecha']))
    {
      $fecha=$_POST['fecha'];
      //$ruta=$_POST['ruta'];
      $fechd=date("N", strtotime($fecha)); 
      $fechdi=date("d", strtotime($fecha));
      $fechm=date("n", strtotime($fecha)); 
      $fechaa=date("Y", strtotime($fecha)); 
      }else{
      //$ruta=$_COOKIE['dni'];
      $fecha=date("Y-m-d");
      $fechd=date("N");
      $fechdi=date("d");
      $fechm=date("n");
      $fechaa=date("Y");
    }

  ?>

  <title>Fecha: <?=$fecha?></title>
  <?php
    require("../conexion/conexion.php");
    include("../scripts/textoalt.php");
    $total1=0;
    $total2=0;
    $total3=0;

    $_dias=array (1 => "Lunes",2 => "Martes",3 => "Miercoles",4 => "Jueves",5 => "Viernes",6 => "Sabado",7 => "Domingo");

    $_meses=array (1 => "Enero",2 => "Febrero",3 => "Marzo",4 => "Abril",5 => "Mayo",6 => "Junio",7 => "Julio",8 => "Agosto",9 => "Septiembre",10 => "Octubre",11 => "Noviembre",12 => "Diciembre");


    //Formatenado fecha de consulata
    $fechaactvidad[0]=$_dias[$fechd];
    $fechaactvidad[1]=$fechdi;
    $fechaactvidad[2]=$_meses[$fechm];
    $fechaactvidad[3]=$fechaa;
  ?>

</head>
<body>

<!--Div de la grafica, descomentar para ver la grafica-->
<!--<div id="myfirstchart" style="height: 220px; width: 60%;  margin: 5px 10% 0px 10%;" ></div>-->
<center>
<table class="titu" border="0"  cellpadding="5" cellspacing="0" style=" text-align: center; ">
<tr><td style=" color: #fff">Incidencias del <?php echo $fechaactvidad[0]." ".$fechaactvidad[1]." de ".$fechaactvidad[2]." del ".$fechaactvidad[3];?></td></tr>
</table>



<table border="1"  style=" background-color: #fff; " class="table table-responsive table-hover table-striped tamano_letra tablas" cellpadding="0" cellspacing="0">

<tr class="subtotal" style="background:#000; color:#000;">

<th> # </th>
<th> Ruta </th>
<th> Nombre </th>

<th> Ciudad </th>
<th> Tel&eacute;fono </th>
<th> Monitoreo </th>

<th> Comentario </th>
<th> Opci&oacute;n </th>
<th> </th>
</tr>




<?php

$numera=1;
$contusu=0;
$contdes=0;

$sqlnom ="SELECT  *  FROM usuario WHERE  acceso=2 order by idusuario asc ";
$idnom = odbc_exec($conexion, $sqlnom);
b:
while ($row = odbc_fetch_object($idnom))
{               
$contusu++;

$objdia = "SELECT count($_dias[$fechd])as objdia FROM cliente WHERE $_dias[$fechd]=1 and RutaVenta=($row->idusuario)";
$objdia = odbc_exec($conexion, $objdia);
$objdia = odbc_fetch_object($objdia);

if ($objdia->objdia==0) {
  
  $contdes++;
  goto b;
}


$actual = "SELECT  count(idusuario)as activ  FROM actividad WHERE idusuario=($row->idusuario) AND FechaVisita='$fecha'";
$actual = odbc_exec($conexion,$actual);
$actual = odbc_fetch_object($actual);


$style=(($row->idusuario)%2);



if (empty($actual->activ)) {

$dni = "SELECT * FROM supervisor WHERE Ruta='$row->dni' ";
$dni = odbc_exec($conexion, $dni);
$dni = odbc_fetch_object($dni);
$monitoreo=@$dni->Monitoreo;

if ($monitoreo!='') {
  echo "<tr class='fil$style' >
  <td class='cel1'> $numera</td>
  <td> ".$row->idusuario."</td>
  <td> ".$row->nombre."</td>
  <td>$row->apellidos</td>
  <td>$row->telefono</td>
  <td>".$monitoreo." </td> 

  ";



$timee=json_encode($fecha);
$nombre=json_encode(utf8_encode($row->nombre));
$dni=json_encode(utf8_encode($row->dni));

@$monitor=utf8_encode($dni->Monitoreo);
$consul=$row->idusuario."<>".$fecha;


$conten="SELECT * FROM incidencia WHERE idincidencia='$consul'";
$conten=odbc_exec($conexion,$conten);
$conten=odbc_fetch_object($conten);


    @$textarea="<textarea class='areat' id='ta$numera' rows='1.6'  >$conten->comentario</textarea>";
    @$boton="<input type='button' value='Ok' onclick='insertinci($row->idusuario,$row->telefono,$timee,$numera,$dni)'>";
    $select='';

    $select="<select id='sel$numera'>
      <option>Seleccionar</option>
      <option>Nulo</option>      
      <option>Vacaciones</option>        
      <option>Baja</option>
      <option>Incapacidad</option>
      <option>Permiso</option>
      <option>Robo</option>
      <option>Daño</option>
      <option>Extravio</option>
      <option>Incidencias</option>
      <option>Trabajo sin aplicacion</option>
      
     </select>";
      

  
echo"<td >".$textarea."
<input type'text' id='in$numera' value='".@$monitoreo."' style='display:none;'></td>
<td>
$select
</td>
<td>".$boton."</td>
</tr>";



$numera++;
$objtag2=0;

a:
}

}
unset($_objtag);

unset($_objdia1);

 }


?>


</table>
<br><br><br><br><br>
</center>









</body>
</html>