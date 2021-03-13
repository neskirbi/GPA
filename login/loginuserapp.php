<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/cssapp.css">
    <title>Document</title>
    <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   
</head>
<body>
    
<?php



//include("34534fgf445/encrip.php");
        
if(isset($_COOKIE["login"]))
{    
$cook = $_COOKIE["login"];
$ref1 = $_COOKIE["ref"];
//$decook = decrypt($cook);
//$decook2 = decrypt($ref1);
$decook = ($cook);
$decook2 = ($ref1);
header("location:../principalapp.php");



    }else
    {

?>




        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="../imagenes/gp.png" />
            <p id="profile-name" class="profile-name-card"></p>
            
            <form  name="form1"  action="contraseniaapp.php" method="post"">
                <span id="reauth-email" ></span>
                <input  type="text" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus name="usuario">
                <br>
                <br>
                <input  type="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a" required name="contrasenia">
                <div id="remember" class="checkbox">
                    <!--<label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>-->
                </div>
                <br>
                <button class="boton1" name="enviar" type="submit">Iniciar Sesi&oacute;n</button>
            </form>
        </div>
    



<?php

}

?>





</body>
</html>





