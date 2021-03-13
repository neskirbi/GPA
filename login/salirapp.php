<?php
//require("coneccion/conect.php");

//$id = decrypt($_COOKIE['ref']);

//$sql =mysql_query("UPDATE registrados SET conectado = '0' WHERE id = '$id'  ", $link);

setcookie("ref","",time()-86400,"/"); 
setcookie("login","",time()-86400,"/"); 
 

?>
<center>
  <script>alert('Sesion Finalizada');</script>
</center>
<?php
header("location:loginuserapp.php");
?>
