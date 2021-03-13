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
	  </style>
</head>
<body class="hold-transition sidebar-mini skin-yellow sidebar-collapse" >
	<?php
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
					if($row->Id_tipouser == 3)
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
	          Actualizar
	          <small style="color: white;">clientes</small>
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
	        <li class="treeview">
	          <a href="ticket.php">
	            <i class="ion ion-android-checkbox-outline"></i> <span>Ticket</span>
	          </a>
	        </li>
	        <li class="treeview">
	          <a href="reportewebexhibicion.php">
	            <i class="ion ion-cube"></i> <span>Exhibici&oacute;n adicional</span>
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
					        <li class='active treeview'>
					          <a href='actualizartienda.php'>
					            <i class='ion ion-ios-cart'></i> <span>Actualizar cliente</span>
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
	                  		<form action="actualizartienda.php" method="post">
	                  		<table>
	                  			<tr>
	                  				<td style="width: 310px; vertical-align: middle;" align="right">
		                  				Nombre de tienda:
		                  				 <input type="text" style='width: 180px;' class="form-control pull-right" name="RazonSocial">
	                  				</td>
	                  				<td style="width: 240px; vertical-align: middle; display: none" align="right">
		                  				ID cliente:
		                  				 <input type="text" style='width: 180px;' class="form-control pull-right" name="id_cliente">
	                  				</td>
	                  				<td style="width: 230px;" align="right">
	                  					Ruta:
	                  					<input type="text" style='width: 180px;' class="form-control pull-right" name="id_usuario">
	                  				</td>
	                  				<td style="width: 50px;">
	                  					<button type="submit" class="btn btn-info btn-flat">Buscar</button>
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
	                  <h3 class="box-title">Actualizar</h3>
	                  <?php

	      					}

	      				?>
	                </div>
	                <!-- /.box-header -->
	                <div class="box-body">
	                	<div class="table-responsive">
	                  <table id="examplenada" class="table table-bordered table-hover">
	                  	<tr>
	                  		<th>ID cliente</th>
	                  		<th>Nombre</th>
                                        <th>Cadena</th>
	                  		<th>Latitud</th>
	                  		<th>Longitud</th>
	                  		<th>Ruta</th>
	                  		<th>Ultima Visita</th>
	                  		<th>Guardar</th>
	                  	</tr>
	                    <?php
							
							if(isset($_POST['id_cliente']) and !empty($_POST['id_cliente']))
							{
								$id_cliente = $_POST['id_cliente'];
							}
							else
							{
								$id_cliente = "";
							}

							if(isset($_POST['id_usuario']) and !empty($_POST['id_usuario']))
							{
								$id_usuario = $_POST['id_usuario'];
							}
							else
							{
								$id_usuario = "";	
							}

							if(isset($_POST['RazonSocial']) and !empty($_POST['RazonSocial']))
							{
								$RazonSocial = $_POST['RazonSocial'];
							}
							else
							{
								$RazonSocial = "";	
							}

							if(!empty($id_cliente) or !empty($id_usuario) or !empty($RazonSocial))
							{
								$json = actualizar_cliente($conexion, $id_cliente, $id_usuario, $RazonSocial);

								for ($i=0; $i < count($json); $i++) 
								{
									echo "<tr>
											<td>".$json[$i]['id_cliente']."</td>
											<td>".$json[$i]['RazonSocial']."</td>
                                                                                        <td>".$json[$i]['cadena']."</td>    
											<td><input type='text' id='lat".$json[$i]['id_cliente']."' value='".$json[$i]['Lat']."'></td>
											<td><input type='text' id='lon".$json[$i]['id_cliente']."' value='".$json[$i]['Lon']."'></td>
											<td>".$json[$i]['id_usuario']."</td>
                                                                                        <td><input type='text' id='visita".$json[$i]['id_cliente']."' value='".$json[$i]['cl_ultvisita']."'></td>    
											<td><input type='button' name='guardar' value='Guardar' onclick='guardar(".$json[$i]['id_cliente'].")'></td>
										  </tr>";
								}
							}
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
	function guardar(id_cliente)
	{
		var lat = document.getElementById("lat"+id_cliente).value;
		var lon = document.getElementById("lon"+id_cliente).value;
                var visita=document.getElementById("visita"+id_cliente).value;

		window.open("../actualizar/actualizar_cliente.php?id_cliente="+id_cliente+"&lat="+lat+"&lon="+lon+"&visita="+visita, "actualizar", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=600, height=200");
	}
</script>
</body>
</html>