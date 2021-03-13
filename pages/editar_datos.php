<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<?php include "../funciones/consultaKua.php";
include "../conexion/conexion.php";
$cliente=$_GET['id'];
$date=$_GET['date'];
$data=getModificaDatos($cliente, $date,$conexion);
$idActividad=$data->Id_actividad;
$entrada=$data->entrada;
$salida=$data->salida;?>
<form action="editarRegistro.php" id="editar" name="editar" method="post">
    <input readonly type="text" name="id" id="id" value="<?php echo $idActividad?>"/>
    <label for="entrada">Entrada</label>
    <input id="entrada" name="entrada" type='text' value='<?php echo $entrada ?>'/>
    <label for="salida">Salida</label>
    <input id="salida" name="salida" type='text' value='<?php echo $salida ?>'/>
    <input type="submit" name="enviar" id="enviar" value="Actualizar">
</form>
<script>
$(document).ready(function () {
    $('#enviar').submit(function(event) {
        var formData = $(this).serialize();
        $.ajax({
            type: 'post', 
            url: 'editarRegistro.php', 
            data: formData, 
            dataType: 'json'
        });
        event.preventDefault();
    });
});
</script>

