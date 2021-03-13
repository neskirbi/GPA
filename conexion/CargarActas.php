<?php
include "conexion.php";

$id=$_POST['id'];
$data=$_POST['data'];
$name=$_POST['name'];
$numero=$_POST['numero'];

$dir="../documents/";
if(!is_dir($dir)){
    mkdir($dir, 0777, true);
}


$base_to_php = explode(',', $data);
// El segundo item del array base_to_php contiene la información que necesitamos (base64 plano)
// y usar base64_decode para obtener la información binaria de la imagen
$data = base64_decode($base_to_php[1]);

// Proporciona una locación a la nueva imagen (con el nombre y formato especifico)
$filepath = $dir.$name; 

// Finalmente guarda la imágen en el directorio especificado y con la informacion dada
if(file_exists ($filepath)){
    echo "Error:el archivo ya existe.";
}else{
    if(file_put_contents($filepath, $data)){
        
        $query="SELECT actas from  usuarionom WHERE  Id_usuario='$id'";
	    $result=odbc_exec($conexion,$query);
        $row= odbc_fetch_object($result);
        $acta=json_decode($row->actas,true); 
        $acta[$numero]=$name;

        $query="UPDATE usuarionom SET actas='".json_encode($acta)."' WHERE  Id_usuario='$id'";
	    odbc_exec($conexion,$query);
        echo "ok";
    }else{
        echo "Error: al cargar el archivo.";
    }
}

?>

