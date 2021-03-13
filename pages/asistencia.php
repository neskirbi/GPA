<!DOCTYPE html>
<html>
<head>
	<title>Asistencia</title>
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

	  <header class="main-header">
	    <!-- Logo -->
		
		<a href="../" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini"><b>S</b>MC</span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg"><b>Sistema </b>Asistencia</span>
	    </a>
	
	    <!-- Header Navbar: style can be found in header.less -->
	    <nav class="navbar navbar-static-top">
	      <!-- Sidebar toggle button-->
	      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	        <span class="sr-only">Toggle navigation</span>
	      </a>

	      <div class="titulo">
	        <h1 style="font-size: 23px;">
	        	Asistencia
	        <small style="color: white;"></small>
	        </h1>
	      </div>

	      <div class="navbar-custom-menu">
	        <ul class="nav navbar-nav">
				
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
	            <i class="fa fa-dashboard"></i> <span>Confirmar Asistencia</span>
	          </a>
	        </li>
	      
	        <?php

		        if($_COOKIE['ref']!= 5)
		        {
		        	echo "	<li class='active treeview'>
					          <a href='asistencia.php'>
					            <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
					          </a>
					        </li>";
		        }
		    	        
	        ?>

	          <li class='treeview'>
                    <a href='periodo_consulta.php'>
                      <i class="fa fa-users" aria-hidden="true"></i> <span>Nomina</span>
                    </a>
                  </li>
	      
	      </ul>
	    </section>
	  
	  </aside>

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
	

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
	                  		<form action="asistencia.php" method="post">
	                  		<table>
	                  			<tr>
	                  				<td style="width: 230px;" align="right">
		                  				Fecha Inicio:  <input type="date" style='width: 180px;' class="form-control pull-right" name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>">
	                  				</td>
                                                        <td style="width: 230px;" align="right">
		                  				Fecha Fin: <?php echo $dni; ?> <input type="date" style='width: 180px;' class="form-control pull-right" name="fecha_fin" id="fecha_fin" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>">
	                  				</td>
	                  				<td style="width: 50px;">
	                  					<button type="submit" class="btn btn-info btn-flat">Buscar</button>
	                  				</td>
                                                        <td> <button class="btn btn-facebook btn-flat" onclick="tableToExcel('tabla', 'asistencia')" data-toggle="tooltip" title="Exportar"><i class="fa fa-file-excel-o"></i></button></td>
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
                                echo "<h3 class='box-title'>Lista de asistencias</h3>";
                            }
                            ?>
	                </div>
	                <!-- /.box-header -->
	                <div class="box-body">
                            
	                	<div class="table-responsive">
	                		<table id="examplenada" class="table table-bordered table-hover">
					<?php
                                            $json = asistencia($conexion, $fecha,$fecha_fin);
                                            $json1 = resumen_asistencia($conexion, $fecha,$fecha_fin);
                                            $motivo = motivo($conexion);							

                                            echo "<tr>
                                                    <th>Fecha</th>
                                                    <th>En tiempo</th>
                                                    <th>Retardo</th>";
                                            //echo "</tr>";
                                            $tiempo = 0;
                                            $retardo = 0;
                                            for ($i=0; $i < count($json); $i++) 
                                            {
                                                if($json[$i]['entrada'] > "08:00:00")
                                                {
                                                    $retardo++;
                                                }
                                                else
                                                {
                                                    $tiempo++;
                                                }
                                            }

                                            for ($i=0; $i < count($motivo); $i++) 
                                            { 
                                                if(!empty($motivo[$i]['motivo']))
                                                {
                                                    echo "<th>".$motivo[$i]['motivo']."</th>";
                                                }
                                                else
                                                {
                                                    echo "<th>Asisti&oacute;</th>";	
                                                }
                                            }

                                            echo "</tr>";

                                            echo "	<tr>
                                                        <td>".$fecha."</td>
                                                        <td>".$tiempo."</td>
                                                        <td>".$retardo."</td>";
                                            for ($i=0; $i < count($motivo); $i++) 
                                            { 
                                                if($json1[$motivo[$i]['id_motivo']]['id_motivo'] == $motivo[$i]['id_motivo'])
                                                {
                                                    echo "<td>".$json1[$motivo[$i]['id_motivo']]['motivo']."</td>";
                                                }
                                                else
                                                {
                                                    echo "<td>0</td>";
                                                }
                                            }
                                            echo "</tr>";
                                            ?>
		                	</table><br>

	                  		<table id="tabla" name="tabla" class="table table-bordered table-hover">
	                  			<tr>
	                  				<th>Fecha</th>
	                  				<th>Cedis</th>
	                  				<th>No. Empleado</th>
	                  				<th>Promotor</th>
	                  				<th>Motivo</th>
	                  			</tr>
                                                <?php
                                                        for ($i=0; $i < count($json); $i++) 
                                                        { 
                                                            if(empty($json[$i]['motivo']))
                                                            {
                                                                $asistencia = "Asisti&oacute;";
                                                            }
                                                            else
                                                            {
                                                                $asistencia = $json[$i]['motivo'];
                                                            }
                                                            if($json[$i]['entrada'] > "08:00:00")
                                                            {
                                                                $retardo = "style='color: #ce1e1e; font-weight: bold;'";
                                                            }
                                                            else
                                                            {
                                                                $retardo = "";	
                                                        }
                                                        echo "<tr>
                                                                <td>".$json[$i]['fecha']."</td>
                                                                <td>".$json[$i]['supervisor']."</td>
                                                                <td>".$json[$i]['id_usuario']."</td>
                                                                <td>".$json[$i]['nombre']."</td>
                                                                <td>".$asistencia."</td>
                                                             </tr>";
                                                        }
                                                        odbc_close($conexion);
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
        var link = document.createElement('a');
        link.download = 'asistencia.xls';
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,'
              , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
              , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))); }
              , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }); };
            return function(table, name) {
              if (!table.nodeType) table = document.getElementById(table);
              var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML};
              link.href = uri + base64(format(template, ctx));
              link.click();
                };
        })();
</script>
</body>
</html>