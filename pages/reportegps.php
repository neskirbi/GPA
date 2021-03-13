<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
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

  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" type="text/css" href="../css/bootstrap-multiselect.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style type="text/css">
    .icona
    {
      width: 30px;
      height: 30px;
      background-color: #fff;
      background-image: url(../app/imagen/gpsactivo.png);
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }
    .icond
    {
      width: 30px;
      height: 30px;
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
    #new-search-area 
    {
      width: 100%;
      clear: both;
      padding-top: 20px;
      padding-bottom: 20px;
    }
    #new-search-area input 
    {
      width: 600px;
      font-size: 20px;
      padding: 5px;
    }
    .titulo
    {
      position: absolute;
      width: 70%;
      left: 45px;
      bottom: 4px;
    }
  </style>
  <script type="text/javascript">
    function mapa_ruta(ruta)
    {
        $('html, body').animate({
            scrollTop: $("#mappy").offset().top
        }, 1000);
      var fecha_inicio = document.getElementById('datepicker').value;
      var fecha_fin = document.getElementById('datepicker1').value;

      var url="../gps/mapas.php?fechas="+fecha_inicio+","+fecha_fin+"&ruta="+ruta;

      document.getElementById('mapa_act').src=url;
      document.getElementById('ruta_mapa').innerHTML=ruta;

      url = "../datos/dato_personal.php?ruta="+ruta+"&fecha=2017-10-11";
      document.getElementById('dato_actual').src = url;
    }

    function mapa_act(ruta, lat, lon, hora)
    {
        $('html, body').animate({
            scrollTop: $("#mappy").offset().top
        }, 1000);
      var url="../gps/posicion_actual_ruta.php?ruta="+ruta+"&lat="+lat+"&lon="+lon+"&hora="+hora;
      document.getElementById('mapa_act').src=url;
      document.getElementById('ruta_mapa').innerHTML=ruta;

      //url = "../datos/dato_personal.php?ruta="+ruta+"&fecha=2017-10-11";
      //document.getElementById('dato_actual').src = url;
    }
  </script>
</head>
<body class="hold-transition sidebar-mini skin-yellow sidebar-collapse" >
  <?php
    date_default_timezone_get();
    ini_set('max_execution_time', 1000);

    

    //include "../funciones/consulta.php";
    include "../funciones/consultaKua.php";
    //include "../funciones/funciones.php";
    //include "../funciones/metodos/metodos1.php";
    //include "../gps/trazar.php";
    include "../gps/trazarkua.php";
    //include "../ruta/mapa.php";
    include "../gps/gps_ruta.php";
    include "../conexion/conexion.php";
    require "libs/Mobile_Detect.php";
    $detect = new Mobile_Detect;

    //Notificacion de ticket
    $icon_usuario = "../imagen/usuario2.png";
    $click = "ticket.php";

  
    if(!isset($_COOKIE["login"]))
    {  
      include("login/loginuser.php"); 
    }
  //  $usu = $_COOKIE['login'];
   // $dni = $_COOKIE['dni'];
    
    if (isset($_GET['movil']) or $_COOKIE['movil'] == 1 or $_COOKIE['movil'] == "si") 
		{
			if(!empty($_GET['movil']))
			{
				$usu = $_GET['usuario'];
				$usu1 = $_GET['movil'];

				$sql = "SELECT Id_tipouser, dni, nombre FROM usuario where Id_usuario='$usu'";
				$sql = odbc_exec($conexion, $sql);
				if($row = odbc_fetch_object($sql))
				{
					if($row->Id_tipouser == 5)
					{					
						$dni = $row->dni;
						//se crea una cookie usuario e id
						setcookie("ref",$usu1,time()+86400,"/");
						setcookie("login",$usu,time()+86400,"/");
						setcookie("dni",$dni,time()+86400,"/");
						setcookie("activo",$usu,time()+86400,"/");
						setcookie("movil",$usu1,time()+86400,"/");

					}
					else
					{
						//echo "No es supervisor";	
					}
					
				}		
			}
			else
			{
				//echo "<br><br><br><br><br>Movil: ".$_COOKIE['movil']."<br>";

				$usu = $_COOKIE['login'];
				$usu1 = 2;
				$dni = $_COOKIE['dni'];
				//se crea una cookie usuario e id
				setcookie("ref",$usu1,time()+86400,"/");
				setcookie("login",$usu,time()+86400,"/");
				setcookie("dni",$dni,time()+86400,"/");
				setcookie("activo",$usu,time()+86400,"/");
				setcookie("movil",$usu1,time()+86400,"/");	
			}
		}		
		else
		{
			//echo "<br><br><br><br><br>Movil: ".$_COOKIE['movil']."<br>";

			if(!isset($_COOKIE["login"]))
			{  
			  include("login/loginuser.php"); 
			}
			$usu = $_COOKIE['login'];
			$dni = $_COOKIE['dni'];
			$usu1 = $_COOKIE['movil'];
		}
    

    //Obtener fecha y hora
    if(isset($_POST['fecha']))
    {
      $fecha = $_POST['fecha'];
    }
    else
    {
      $fecha = date("Y-m-d");
    }

    if (isset($_POST['fecha_inicio'])) 
    {
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
    }
    else
    {
      $fecha_inicio = date("Y-m-d");
      $fecha_fin = $fecha_inicio;
    }

    $hora = date("H:i:s", time());
    $fecha_actual = date("Y-m-d");


   
    

    /*for ($i=0; $i < count($json); $i++) 
    {
      $foto_usu = "../fotos/".$json[$i]['foto'];
      $pass = $json[$i]['pass'];
    }*/

    $foto_usu = "../imagen/usuario2.png";
    
  ?>
<div class="wrapper">
<?php if(!$detect->isMobile())
         {?>
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

      <div class="titulo">
        <h1 style="font-size: 23px;">
          Detalle de Ruta
          <small style="color: white;">Por promotor</small>
        </h1>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!--Notificacion de ticket
          <li class='dropdown messages-menu' id='ticket'>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <!--<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
             <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                inner menu: contains the actual data 
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
                  <?php echo ucfirst($_COOKIE['login']); ?>
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
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
         <?php }?>
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
       <li class="header">Sistema de Monitoreo y Control</li>
        <li class="treeview">
          <a href="../">
            <i class="fa fa-dashboard"></i> <span>Seguimiento de Ruta</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="reportegps.php">
            <i class="ion ion-flag"></i> <span>Mapa GPS</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">nuevo</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="reportewebproducto.php">
            <i class="ion ion-ios-paper-outline"></i> <span>Detalle de Ruta</span>
          </a>
        </li>
       
        
		 <li class="treeview">
          <a href="ticket.php">
            <i class="ion ion-android-checkbox-outline"></i> <span>Ticket</span>
          </a>
        </li>
		
        <?php

            if($_COOKIE['ref'] == 3)
            {
              echo "  <li class='treeview'>
                    <a href='asistencia.php'>
                      <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
                    </a>
                  </li>
                  <li class='treeview'>
                    <a href='actualizartienda.php'>
                      <i class='ion ion-ios-cart'></i> <span>Actualizar cliente</span>
                    </a>
                  </li>";
            }
            else if($_COOKIE['ref'] == 1)
            {
              echo "<li class='treeview'>
                    <a href='asistencia.php'>
                      <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
                    </a>
                  </li>";
            }
          
          ?>
        <!--<li class="treeview">
          <a href="promotores.php">
            <i class="ion ion-person-stalker"></i> <span>Mi personal</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">nuevo</small>
            </span>
          </a>
        </li>
        <li class="  treeview">
          <a href="contacto.php">
            <i class="ion ion-android-contacts"></i> <span>Contactos</span>
          </a>
        </li>-->
      </ul>
    </section>f
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header)
    <section class="content-header">
      <h1>
        Detalle de Ruta
        <small>Por promotor</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="ion ion-flag"></i> Mapa GPS</a></li>
        <li class="active">Detalle de Ruta</li>
      </ol>
    </section> -->

    <!-- Tabla de promotores -->
    <section class="content">
      <!-- Main content -->
      <div class="row">
        <?php



          //if(isset($_POST['nom']))//TABLA REDUCIDA
          //{
            $tamanio = '9';
            echo "<div class='col-md-3' style='height: 900px; overflow: scroll'>
                    <div class='box box-info'>

                      <!-- /.box-header -->
                      <div class='box-body'>
                        <table class='table table-bordered table-hover'>
                          <thead>
                          <tr>
                            <th>Objetivos de ruta</th>
                          </tr>
                          </thead>
                          <tbody>";

                  if(isset($_POST['nom']))
                  {
                    $nom2 = $_POST['nom'];
                  }
                  else
                  {
                    $nom2 = "todo";
                  }
                  $json=array();
                  $dia = getDia($fecha);
                  $json = consultar_perfil_promotor1($fecha, $usu, "", $dia, $dni);
                  $latitud = "nada";
                  $longitud = "";
                  $horas = "";
                  $foto="";
                  $promotores_rutas = "";
                  $ii = true;

                  for ($i=0; $i < count($json) ; $i++) 
                  { 

                    if($json[$i]["conectado"] == "Tracker" && $ii == true)
                    {
                      $latitud = $json[$i]['lat'];
                      $longitud = $json[$i]['lon'];
                      $promotores_rutas = $json[$i]['nombre'];
                      $horas = $json[$i]['hora'];
					  $foto = $json[$i]['foto'];
                      $ii = false;
                    }
                    
                    else if($json[$i]["conectado"] == "Tracker")
                    {
                      $latitud = $json[$i]['lat'].",".$latitud;
                      $longitud = $json[$i]['lon'].",".$longitud;
                      $promotores_rutas = $json[$i]['nombre'].",".$promotores_rutas;
                      $horas = $json[$i]['hora'].",".$horas;
					  $foto = $json[$i]['foto'];
                    }
			str_replace("\/", "/", $foto);
                  //  if(file_exists($foto) and ($json[$i]['foto'] != null or $json[$i]['foto'] != ""))
                   // {
                      
                   // }
                   // else
                  //  {
                   //   $foto = "../imagen/usuario.jpg";
                   // }

                    if($json[$i]['conectado'] == "Tracker")
                    {
                      $gps = "<form method='POST' action='reportegps.php'>
                                <input type='submit' class='btn icona' value='' >
                                <input type='text' name='nom' value='".$json[$i]["nickname"]."' style='display:none;'>
                                <input type='text' name='fecha_inicio' value='".$fecha_inicio."' style='display:none;'>
                                <input type='text' name='fecha_fin' value='".$fecha_fin."' style='display:none;'>
                              </form>";
                      $status = "Tracker";
                    }
                    else
                    {
                      $gps = "<div class='btn icond' ></div>"; 
                      $status = "OffLine";
                    }
                    echo "<tr>
                            <td>";
                            include "../conexion/conexionkua.php";
                            include "../tarjeta/tarjeta.php";

                    echo "  </td>
                            <!--<td>
                              <div style='width: 30px; height: 30px;'>
                                <img  class='clipin' style='background-image: url(".$foto.");'>
                              </div>
                            </td>
                            <td>".$json[$i]["nombre"]."</td>
                            <td>".$json[$i]["nickname"]."</td>
                            <td>".$gps."</td>
                            <td><a href='#' onclick='consultar()'>fecha</a></td>-->
                          </tr>";
                  }
                  echo "  <!--<tr>
                            <td>Presto</td>
                            <td>Opera for Wii</td>
                            <td>Wii</td>
                            <td>-</td>
                          </tr>-->

                          </tbody>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>";
        ?>
        <!--Elegir un rango de fecha inicio y fin-->
        <div class="col-md-<?php echo $tamanio; ?>">
          <div class="box box-danger">
            <!-- /.box-header -->
            <div class="box-body">
              <form action="reportegps.php" method="post">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>
                         <select id="nom" multiple='multiple' name='nom[]' style="width: 100%;">
                          <?php
                          if(isset($_POST['nom']))
                          {
                            $nom = $_POST['nom'];
                            //$json = consultar_perfil_promotor1($fecha, $usu, $pass, "todo");
                            $nombre = $json;
                            //print_r($json);
                            //echo "<br>aqui----".$json[0]."<br>";
                            for ($i=0; $i < count($nombre); $i++)
                            {
                              if($nom == $nombre[$i]['nickname'])
                              {
                                $selecionado = "selected";
                              }
                              else
                              {
                                $selecionado = "";
                              }

                              echo "<option ".$selecionado.">
                                      ".$nombre[$i]['nickname']."
                                    </option>";
                            }
                          }
                          else
                          {
                            //$json = consultar_perfil_promotor1($fecha, $usu, $pass, "todo");
                            $nombre = $json;
                            //print_r($json);
                            //echo "<br>aqui----".$json[0]."<br>";
                            for ($i=0; $i < count($nombre); $i++)
                            {
                              echo "<option value='".$nombre[$i]['nickname']."'>
                                      ".$nombre[$i]['nickname'].": ".$nombre[$i]['nombre']."
                                    </option>";
                            }
                          }
                          
                        ?>
                        </select>
                      </th>
                      <th>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar">&nbsp;Inicio:</i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>">
                        </div>
                      </th>
                      <th>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar">&nbsp;Fin:</i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker1" name="fecha_fin" id="fecha2" value="<?php echo $fecha_fin; ?>">
                        </div>
                      </th>
                      <th>
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-info btn-flat">Ir</button>
                          </span>
                          <input type="text" name="opciones" value="opciones" style="display: none;">
                      </th>                
                    </tr>
                  </thead>
                </table>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

          <!-- Map box MAPA RUTA -->
        <div class="col-md-<?php echo $tamanio; ?>">
          <div class="box box-solid">
            <div class="box-header">
              <!-- tools box -->
              <form method="action" action="reportegps.php">
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Ocultar" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
                
                  <input type="submit" class="btn btn-success btn-sm pull-right" id="sendEmail" value="Ver todos">&nbsp;&nbsp;
                
              </div>
              </form>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                Mapa
              </h3>
              
            </div>

            <?php 

              if(empty($nom))
              {
                //include ("../ubicar/ubicar.php");
                //include "../ruta/mapa.php";
              }
              
            ?>
            <!-- Date range 
            <div class="form-group">
              <label>Buscar Ruta:</label>

              <div class="input-group" style="width: 10%;">
                <div class="input-group-addon">
                  <i class="fa fa-user"></i>
                </div>
                <input type="text" class="form-control pull-right" id="">
              </div>
            </div>
            <div class="form-group">
              <label>Buscar Ruta:</label>

              <div class="input-group" style="width: 10%;">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker">
              </div>
            </div>
            <div class="form-group">
              <label>Buscar Ruta:</label>

              <div class="input-group" style="width: 10%;">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker1">
              </div>
            </div>-->
            <!-- /.form group -->
            <div class="box-body" id="mappy">
              <!--<div id="world-map" style="height: 250px; width: 100%;"></div>-->
              <!--<div id="mapa" style="height: 500px; width: 100%;"></div>-->
            
            <?php              
              echo'<iframe id="mapa_act" frameborder="0px" style="width: 100%; height: 600px; " src="../gps/posicion_actual.php?hora='.$horas.'&lat='.$latitud.'&lon='.$longitud.'&ruta='.$promotores_rutas.'"></iframe>';
         
            ?>
            </div>
            <!-- /.box-body-->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-1"></div>
                  <div class="knob-label" style="font-size: 14px;"><b style="font-size: 14px;">Ruta: </b> 
                    <div id="ruta_mapa"></div>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <div id="sparkline-2"></div>
                  <div class="knob-label" style="font-size: 14px;">
                  <?php
                    $h_inicio = json_decode($marcadores1); 
                    echo "<b style='font-size: 14px;'>Inicio: </b>".@$h_inicio[0][2]; 
                  ?></div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <div id="sparkline-3"></div>
                  <div class="knob-label" style="font-size: 14px;">
                  <?php 
                    $h_fin = json_decode($marcadores1);
                    echo "<b style='font-size: 14px;'>Fin: </b>".@$h_fin[count($h_fin)-1][2]; 
                  ?></div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        </div>
      </div>

      <!-- =========================================================== -->

      <!-- =========================================================== -->

      <!-- =========================================================== -->

      <?php

      if(isset($_POST['nom']))//Mostrar el dato en la tabla
      {

      ?>
      <!--Dato personal-->
      <!--<div class="col-xs-13">
        <div class="box">

          <div class="box-header">
            <div class="pull-right box-tools">
              <div class="pull-right box-tools">
                  <button type="button" class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Ocultar" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <h3 class="box-title">Dato personal</h3>
          </div>
          <div class="box-body">
            <iframe id="dato_actual" frameborder="0px" style="width: 100%; height: 210px;" src="../datos/dato_personal.php?ruta=11&fecha=2017-10-11"></iframe>
          </div>
        </div>
      </div>
       /.col -->

        

         <!-- REPORTES -->
        <section class="content">
          <div class="row">
            <div class="col-xs-13">
              <div class="box">

                <div class="box-header">
                  <div class="pull-right box-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Exportar Excel" onclick="exportexcelgps('<?php $promotores = implode(",", $nom); echo $promotores; ?>')">
                      <i class="ion ion-android-clipboard"></i></button>
                  </div>
                  <h3 class="box-title">Tiempos y Traslados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="examplenada" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                    <!-- TITULO -->
                      <th>Ruta</th>
                      <th>Cliente</th>
                      <th>Entrada</th>
                      <th>Salida</th>
                      <th>Servicio</th>
                      <th>Traslado</th>
                    </tr>
                    </thead>
                    <!-- Datos -->
                    <tbody id="tabla1">
                    <?php
                    //$activ=actividad($nom, $_POST['fecha_inicio'],$_POST['fecha_fin']);
                      /*include "../gps/capturar_tiendas.php";
                      //echo $resultados_tabla;
                      for ($i=0; $i < count($resultados_tabla1); $i++) 
                      { 
                        echo $resultados_tabla1[$i];
                      }*/

                      //include "../reporteweb/reporte.php";
                      $json1 = reporte($fecha_inicio, $fecha_fin, $nom);
                      $comprobar_fecha = "1999-12-30";

                      for ($i=0; $i < count($json1); $i++) 
                      {

                        if(!empty($json1[$i]['salida']))
                        {
                          //calcular traslado
                          $h_traslado = restatime($json1[$i]['entrada'], $json1[$i-1]['salida']);
                        }
                        else
                        {
                          $h_traslado = ""; 
                        } 

                        if($comprobar_fecha != $json1[$i]['fecha'])
                        {
                          $h_traslado = "";
                          $comprobar_fecha = $json1[$i]['fecha'];
                          $cont_fecha = 1;

                          echo  "<tr class='info'>
                                      <th colspan='6' style='text-align: center;'>".$json1[$i]['fecha']."</th>
                                    </tr>";
                          $cont++;
                        }
                        //Calcular servicio
                        $h_servicio = restatime($json1[$i]['salida'], $json1[$i]['entrada']);

                        

                        echo "<tr>
                                <td>".$json1[$i]['ruta']."</td>
                                <td>".$json1[$i]['nombre_cliente']."</td>
                                <td>".$json1[$i]['entrada']."</td>
                                <td>".$json1[$i]['salida']."</td>
                                <td>".$h_servicio."</td>
                                <td>".$h_traslado."</td>
                              </tr>";
                      }
                    ?>
                      <!--<tr>
                        <th colspan='6' style='text-align: center;'>2017-10-20</th>
                      </tr>
                      <tr>
                        <td>aqui</td>
                        <td>aqui</td>
                        <td>aqui</td>
                        <td>aqui</td>
                        <td>aqui</td>
                        <td>aqui</td>
                      </tr>-->
                    </tbody>
                    <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>

         <?php
            }
          ?>

    </section>
    <!-- /.content -->
</div>
      <!-- /.row -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Promotecnicas y Ventas S.A. de C.V.</strong>
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
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

<!-- Select2 -->
<script src="../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Page script -->

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script><!--Esta modificando-->
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>

<script src="../js/bootstrap-multiselect.js"></script>

<script>
  $(function () {

    //Direccion a partir las coordenadas

    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      format:'yyyy-mm-dd',
      autoclose: true
    });

    //Date picker
    $('#datepicker1').datepicker({
      format:'yyyy-mm-dd',
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "emptyTable":     "No hay datos disponibles en la tabla.",
      "paging": true,
      "lengthMenu":   [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "iDisplayLength": 7,
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":         "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "(filtrados de un total de _MAX_ registros)",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":     "Buscar:",
        "searchPlaceholder":    "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      },
      "columns" : [
        {"data": 0, 'orderable': false, 'searchable': false}
      ]
      

    });
    $('#example3').DataTable({
      "emptyTable":     "No hay datos disponibles en la tabla.",
      "paging": true,
      "lengthMenu":   [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "iDisplayLength": 5,
      "lengthChange": true,
      "searching": true,
      "language": {
        "emptyTable":     "No hay datos disponibles en la tabla.",
        "info":         "Del _START_ al _END_ de _TOTAL_ ",
        "infoEmpty":      "Mostrando 0 registros de un total de 0.",
        "infoFiltered":     "(filtrados de un total de _MAX_ registros)",
        "infoPostFix":      "(actualizados)",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords":   "Cargando...",
        "processing":     "Procesando...",
        "search":     "Buscar:",
        "searchPlaceholder":    "Dato para buscar",
        "zeroRecords":      "No se han encontrado coincidencias.",
        "paginate": {
          "first":      "Primera",
          "last":       "Última",
          "next":       "Siguiente",
          "previous":     "Anterior"
        },
        "aria": {
          "sortAscending":  "Ordenación ascendente",
          "sortDescending": "Ordenación descendente"
        }
      },
      "columns" : [
        {"data": 0, 'orderable': false, 'searchable': false}
      ]
      

    });

    $('#nom').multiselect({
      selectAllText: 'Seleccionar todos',
      nonSelectedText: 'No seleccionado',
      includeSelectAllOption: true,
      maxHeight: 350
    });    
  });

  var num_notifiacion = 0;
  var status = 0;
  setInterval(function(){ not(); }, 15000);

  function not()
  {
    $.post('../reporteweb/notificaciones_nuevo_ticket.php?cont='+num_notifiacion, function(data1, status){
        status = data1.split("-");
        //console.log(status[1]);

        if(status[1] == "0")
        {
          num_notifiacion = status[0];
          //console.log("Mostro la notificacion: "+num_notifiacion);
          $.post('../reporteweb/notificaciones_mostrar_ticket.php?icon=<?=$icon_usuario?>&click=<?=$click?>', function(data2, status){
              //num_notifiacion++;
              document.getElementById('ticket').innerHTML = data2;
          });
        }
    }); 
  }

  
</script>

<?php
  //MODAL
  echo "<script>";
          for ($i = 0; $i < count($json); $i++) 
          {
            echo "$('#myBtn".$i."').click(function(){
                    $('#myModal".$i."').modal();
                    //console.log('".$json[$i]['nickname']."---->".$json[$i]['fecha']."');
                    $.post('../reporteweb/crear_visitas.php?id_usuario=".$json[$i]['nickname']."&fecha=".$json[$i]['fecha']."', function(data, status){

                      document.getElementById('reportes".$i."').innerHTML = data;
                    });
                                        
                  });"; 
          }
  echo "</script>";

?>
</body>
</html>



