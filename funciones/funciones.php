
<script type="text/javascript">
	function exportexcelgps(rutas)
	{
		//fecha
		var fecha=document.getElementById("datepicker").value;
		//fecha
		var fecha2=document.getElementById("datepicker1").value;
		//Supervisor
		var superv=document.getElementById("nom").value;
		// Si no Supervisor 
		//var superv1=document.getElementById("nom1").value;
		//marcadores1 ruta
		//var m1=document.getElementById("m1").value;
		//marcadores2 tienda
		//console.log(m2[2][0]);

		document.location.target = "_blank";
		var url="../reportesexcel/reporteexcelkua.php?fecha="+fecha+"&fecha2="+fecha2+"&perio=Diario&super="+rutas+"&foto=con";
		console.log(url);
		document.location.href=url;
			}

  function exportexcel()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha = document.getElementById("fecha_inicio").value;
    var fecha2 = document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetallepen.php?fecha="+fecha+"&fecha2="+fecha2;
    console.log(url);
    document.location.href=url;
  }
  function exportexcel_alen()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha = document.getElementById("fecha_inicio").value;
    var fecha2 = document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetallepen_alen.php?fecha="+fecha+"&fecha2="+fecha2;
    console.log(url);
    document.location.href=url;
  }

  function exportexcelnew()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha_inicio=document.getElementById("fecha_inicio").value;
    var fecha_fin=document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetalle.php?fecha="+fecha_inicio+"&fecha_fin="+fecha_fin;
    console.log(url);
    document.location.href=url;
  }
  
  function exportphotos()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha_inicio=document.getElementById("fecha_inicio").value;
    var fecha_fin=document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/photoExcel.php?fecha="+fecha_inicio+"&fecha_fin="+fecha_fin;
    console.log(url);
    document.location.href=url;
  }
  
  function exportexcelCF()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha_inicio=document.getElementById("fecha_inicio").value;
    var fecha_fin=document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetalleCF.php?fecha="+fecha_inicio+"&fecha_fin="+fecha_fin;
    console.log(url);
    document.location.href=url;
  }

  function exportexcelnewsin()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha=document.getElementById("fecha_inicio").value;
    var fecha_fin=document.getElementById("fecha_fin").value;
    var txtcad=document.getElementById("txtCadena").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    /*var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }*/


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetalle_sinfotos_new.php?fecha="+fecha+"&fecha_fin="+fecha_fin+"&txtcadena="+txtcad;
	//var url="../reportesexcel/reporteexceldetalle_sinfotos_new 9jul.php?fecha="+fecha+"&fecha_fin="+fecha_fin;
    console.log(url);
    document.location.href=url;
  }


 /*function exportexcelpruebas()
  {
    //supervisor
    //var superv=document.getElementById("a111").value;
    //fecha
    var fecha=document.getElementById("fecha_inicio").value;
    var fecha_fin=document.getElementById("fecha_fin").value;
    //periodo
    //var peri=document.getElementById("c333").value;
    //foto
    //var foto=document.getElementsByName('csfotos');
    var seleccionado = 0;
    for(var i=0; i<foto.length; i++) 
    {    
      if(foto[i].checked) 
      {
        seleccionado = i;
        break;
      }
    }


    document.location.target = "_blank";
    var url="../reportesexcel/reporteexceldetalle_sinfotospruebas.php?fecha="+fecha+"&fecha_fin="+fecha_fin;
    console.log(url);
    document.location.href=url;
  }*/

</script>