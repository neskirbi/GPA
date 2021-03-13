<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <title>Document</title>

      <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>


<style type="text/css">
        .boton
        {
          font-size: 15px; 
          background-color: #FCC42B;
          border: none;
        }

      .boton:hover
      {
        background-color: #F9CE46;
      }
</style>




<body>

<?php
      
      include("../conexion/conexion.php");
include"../reporteweb/funciones.php";





echo"<table class='table table-hover table-striped' border=0 style='width: 50%; font-size:12px;'>
<tr class='subtotal'>
<td>Num</td>
<td>Razon<br>Social</td>
<td>Contacto</td>


</tr>


";

$cont=1;
$us ="SELECT * FROM supervisor";
$us = odbc_exec($conexion, $us);
while($us2 = odbc_fetch_object($us))

{
//890
      

echo"
<tr>
<td><font color='#000'>$cont</font></td>
<td>".json_encode($us2->Monitoreo)."</td>
<td><input type='text' name='$cont' id='2$cont' size='5' value='$us2->PassMon'></td>


</tr>

";    
$cont++;



}
echo"</table>";

?>

      <table><tr><td></td></tr></table>
</body>
</html>