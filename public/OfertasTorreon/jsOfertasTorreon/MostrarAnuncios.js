function FechaActual (argument) {
	var fecha = new Date();
	var Mes = (fecha.getMonth()+1)
	var Dia=fecha.getDate()
	var NumMes
	if(Mes < 10){  NumMes= "0"+Mes  }
	else{   NumMes=Mes  }
	if(Dia<10){ Dia="0"+Dia}
	var ActualFecha = new Date(fecha.getFullYear() + '-'+ NumMes  +'-' +Dia);
	return ActualFecha;
}
function FechaLimite (FechaLimite) {
	var Limite = new Date(FechaLimite)
	var Dia=Limite.getDate()
	var Mes = (Limite.getMonth()+1)
	var NumMes
	if(Mes < 10){  NumMes= "0"+Mes  }
	else{   NumMes=Mes  }
	if(Dia<10){ Dia="0"+Dia}
	var FLimite = new Date(Limite.getFullYear() + '-'+ NumMes  +'-' +Dia);
	return FLimite;
}

var id;
function TablaAnuncios(Anuncios){
	if(Anuncios.length<=0){
		$("#Aviso").show();
	}
			$("#TablaAnuncios").empty();
			var renglon;
			var date=FechaActual()			
			$.each(Anuncios, function(index, Anuncio){
				var Flimite=FechaLimite(Anuncio.FechaLimite)
						var dias= Flimite-date
						var diasEnt = Math.floor(dias / (1000 * 60 * 60 * 24));
						var ClaseColorLabel="",MensajeLabel="";
			if(dias>=0){ ClaseColorLabel="primary"; MensajeLabel="Anuncio activo"; }
						else{ ClaseColorLabel="danger"; MensajeLabel="El anuncio ha expirado" }
					renglon+='<tr class="renglon">\
				<td hidden class="IdentificadorAnuncio">'+Anuncio.id+'</td>\
				<td style="width:14%" class="add-img-td">\
					<a href="ads-details.html">\
						<img class="thumbnail no-margin" src="/Imagenes/ImagenesArticulos/'+Anuncio.NombreImagen1+'">\
					</a>\
				</td>\
				<td style="width:58%" class="ads-details-td">\
					<div>\
						<p><strong><a href="ads-details.html" title="'+Anuncio.Nombre+'">'+Anuncio.Nombre+'</a></strong></p>\
					<p><strong>Fecha limite de la publicacion</strong>: '+Anuncio.FechaLimite+'</p>\
					<p><strong><span class="label label-'+ClaseColorLabel+'">'+MensajeLabel+'</span></strong></p>\
					</div>\
				</td>\
				<td style="width:10%" class="action-td">\
					<div>\
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">\
						<div class="row">\
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">\
							<p> <a class="btn btn-success btn-xs" data-toggle="modal" href="#ModificarModal"> <i class=" fa fa-envelope"></i> Editar publicacion marcada</a></p>\
						</div>\
						</div>\
						<div class="row">\
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">\
							<p> <a class="btn btn-danger btn-xs" data-toggle="modal" href="#EliminarModal"> <i class=" fa fa-ban"></i>  Eliminar publicacion marcada</a></p>\
						</div>\
						</div>\
					</div>\
					</div>\
					</td>\
				</tr>';
			});
			$("#TablaAnuncios").append(renglon);
	
}
function Servidor(){
	$.ajax({
		url: '/MostrarPublicacionesMarcadas',
		type: 'POST',
		dataType: 'JSON',
		success: function (Anuncios) {
			TablaAnuncios(Anuncios)
		}
	});
}
Servidor();
$("#TablaAnuncios").on('click','.renglon',function () {
	id=$(".IdentificadorAnuncio", $(this)).html();
	$("#IdentificadorModal").html(id);
});
$("#EliminarAn").click(function(){
	id=$("#IdentificadorModal").html();
	$.ajax({
			url: '/EliminarPublicacionMarcada',
			type: 'POST',
			data: {id:id},
			dataType:'JSON',
			success: function (Anuncios) {
				TablaAnuncios(Anuncios);
			}
		});
	$("#EliminarModal").modal('hide');
});
$("#ModificarAn").click(function(){
	id=$("#IdentificadorModal").html();
	Dias=$("#DiasNuevos").val();
	$.ajax({
		url: '/ModificarPublicacionMarcada',
		type: 'POST',
		data: {id:id,Dias:Dias},
		dataType:'JSON',
		success: function (Anuncios) {
			TablaAnuncios(Anuncios);
		}
	});
	$("#ModificarModal").modal('hide');
});
