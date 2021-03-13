<?php
$arreglo[]="hola".$est;
$arreglo[]="guapa";
$arreglo[]=";)";
print_r($arreglo);
echo"<br>";
$arreglo=implode(",",$arreglo);
echo $arreglo;


?>