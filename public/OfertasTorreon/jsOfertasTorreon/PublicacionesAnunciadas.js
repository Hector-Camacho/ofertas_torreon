$("#Aviso").hide();
$("#addManageTable").hide();
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

function TraerPublicaciones () {
	$.ajax({
			url: '/MostrarPublicaciones',
			type: 'POST',
			success: function (Publicaciones) {
				if(Publicaciones.length>0)
				{
				$("#addManageTable").show()
				var date=FechaActual()
					$.each(Publicaciones, function(index, Publicacion){
						var Flimite=FechaLimite(Publicacion.FechaLimite)
						var dias= Flimite-date
						var diasEnt = Math.floor(dias / (1000 * 60 * 60 * 24));
						var ClaseColorLabel="",MensajeLabel=""
						if(dias>=0){ ClaseColorLabel="primary"; MensajeLabel="Anuncio activo"; }
						else{ ClaseColorLabel="danger"; MensajeLabel="El anuncio ha expirado" }
						var Renglon;
						Renglon+='<tr class="Renglon">\
								<td style="width:58%" class="add-img-td">\
									<div class="row">\
										<div class="col-md-3 col-sm-9 col-xs-9">\
											<a href="ads-details.html">\
												<img class="thumbnail no-margin" src="/Imagenes/ImagenesPublicaciones/'+Publicacion.NombreImagenPublicacion+'">\
											</a>\
										</div>\
										<div class="col-md-9 col-sm-9 col-xs-9 ">\
											<p><strong> <a href="'+diasEnt+'" class="DiaEnt" title="Brend New Nexus 4" > <span class="NombrePublicacion">'+Publicacion.NombrePublicacion+'</span></a> </strong></p>\
											<p > <strong > Fecha límite de la publicación: </strong> <span class="FechaLimite" value="">'+Publicacion.FechaLimite+'</span></p>\
											<p><strong><span class="label label-'+ClaseColorLabel+'">'+MensajeLabel+'</span></strong></p>\
										</div>\
									</div>\
								</td>\
								<td style="width:14%" class="ads-details-td">\
									<div>\
										<p> <a class="btn btn-success btn-xs Editar" href="'+Publicacion.id+'"> <i class=" fa fa-pencil"></i> Editar anuncio </a></p>\
										<p> <a class="btn btn-danger btn-xs Eliminar" href="'+Publicacion.id+'"> <i class=" fa fa-trash"></i> Eliminar anuncio </a></p>\
									</div>\
								</td>\
							</tr>';
							$("[name=PublicacionesAdministrador]").append(Renglon)
					});
				}
				else{
					$("#addManageTable").hide()
					$("#Aviso").show()
				}
			}
		});
}
TraerPublicaciones()
$(document).ajaxStop(function () {
	$("#message").hide()
})	
$("[name=PublicacionesAdministrador]").on('click','a.Editar, .DiaEnt',function  (evt) {
	evt.preventDefault()	
	$("#idAnuncio").val($($(this)).attr('href'))
	$("#modal-1").modal('show')
	$("#NombrePublicacion").val($(".NombrePublicacion",$(this)).html())
	if($(".DiaEnt",$(this)).attr('href')<0){
		$("#DiasDuracion").val(0)
	}
	else{
		$("#DiasDuracion").val($(".DiaEnt",$(this)).attr('href'))
	}	
})
var Formulario;
$("[name=PublicacionesAdministrador]").on('click','a.Eliminar',function (ex) {
	ex.preventDefault()
	$("#idAnuncioEliminar").val($($(this)).attr('href'))
	$("#modal-2").modal('show')
})