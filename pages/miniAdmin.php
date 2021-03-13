<?php
include '../conexion/conexion.php';
$query="SELECT cfecha,chora,dni FROM usuario WHERE cfecha!='' GROUP BY cfecha,chora,dni ";
$result= odbc_exec($conexion, $query);
echo "<html><header></header><body> <b>Citas Agendadas</b><br/>";
echo "<table border='1'><thead><th>DNI</th><th>Fecha</th><th>Hora</th><th>Borrar</th></thead><tbody>";
while($row= odbc_fetch_object($result))
{
    $dni=$row->dni;
    echo "<tr><td>".$dni."</td><td>".$row->cfecha."</td><td>".$row->chora."</td><td><button onClick='borrarCita(\"".$dni."\")'>Borrar</button></td></tr>";
}
echo "</tbody></table>";
echo "</body></html>";
?>
<script src="../plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
<script>
function borrarCita(this_dni){
    var dni=this_dni;
    $.post("../conexion/borrarCita.php", {dni:dni}, function(data){
          alert("Cita "+data);
          location.reload();
      });
    
}    
</script>