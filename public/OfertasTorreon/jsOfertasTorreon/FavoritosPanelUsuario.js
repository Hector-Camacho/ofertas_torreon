function eliminarFavorito (element) {
	jQuery.ajax({
		url: '/QuitarFavorito',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('data-artic') },
		success: function (response) {
			document.querySelector('#tablon').innerHTML = response;
			$('#ElimFav').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};
