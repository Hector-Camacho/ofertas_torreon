$("#RegistrarAnuncio").click(function(){
idArticulo=$("select[name=Publicacion]").val();
DiasDuracion=$("input[name=Dias]").val();
$.ajax({
		url: '/GuardarArticulo',
		type: 'POST',
		data: {idArticulo:idArticulo,Dias:DiasDuracion},
		success: function (Articulos) {
			alert("Se guardo correctamente");
		}	
	});
});