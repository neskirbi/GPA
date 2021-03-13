<?php


$titulo="Código de activación ciudadwarez.com";
$mensaje="Bienvenido a Ciudad Warez \nGracias por registrarte\nTu código de activacion es: ".$codigo."\nClick en el enlace para ir a la página de activación http://www.ciudadwarez.com/cwregistro/confirma.php";
c:
if(mail($para, $titulo, $mensaje))
{

echo("<script>alert('Primero debe completar la activacion (Se ha reenviado un correo para completar la activacion)');</script>");

}else{goto c;}


?>
