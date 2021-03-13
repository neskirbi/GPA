<?php
include "conexion.php";
$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);
$imei= $data["imei"];
$fecha= $data["fecha"];
$hora= $data["hora"];
$lat= $data["lat"];
$lon= $data["lon"];
$otros= "'1','1'";
$bateria= $data["bateria"];
$query = "INSERT INTO Gps ( imei,fecha,hora,lat,lon,status,permisos,bateria) VALUES ('".$imei."','".$fecha."','".$hora."','".$lat."',".$lon.",".$otros.",'".$bateria."')";
odbc_exec($conexion, $query);
//echo $query;
echo json_encode("success");