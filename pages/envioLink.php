<?php
$id= filter_input(INPUT_GET, 'dni');
$tipoConf= filter_input(INPUT_GET, 'tipoConf')
?>
<html>
    <head>
        
    </head>
    <body>
        <input type="hidden" id="id" value="<?php echo $id;?>">
        <?php if($tipoConf==='3')
        {?>
            <input type="text" id="vinculo" name="vinculo" placeholder="Coloca aqui el vinculo">
            <button onClick= 'guardarLink()'>Guardar</button>
        <?php 
        }else if($tipoConf==='2')
        {?>
            <input type="text" id="numero" name="numero" placeholder="Coloca aqui el numero">
            <input type="text" id="idCall" name="idCall" placeholder="Coloca aqui el ID">
            <button onClick= 'guardarNum()'>Guardar</button>
        <?php
        }
        ?>
    </body>
</html>
<script src="../plugins/jQuery/jquery-2.2.3.min.js" type="text/javascript"></script>
<script>
function guardarLink()
{
    var link =$("#vinculo").val();
    var dni=$("#id").val();
      $.post("../conexion/guardarLink.php", {link:link,dni:dni}, function(data){
          alert("Vinculo "+data);
      });
}

function guardarNum()
{
    var numero =$("#numero").val();
    var idCall=$("#idCall").val();
    var dni=$("#id").val();
      $.post("../conexion/guardarLink.php", {numero:numero,idCall:idCall,dni:dni}, function(data){
          alert("Vinculo "+data);
      });
}
</script>



