<?php



function encrypt($string) {
	$key="ramira";
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}



function decrypt($string) {
	$key="ramira";
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}

function clavesuser($string1,$string2,$string3){
for($i=0;$i<=4;$i++)
{

$clave2.=$string2[$i];
$clave3.=$string3[$i];
}
$result=$string1.$clave2.$clave3;
return $result;


}



?>
