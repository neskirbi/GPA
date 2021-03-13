<?php

function  convierteFecha($dia,$mes,$anio)
{
   $inicial=1900;
   //anio+=2000;//**
   $aniosTrans=$anio-$inicial;
   $diasAnio=[31,28,31,30,31,30,31,31,30,31,30,31];
   $lFecha=0; 
   $diasTrans=1;
   $iDiasB=(($aniosTrans/4));
   for ( $i = 0; $i < $mes; $i++) 
   $diasTrans=$diasTrans+$diasAnio[$i];

if ($anio%4 == 0 && $mes>2){
$diasTrans++;
$iDiasB--;}

$diasTrans=$diasTrans+$dia+$iDiasB;
$lFecha=(($aniosTrans)*365)+$diasTrans;
return $lFecha;
}

$fecahpart=explode('-','2016-06-15');

$fechaent=convierteFecha($fecahpart[2],$fecahpart[1],$fecahpart[0])-30;


include"coneccionacces.php";
echo $sqlnom ="SELECT  *  FROM Bitacora where  FechaR=$fechaent and Unidad='354149070647935' order by HoraR desc ";
$idnom = odbc_exec($conexionacc, $sqlnom);


$row = odbc_fetch_object($idnom);



echo"<br><br>IMEI:".$row->Unidad;
echo" hora:".$row->HoraR;
echo" Lat:".$row->Latitud;
echo" Lon:".$row->Longitud;


?>