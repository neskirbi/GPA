$(document).on("ready", main);



function main(){



	$("#guardarz").on("click", validarFormulario);

}

function validarFormulario(){
	var nombre = $("#name").val();
	var contrasenia = $("#pass").val();
	var contrasenia2 = $("#pass2").val();
	var correo = $("#correo2").val();

$("#contrass").fadeOut();

 if(nombre == ""){
	$("#name").addClass("campo-vacio");
}else{
	$("#name").removeClass("campo-vacio");
}


 if(contrasenia == ""){
	$("#pass").addClass("campo-vacio");
}else{
	$("#pass").removeClass("campo-vacio");
}


 if(contrasenia2 == ""){
	$("#pass2").addClass("campo-vacio");
}else{
	$("#pass2").removeClass("campo-vacio");
}


 if(correo == ""){
	$("#correo2").addClass("campo-vacio");
}else{
	$("#correo2").removeClass("campo-vacio");
}



if(nombre == "" || contrasenia == "" || contrasenia2 == "" || correo == "" ){
	$("#errores").fadeIn();

	return false;
}else{

$("#errores").fadeOut();
if (contrasenia == contrasenia2){




	document.formenviar.submit();
}else{
	$("#contrass").fadeIn();
	return false;

}
	
}











}