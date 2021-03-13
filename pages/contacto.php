<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monitoreo | SMC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style type="text/css">
    .icona
    {
      width: 40px;
      height: 40px;
      background-color: #fff;
      background-image: url(../app/imagen/gpsactivo.png);
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }
    .icond
    {
      width: 40px;
      height: 40px;
      background-color: #fff;
      background-image: url(../app/imagen/gpsdesactivo.png);
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }
    .clipin
    {
      height: 100%;
      width: 100%;
      background-repeat: no-repeat;
      background-position: 50%;
      border-radius: 50%;
      background-size: 100% auto;
    }
  </style>

</head>
<body class="hold-transition skin-yellow sidebar-mini sidebar-collapse">
  <?php
    date_default_timezone_get("America/Mexico_City");

    include "../conexion/conexion.php";
    include "../funciones/consulta.php";
    include "../gps/trazar.php";
    //include "../ruta/mapa.php";
    include "../gps/gps_ruta.php";

    

    //Obtener fecha
    $fecha = date("Y-m-d");
    $hora = date("H:i:s", time());
    if(!isset($_COOKIE["login"]))
    {  
      include("../login/loginuser.php"); 
    }

    $usu = $_COOKIE['nickname'];
    //$pass = obtener_password($usu, $conexion);
    $json = obtener_usuario($usu, $conexion);

    for ($i=0; $i < count($json); $i++) 
    {
      $foto_usu = "../fotos/".$json[$i]['foto'];
      $pass = $json[$i]['pass'];
    }
    
  ?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>MC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sistema </b>SMC</span>
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <!--<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-light-blue"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="display: flex;">
              <?php
                echo "<div style='width: 30px; '>
                      <img  class='clipin' style='
                          height: 17px;
                          width: 17px;
                          background-repeat: no-repeat;
                          background-position: 50%;
                          border-radius: 50%;
                          background-size: 100% auto;
                          background-image: url(".$foto_usu.");'>
                      </div>";
              ?>
              <span class="hidden-xs"><?php echo $_COOKIE['login']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php
                  echo "<img  class='clipin' style='
                            height: 95px;
                            width: 95px;
                            background-repeat: no-repeat;
                            background-position: 50%;
                            border-radius: 50%;
                            background-size: 100% auto;
                            background-image: url(".$foto_usu.");'>";
                ?>
                <p>
                  <?php echo ucfirst($_COOKIE['puesto']); ?>
                  <small><?php echo date("d-M-Y")."<br>".$hora; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../login/salir.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
            echo "<img  class='clipin' style='
                      height: 35px;
                      width: 35px;
                      background-repeat: no-repeat;
                      background-position: 50%;
                      border-radius: 50%;
                      background-size: 100% auto;
                      background-image: url(".$foto_usu.");'>";
          ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $_COOKIE['login']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       <li class="header">Sistema de Monitoreo y Control</li>
        <li class="treeview">
          <a href="../">
            <i class="fa fa-dashboard"></i> <span>Seguimiento de Ruta</span>
          </a>
        </li>
        <li class="treeview">
          <a href="reportegps.php">
            <i class="ion ion-flag"></i> <span>Mapa GPS</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">nuevo</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="promotores.php">
            <i class="ion ion-person-stalker"></i> <span>Mi personal</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">nuevo</small>
            </span>
          </a>
        </li>
        <li class="active treeview">
          <a href="contacto.php">
            <i class="ion ion-android-contacts"></i> <span>Contactos</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Contactos
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="ion ion-person-stalker"></i>Contactos</a></li>
        <li class="active">Perfil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- =========================================================== -->

      <!-- =========================================================== -->

      <!-- =========================================================== -->

      <!-- =========================================================== -->


      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Perfil</th>
              <th>Nombre</th>
              <th>Ciudad</th>
              <th>Equipo</th>
              <th>Tel&eacute;fono</th>
              <th>Promotor</th>  
              <th>Agregar contacto</th>
            </tr>
            </thead>
            <tbody>
        <?php
          $json = consultar_sin_contacto($usu);
          $cont = 0;
          $contacto = array();
          //print_r($json);
          //echo "<br>aqui----".$json[0]."<br>";
          for ($i=0; $i < count($json); $i++) 
          { 
            //echo $json[$i];
            $foto = "../fotos/".$json[$i]['foto'];

            if(file_exists($foto) and ($json[$i]['foto'] != null or $json[$i]['foto'] != ""))
            {
              
            }
            else
            {
              $foto = "../imagen/usuario.jpg";
            }
            echo "<!-- /.col AGREGAR CONTACTO 
                  <div class='col-md-3'>
                    <div class='box box-widget widget-user'>
                      <div class='widget-user-header bg-yellow' style='display:flex;'>
                        <div style='width: 100px; height: 100px;'>
                          <img  class='clipin' style='background-image: url(".$foto.");'>
                        </div>
                        <div style='width: 45%; height: 90px;'>
                          <h3 class='widget-user-username'>".$json[$i]['nombre']." ".$json[$i]['apellidos']."</h3>
                          <div style='display:flex; justify-content: space-between; width:150%; '>
                            <h5 class='widget-user-desc'>".$json[$i]['puesto']."</h5>
                            <input type='submit' class='btn btn-primary' value='Agregar' id='boton$cont' onClick='enviarDatos$cont(); return false'>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>-->
                  ";

            echo "<tr>
                    <td width='100px'>
                      <div style='width: 30px; height: 30px;'>
                        <img  class='clipin' style='background-image: url(".$foto.");'>
                         <!--ventanas emergentes-->
                          <div class='container'>
                            <button type='button' class='btn btn-info btn-lg' id='myBtn'>Open Modal</button>

                            <!-- Modal -->
                            <div class='modal fade' id='myModal' role='dialog'>
                              <div class='modal-dialog'>
                              
                                <!-- Modal content-->
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                    <h4 class='modal-title'>Dato personal</h4>
                                  </div>
                                  <div class='modal-body'>
                                    <div class='col-md-13'>
                                      <!-- Widget: user widget style 1 -->
                                      <div class='box box-widget widget-user-2'>
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class='widget-user-header bg-yellow'>
                                          <div class='widget-user-image'>
                                            <img class='img-circle' src='../dist/img/user7-128x128.jpg' alt='User Avatar'>
                                          </div>
                                          <!-- /.widget-user-image -->
                                          <h3 class='widget-user-username'>Nadia Carmichael</h3>
                                          <h5 class='widget-user-desc'>Lead Developer</h5>
                                        </div>
                                        <div class='box-footer no-padding'>
                                          <ul class='nav nav-stacked'>
                                            <li><a href='#'>Projects <span class='pull-right badge bg-blue'>31</span></a></li>
                                            <li><a href='#'>Tasks <span class='pull-right badge bg-aqua'>5</span></a></li>
                                            <li><a href='#'>Completed Projects <span class='pull-right badge bg-green'>12</span></a></li>
                                            <li><a href='#'>Followers <span class='pull-right badge bg-red'>842</span></a></li>
                                          </ul>
                                        </div>
                                      </div>
                                      <!-- /.widget-user -->
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <div class='modal-footer'>
                                    
                                  </div>
                                </div>
                                
                              </div>
                            </div>
                            
                          </div>
                          <!--ventanas emergentes-->
                      </div>
                    </td>
                    <td>".$json[$i]['nombre']."</td>
                    <td>".utf8_encode($json[$i]['ciudad'])."</td>
                    <td>".$json[$i]['equipo']."</td>
                    <td>".$json[$i]['telefono']."</td>
                    <td>".$json[$i]['puesto']."</td>
                    <td><input type='submit' class='btn btn-primary' value='Agregar' id='boton$cont' onClick='enviarDatos$cont(); return false'></td>
                  </tr>";
            $contacto[$cont]['id_usuario'] = $json[$i]['id_usuario'];
            $cont++;
          }
        ?>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        
        <!-- /.col -->
        <div class="col-md-4">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <!--ventanas emergentes-->
          <div class="container">
            <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Dato personal</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-13">
                      <!-- Widget: user widget style 1 -->
                      <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-yellow">
                          <div class="widget-user-image">
                            <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                          </div>
                          <!-- /.widget-user-image -->
                          <h3 class="widget-user-username">Nadia Carmichael</h3>
                          <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                          <ul class="nav nav-stacked">
                            <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                            <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                            <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                            <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.widget-user -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="modal-footer">
                    
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
          <!--ventanas emergentes-->
        </div>

      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Promotecnicas y Ventas S.A. de C.V.</strong>
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script type='text/javascript'>

<?php
  for ($i=0; $i < $cont; $i++) 
  {
    $id = $contacto[$i]['id_usuario'];
       echo "function agregar$i()
            {
              document.getElementById('boton".$i."').style = 'background-color: green;';
              document.getElementById('boton".$i."').value = 'Agregado';
            }
            function enviarDatos$i()
            {

              //Recogemos los valores introducimos en los campos de texto
              //id_usuario = document.contacto.id_usuario.value;
              //dorsal = document.contacto.dorsal.value;

              //Aquí será donde se mostrará el resultado
              //jugador = document.getElementById('boton".$i."');

              //instanciamos el objetoAjax
              ajax = objetoAjax();

              //Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
              ajax.open('POST', '../funciones/consulta.php', true);

              //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
              ajax.onreadystatechange = function() {

                       //Cuando se completa la petición, mostrará los resultados 
                if (ajax.readyState == 4){

                  //El método responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
                  //jugador.value = (ajax.responseText) 
                }
              } 

              //Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario. 
              ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded'); 

              //enviamos las variables a 'consulta.php' 
              ajax.send('&nick=$usu&contacto=$id'); 

            } ";
  }
  
?>
  window.onload = function()
  {
    document.getElementById('boton1').addEventListener('click', agregar1);
    //document.getElementById('boton2').addEventListener('click', agregar2);
<?php
  for ($i=0; $i < $cont; $i++) 
  {
       echo "document.getElementById('boton".$i."').addEventListener('click', agregar".$i.");";
  }
  
?>
  }


  function objetoAjax(){
    var xmlhttp = false;
    try {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {

      try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (E) {
        xmlhttp = false; }
    }

    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
      xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
  }

</script>




<!-- jQuery 2.2.3 -->
<!--<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
</body>
</html>
