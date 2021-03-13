
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
	          Detalle de Ruta
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

	    	<!-- REPORTE Productos-->
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
		                  				<input type="date" style='width: 180px;' class="form-control pull-right" name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>">
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
	                </div>
	                <!-- /.box-header -->
	                <div class="box-body">
	                	<div class="table-responsive">
	                  <table id="examplenada" class="table table-bordered table-hover">
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
								if($json[$i]['pertenece'] == 0)
								{
									$color = "style='background-color: #4656ea; color: #fff;'";		
									$adicional = "Fuera de ruta";
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
								if($igual != $json[$i]['nombre'])
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
							                    <!--<td>".$obj."</td>-->
							                    <!--<td>".$visitadas."</td>-->
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
							                  </tfoot>";
							            $p_entrada = "";
								    	$p_salida = "";
									}
									$ban = true;

									$obj = $json[$i]['obj_cliente'];
									$visitadas = $json[$i]['visitas'];
									$avance = round(($visitadas*100)/$obj, 2);
										
									echo "<thead>
											<tr>
												<th>".$json[$i]['ruta']."-".$json[$i]['nombre']." ".$fecha."</th>
												<th>Obj. d&iacute;a:</th>
												<td>".$obj."</td>
												<th>Real d&iacute;a:</th>
												<td>".$visitadas."</td>
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
									          <th>Cliente</th>
									          <th>Estatus</th>
									          <th>Entrada</th>
									          <th>Salida</th>
									          <th>Estancia</th>
									          <th>Traslado</th>
									          <!--<th>Obj. d&iacute;a</th>-->
									          <!--<th>Real d&iacute;a</th>-->
									          <th>Avance</th>
									          <th>H. Trab</th>
									          <th>% Bateria</th>
									          <th>Inventarios</th>";

									//Nombre de marcas
									for ($im=1; $im <= count($nom_marcas); $im++) 
									{ 
										echo "<th>".$nom_marcas[$im]."</th>";	
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
					                    <td $color>".$json[$i]['nombre_cliente']."-".$json[$i]['Id_cliente']."</td>
					                    <td>".$adicional."</td>
					                    <td>".$json[$i]['entrada']."</td>
					                    <td>".$json[$i]['salida']."</td>
					                    <td>".$h_servicio."</td>
					                    <td>".$h_traslado."</td>
					                    <!--<td></td>-->
					                    <!--<td></td>-->
					                    <td></td>
					                    <td></td>
					                    <td>".$json[$i]['bateria']."</td>
					                    <td><center><a href='' id='myBtn".$i."' data-toggle='modal' data-target='.bs-example-modal-lg'><img src='../imagen/reportes.png' width='20'></a></center></td>";

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
										    <div class='modal-content' id='Freportes".$i."'>
										    	<div id='Freportes".$i."'>Descargando informacion...</div>
										    	
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
	    <!-- /.content -->
	</div>
