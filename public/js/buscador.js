$("#Buscar").click(function(evento){
evento.preventDefault();
	articulo=$("#searchCatInput").val();
 	$("#Buscar").attr("href",'/Buscador/'+articulo);
 	url=$(this).attr("href");
 	window.location.href=url;
});