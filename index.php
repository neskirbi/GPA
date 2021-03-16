<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Control de Asistencia</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <style type="text/css">
        .icona {
            width: 30px;
            height: 30px;
            background-color: #fff;
            background-image: url(../app/imagen/gpsactivo.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        .icond {
            width: 30px;
            height: 30px;
            background-color: #fff;
            background-image: url(../app/imagen/gpsdesactivo.png);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        .clipin {
            height: 100%;
            width: 100%;
            background-repeat: no-repeat;
            background-position: 50%;
            border-radius: 50%;
            background-size: 100% auto;
        }
        
        .titulo {
            position: absolute;
            width: 70%;
            left: 45px;
            bottom: 4px;
        }
    </style>

</head>

<body class="hold-transition skin-yellow sidebar-mini sidebar-collapse">

    <?php
          //date_default_timezone_set('Mexico/General');
          date_default_timezone_set('America/Mexico_City');
          date_default_timezone_get();

          include "conexion/conexion.php";
          include "funciones/consultaKua.php";
          include "funciones/metodos/metodos1.php";

          //Obtener fecha y hora
          $fecha = date("Y-m-d");
          $hora = date("H:i:s", time());

          if(!empty($_GET['movil']))
          {
            $usu1 = $_GET['movil'];
            $dni = $_GET['dni'];
            $usu = $_GET['nombre'];

            //se crea una cookie usuario e id
            setcookie("ref",$usu1,time()+86400,"/");
            setcookie("login",$usu,time()+86400,"/");
            setcookie("dni",$dni,time()+86400,"/");
            setcookie("activo",$usu,time()+86400,"/");
            setcookie("movil",$usu1,time()+86400,"/");

            $ajuste = "style='width: 35%; height: 90px;'";
            $ajuste2 = "data-width='48' data-height='48'";
          }
          else
          {
            if(!isset($_COOKIE["login"]))
            {  
              include("login/loginuser.php"); 
            }
            $usu = $_COOKIE['login'];
            $dni = $_COOKIE['dni'];
          }

          if(isset($_COOKIE["movil"]))
          { 
            if($_COOKIE["movil"] == "si")
            {
              $ajuste = "style='width: 35%; height: 90px;'";
              $ajuste2 = "data-width='48' data-height='48'";
            }
            else
            {
              $ajuste = "style='width: 40%; height: 90px;'";
              $ajuste2 = "data-width='60' data-height='60'";
            }

          }
          else
          {
            $ajuste = "style='width: 40%; height: 90px;'";
            $ajuste2 = "data-width='60' data-height='60'";
          }

          //$pass = obtener_password($usu, $conexion);
          //$json = obtener_usuario($usu, $conexion);

          /*for ($i=0; $i < count($json); $i++) 
          {
            $foto_usu = "fotos/".$json[$i]['foto'];
            $pass = $json[$i]['pass'];
          }*/

          $foto_usu = "imagen/usuario2.png";
          $icon_usuario = $foto_usu;

          //Notificacion de ticket
          $icon_usuario = $foto_usu;
          $click = "pages/ticket.php";

          //Consulta SQL
          //$json = consultar_perfil_promotor($fecha, $dni);
          //echo $json;
          $conectados = 0; 
          $sum_obj_cliente = 0;
          $sum_visitas = 0;

          $sum_obj_cliente2 = 0;
          $sum_visitas2 = 0;

          $conectados_tracker = 0;

          

          $dia = getDia($fecha);
          //$count_rutas = rutas_ejecucion($conexion, date("Y-n-d"), $dia);

          //$noti = notificacion($fecha);
          //$noti = notificacion("2018-01-18");
        ?>
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>S</b>MC</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Sistema </b>Control de Asistencia</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="titulo">
                        <h1 style="font-size: 23px;">
          Nomina
          <small style="color: white;">Control panel</small>
        </h1>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                      
                            <!-- User Account: style can be found in dropdown.less -->
                            <!--Usuario quien ingreso al admin-->
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
                                                <?php echo ucfirst($_COOKIE['login']); ?>
                                                    <small><?php echo date("d-M-Y")."<br>".$hora; ?></small>
                                            </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="login/salir.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
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
                            <p>
                                <?php echo $_COOKIE['login']; ?>
                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">Nominas</li>
                          <li class="active treeview">
                             <a href="index.php">
                                <i class="ion ion-flag"></i> <span>Confirmar Asistencia</span>
                                <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                            </a>
                        </li>
                    
                        <?php

            if($_COOKIE['ref'] != 6)
            {
              echo "  <li class='treeview'>
                        <a href='pages/asistencia.php'>
                          <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
                        </a>
                      </li>";
            }
            
          ?>

            <li class='treeview'>
                    <a href='pages/periodo_consulta.php'>
                      <i class="fa fa-users" aria-hidden="true"></i> <span>Nomina</span>
                    </a>
                  </li>
                  </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
             

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <?php
          //Calcular porcentaje
          /*$porcentaje = round(($conectados*100)/count($json), 2);

          //Calcular porcentaje rutas
          $porcentaje_rutas = round(($count_rutas*100)/count($json), 2);

          //calcular poercentaje de clientes visitadas en linea
          if($sum_obj_cliente>0)
          {
              $porcentaje_visitas = round(($sum_visitas*100)/$sum_obj_cliente, 0);
          }
          else
          {
              $porcentaje_visitas=0;
          }
          if($porcentaje_visitas > 100)
          {
            $porcentaje_visitas = 100;
          }

          //calcular poercentaje de clientes visitadas en linea y sin general
          if($sum_obj_cliente2>0)
          {
              $porcentaje_visitas2 = round(($sum_visitas2*100)/$sum_obj_cliente2, 0);
          }
          else{
              $porcentaje_visitas2=0;
          }
          if($porcentaje_visitas2 > 100)
          {
            $porcentaje_visitas2 = 100;
          }*/

        ?>
                    
        </div>
           <!-- Main row -->
        <div class="row">
           

    <section class="col-lg-5 connectedSortable" style='height:100%; width:100%;'>
        <div class="box box-primary" style='height:100%; width:100%;'>
            <div class="box-header with-border">
                <h3 class="box-title">Confirmar Asistencias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  date("Y-n-d"); ?> 
				  <button style="position: absolute; right: 50px;" class="btn btn-adn btn-flat" onClick="enviarasistencia()">Confirmar asistenia de todos</button>
				</h3>
			
						
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <th>&nbsp;&nbsp;Buscar Empleado</th> <input type="text" style="width:23%; margin-left: 1.5%" id="filtroTabla" onkeyup="buscador()" placeholder="Buscar por nombre o ruta..">
            <div class="box-body" style='height: 847px; width:100%; overflow:auto;'>
                <table id="tablaMensajes" name="tablaMensajes" class="table table-bordered table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>No.Empleado</th>
                        <th>Bodega</th>
                        <th>Asistencia</th>
                        <th></th>
                        <th>Actas</th>
                    </thead>
                    <tbody>
                        <?php 
					
                $users= getUsers();
				asistenciac();
				for($i=0;$i<count($users);$i++)
        {
          ?>
          <tr>
            <td><?php echo $users[$i]["id"];?></td>
            <td><?php echo $users[$i]["nombre"];?></td>
            <td><?php echo $users[$i]["ruta"];?></td>
            <td><?php echo $users[$i]["ciudad"];?></td>
            <td>
              <select id="t<?php echo $users[$i]['id'];?>">
              <option id="t<?php echo $users[$i]['id'];?>n1">Asistencia</option>  
              <option id="t<?php echo $users[$i]['id'];?>n2">Falta</option>  
              <option id="t<?php echo $users[$i]['id'];?>n3">Incapacidad</option>
              <option id="t<?php echo $users[$i]['id'];?>n4">Vacaciones</option>    
              <option id="t<?php echo $users[$i]['id'];?>n5">Retardo</option> 
              <option id="t<?php echo $users[$i]['id'];?>n6">Permiso con Sueldo</option>                
              <option id="t<?php echo $users[$i]['id'];?>n7">Baja</option>                
              <option id="t<?php echo $users[$i]['id'];?>n8">Permiso sin Sueldo</option>             
            </td>
                
            <td>
              <button id="t<?php $users[$i]['id']?>" onClick= "enviarMensaje(<?php echo $users[$i]['id']?>)" class="btn btn-primary btn-flat">Enviar</button></td>
            
            <td>
                <?php
                $acta=json_decode($users[$i]['actas'],true); 
                $actas_status=json_decode($users[$i]['actas_status'],true); 
                $actas_comentarios=json_decode($users[$i]['actas_comentarios'],true); 

                for($ele=1;$ele<=3;$ele++){
                    if(!isset($acta[$ele])){
                        ?>
                        <img src="imagen/uploadfile.png" title="Subir Acta" id="img<?php echo $ele.$users[$i]['id'];?>" onclick="Cargar('file<?php echo $ele.$users[$i]['id'];?>');" style="cursor: pointer;" width="30px">
                        <?php
                    }else{
                        if(isset($actas_status[$ele])){
                          if(@$actas_status[$ele]['cap']=='0' || @$actas_status[$ele]['leg']=='0'){

                          $title=@$actas_comentarios[$ele]['cap']."\n".@$actas_comentarios[$ele]['leg'];
                          $texto=@$actas_comentarios[$ele]['cap']."<br>".@$actas_comentarios[$ele]['leg'];      
                          ?>           
                          <img src="imagen/filetache.jpg" title="<?php echo $title;?>" id="img<?php echo $ele.$users[$i]['id'];?>" data-toggle="modal" data-target="#RechazarModal" onclick="IniciarModalRechazo(<?php echo $users[$i]['id'];?>,<?php echo $ele; ?>,'<?php echo $texto;?>','<?php echo $acta[$ele];?>');" style="cursor: pointer;" width="30px">
                          <?php
                            }else{
                              ?>                    
                              <img src="imagen/fileclip.png" title="<?php echo $acta[$ele];?>" id="img<?php echo $ele.$users[$i]['id'];?>" onclick="DescargarActa('<?php echo $acta[$ele];?>');" style="cursor: pointer;" width="30px">
                              <?php
                            }
                          }else{
                            ?>                    
                            <img src="imagen/fileclip.png" title="<?php echo $acta[$ele];?>" id="img<?php echo $ele.$users[$i]['id'];?>" onclick="DescargarActa('<?php echo $acta[$ele];?>');" style="cursor: pointer;" width="30px">
                            <?php
                          }
                        
                    }
                }
              

                
                
                ?>
              <div id="content-files">
                <input type="file" style="visibility:hidden;" onchange="CargarActas('<?php echo $users[$i]['id'];?>',this,1);" id="file1<?php echo $users[$i]['id'];?>">
                <input type="file" style="visibility:hidden;" onchange="CargarActas('<?php echo $users[$i]['id'];?>',this,2);" id="file2<?php echo $users[$i]['id'];?>">
                <input type="file" style="visibility:hidden;" onchange="CargarActas('<?php echo $users[$i]['id'];?>',this,3);" id="file3<?php echo $users[$i]['id'];?>">
              </div>
              
              
            </td>

             
          </tr>
          <?php
        }?>
        </tbody>
    </table>

    </section>

    <!-- RechazarModal -->
    <div class="modal fade" id="RechazarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Comentario</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body rechazar-body">
           
          </div>
          <div class="modal-footer rechazar-footer">
           
            
          </div>
        </div>
      </div>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Promotecnicas y Ventas S.A. de C.V.</strong>
    </footer>
    <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>

    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <!--Esta modificando-->
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="js/jquery-clock-timepicker.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Obj', 'Hoy'],
                ['Visitas activos', <?= $sum_visitas ?>],
                ['Visitas sin activos', <?php echo  $sum_visitas2-$sum_visitas;?>],
                ['No visitadas', <?php echo $sum_obj_cliente2-$sum_visitas2;?>]
            ]);

            var options = {
                is3D: true,
                slices: {
                    2: {
                        offset: 0.1
                    },
                },
                colors: ['#00A65A', '#3366CC', '#DC3912'],
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>

    <script>
        /*   
         * Limitar fecha
         */
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("fechaC")[0].setAttribute('min', today);
        /*
         * /limitar fecha 
         */

        $('#horaC').clockTimePicker();

        function buscador() {
            // Declare variables 
            var input, filter, table, tr, tdNombre, tdRuta, i, txtValue;
            input = document.getElementById("filtroTabla");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablaMensajes");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                tdNombre = tr[i].getElementsByTagName("td")[1];
                tdRuta = tr[i].getElementsByTagName("td")[2];
                if (tdNombre || tdRuta) {
                    txtValue1 = tdNombre.textContent || tdNombre.innerText;
                    txtValue2 = tdRuta.textContent || tdRuta.innerText;
                    if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function mensajeClienteTodos() {
            var mensaje = $("#mensajeClienteTodos").val();
            $.post("conexion/mensajeClienteTodos.php", {
                mensaje: mensaje
            }, function(data) {
                alert("Mensaje " + data + " a  todos");
            });
        }

        function mensajeCliente() {
            var mensaje = $("#mensajeCliente").val();
            var id = $("#idBusqueda").val();
            $.post("conexion/mensajeCliente.php", {
                mensaje: mensaje,
                id: id
            }, function(data) {
                alert("Mensaje " + data);
            });
        }

        function buscarMensaje() {
            var id = $("#idBusqueda").val();
            $.post("conexion/buscarMensaje.php", {
                id: id
            }, function(data) {
                $("#mensajeCliente").val(data);
            });
            $.post("conexion/buscarNombre.php", {
                id: id
            }, function(data) {
                $("#nombreBusqueda").text(data);
            });
        }

        function agendarSala() {
            var id = $("#supervisor").val();
            var fecha = $("#fechaC").val();
            var hora = $("#horaC").val();
            var tipoCon = $("#tipoCon").val();
            $.post("conexion/agendarSala.php", {
                id: id,
                tipoCon: tipoCon,
                fecha: fecha,
                hora: hora
            }, function(data) {
                alert("Sala virtual " + data);
            });
        }

        function avance() {

            var fecha = document.getElementById('fecha').value;
            var ft = fecha.split('-');
            ft[1] = ft[1].replace("0", "");
            fecha = ft.join('-');

            var fecha2 = document.getElementById('fecha2').value;
            var ft = fecha2.split('-');
            ft[1] = ft[1].replace("0", "");
            fecha2 = ft.join('-');

            var id = 0;
            $.post("pages/monitoreo.php", {
                fecha: fecha,
                fecha2: fecha2
            }, function(result) {

                $('#salida').html(result);
            });
        }

        function enviarMensaje(this_id) {
            var mensaje = $("#t" + this_id).val();
            $.post("conexion/enviarMensaje.php", {
                mensaje: mensaje,
                id: this_id
            }, function(data) {
                alert("Mensaje " + data);
            });
        }

		function enviarasistencia(){
           
            $.post("conexion/asisten.php", {
               }, function(data) {
                alert("Asistencia " +data );
            });
        } 
		
        function enviarMensajeTodos() {
            var mensaje = $("#mensajeTodos").val();
            $.post("conexion/enviarMensajeTodos.php", {
                mensaje: mensaje
            }, function(data) {
                alert("Mensaje " + data + " a  todos");
            });
        }

        $(function() {
            $('#tabla3').DataTable({
                "emptyTable": "No hay datos disponibles en la tabla.",
                "paging": true,
                "lengthMenu": [
                    [5, 10, 20, 25, 50, -1],
                    [5, 10, 20, 25, 50, "Todos"]
                ],
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 7,
                "language": {
                    "emptyTable": "No hay datos disponibles en la tabla.",
                    "info": "Del _START_ al _END_ de _TOTAL_ ",
                    "infoEmpty": "Mostrando 0 registros de un total de 0.",
                    "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                    "infoPostFix": "(actualizados)",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "searchPlaceholder": "Dato para buscar",
                    "zeroRecords": "No se han encontrado coincidencias.",
                    "paginate": {
                        "first": "Primera",
                        "last": "Última",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": "Ordenación ascendente",
                        "sortDescending": "Ordenación descendente"
                    }
                },
                "columns": [{
                    "data": 0,
                    'orderable': false,
                    'searchable': false
                }, {
                    "data": 1,
                    'orderable': false,
                    'searchable': false
                }, {
                    "data": 3,
                    'orderable': false,
                    'searchable': false
                }, ]

            });
        });

        var num_notifiacion = 0;
        var status = 0;
        setInterval(function() {
            not();
        }, 15000);

        function not() {
            $.post('reporteweb/notificaciones_nuevo_ticket.php?cont=' + num_notifiacion, function(data1, status) {
                status = data1.split("-");
                //console.log(status[1]);

                if (status[1] === "0") {
                    num_notifiacion = status[0];
                    //console.log("Mostro la notificacion: "+num_notifiacion);
                    $.post('reporteweb/notificaciones_mostrar_ticket.php?icon=<?=$icon_usuario?>&click=<?=$click?>', function(data2, status) {
                        //num_notifiacion++;
                        document.getElementById('ticket').innerHTML = data2;
                    });
                }
            });
        }

        function expo_mon() {
            var fecha = document.getElementById('fecha').value;
            var ft = fecha.split('-');
            ft[1] = ft[1].replace("0", "");
            fecha = ft.join('-');

            var fecha2 = document.getElementById('fecha2').value;
            var ft = fecha2.split('-');
            ft[1] = ft[1].replace("0", "");
            fecha2 = ft.join('-');

            window.open('reportesexcel/monitoreo_excel.php?fecha=' + fecha + '&fecha2=' + fecha2, '_blank');
        }

        function IniciarModalRechazo(id,numero,comentario,name){
          $('.rechazar-body').html('<p>'+comentario+'</p>');
          $('.rechazar-footer').html(' <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="button" onclick="EliminarActa('+id+','+numero+',\''+name+'\');" class="btn btn-danger" data-dismiss="modal">Eliminar</button>');
        }

        function EliminarActa(id,numero,name){
          if(confirm('¿Eliminar acta?')){
            $.post("conexion/EliminarActa.php", {
                id: id,
                name: name,
                numero:numero
            }, function(data) {
              console.log(data);
                if(data.includes("ok")){
                    $('#img'+numero+id).attr("src","imagen/uploadfile.png");
                    $('#img'+numero+id).attr('title','Subir Acta');
                    $('#img'+numero+id).removeAttr('data-target');
                    $('#img'+numero+id).removeAttr('data-toggle');
                    //$('#img'+numero+id).prop("onclick", null).off("click");
                    $('#img'+numero+id).attr('onclick', 'Cargar(\'file'+numero+id+'\')');
                    $('#content-files').append('<input type="file" style="visibility:hidden;" onchange="CargarActas('+id+',this,'+numero+');" id="file'+numero+id+'">');
                    
                }else{
                    alert(data);
                }
                
            });
          }
        }

        function CargarActas(id,file,numero) {
            var elemento=file;
            file=file.files[0];
            var name =file.name;
            
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {  
                
                nametemp=name.split(".");
                if(nametemp[1]=="zip" || nametemp[1]=="rar" || nametemp[1]=="pdf" || nametemp[1]=="jpg"){
                    $.post("conexion/CargarActas.php", {
                        data: reader.result,
                        id: id,
                        name: name,
                        numero:numero
                    }, function(data) {
                        if(data.includes("ok")){
                            $('#img'+numero+id).attr("src","imagen/fileclip.png");
                            $('#img'+numero+id).attr("title",name);
                            //$('#img'+numero+id).prop("onclick", null).off("click");
                            $('#img'+numero+id).attr('onclick', 'DescargarActa("'+name+'")');
                            $(elemento).remove();
                        }else{
                            alert(data);
                        }
                        
                    });
                }else{
                    alert("Error: Solo se permite .PDF .RAR .ZIP  .JPG");
                }
            };
            reader.onerror = function (error) {
                console.log('Error: ', error);
            };
        }

        avance();

        function DescargarActa(name){
            window.open("documents/"+name, '_blank');
        }

        function Cargar(id){
            $('#'+id).click();
        }
    </script>
    
</body>

</html>