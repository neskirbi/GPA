<!DOCTYPE html>
<html>
<head>
	<title>Detalle de ruta</title>
	 <!-- Tell the browser to be responsive to screen width -->
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <meta charset="UTF-8">
          <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>

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
                
                require "libs/Mobile_Detect.php";
                $detect = new Mobile_Detect;
		
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
	      </a>

	      <div class="titulo">
	        <h1 style="font-size: 23px;">
	        	Avance
	        <small style="color: white;"></small>
	        </h1>
	      </div>

	      <div class="navbar-custom-menu">
	        <ul class="nav navbar-nav">
				
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
		        	echo "	<li class='active treeview'>
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
	              echo "<li class='active treeview'>
	                    <a href='asistencia.php'>
	                      <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
	                    </a>
	                  </li>";
	            }
	        
	        ?>
	        
	      </ul>
	    </section>
	    <!-- /.sidebar -->
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	    
            <!-- REPORTE Productos-->
            <section class="content">
              <div class="row">
                <div class="col-xs-12">
                  <div class="box ">
                    <div class="box-header">
                      <?php

                        if ($_COOKIE['movil'] == 0) 
                        {
                            echo "<h3 class='box-title'>Avance</h3>";
                        }
                        ?>
                        <div class="table-responsive ">
                            <form action="avance.php" method="post">
                                <table class="table table-condensed">
                                    <tr>
                                        <td >
                                            <div class="input-group col-xs-1">
                                                <input style="width:120px;" type="date" class="form-control input-sm " name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>">
                                            </div>
                                        </td>
                                        <td  >
                                            <div class="input-group col-xs-1 ">
                                                <input style="width:120px;" type="date" class="form-control input-sm" name="fecha_fin" id="fecha_fin" value="<?php echo date('Y-m-d', strtotime($fecha_fin)); ?>">
                                            </div>
                                        </td>
                                        <td >
                                            <div class="input-group col-xs-1 ">
                                                <button type="submit" class="btn btn-info btn-flat btn-sm ">Buscar</button>
                                            </div>
                                        </td>
                                        <!--<td> <button class="btn btn-facebook btn-flat btn-sm" onclick="tableToExcel('tabla', 'asistencia')" data-toggle="tooltip" title="Exportar"><i class="fa fa-file-excel-o"></i></button></td>-->
                                    </tr>
                                </table>
                            </form>
                         </div>
                        <button class="btn btn-block bg-olive-active" onclick="expo_mon();"><i class="fa fa-file-excel-o"></i> Exportar</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="tablaAvance" name="tablaAvance">
                                <thead>
                                    <tr>
                                        <th style="text-align:center">Cumple plan</th>
                                        <th style="text-align:center">Operador</th>
                                        <th style="text-align:center">Ciudad</th>
                                        <th style="text-align:center">Fecha</th>
                                        <th style="text-align:center;">Tiendas Objetivo</th>
                                        <th style="text-align:center">Tiendas en Plan</th>
                                        <th style="text-align:center">Tiendas Fuera de Plan</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <?php
                                       $array=array();
                                       $array=getAvance($fecha,$fecha_fin);
                                       for($i=0;$i<count($array);$i++){
                                           if($array[$i]['cumple']=='No'){
                                               $mod=" class='btn btn-danger btn-sm'";
                                           }
                                           else if($array[$i]['cumple']=='Par'){
                                               $mod=" class='btn btn-warning btn-sm'";
                                           }
                                           else{
                                               $mod=" class='btn btn-success btn-sm'";
                                           }
                                           echo "<tr>";
                                           echo "<td align='center'><button $mod>".$array[$i]['cumple']."</button></td>";
                                           echo "<td >".$array[$i]['nombre']."</td>";
                                           echo "<td >".$array[$i]['ciudad']."</td>";
                                           echo "<td align='center'>".$array[$i]['fecha']."</td>";
                                           
                                           echo "<td align='center'>".$array[$i]['objetivo']."</td>";
                                           echo "<td align='center'> ".$array[$i]['plan']."</td>";
                                           echo "<td align='center'>".$array[$i]['noplan']."</td></tr>";
                                       }
                                    ?>
                                </tbody>
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
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>


<script type="text/javascript">
    $(document).ready( function () {
    $('#tablaAvance').DataTable({
        ordering:true,
        searching:false,
        paging:false,
        info:false,
        fixedHeader: true
    });
} );
function expo_mon() {
    var fecha = document.getElementById('fecha_inicio').value;
    var ft = fecha.split('-');
    ft[1] = ft[1].replace("0", "");
    fecha = ft.join('-');

    var fecha2 = document.getElementById('fecha_fin').value;
    var ft = fecha2.split('-');
    ft[1] = ft[1].replace("0", "");
    fecha2 = ft.join('-');

    window.open('../reportesexcel/monitoreo_excel.php?fecha=' + fecha + '&fecha2=' + fecha2, '_blank');
}
</script>
</body>
</html>