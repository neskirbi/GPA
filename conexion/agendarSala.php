<?php
include "conexion.php";

$id=filter_input(INPUT_POST,'id');
$fecha=filter_input(INPUT_POST,'fecha');
$hora=filter_input(INPUT_POST,'hora');
$tipoConf= filter_input(INPUT_POST, 'tipoCon');

$queryGrupo="SELECT dni from usuario where Id_usuario='$id'";

$result=odbc_exec($conexion, $queryGrupo);
while(odbc_fetch_row($result))
{
    $dni= odbc_result($result,1);
}
$date=date_create($fecha);
$fFecha=date_format($date,"Y/m/d");
$query="UPDATE usuario SET cfecha='$fFecha', chora='$hora', tipocon='$tipoConf', telefono='1' WHERE dni='$dni' ";

$fFecha=date_format($date,"d/m/Y");


$to = "noemi.ruiz@promo-tecnicas.com";
$subject = "Agendar Sala Virtual";
$txt = "<html><head></head><body><p>Hola Noemi! Favor de agendar sala virtual el dia ".$fFecha." a las ".$hora."</p><a href='http://cbd.mine.nu/alen/pages/envioLink.php?dni=$dni&tipoConf=$tipoConf'>CLICK AQUI PARA GUARDAR</a></body></html>";


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: javier.trinidad@promo-tecnicas.com";
mail($to,$subject,$txt,$headers);

if(odbc_exec($conexion,$query))
{
    echo "agendada";
}
else
{
    echo "no agendada";
}