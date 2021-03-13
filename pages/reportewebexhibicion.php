<!DOCTYPE html>
<html>
<head>
	<title>Exhibici&oacute;n Adicional</title>
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
</head>
<body class="hold-transition sidebar-mini skin-yellow sidebar-collapse" >
	<?php
		date_default_timezone_set('America/Mexico_City');
		include "../conexion/conexion.php";
		include "../funciones/metodos/metodos1.php";
		include "../funciones/consultaKua.php";
		include "../funciones/funciones.php";

		if(!isset($_COOKIE["login"]))
		{  
			include("login/loginuser.php"); 
		}
		$usu = $_COOKIE['login'];
		$usu1 = $_COOKIE['movil'];
		$dni = $_COOKIE['dni'];

		if(isset($_POST['fecha_inicio']))
	    {
	      $fecha = $_POST['fecha_inicio'];
	      $fecha = date('Y-n-d', strtotime($fecha));
	      $fecha_fin = $_POST['fecha_fin'];
	      $fecha_fin = date('Y-n-d', strtotime($fecha_fin));
	    }
	    else
	    {
	      $fecha = date("Y-n-d");
	      $fecha_fin = date("Y-n-d");
	    }

	    $hora = date("H:i:s", time());
    	$fecha_actual = date("Y-m-d");

	    $foto_usu = "../imagen/usuario2.png";
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
	      </a>

	      <div class="titulo">
	        <h1 style="font-size: 23px;">
	          Exhibici&oacute;n Adicional
	          <small style="color: white;">Por promotor</small>
	        </h1>
	      </div>

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
	        <li class="treeview">
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
	       
	        <li class="active treeview">
	          <a href="reportewebexhibicion.php">
	            <i class="ion ion-cube"></i> <span>Exhibici&oacute;n adicional</span>
	          </a>
	        </li>
		  <li class="treeview">
            <a href="competencia.php">
              <i class="ion ion-cube"></i> <span>Competencia</span>
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
		        	echo "	<li class='treeview'>
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
	    </section>
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

	    <!--Resporte productos-->
	    <section class="content">
	    	<!-- REPORTE Productos-->
	        <section class="content">
	          <div class="row">
	            <div class="col-xs-13">
	              <div class="box">

	                <div class="box-header">
	                  <div class="pull-right box-tools">
	                  	<div class="box-tools pull-right">
	                  		<form action="reportewebexhibicion.php" method="post">
	                  		<table>
	                  			<tr>
	                  				<td style="width: 230px;" align="right">
	                  					<b>Buscar tienda o nombre de ruta: </b><input id="searchTerm" type="text" size='27px' onkeyup="doSearch()" />
	                  				</td>
	                  				<td style="width: 230px;" align="right">
		                  					Inicio: 
		                  				 <input type="date" style='width: 180px;' class="form-control pull-right" name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>">
	                  				</td>
	                  				<td style="width: 230px;" align="right">
	                  					Fin: <input type="date" style='width: 180px;' class="form-control pull-right" name="fecha_fin" id="fecha_fin" value="<?php echo date('Y-m-d', strtotime($fecha_fin)); ?>">
	                  				</td>
	                  				<td style="width: 50px;">
	                  					<button type="submit" class="btn btn-info btn-flat">Buscar</button>
	                  				</td>
	                  				<td style="width: 40px;">
	                  					<button type="button" class="btn btn-warning btn-sm daterange pull-right" data-toggle="tooltip" title="Layout con fotos" onclick="exportexcelnew()">
	                      				<i class="fa fa-file-photo-o"></i></button>
	                      			</td>
	                      			<td style="width: 40px;">
	                      				<button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Layout sin fotos" onclick="exportexcelnewsin()">
	                      				<i class="fa fa-file-excel-o"></i></button>
	                      			</td>
	                      			<td style="width: 40px;">
	                      				<button type="button" class="btn btn-success btn-sm daterange pull-right" data-toggle="tooltip" title="Tiempos y Traslados" onclick="exportexcel()">
	                      				<i class="ion ion-android-clipboard"></i></button>
	                      			</td>
	                  			</tr>
	                  		</table>
	                  		</form>
		                 </div>
	                    <!--<button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Exportar Excel" onclick="exportexcelgps('<?php $promotores = implode(",", $nom); echo $promotores; ?>')">
	                      <i class="ion ion-android-clipboard"></i></button>-->
	                  </div>
	                  <h3 class="box-title">Reporte de Exhibici&oacute;n</h3>
	                </div>
	                <!-- /.box-header -->
	                <div class="box-body">
	                	<div class="table-responsive">
	                  <table id='datos' >
	                    <?php
			

							
							$dia = getDia($fecha);
							$igual = "primer";
							$ban = false;
							$p_entrada = "";
							$p_salida = "";

							$nom_marcas = nombre_marcas($conexion);
							$json = reporteproductos($fecha, $conexion, $dia, $dni);

							for ($i=0; $i < count($json); $i++) 
							{ 
								//Color Ruta o Fuera de ruta
								if($json[$i]['dia'] == 1 && !empty($json[$i]['entrada']))
								{
									$color = "style='background-color: #D0E9C6; vertical-align: middle;'";
								}
								else if($json[$i]['dia'] == 1)
								{
									$color = "style='background-color: #EBCCCC; vertical-align: middle;'";	
								}
								else
								{
									$color = "style='background-color: #f2eea4; vertical-align: middle;'";		
								}

								//Titulo
								if($igual != $json[$i]['nombre'])
								{	
									if($ban)
									{
										//total
										$h_trabajado = restatime($p_salida, $p_entrada);
										echo "<tr>
							                    <td>Total</td>
							                    <td>".$p_entrada."</td>
							                    <td>".$p_salida."</td>
							                    <td></td>
							                    <td></td>
							                    <!--<td>".$obj."</td>-->
							                    <!--<td>".$visitadas."</td>-->
							                    <!--<td>".$avance."%</td>-->
							                    <td>".$h_trabajado."</td>
							                    <td></td>
							                    <td></td>";
							            //Nombre de marcas
										for ($im=1; $im <= count($nom_marcas); $im++) 
										{ 
											echo "<td></td>";	
										}
							                    
							            echo "</tr>
							                  <tfoot>
							                    <tr>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                      <th></th>
							                    </tr>
							                  </tfoot>
							                  </table></td></tr>";
							            $p_entrada = "";
								    	$p_salida = "";
									}
									$ban = true;

									$obj = $json[$i]['obj_cliente'];
									$visitadas = $json[$i]['visitas'];
									$avance = round(($visitadas*100)/$obj, 2);
										
									echo "<tr><td>
										 <table class='table table-bordered table-hover' >
										  <thead>
											<tr>
												<th style='vertical-align: middle;'>".$json[$i]['ruta']."-".$json[$i]['nombre']." ".$fecha."</th>
												<th style='vertical-align: middle;'>Obj. d&iacute;a:</th>
												<td style='vertical-align: middle;'>".$obj."</td>
												<th style='vertical-align: middle;'>Real d&iacute;a:</th>
												<td style='vertical-align: middle;'>".$visitadas."</td>
												<th style='vertical-align: middle;'>Avance:</th>
												<td style='vertical-align: middle;'>".$avance."%</td>
												<th style='vertical-align: middle;'></th>
												<!--<th style='vertical-align: middle;'></th>-->
												<!--<th style='vertical-align: middle;'></th>-->
												<!--<th style='vertical-align: middle;'></th>-->
												<th colspan='".(count($nom_marcas)+count($nom_marcas))."' style='text-align:center; vertical-align: middle;'>Fotos de Exhibici&oacute;n adicional</th>
											</tr>
									        <tr>
									        <!-- TITULO -->
									          <th>Cliente</th>
									          <!--<th>Determinante</th>-->
									          <th>Entrada</th>
									          <th>Salida</th>
									          <th>Estancia</th>
									          <th>Traslado</th>
									          <!--<th>Obj. d&iacute;a</th>-->
									          <!--<th>Real d&iacute;a</th>-->
									          <!--<th>Avance</th>-->
									          <th>H. Trab</th>
									          <th>% Bateria</th>
									          <th>Inventarios</th>";

									//Nombre de marcas
									for ($im=1; $im <= count($nom_marcas); $im++) 
									{ 
										echo "<th>".$nom_marcas[$im]."</th>
											  <th>piezas</th>";	
									}


									echo "
									        </tr>
								        </thead>
								        <!--<tbody>-->";
								    $igual = $json[$i]['nombre'];
								    //Obtener entrada
								    $p_entrada = $json[$i]['entrada'];
								}

								if(!empty($json[$i]['salida']))
					            {
					              //calcular traslado
					              $h_traslado = restatime($json[$i]['entrada'], $json[$i-1]['salida']);
					            }
					            else
					            {
					              $h_traslado = ""; 
					            } 

					            //Calcular servicio
					            $h_servicio = restatime($json[$i]['salida'], $json[$i]['entrada']);

					            if($h_servicio == "00:00:00")
					            {
					            		$h_servicio = "";
					            }

					            echo "<tr>
					                    <td $color width='10%'>".$json[$i]['nombre_cliente']."-".$json[$i]['Id_cliente']."</td>
					                    <!--<td style='vertical-align: middle;'>".$json[$i]['determinante']."</td>-->
					                    <td style='vertical-align: middle;'>".$json[$i]['entrada']."</td>
					                    <td style='vertical-align: middle;'>".$json[$i]['salida']."</td>
					                    <td style='vertical-align: middle;'>".$h_servicio."</td>
					                    <td style='vertical-align: middle;'>".$h_traslado."</td>
					                    <!--<td style='vertical-align: middle;'></td>-->
					                    <!--<td style='vertical-align: middle;'></td>-->
					                    <!--<td style='vertical-align: middle;'></td>-->
					                    <td style='vertical-align: middle;'></td>
					                    <td style='vertical-align: middle;'>".$json[$i]['bateria']."</td>
					                    <td style='vertical-align: middle;'><center><a href='' id='myBtn".$i."' data-toggle='modal' data-target='.bs-example-modal-lg'><img src='../imagen/reportes.png' width='20'></a></center></td>";

				                //Nombre de marcas
								for ($im=1; $im <= count($nom_marcas); $im++) 
								{ 
									if ($json[$i]['fotos'][1]['boolean'] == true) 
									{
										echo "<td>";

										if (!empty($json[$i]['fotos'][$im]['f_exh1']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh1'])) 
										{
											echo "<a href='' id='FmyBtn".$i."f_exh1".$im."' data-toggle='modal' data-target='.bs-example-modal-lg'><img style='width: 65px;' id='f_exh1".$im."' src='../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh1']."'></a>&nbsp;&nbsp;  ";	
										}
										if (!empty($json[$i]['fotos'][$im]['f_exh2']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh2'])) 
										{
											echo "<a href='' id='FmyBtn".$i."f_exh1".$im."' data-toggle='modal' data-target='.bs-example-modal-lg'><img style='width: 65px;' src='../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh2']."'></a>";
										}
										if (!empty($json[$i]['fotos'][$im]['f_exh3']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh3'])) 
										{
											echo "<a href='' id='FmyBtn".$i."f_exh1".$im."' data-toggle='modal' data-target='.bs-example-modal-lg'><img style='width: 65px;' src='../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh3']."'></a>";
										}
										
										echo "</td>";
										//Numero de piezas
										echo "<td style='vertical-align: middle;'>";
										if (!empty($json[$i]['fotos'][$im]['f_exh1']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['f_exh1'])) 
										{
											echo $json[$i]['fotos'][$im]['piezas'];	
										}
										echo "</td>";
									}
									else
									{
										echo "<td></td>";
										echo "<td></td>";
									}										
								}
					                    
					            echo "</tr>
					                  <div class='modal fade' role='dialog' id='myModal".$i."'>
										  <div class='modal-dialog modal-lg' role='document'>
										    <div class='modal-content' id='reportes".$i."'>
										      Descargando informacion...
										    </div>
										  </div>
									  </div>
									  <div class='modal fade' role='dialog' id='FmyModal".$i."'>
										  <div class='modal-dialog modal-lg' role='document'>
										  	<div class='modal-content'>
											    <div id='Freportes".$i."'>
											      Descargando informacion...
											    </div>
											</div>
										  </div>
									  </div>
									  ";
						            

					            //Obtener salida
					            if(!empty($json[$i]['salida']) || $json[$i]['salida'] != "" || $json[$i]['salida'] != null)
					            {
					            	$p_salida = $json[$i]['salida'];
					            }
							}
							echo "	<!--</tbody>-->";
						
				//<td>".$h_servicio."</td>
				//<td>".$h_traslado."</td>


					?>
	                   </table> 
	              </div>
	                </div>
	                <!-- /.box-body -->
	              </div>
	              <!-- /.box -->
	            </div>
	            <!-- /.col -->
	          </div>
	          <!-- /.row -->
	        </section>
	    </section>
	    <!-- /.content -->
	</div>
	 <footer class="main-footer">
	    <div class="pull-right hidden-xs">
	      <b>Version</b> 1.0.0
	    </div>
	    <strong>Promotecnicas y Ventas S.A. de C.V.</strong>
	  </footer>

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

<script type="text/javascript">
	$(function(){
		//Date picker
	    $('#datepicker1').datepicker({
	      format:'yyyy-mm-dd',
	      autoclose: true
	    });
	});

	function doSearch()
	{
		var tableReg = document.getElementById('datos');
		var searchText = document.getElementById('searchTerm').value.toLowerCase();
		var cellsOfRow="";
		var found=false;
		var compareWith="";

		// Recorremos todas las filas con contenido de la tabla
		for (var i = 0; i < tableReg.rows.length; i++)
		{
			cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
			found = false;
			// Recorremos todas las celdas
			for (var j = 0; j < cellsOfRow.length && !found; j++)
			{
				compareWith = cellsOfRow[j].innerHTML.toLowerCase();
				// Buscamos el texto en el contenido de la celda
				if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
				{
					found = true;
				}
			}
			if(found)
			{
				tableReg.rows[i].style.display = '';
			} else {
				// si no ha encontrado ninguna coincidencia, esconde la
				// fila de la tabla
				tableReg.rows[i].style.display = 'none';
			}
		}



	}
</script>
<?php

  //MODAL
  echo "<script>";
          for ($i = 0; $i < count($json); $i++) 
          {
            echo "$('#myBtn".$i."').click(function(){
                    $('#myModal".$i."').modal();
                    //alert(".$i."+'-------'+".$json[$i]['Id_cliente'].");

                    $.post('../reporteweb/crear_inventario.php?id_cliente=".$json[$i]['Id_cliente']."&id_usuario=".$json[$i]['ruta']."&fecha=".$fecha."&movil=".$usu1."', function(data, status){
			            //alert('Data: ' + data + 'Status: ' + status);

			            document.getElementById('reportes".$i."').innerHTML = data;
			        });

                    //var info = document.getElementById('reportes');
                  });"; 

            //Nombre de marcas
			for ($im=1; $im <= count($nom_marcas); $im++) 
			{
				   echo "$('#FmyBtn".$i."f_exh1".$im."').click(function(){
	                    $('#FmyModal".$i."').modal();
	                    //alert(".$i."+'-------'+".$json[$i]['Id_cliente'].");

	                    $.post('../reporteweb/mostrar_foto_exhibicion.php?fotoex1=".$json[$i]['fotos'][$im]['f_exh1']."&fotoex2=".$json[$i]['fotos'][$im]['f_exh2']."&fotoex3=".$json[$i]['fotos'][$im]['f_exh3']."&marca=".$nom_marcas[$im]."&movil=".$usu1."', function(data, status){
				            //alert('Data: ' + data + 'Status: ' + status);

				            document.getElementById('Freportes".$i."').innerHTML = data;
				        });

	                    //console.log('fa_p1_".$im."-'+'".$json[$i]['fotos'][$im]['fa_p1']."');
	                  });"; 

	                 /*echo "$('#FmyBtn".$i."fd_p1_".$im."').click(function(){
	                    $('#FmyModal".$i."').modal();
	                    //alert(".$i."+'-------'+".$json[$i]['Id_cliente'].");

	                    $.post('../reporteweb/mostrar_foto.php?fotoa1=".$json[$i]['fotos'][$im]['fa_p1']."&fotod1=".$json[$i]['fotos'][$im]['fd_p1']."&fotoa2=".$json[$i]['fotos'][$im]['fa_p2']."&fotod2=".$json[$i]['fotos'][$im]['fd_p2']."&marca=".$nom_marcas[$im]."&movil=".$usu1."', function(data, status){
				            //alert('Data: ' + data + 'Status: ' + status);

				            document.getElementById('Freportes".$i."').innerHTML = data;
				        });

	                    //console.log('fd_p1_".$im."-'+'".$json[$i]['fotos'][$im]['fd_p1']."');
	                  });";*/ 
			}
          }
  echo "</script>";

?>
</body>
</html>