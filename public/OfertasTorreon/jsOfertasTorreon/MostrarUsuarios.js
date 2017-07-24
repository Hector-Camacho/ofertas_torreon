var id;
$("#TablaUsuarios").on('click','.renglon',function () {
	id=$(".IdentificadorUsuario", $(this)).html();
	$("#IdentificadorModal").html(id);
});
$("#EnvMensajeAdv").click(function(){
	id=$("#IdentificadorModal").html();
	Mensaje=$("textarea[name=MensajeModal]").val();
	RealizarAccion(id, Mensaje,"EnviarMensaje");
});
$("#EnvMensajePer").click(function(){
	id=$("#IdentificadorModal").html();
	Mensaje=$("textarea[name=MensajeModal]").val();
	RealizarAccion(id, Mensaje, "EnviarMensaje");
});
$("#Ban").click(function(){
	id=$("#IdentificadorModal").html();
	RealizarAccion(id,'',"Baneo");
});
$("#Desbannear").click(function(){
	id=$("#IdentificadorModal").html();
	RealizarAccion(id, '', 'Desbaneo')
});
function RealizarAccion(id,Mensaje,Accion){
	if(Accion=="EnviarMensaje"){
			$.ajax({
				url: 'EnviarMensaje',
				type: 'POST',
				data: {id:id,Mensaje:Mensaje},
				dataType:'JSON',
				success: function (respuesta) {
					$('#MensajeAdv').modal('hide')
					$('#MensajePer').modal('hide')
					window.location.href = respuesta.Ruta;
				}
			});	
		}
	if(Accion=="Baneo"){
		$.ajax({
			url: '/BanearUsuario',
			type: 'POST',
			data: {id:id},
			dataType:'JSON',
			success: function (respuesta) {
				$('#Bannear').modal('hide')
				window.location.href = respuesta.Ruta;
			}
		});
	}
	if(Accion=='Desbaneo'){
		$.ajax({
			url: '/DesbanearUsuario',
			type: 'POST',
			data: {id:id},
			dataType:'JSON',
			success: function (respuesta) {
				window.location.href = respuesta.Ruta;
				$('#DesBaneo').modal('hide');
			}
		});
	}
}
