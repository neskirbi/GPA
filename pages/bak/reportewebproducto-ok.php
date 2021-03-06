<!DOCTYPE html>
<html>
<head>
	<title>Detalle de ruta</title>
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
	    /* The Close Button */
		.close {
		    color: #666666;
		    float: right;
		    font-size: 35px;
		    font-weight: bold;
		    width: 100%;
		    height: 50px;
		}
		.tabla {
    		width:100%;
		}
		.cliente
		{
			width:15%;
		}
		.cliecont
		{
			width:6.8%;
		}
		.clieconta
		{
			width:7%;
		}
		.cliecontaf
		{
			width:9%;
		}

	  </style>
</head>
<body class="hold-transition sidebar-mini skin-yellow sidebar-collapse" >
	<?php
		//ini_set('max_execution_time', 3000);
		date_default_timezone_set('America/Mexico_City');
		include "../conexion/conexion.php";
		include "../funciones/metodos/metodos1.php";
		include "../funciones/consultaKua.php";

		//Notificacion de ticket
		$icon_usuario = "../imagen/usuario2.png";
		$click = "ticket.php";
		
		//echo "<br><br><br><br><br>Movil: ".$_COOKIE['movil']."<br>";
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

		include "../funciones/funciones.php";

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

		
	    //Cargar en web
		if ($usu1 == 0) 
		{

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
	          Detalle de Ruta
	          <small style="color: white;">Por promotor</small>
	        </h1>
	      </div>

	      <div class="navbar-custom-menu">
	        <ul class="nav navbar-nav">
				<!--Notificacion de ticket-->
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
	        <li class="active treeview">
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
	                  		<form action="reportewebproducto.php" method="post">
	                  		<table>
	                  			<tr>
	                  				<td style="width: 230px;" align="right">
	                  					<b>Buscar tienda de la ultima visita: </b><input id="searchcliente" type="text" size='27px' onkeyup="doCLiente()" />
	                  				</td>
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
	                  <?php

	      					if ($_COOKIE['movil'] == 0) 
	      					{

	      				?>
	                  <h3 class="box-title">Tiempos y Traslados</h3>
	                  <?php

	      					}

	      				?>
	                </div>
	                <!-- /.box-header -->
	                <div class="box-body" >
	                	<div class="table-responsive" id='clienteultima'>
	                	</div>
	                	<div class="table-responsive">
	                  <table id="datos">
	                    <?php
			

							
							$dia = getDia($fecha);
							$igual = "primer";
							$ban = false;
							$p_entrada = "";
							$p_salida = "";
							$text_color = "";

							$nom_marcas = nombre_marcas($conexion);
							$json = reporteproductos($fecha, $conexion, $dia, $dni);

							for ($i=0; $i < count($json); $i++) 
							{ 
								//echo $json[$i]['ruta']."<br>";
								//Color Ruta o Fuera de ruta
								if($json[$i]['pertenece'] == 0)
								{
									$color = "style='background-color: #4656ea; color: #fff;'";		
									$adicional = "Visita de ruta";
								}
								else if($json[$i]['dia'] == 1 && !empty($json[$i]['entrada']))
								{
									$color = "style='background-color: #D0E9C6;'";
									$adicional = "En ruta";
								}
								else if($json[$i]['dia'] == 1)
								{
									$color = "style='background-color: #EBCCCC;'";
									$adicional = "No Visitada";

								}
								else
								{
									$color = "style='background-color: #f2eea4;'";
									$adicional = "Error en d&iacute;a";		
								}

								//Titulo
								if($igual != $json[$i]['ruta'])
								{	
									if($ban)
									{
										//total
										$h_trabajado = restatime($p_salida, $p_entrada);
										echo "<tr>
							                    <td>Total</td>
							                    <td></td>
							                    <td>".$p_entrada."</td>
							                    <td>".$p_salida."</td>
							                    <td></td>
							                    <td></td>
							                    <td>".$obj."</td>
							                    <td>".$visitadas."</td>
							                    <td>".$avance."%</td>
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
							                      <th></th>
							                      <th></th>
							                    </tr>
							                  </tfoot>
							                  </table></td></tr>";
							            $p_entrada = "";
								    	$p_salida = "";
									}
									$ban = true;
										
									echo "<tr><td>
										 <table class='tabla table table-bordered table-hover' >
											<thead>
											<tr>
												<th style='width=200px' colspan='5'>".$json[$i]['ruta']."-".$json[$i]['nombre']." ".$fecha."</th>
												<th>".$json[$i]['sesion']."</th>
												
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												
												
												<th colspan='".count($nom_marcas)."' style='text-align:center;'>Fotos</th>
											</tr>
									        <tr>
									        <!-- TITULO -->
									          <th class='cliente'>Cliente</th>
									          <th class='clieconta'>Estatus</th>
									          <th class='cliecont'>Entrada</th>
									          <th class='cliecont'>Salida</th>
									          <th class='cliecont'>Estancia</th>
									          <th class='cliecont'>Traslado</th>
									          <th class='cliecont'>Obj. d&iacute;a</th>
									          <th class='cliecont'>Real d&iacute;a</th>
									          <th class='cliecont'>Avance</th>
									          <th class='cliecont'>H. Trab</th>
									          <th class='cliecont'>% Bateria</th>
									          <th class='cliecont'>Packs</th>";
									          

									//Nombre de marcas
									for ($im=1; $im <= count($nom_marcas); $im++) 
									{ 
										echo "<th class='cliecontaf'>".$nom_marcas[$im]."</th>";	
									}

									if($_COOKIE['login']=='Soporte3'){
										echo "
											<th>Editar</th>
									        </tr>
								        </thead>
								        <!--<tbody>-->";
									}
									else{
										echo "
									        </tr>
								        </thead>
								        <!--<tbody>-->";
									}
									
								    $igual = $json[$i]['ruta'];
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
					            $style='';

					            if(checa_merma($json[$i]['FechaVisita'],$json[$i]['Id_cliente'],$conexion)){
					            	$style='color="#ff0000";width=200px';
					            }

					            echo "<tr>
					                    <td $color><font $style>".$json[$i]['nombre_cliente']."-".$json[$i]['Id_cliente']."</font></td>
					                    <td>".$adicional."</td>
					                    <td>".$json[$i]['entrada']."</td>
					                    <td>".$json[$i]['salida']."</td>
					                    <td>".$h_servicio."</td>
					                    <td>".$h_traslado."</td>
					                    <td>".$json[$i]['objetivo']."</td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td>".$json[$i]['bateria']."</td>
					                    <td><center><a href='' id='myBtn".$i."' data-toggle='modal' data-target='.bs-example-modal-lg'><img src='../imagen/reportes.png' width='20'></a></center>
					                    </td>";
					                    

				                //Nombre de marcas
								for ($im=1; $im <= count($nom_marcas); $im++) 
								{ 
									if ($json[$i]['fotos'][1]['boolean'] == true) 
									{
										echo "<td>";

										if (!empty($json[$i]['fotos'][$im]['fa_p1']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['fa_p1'])) 
										{
											echo "<a href='' id='FmyBtn".$i."fa_p1_".$im."' data-toggle='modal' data-target='.bs-example-modal-lg'><img style='width: 40%;' id='fa_p1_".$im."' src='../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['fa_p1']."'></a>&nbsp;&nbsp;  ";	
										}
										if (!empty($json[$i]['fotos'][$im]['fd_p1']) and file_exists("../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['fd_p1'])) 
										{
											echo "<a href='' id='FmyBtn".$i."fd_p1_".$im."' data-toggle='modal' data-target='.bs-example-modal-lg'><img style='width: 40%;' src='../Imagenes_CByD/productos_mini/".$json[$i]['fotos'][$im]['fd_p1']."'></a>";
										}
										
										echo "</td>";	
									}
									else
									{
										echo "<td></td>";
									}		
									 							
								}
								 if($_COOKIE['login']=='Soporte3'){
									echo "<td><a  href='editar_datos.php?id=".$json[$i]['Id_cliente']."&date=".$json[$i]['fecha']."' class='btn btn-info btn-flat'>Editar</a></td>";}	
					                    
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
										    	<div id='Freportes".$i."'>Descargando informacion...</div>
										    	<!--<div><button type='button' class='close' data-dismiss='modal'>&times;</button></div>-->
										    </div>
										  </div>
									  </div>
									  ";
								$obj = $json[$i]['obj_cliente'];
								$visitadas = $json[$i]['visitas'];
								$avance = round(($visitadas*100)/$obj, 2);
						            

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

		<?php
			}
			else if($usu1 == 1)//Cargar en movil
			{
				include "app/reportemovilproducto.php";
			}
			else
			{
				include "app/reportemovilproductoAvance.php";	
			}
		?>
	    
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

	var ban = true;
	var cliente_letra = "";
	function doCLiente()
	{
		var tableReg = document.getElementById('datos');
		var cliente = String(document.getElementById('searchcliente').value);


		if(cliente != "")
		{
			if(ban == true)
			{
				tableReg.style.display = 'none';
				ban = false;	
			}

			if(cliente_letra != cliente)
			{
				console.log(cliente);	
				cliente_letra = cliente;

				$.post('../reporteweb/cliente_ultima_visita.php?cliente='+cliente, function(data, status){
					            //alert('Data: ' + data + 'Status: ' + status);
					var separar = data.split('<->');

					if(separar[1] == cliente_letra)
					{
						document.getElementById('clienteultima').innerHTML = separar[0];
		            	console.log("Desde servidor: "+separar[1]);
					}
		        });
		    }
		}
		else
		{
			console.log("vacio");
			document.getElementById('clienteultima').innerHTML = '';
			tableReg.style.display = '';
			ban = true;
		}
	}

	function my_modal(cont, id_cliente, ruta, fecha)
	{
		console.log(fecha);
		$('#myModalsearch'+cont).modal();
		//alert('Posicion: '+cont);
		$.post('../reporteweb/crear_inventario.php?id_cliente='+id_cliente+'&id_usuario='+ruta+'&fecha='+fecha+'&movil=<?=$usu1?>', function(data, status){
			document.getElementById('reportessearch'+cont).innerHTML = data;
		});
	}

	function fmy_modal(cont, marca, fa_p1, fd_p1, fa_p2, fd_p2)
	{
		$('#FmyModalsearch'+cont).modal();
		//alert('Posicion: '+cont);

		$.post('../reporteweb/mostrar_foto.php?fotoa1='+fa_p1+'&fotod1='+fd_p1+'&fotoa2='+fa_p2+'&fotod2='+fd_p2+'&marca='+marca+'&movil=<?=$usu1?>', function(data, status){

            document.getElementById('Freportessearch'+cont).innerHTML = data;
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
			   echo "$('#FmyBtn".$i."fa_p1_".$im."').click(function(){
                    $('#FmyModal".$i."').modal();
                    //alert(".$i."+'-------'+".$json[$i]['Id_cliente'].");

                    $.post('../reporteweb/mostrar_foto.php?fotoa1=".$json[$i]['fotos'][$im]['fa_p1']."&fotod1=".$json[$i]['fotos'][$im]['fd_p1']."&fotoa2=".$json[$i]['fotos'][$im]['fa_p2']."&fotod2=".$json[$i]['fotos'][$im]['fd_p2']."&marca=".$nom_marcas[$im]."&movil=".$usu1."', function(data, status){
			            //alert('Data: ' + data + 'Status: ' + status);

			            document.getElementById('Freportes".$i."').innerHTML = data;
			        });

                    //console.log('fa_p1_".$im."-'+'".$json[$i]['fotos'][$im]['fa_p1']."');
                  });"; 

                 echo "$('#FmyBtn".$i."fd_p1_".$im."').click(function(){
                    $('#FmyModal".$i."').modal();
                    //alert(".$i."+'-------'+".$json[$i]['Id_cliente'].");

                    $.post('../reporteweb/mostrar_foto.php?fotoa1=".$json[$i]['fotos'][$im]['fa_p1']."&fotod1=".$json[$i]['fotos'][$im]['fd_p1']."&fotoa2=".$json[$i]['fotos'][$im]['fa_p2']."&fotod2=".$json[$i]['fotos'][$im]['fd_p2']."&marca=".$nom_marcas[$im]."&movil=".$usu1."', function(data, status){
			            //alert('Data: ' + data + 'Status: ' + status);

			            document.getElementById('Freportes".$i."').innerHTML = data;
			        });

                    //console.log('fd_p1_".$im."-'+'".$json[$i]['fotos'][$im]['fd_p1']."');
                  });"; 

			}
          }
	echo "</script>";

?>
</body>
</html>