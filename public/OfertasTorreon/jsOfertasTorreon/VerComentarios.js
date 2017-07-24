function TraerMensajes () {
$("[name=TM]").hide()
$("#AlertaSinMensajes").hide()
	$.ajax({
		url: '/MostrarMensajes',
		type: 'POST',
		dataType: 'JSON',
	    }).success(function  (Mensajes) {
	    	if(Mensajes.length>0){
	    		$("[name=TM]").show()
	    		$("#AlertaSinMensajes").hide()
	    		$.each(Mensajes, function(index, Mensaje){
		    	var Renglon;
		    	var Remitente=Mensaje.idUsuarioRemitente
		    	Renglon+='<tr>\
					<td style="width:58%" class="ads-details-td">\
					<div>\
						<p><strong class="Usuario"> <a href="#"> Nombre del usuario: '+Mensaje.NombreUsuario+'</a> </strong></p>\
						<p> <strong class="Mensaje"> Mensaje realizado: '+ Mensaje.Mensaje +'</strong></p>\
					</div>\
					</td>\
					<td style="width:16%"\
						<p><button class="btn btn-primary btn-xs" name="Resp" value="'+Mensaje.id+'" href="'+Remitente+'" data-toggle="modal"><i class="fa fa-edit"></i> Responder  </button></p>\
					</td>\
				</tr>';
				$("#MensajesDelUsuario").append(Renglon);
		    	});  
		    	Remitente=""
	    	}
	    	else{
	    		$("[name=TraerMensajes]").hide()
	    		$("#AlertaSinMensajes").show()
	    	}
	    	  	
	    }).error(function  (a,b,c) {
	    	alert()
	    });		
}

TraerMensajes()

function eliminarArticulo (element) {
	event.preventDefault();
	jQuery.ajax({
		url: '/BorrarArticuloRep',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('artic-id') },
		success: function (response) {
			document.getElementById('tablon').innerHTML = response;
			$('#publicacionBorrar').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};

function eliminarReporte (element) {
	event.preventDefault();
	jQuery.ajax({
		url: '/BorrarReporte',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('report-id') },
		success: function (response) {
			document.getElementById('tablon').innerHTML = response;
			$('#reporteBorrar').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};

var RespuestaMensaje={
	idMensaje:"",
	Mensaje:"",
	idRemitenteRespondido:""
}
$("#MensajesDelUsuario").on('click','[name=Resp]',function  (ev) {
	ev.preventDefault()
	RespuestaMensaje.idMensaje=$(this).val()
	RespuestaMensaje.idRemitenteRespondido=$(this).attr('href')
	$("#modalEditarPublicacion").modal('show')
	
})
$("[name=EnviarRespuesta]").click(function  () {
	RespuestaMensaje.Mensaje=$("[name=RespuestaAlMensaje]").val()
	console.log(RespuestaMensaje);
	$.ajax({
		url: '/EnviarRespuestaMensaje',
		type: 'POST',
		dataType: 'JSON',
		data:RespuestaMensaje,
	    }).success(function  (RespMensaje) {
	    	if(RespMensaje.insercion){
	    		$("#MensajesDelUsuario").empty()
	    		$("#modalEditarPublicacion").modal('hide')
	    		TraerMensajes()
	    	}
	    	
	    })	
})

/*-----------------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------------------------*/
/*
/*Falta editar la publicacion*/
/* Yo me encargo */

function TraerDetallesArticulo (element) {
	event.preventDefault();
	var articulo = element.getAttribute('data-artic');
	jQuery.ajax({
		url: '/MisPublicaciones/MostrarArticuloDetalles',
		type: 'POST',
		dataType: 'JSON',
		data: { id : articulo },
		success: function (response) {
			document.getElementById('artNombre').value = response[0].Nombre;
			document.getElementById('artPrecio').value = response[0].Precio;
			document.getElementById('artDescripcion').value = response[0].Descripcion;
			document.querySelector('[data-getter=artCategoria]').innerHTML = response[0].subcategoria;
			document.querySelector('[data-getter=artCategoria]').setAttribute('value', response[0].subcat_id);
			if (response[0].TipoVenta == 'Venta') {
				document.getElementById('radios-0').checked = true;
				document.getElementById('radios-1').checked = false;
			} else {
				document.getElementById('radios-0').checked = false;
				document.getElementById('radios-1').checked = true;
			}
			document.getElementById('entrega').value = response[0].UbicacionArticulo;
			document.getElementById('editarDetalles').setAttribute('data-artic', response[0].id);
			$('#modalEditarPublicacion').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};

function EditarDetallesArticulo (element) {
	var
		innombre = document.getElementById('artNombre').value,
		inprecio = document.getElementById('artPrecio').value,
		indescripcion = document.getElementById('artDescripcion').value,
		incategoria = document.getElementById('artCategoria').value,
		intipoventa = getRadioVal(document.querySelector('[name = FormEditarPublicacion]'), 'radios'),
		inubicacion = document.getElementById('entrega').value
	;
	jQuery.ajax({
		url: '/MisPublicaciones/EditarArticuloDetalles',
		type: 'POST',
		dataType: 'HTML',
		data: {
			id: element.getAttribute('data-artic'),
			nombre: innombre,
			precio: inprecio,
			descripcion: indescripcion,
			categoria: incategoria,
			tipoventa: intipoventa,
			ubicacion: inubicacion
		},
		success: function (response) {
			$('#modalEditarPublicacion').modal('toggle');
			document.getElementById('tablon').innerHTML = response;
		},	
		error: function (a,b,c) {}
	});
};
function BorrarArticulo (element) {
	event.preventDefault();
	jQuery.ajax({
		url: '/MisPublicaciones/BorrarArticulo',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('data-artic') },
		success: function (response) {
			document.getElementById('tablon').innerHTML = response;
			$('#modalBorrarPublicacion').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};

function getRadioVal (form, name) {
	var
		val,
		radios = form.elements[name],
		len = radios.length
	;
	for (var i = 0; i < len; i++) {
		if (radios[i].checked) {
			val = radios[i].value;
			break;
		}
	}
	return val;
};
