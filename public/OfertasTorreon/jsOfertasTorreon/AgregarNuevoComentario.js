var NuevoComentario={
	Calificacion:"",
	Coment:"",
	idPublicacion:""
}

var NuevoMensaje={
	Mensaje:"",
	Destinatario:""
}
$("#NotEnviado").hide()
$("[name=GuardarComentario]").click(function () {
	NuevoComentario.Calificacion=$("[name=Calificacion]").val()
	NuevoComentario.Coment=$("#com").val()
	NuevoComentario.idPublicacion=$("input[name=idPublicacion]").val();
	$.ajax({
		url: '/AddComentario',
		type: 'POST',
		dataType: 'JSON',
		data: NuevoComentario,
	    }).success(function  (ComentarioGuardado) {
	    	if(ComentarioGuardado.insercion){
	    		$("[name=GuardarComentario]").hide()
	    		$("#NotEnviado").show()
	    		$("#com").val("")
	    		$("#input-rating").val("")
	    	}
	    	else{
	    		alert("Nooooo")
	    	}
	    	$("#UltimosComentarios").empty()
	    	CargarComentarios()
	    }).error(function  (a,b,c) {
	    	alert("Error en la peticion")
	    });	
})
$("[name=idPublicacion]").hide()
$("#NotMensajeEnv").hide()
$("[name=EnviarMensaje]").click(function  () {
	NuevoMensaje.Mensaje=$("[name=Mensaje]").val()
	NuevoMensaje.Destinatario=$("input[name=Articulo]").val();
	console.log(NuevoMensaje);
	$.ajax({
		url: '/EnviarMensaje',
		type: 'POST',
		dataType: 'JSON',
		data: NuevoMensaje,
	    }).success(function  (MensajeGuardado) {
	    	$("#NotMensajeEnv").show()
	    	$("#EnviarMensaje").hide()
	    	$("[name=Mensaje]").val("")
	    	
	    }).error(function  (a,b,c) {
	    	// alert("Mierda")
	    	$("#NotEnviado").show("")
	    	$("#NotEnviado").html("Ha ocurrido un error.")
	    });
})
$("#AlertaSinComentarios").hide()
$("#PanelComentarios").hide()
function CargarComentarios () {
	var idPublicacion=$("[name=idPublicacion]").val()
	$.ajax({
		url: '/CargarComentarios',
		type: 'POST',
		dataType: 'JSON',
		data: {idPub:idPublicacion},
	    }).success(function  (Publicaciones) {
	    	if(Publicaciones.length>0){
	    		$("#PanelComentarios").show()
	    		$("#AlertaSinComentarios").hide()
	    		$.each(Publicaciones, function(index, Publicacion){
		    	var Renglon="";
		    	Renglon+='<li>\
							<div class="blogs-comment-wrapper">\
								<div class="blogs-comment-avatar">\
									<figure>\
										<img alt="avatar" src="/Imagenes/AvatarUsuarios/'+Publicacion.NombreImagen+'">\
									</figure>\
									</div>\
									<div class="blogs-comment-details">\
									<div class="blogs-comment-name">\
										<a href="#">'+Publicacion.Nombre+'</a>\
										<span class="blogs-comment-date">'+Publicacion.FechaComentario+'</span>\
									</div>\
									<div class="blogs-comment-description">\
										<p>'+Publicacion.Comentario+'</p>\
									</div>\
								</div>\
							</div>\
						</li>';
				$("#UltimosComentarios").append(Renglon);
		    	});  
	    	}
	    	else{
	    		$("#AlertaSinComentarios").show()
	    		$("#PanelComentarios").hide()
	    	}
	    }).error(function  (a,b,c) {
	    	alert("Error en la petición")
	    });
}
CargarComentarios()
$(document).ajaxStop(function () {
	$(".input-rating").rating()
})