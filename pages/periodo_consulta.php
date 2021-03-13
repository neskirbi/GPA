<!DOCTYPE html>
<html>
<head>
  <title>Nomina</title>
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

        //nota en el head esta el conect db
 
    if(count($_POST)==0){
      $sql4 = odbc_exec($conexion, "SELECT TOP 1 period FROM periodo ORDER BY idp DESC");
      if($c=odbc_fetch_array($sql4)) {
        $ultimoPeriodo=$c['period'];
      } 
    }else{
     $ultimoPeriodo=$_POST['periodo'];
    }
    $zonausu=$_COOKIE['dni'];
    
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
              echo "  <li class='treeview'>
                    <a href='asistencia.php'>
                      <i class='ion ion-android-clipboard'></i> <span>Asistencia</span>
                    </a>
                  </li>";
            }
                  
          ?>

          <li class='active treeview'>
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
                    <i class="fa fa-globe"> Nómina autorizada por el cliente.</i> <!--- Periordo. -->
                    <font class="pull-right">Periodo: <?php echo $ultimoPeriodo; ?>.</font>
                    
                     <br>
                        <div class="pull-right">
                        <select id="periodos" class="form-control pull-right" style="width: 220px; " onchange="FiltaPeriodo(this);">

                        <?php
                        if(count($_POST)!=0){
                          echo'<option value="'.$ultimoPeriodo.'">'.$ultimoPeriodo.'</option><optgroup>-----</optgroup>';
                        } 

                        $opt = "SELECT  distinct per.period, (select top 1 idp from periodo where period=per.period) as idp FROM periodo as per order by idp desc ";     
                        $opt = odbc_exec($conexion, $opt);
                        while($options = odbc_fetch_array($opt)){
                          $option='<option value="'.$options['period'].'">'.$options['period'].'</option>';
                          echo $options['period']==null || $options['period']=="" ? "" : $option;
                        }

                        ?>
                        </select>
                        <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-info pull-right" onclick="TableToExcel('nomina', 'W3C Example Table','<?php echo $ultimoPeriodo;?>')" data-original-title="Exportar Excel"><i class="glyphicon glyphicon-folder-open"></i></a>
                        <button data-toggle="tooltip" data-placement="top" title='Imprimir' class="btn btn-success pull-right no-print" onclick="window.print();"><i class="fa fa-print"></i></button>


                          <select id="puestos" class="form-control pull-right" style="width: 220px;" onchange="Buscar(this);">
                            <option value="">--Puesto--</option>
                            <?php

                            $opt = "SELECT distinct descripcion FROM puesto  ";     
                            $opt = odbc_exec($conexion, $opt);
                            while($options = odbc_fetch_array($opt)){
                              echo'<option value="'.$options['descripcion'].'">'.$options['descripcion'].'</option>';
                            }
                            ?>
                          </select>


                          <select id="empleados" class="form-control pull-right" style="width: 180px; margin-right: 5px;" onchange="Buscar(this);">
                            <option value="">--Empleado--</option>
                            <?php
                            $opt = "SELECT dat.us_nombre_real 
                            FROM periodo as per
                            join datosp as dat on dat.Periodo=per.periodo 
                            where per.period='$ultimoPeriodo' AND dat.us_nombre_real != 'VACANTE' and dat.estatus='$zonausu' ORDER BY dat.Id_usuario ASC";

                            $opt = odbc_exec($conexion, $opt);
                            while($options = odbc_fetch_array($opt)){
                              echo'<option value="'.$options['us_nombre_real'].'">'.$options['us_nombre_real'].'</option>';
                            }
                            ?>
                          </select>


                          <select id="cedis" class="form-control pull-right" style="width: 180px; margin-right: 5px;" onchange="Buscar(this);">
                            <option value="">--cedis--</option>
                            <?php
                            $opt = "SELECT distinct us_nombre FROM usuarionom where dni='$zonausu'  ORDER BY us_nombre desc";     
                            $opt = odbc_exec($conexion, $opt);
                            while($options = odbc_fetch_array($opt)){
                              echo'<option value="'.$options['us_nombre'].'">'.$options['us_nombre'].'</option>';
                            }
                            ?>
                          </select>


                        </div>  

                  
                  </div>
                  <!-- /.box-header -->
                
                  <div class="box-body" style="overflow-x: scroll;">

                  <table  class="table table-striped jambo_table table-bordered bulk_action" id="nomina">
                                <!--- Para Excel Custom cambiar la id por id="testTable" NOTA ES EL FILTRO O ESTO  -->
                              <!--table id="myTable" class="table table-striped table-bordered"-->
                    <thead>
                      <tr>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Numero Empleado</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Nombre</font></th>   
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Puesto</font></th> 
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >CEDIS</font></th>  
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Periodo</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Cheque</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Transferencia</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Trabajados</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias de Descanso</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Adicionales</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Descanso Adicionales</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Vacaciones</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Dias Totales</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Sueldo Diario</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Sueldo D</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Pasaje Dirario</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Pasaje</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Incentivo</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Incent.Permanencia</font></th>
                        <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total Percepciones</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Subsidio Empleo</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >ISR</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >IMSS</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Anticipo Nomina</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Prestamo Personal</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Pension Alimenticia</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Otras Deducciones</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Caja Ahorro</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Prestamo de Caja</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Amortización infonavit</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Intereses Prestamo</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Credito Fonacot</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Total deducciones</font></th>
                <th style="text-align: center; background-color: #405467; border:solid #fff 1px;"><font style="color: #fff; "  size="2" >Neto Pagado</font></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 

                      $suma_totales_adicionales=0;
                      $suma_totales_dvac=0;
                      $suma_toatels_trabajados=0;
                      $suma_sueldos=0;
                      $suma_totales_trabj_sueld=0;
                      $pasajes_suma=0;
                      $suma_pasaje_total=0;
                      $suma_incentivo=0;
                      $suma_incentivop=0;
                      $suma_de_todo=0;
                      $s_deduccion1=0;
                      $s_deduccion2=0;
                      $s_deduccion3=0;
                      $s_deduccion4=0;
                      $s_deduccion5=0;
                      $s_deduccion6=0;
                      $s_deduccion7=0;
                      $s_deduccion8=0;
                      $s_deduccion9=0;
                      $s_deduccion10=0;
                      $s_deduccion11=0;
                      $s_deduccion12=0;
                      $s_tdeduccion =0;
                      $s_neto  =0;
                      $sql = "SELECT *
                      FROM periodo as per
                      join datosp as dat on dat.Periodo=per.periodo
                      join usuarionom as usu on usu.Id_usuario = dat.Id_usuario
                      join puesto as pus on pus.id=usu.puesto
                      where per.period='$ultimoPeriodo' AND dat.us_nombre_real != 'VACANTE' and dat.estatus in ('".str_replace(",","','",$zonausu)."') 
                      ORDER BY dat.Id_usuario ASC ";  

                      //echo'<script> console.log("'.str_replace("\n"," ",$sql).'"); </script>';  
                      $result = odbc_exec($conexion, $sql);  
                      while($periodo = odbc_fetch_array($result)) {


                        $Id_usuario=$periodo['Id_usuario'];
                        $us_nombre_real=utf8_encode($periodo['us_nombre_real']);
                        $periodo_fecha=$periodo['Periodo'];
                        $SD=$sueldos=$periodo['SD'];
                        $Pasajediario=$periodo['Pasajediario'];
                        $diaspago=$periodo['diaspago'];
                        $periodo['tincentivo'];
                        $periodo['tincentivop'];
                        $transferencia=$periodo['transferencia'];
                        $cheque=$periodo['cheque'];
                        $infonavit=$periodo['infonavit'];
                        $cahorro=$periodo['cahorro'];
                        $ddescanso=$periodo['ddescanso'];
                        $dias_dvac=$periodo['dvac'];
                        $diasextra=$periodo['diasextra'];
                        $NoEmpleado=$periodo['ucfdi'];
                        $dias_trabajados=$periodo['dias_trabajados'];
                        $dias_adicionales=$periodo['dias_adicionales'];
                        $periodo['sueldos'];
                        $pasajes=floatval($periodo['Pasajes']);
                        $tincentivo=$incentivo=$periodo['Incentivos'];
                        $incentivosp=$periodo['incentivosp'];
                        $id_ruta=$periodo['us_nombre'];
                        $periodo['ultima_actualizacion'];
                        $periodo['estatus'];   
                        $us_nombre=$periodo['us_nombre'];
                        $descripcion=$periodo['descripcion'];
                        $OneDivSix = 1/6;
                        $dias_descanso = $dias_trabajados*($OneDivSix);
                        $totales_adicionales = $dias_adicionales*($OneDivSix);
                        $totales_dvac = $dias_dvac*($OneDivSix);
                    $diasvac = $dias_dvac+($dias_dvac*($OneDivSix));
                        $toatels_trabajados = ($dias_adicionales+($dias_adicionales*($OneDivSix)))+($dias_trabajados+($dias_trabajados*($OneDivSix)))+($dias_dvac+($dias_dvac*($OneDivSix)));
                        $totales_trabj_sueld = $toatels_trabajados*$sueldos;
                        $pasaje_total= $toatels_trabajados*$pasajes;
                        $total_suma_final = $totales_trabj_sueld+$incentivo+$incentivosp+$pasaje_total;        
                        $suma_totales_adicionales+=$totales_adicionales;
                        $suma_totales_dvac+=$totales_dvac;
                        $suma_toatels_trabajados+=$toatels_trabajados;
                        $suma_sueldos+=$sueldos;
                        $suma_totales_trabj_sueld+=$totales_trabj_sueld;
                        $pasajes_suma +=$pasajes;
                        $suma_pasaje_total+=$pasaje_total;
                        $suma_incentivo+=$incentivo;
                        $suma_incentivop+=$incentivosp;
                        $suma_de_todo+=$total_suma_final;

                    $deduccion1=$periodo['deduccion1'];
                    $deduccion2=$periodo['deduccion2'];
                    $deduccion3=$periodo['deduccion3'];
                    $deduccion4=$periodo['deduccion4'];
                    $deduccion5=$periodo['deduccion5'];
                    $deduccion6=$periodo['deduccion6'];
                    $deduccion7=$periodo['deduccion7'];
                    $deduccion8=$periodo['deduccion8'];
                    $deduccion9=$periodo['deduccion9'];
                    $deduccion10=$periodo['deduccion10'];
                    $deduccion11=$periodo['deduccion11'];
                    $deduccion12=$periodo['deduccion12'];
                    $tdeduccion=$periodo['tdeduccion'];
                    $neto=$periodo['neto'];
                    
                    $s_deduccion1+=$deduccion1;
                    $s_deduccion2+=$deduccion2;
                    $s_deduccion3+=$deduccion3;
                    $s_deduccion4+=$deduccion4;
                    $s_deduccion5+=$deduccion5;
                    $s_deduccion6+=$deduccion6;
                    $s_deduccion7+=$deduccion7;
                    $s_deduccion8+=$deduccion8;
                    $s_deduccion9+=$deduccion9;
                    $s_deduccion10+=$deduccion10;
                    $s_deduccion11+=$deduccion11;
                    $s_deduccion12+=$deduccion12;
                    $s_tdeduccion+=$tdeduccion;
                    $s_neto+=$neto;
                    
                        ?>
                      <tr>
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $NoEmpleado; ?></font></td>
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $us_nombre_real; ?></font></td>
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $descripcion; ?></font></td>
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $us_nombre; ?></font></td>  
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $periodo_fecha; ?></font></td>           
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $cheque; ?></font></td>                  
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $transferencia; ?></font></td>  
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $dias_trabajados; ?></font></td>         
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($dias_descanso, 2, ".", ","); ?></font></td>           
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $dias_adicionales; ?></font></td>   
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($totales_adicionales, 2, ".", ","); ?></font></td>    
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($diasvac, 2, ".", ","); ?></font></td>     
                        <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo number_format($toatels_trabajados, 2, ".", ","); ?></font></td>      
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($sueldos, 2, ".", ","); ?></font></td>                  
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($totales_trabj_sueld, 2, ".", ","); ?></font></td>      
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($pasajes, 2, ".", ","); ?></font></td>                  
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($pasaje_total, 2, ".", ","); ?></font></td>             
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($incentivo, 2, ".", ","); ?></font></td> 
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($incentivosp, 2, ".", ","); ?></font></td>                
                        <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo number_format($total_suma_final, 2, ".", ","); ?></font></td>         
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion1; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion2; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion3; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion4; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion5; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion6; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion7; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion8; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion9; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion10; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion11; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2"><?php echo $deduccion12; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo $tdeduccion; ?></font></td>
                    <td style="text-align: center; min-width: 100px;"><font size="2">$<?php echo $neto; ?></font></td>
                   
                      </tr>
                <?php 
                } 
                ?> 
                                             
                      </tbody>
                        <tr>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"><font style="color: #fff;">Total</font></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td>
                        <td style="text-align: center; background-color:#405467;"></td> 
                        <td style="text-align: center; background-color:#405467;"></td>    
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($suma_totales_adicionales, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($suma_totales_dvac, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($suma_toatels_trabajados, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_sueldos, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_totales_trabj_sueld, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($pasajes_suma, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_pasaje_total, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_incentivo, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_incentivop, 2, ".", ","); ?></font></td>
                        <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($suma_de_todo, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion1, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion2, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion3, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion4, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion5, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion6, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion7, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion8, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion9, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion10, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion11, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;"><?php echo number_format($s_deduccion12, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($s_tdeduccion, 2, ".", ","); ?></font></td>
                    <td style="text-align: center; background-color:#405467; "><font style="color: #fff;">$<?php echo number_format($s_neto, 2, ".", ","); ?></font></td>
                     
                     </tr>                            
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



</body>




<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function FiltaPeriodo(este,path="periodo_consulta.php", params, method='post') {

  // The rest of this code assumes you are not using a library.
  // It can be made less wordy if you use one.
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  //for (const key in params) {
    //if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = "periodo";
      hiddenField.value = este.value;

      form.appendChild(hiddenField);
    //}
  //}

  document.body.appendChild(form);
  form.submit();
}


function TableToExcel(table, name,periodo) {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))); }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }); };
    var row1='<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td>Promotecnicas y ventas SA de Cv.</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>',
    row2='<tr><td></td><td>Periodo: '+periodo+'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
    var tablet=$('#'+table).html();
    
    var tablef=$("<table></table>").html(tablet);
    tablef.find("thead").before(row1).before(row2);
    console.log(tablef.html());
    
   /*if (!table.nodeType)
      table = document.getElementById(table);
      */
     
    var ctx = {worksheet: name || 'Worksheet', table: tablef.html()};
    window.location.href = uri + base64(format(template, ctx));
}

function Buscar(este) {

    switch($(este).attr('id')){
      case "puestos":
      $('#empleados').prop('selectedIndex',0);
      $('#cedis').prop('selectedIndex',0);
      break;
      case "empleados":
      $('#puestos').prop('selectedIndex',0);
      $('#cedis').prop('selectedIndex',0);
      break;
      case "cedis":
      $('#empleados').prop('selectedIndex',0);
      $('#puestos').prop('selectedIndex',0);
      break;

    }

    $('#baba').prop('selectedIndex',0);


    var value = $(este).val();
    $("#nomina tbody tr").filter(function() {
      $(this).toggle($(this).text().indexOf(value) > -1)
    });
  }

</script>        

</html>



