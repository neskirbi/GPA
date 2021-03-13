<?php



include("login/34534fgf445/encrip.php");
		
if(isset($_COOKIE["login"]))
{	 
    $cook = $_COOKIE["login"];
    $ref1 = $_COOKIE["ref"];
    //$decook = decrypt($cook);
    //$decook2 = decrypt($ref1);
    $decook = ($cook);
    $decook2 = ($ref1);
    header("location:index.php");
}
else{
    header("location:pages/login/login.html");

}


?>
