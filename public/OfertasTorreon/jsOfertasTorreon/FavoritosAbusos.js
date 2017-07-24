if($("#Fav").val()==0){
	$("[name=FavoritoMensaje]").text('Guardar Favorito')
	$("#icon").removeClass('glyphicon glyphicon-remove-circle')
	$("#icon").addClass('glyphicon glyphicon-heart')
	$("#Fav").removeClass('active')
	$("[name=Favorito]").css('color','#a94442')

}else{
	$("[name=FavoritoMensaje]").text('Quitar Favorito')
	$("#icon").removeClass('glyphicon glyphicon-heart')
	$("#icon").addClass('glyphicon glyphicon-remove-circle')
	$("#Fav").addClass('active')
	$("[name=Favorito]").css('color','#5cb85c')
}
function ajaxFavoritos (NombreRuta,idPub) {
	return $.ajax({
				url: NombreRuta,
				type: 'post',
				data: idPub,
			});
}
$("[name=Favorito]").click(function  (evento) {
	evento.preventDefault()
	var idArticulo= $(this).attr('href')
	if($("#Fav").hasClass("active")){
		$("#Fav").removeClass('active')
		console.log(idArticulo);
		ajaxFavoritos('/EliminarFavorito',{idPublicacionFavorita:idArticulo}).success(function  (Eliminado) {
			if(Eliminado.Eliminado){
				$("[name=FavoritoMensaje]").text(Eliminado.Mensaje)
				$("#icon").removeClass('glyphicon glyphicon-remove-circle')
				$("#icon").addClass('glyphicon glyphicon-heart')
				$("[name=Favorito]").css('color','#a94442')
			}
			else{
				alert(Eliminado.Mensaje);
			}
		});
	}
	else{
		$("#Fav").addClass('active')
		ajaxFavoritos('/AgregarFavorito',{idPublicacionFavorita:idArticulo}).success(function  (AgregarFav) {			if(AgregarFav.Insertado){
				$("#icon").removeClass('glyphicon glyphicon-heart')
				$("#icon").addClass('glyphicon glyphicon-remove-circle')
				$("[name=FavoritoMensaje]").text(AgregarFav.Mensaje)
				$("[name=Favorito]").css('color','#5cb85c')
			}
			else{
				alert(AgregarFav.Mensaje);
			}
		});
	}
})
	
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
/*-----------------------------------------Enviar Abusos--------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/
// function contador (campo, cuentacampo, limite) { 
// 	if (campo.value.length > limite) {
// 		campo.value = campo.value.substring(0, limite)
// 		// $(".text-count").text(campo.value)
// 	}
// 	else {
// 		cuentacampo.value = limite - campo.value.length; 
// 		// $(".text-count").text(cuentacampo.value)
// 	}
// } 

function init_contadorTa(idtextarea, idcontador,max)
{
$("#"+idtextarea).keyup(function()
{
	updateContadorTa(idtextarea, idcontador,max);
});
 
$("#"+idtextarea).change(function()
{
	updateContadorTa(idtextarea, idcontador,max);
});
 
}
	 
function updateContadorTa(idtextarea, idcontador,max)
{
	var contador = $("#"+idcontador);
	var ta =     $("#"+idtextarea);
	contador.html("0/"+max);
	 
	contador.html(ta.val().length+"/"+max);
	if(parseInt(ta.val().length)>max)
	{
		ta.val(ta.val().substring(0,max-1));
		contador.html(max+"/"+max);
	}
 
}

init_contadorTa("textarea","contador", 300);
$("#Modal").click(function  () {
	$("#reportAdvertiser").modal('show')
});

function reportarArticulo (element) {
	event.preventDefault();
	var
		articulo = element.getAttribute('data-artic'),
		razon = document.getElementById('report-reason').value,
		detalles = document.getElementById('report-details').value
	;
	jQuery.ajax({
		url: '/ReportarArticulo',
		type: 'POST',
		dataType: 'JSON',
		data: {
			artic: articulo,
			reason: razon,
			details: detalles
		},
		success: function (response) {
			document.getElementById('report-panel').innerHTML = '<p><span class="badge">Gracias por tu aportación</span></p>';
			$('#reportAdvertiser').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};
