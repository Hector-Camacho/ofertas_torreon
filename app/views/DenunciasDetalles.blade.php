@extends('base')
@section('contenido')
<div class="main-container inner-page">
<div class="container">
<div class="section-content">
<div class="row ">
<div class="col-sm-8 blogLeft">
<div class="blog-post-wrapper">
<article class="blog-post-item">
<div class="inner-box">
<div class="blog-post-img">
<a href="#">
<figure>
<img class="img-responsive" alt="blog-post image" src="../../Imagenes/ImagenesDenuncias/{{$Data[0]->NombreImagen}}">
</figure>
</a>
</div>
<h2 id="idPublicacion" hidden>{{$Data[0]->id}}</h2>
<div class="blog-post-content-desc">
<span class="info-row blog-post-meta"> <span class="date"><i class=" icon-clock"> </i> {{$Data[0]->Fecha}} </span> -
<span class="author"> <i class="fa fa-user"></i> <a href="#" title="Posts by Jhon Doe" rel="author">{{$Data[0]->nombre}}</a> </span> -
<span class="item-location"><i class="fa fa-comments"></i> Comentarios <a href="#"><?php $Com = new ComentarioDenuncia(); $Cant=$Com::where('denuncia_id','=',$Data[0]->id)->count(); echo $Cant;?></a> </span> </span>
<div class="blog-post-content">
<h2><a href="#">{{$Data[0]->titulo}}</a></h2>
<div class="blog-article-text">
<p>
	{{$Data[0]->Descripcion}}
</p>
</div>
</div>
<div class="clearfix">
<div class="col-md-12  blog-post-bottom">
</div>
</div>
</div>
<div class="blog-post-footer">
<div style="clear: both"></div>
<div class="inner ">
<div class="blogs-comments-area">
<h3 class="list-title"> <a href="#" class="post-comments">{{$Cant}} Comentarios</a></h3>
<div class="blogs-comment-respond" id="respond">
<ul class="blogs-comment-list" id="ComentariosDenuncia">
<li>
<div class="blogs-comment-wrapper" >
	<!-- <div class="blogs-comment-avatar">
		<figure>
			<img alt="avatar" src="http://placehold.it/350x150">
		</figure>
	</div>
	<div class="blogs-comment-details">
		<div class="blogs-comment-name">
			<a href="#">Shawn F. </a>
			<span class="blogs-comment-date">2 days ago</span>
		</div>
		<div class="blogs-comment-description">
			<p>Etiam porttitor magna at condimentum sollicitudin.
			Cras sit amet nisi et nunc elementum rutrum non eget dui.</p>
		</div>
		<div class="blogs-comment-reply"><a href="#">Reply</a></div>
	</div> -->
</div>
</li>
</ul>
<div class="row">
							<div class="col-md-12">
								<form id="Comentario" accept-charset="utf-8">
									<div class="form-group">
										<label  class="control-label">Escribe tu comentario aquí</label>
										<div class="form-group">
											<textarea name="com" id="com" class="form-control" style="resize: none;"rows="6" resize></textarea>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
										</div>
										<div class="col-md-4" >
											@if(Auth::id()!=null)
												<div class="form-group">
													<button type="button" id="GuardarComentario" class="btn btn-danger">Enviar comentario</button>
												</div>
											@else
												<div class="form-group">
													<h3>Inicia sesion para comentar</h3>
												</div>
											@endif
										</div>
									</div>
								</form>
							</div>
						</div>  
</div> 
</div>
</div>
</div>
</div>

</article>

</div>
</div> 
<div class="col-sm-4 blogRight page-sidebar">
<aside>
<div class="inner-box">

 
<div class="categories-list  list-filter">
<h5 class="list-title uppercase"><strong><a href="#"> Denuncias
recientes</a></strong></h5>
<div class="blog-popular-content">
@foreach($Top5 as $Popular)
<div class="item-list">
<div class="col-sm-4 col-xs-4 no-padding photobox">
<div class="add-image"> 
	<a href="ads-details.html">
		<img class="no-margin" src="../../Imagenes/ImagenesDenuncias/{{$Popular->NombreImagen}}" alt="img">
	</a>
</div>
</div>
<div class="col-sm-8 col-xs-8 add-desc-box">
	<div class="add-details">
		<h5 class="add-title"> <a href="ads-details.html">{{$Popular->titulo}}</a> </h5>
		<span class="info-row"> <span class="date"><i class=" icon-clock"> </i>{{$Popular->Fecha}}</span> </span>
	</div>
</div>
 
</div>
@endforeach
</div>
<div style="clear:both"></div>
 
</div>
</div>
</aside>
</div>
 
</div>
</div>
</div>
</div>
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/star-rating.min.js')}}
{{HTML::script('js/star-rating.js')}}
<script type="text/javascript">
	function CargarComentarios () {
	var id=$("#idPublicacion").text()
	$("#ComentariosDenuncia").empty();
	$.ajax({
		url: '/CargarComentariosDenuncia',
		type: 'POST',
		dataType: 'JSON',
		data: {idDenuncia:id},
	    }).success(function  (Publicaciones) {
	    	console.log(Publicaciones);
	    	if(Publicaciones.length>0){
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
										<span class="blogs-comment-date">'+Publicacion.Fecha+'</span>\
									</div>\
									<div class="blogs-comment-description">\
										<p>'+Publicacion.Comentario+'</p>\
									</div>\
								</div>\
							</div>\
						</li>';
				$("#ComentariosDenuncia").append(Renglon);
		    	});  
	    	}
	    	else{
	    		//$("#AlertaSinComentarios").show()
	    		//$("#PanelComentarios").hide()
	    	}
	    }).error(function  (a,b,c) {
	    	alert("Error en la petición")
	    });
}
CargarComentarios();
	$("#GuardarComentario").click(function(){
		Comentario={
			texto:"",
			fecha:"",
			Denuncia_id:""
		}
		var fecha = new Date();var mes = fecha.getMonth();var dia = fecha.getDate();var año = fecha.getFullYear();var fecha_actual=año+'/'+mes+'/'+dia

		Comentario.texto=$("#com").val();
		Comentario.fecha=fecha_actual;
		Comentario.Denuncia_id= $("#idPublicacion").text();
		$.ajax({
				url: '/GuardarComentariosDenuncia',
				type: 'POST',
				data: Comentario,
				success: function (data) {
					CargarComentarios();
				}
			});
	});
</script>
@endsection