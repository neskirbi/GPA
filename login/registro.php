<link href="../Template.css" rel="stylesheet" type="text/css" />
<link href="login/script/formulario.css" type="text/css" rel="stylesheet" />
<script src="login/script/jquery.js" type="text/javascript" ></script>
<script src="login/script/script.js" type="text/javascript" /></script>


<?php

if(isset($_POST['Registro'])){
require("formulario.php");	
}


?>


<div id="errores">Debes de completar todos los campos</div>
<div id="contrass">Las contrase&ntilde;as no coinciden</div>   

</br></br>
<table>
<form action="" method="POST">
<tr><td width="250">
      <label for="usuario">Nombre de usuario*</label></td>
      <td width="250"><input type="text" class="campo" name="name" id="name" /></td>
</tr><tr><td>
      <label for="contrasenia">Contrase&ntilde;a*</label></br></td>
      <td><input type="password" class="campo" name="pass" id="pass" /></td>
</tr><tr><td>
      <label for="contrasenia2">Confirmar contrase&ntilde;a*</label></td>
      <td><input type="password" class="campo" name="pass2" id="pass2" /></td>
</tr><tr><td>
      E-mail  *</td>
      <td><input name="correo2" type="name" class="campo" id="correo2" value="" /></td>
</tr><tr><td height="20"></td></tr><tr><td></td><td>
      <input type="submit" name="Registro" id="guardarz" value="Registar" />
      <input type="reset" name="borrar" id="borrar" value="Borrar" /></td>

</tr>
</form></table>

</br></br>

