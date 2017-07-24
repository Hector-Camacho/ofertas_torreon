@extends('base')
@section('contenido')
<meta charset="utf-8">
<div class="main-container">
	<div class="container">
		<ol class="breadcrumb pull-left">
			<li><a href="/"><i class="icon-home fa"></i> Inicio</a></li>
			<li><a href="/Categorias">Todos los anuncios</a></li>
			<li><a href="/Categorias/{{$Detalle->idCategoria}}/1">{{$Detalle->Categoria}}</a></li>
			<li class="active">{{$Detalle->Subcategoria}}</li>
		</ol>
		<div class="pull-right backtolist"><a href="/Categorias/"> <i class="fa fa-angle-double-left"></i> Volver atras</a></div>
	</div>
	<div class="container">
		<div class="row">

		@if($Detalle->latitud==0 && $Detalle->longitud==0)
		
		@else
			<div class="panel sidebar-panel panel-contact-seller">
				<div class="panel-heading">Ubicacion</div>
					<div class="panel-content user-info">
						<div class="panel-body text-center">
							<div id="map" style="height:200px;">
								
							</div>
						</div>
					</div>
				<button class="btn btn-small btn-block btn-default" type="button" id="TrazarRuta">Trazar ruta</button>
			</div>
		@endif
			<div class="col-sm-9 page-content col-thin-right">
				<div class="inner inner-box ads-details-wrapper">
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
							<h2>{{$Detalle->Articulo}}</h2>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
						@if($Detalle->IdUsuario==Auth::id())
							<button type="button" id="Promocionar" class="btn btn-small btn-info">Promocionar</button>	
						@endif
					</div>
				</div>
				<h2 id="longitud" hidden>{{$Detalle->longitud}}</h2>
				<h2 id="latitud" hidden>{{$Detalle->latitud}}</h2>
					<input hidden name="Articulo" id="Articulo" class="Articulo" value="{{$Detalle->IdUsuario}}">
					<span class="info-row"> <span class="date"><i class=" icon-clock"> </i>{{$Detalle->FechaPublicacion}} </span> - <span class="category">{{ $Detalle->Categoria }} </span>- <span class="item-location" id="Ubicacion"><i class="fa fa-map-marker"></i> Lugar de entrega: {{$Detalle->UbicacionArticulo}}</span> </span>
					<div class="ads-image">
						<h1 class="pricetag">${{$Detalle->Precio}}</h1>
						<ul class="bxslider">
							<li><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen1}}" alt="img" style="max-height:382px;" /></li>
							@if (!empty($Detalle->NombreImagen2))
							<li><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen2}}" alt="img" style="max-height:382px;"/></li>
							@endif
							@if (!empty($Detalle->NombreImagen3))
							<li><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen3}}" alt="img" style="max-height:382px;"/></li>
							@endif
						</ul>
						<div id="bx-pager">
							<a class="thumb-item-link" data-slide-index="0" href="#"><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen1}}" alt="img"/></a>
							@if (!empty($Detalle->NombreImagen2))
							<a class="thumb-item-link" data-slide-index="1" href="#"><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen2}}" alt="img"/></a>
							@endif
							@if (!empty($Detalle->NombreImagen3))
							<a class="thumb-item-link" data-slide-index="2" href="#"><img src="\Imagenes\ImagenesArticulos\{{$Detalle->NombreImagen3}}" alt="img"/></a>
							@endif
						</div>
					</div>

					<div class="Ads-Details">
						<h5 class="list-title"><strong>Descripcion</strong></h5>
						<div class="row">
							<div class="ads-details-info col-md-8">
								<p>{{$Detalle->Descripcion}}</p>
							</div>
							<div class="col-md-4">
								<aside class="panel panel-body panel-details">
									<ul>
										<li>
											<p class=" no-margin "><strong>Precio:</strong>${{$Detalle->Precio}}</p>
										</li>
										<li>
											<p class="no-margin"><strong>Ubicacion:</strong>{{$Detalle->UbicacionArticulo}}</p>
										</li>
										<li>
											<p class="no-margin"><strong>Tipo de venta:</strong>{{$Detalle->TipoVenta}}</p>
										</li>
									</ul>
								</aside>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
								@if (Auth::id() !== null)
									<ul class="nav navbar-nav list-border" style="float: right;">
										<li role="presentation" id="Fav" value="{{$Detalle->idPublicacionFav}}">
											<a href="{{$Detalle->ArtId}}" name="Favorito"> <i id="icon" class="glyphicon glyphicon-heart"></i> <span name="FavoritoMensaje"> Guardar Favorito </span> </a> 
										</li>
										@if ($Detalle->IdUsuario != Auth::id())
											@if (Usuario::find(Auth::id())->Reportes()->where('articulo_id', '=', $Detalle->ArtId)->count())
											<li role="presentation">
												<p><span class="badge">Ya lo reportaste</span></p>
											</li>
											@else
											<li role="presentation" id="report-panel">
												<a href="javascript:;" id="Modal"><i class="fa icon-info-circled-alt"></i> Reportar abuso </a>
											</li>
											@endif
										@endif
									</ul>
								@endif
							</div>
						</div>
						<hr>
						<input class="form-control" id="idPublicacion" name="idPublicacion" value="{{$Detalle->ArtId}}" >
						<div class="row" id="PanelComentarios" >
							<div class="col-md-12">
								<div class="blogs-comments-area">
									<h3 class="list-title"> <a href="#" class="post-comments">Últimos Comentarios</a></h3>
									<div class="blogs-comment-respond">
										<ul class="blogs-comment-list" id="UltimosComentarios">
										</ul>
									</div> 
								</div>
							</div>
						</div>
						<div class="row" id="AlertaSinComentarios">
							<div class="col-lg-12">
								<div class="alert alert-success  alert-lg" role="alert">
									<h2 class="no-margin no-padding"><span class="fa fa-comments"></span>Aún no hay comentarios</h2>
									<h4>Se el primero en comentar esta publicación.</h4>
								</div>
							</div>
						</div>
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
											<div class="form-group">
												<label class="col-md-3 control-label"> Calificación:  </label>
												<input class="input-rating" name="Calificacion" type="number" class="rating" min=0 max=5 step=0 data-size="xs" required>
											</div>
										</div>
										<div class="col-md-4" >
											@if(Auth::id()!=null)
												<div class="form-group">
													<button type="button" name="GuardarComentario" class="btn btn-danger">Enviar comentario</button>
													<h3 id="NotEnviado">Gracias por tu comentario</h3>
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


						<div class="content-footer text-left"> </div>
					</div>
				</div>
 
			</div>
			
 			<div class="col-sm-3  page-sidebar-left">
				<aside>
					<div class="panel sidebar-panel panel-contact-seller">
						<div class="panel-heading">Enviar mensaje privado</div>
						<div class="panel-content user-info">
							<div class="panel-body text-center">
	
								<form name="Comentario" accept-charset="utf-8">
									<div class="row">
										<label class="control-label">Mensaje</label>
										<div class="form-group">
											<div class="col-sm-12">
												<textarea name="Mensaje" id="Mensaje" class="form-control" style="resize: none;"rows="6" resize placeholder="Escribe tu mensaje aquí"></textarea>
											</div>
										</div>
									</div>
									<br>
									@if(Auth::id()!=null)
									<div class="row">
										<div class="form-group">
											<div class="col-sm-offset-1 col-sm-9">
												<button type="button" id="EnviarMensaje" name="EnviarMensaje" class="btn btn-success btn-sm btn-block">Enviar</button>
											</div>
										</div>
										<br>
										<div class="form-group">
											<div class="col-sm-12">
												<h4 id="NotMensajeEnv">Mensaje enviado</h4>
											</div>
										</div>
									</div>
									@else
									<div class="form-group">
										<h3>Inicia sesion para enviar un mensaje</h3>
									</div>
									@endif
								</form>
							</div>
						</div>
					</div>
				</aside>
			</div>

			<div class="col-sm-3 col-md-3 page-sidebar-right">
				<aside>
					<div class="panel sidebar-panel panel-contact-seller">
						<div class="panel-heading">Informacion de contacto</div>
						<div class="panel-content user-info">
							<div class="panel-body text-center">

								<h3 class="no-margin">{{$Detalle->Usuario}}</h3>
								<div class="add-image">
									<a href="/Categorias/Detalles">
								@if($Detalle->Facebook!='No registrado')
									<img class="no-margin" src="{{$Detalle->ImagenUsuario}}" alt="img">
								@else
									<img class="no-margin" src="/Imagenes/AvatarUsuarios/{{$Detalle->ImagenUsuario}}" alt="img">
								@endif
									</a>
								 </div>
								<div class="seller-info">
									<p>Correo electrónico: <strong>{{$Detalle->Correo}}</strong></p>
									<p>Miembro desde: <strong>27-ene-2015</strong></p>
									<p>Calificacion: </p><input class="input-rating" name="Calificacion2" type="number" class="rating" readonly data-size="xs" value="{{$Calificacion[0]->Calificacion}}">
								</div>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</div>

{{-- Modal --}}
<div class="modal fade" id="reportAdvertiser" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title"><i class="fa icon-info-circled-alt"></i> ¿Algo anda mal con este articulo? </h4>
			</div>
			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<label for="report-reason" class="control-label">Razon:</label>
						<select name="report-reason" id="report-reason" class="form-control">
							<option value="">Elige una razon</option>
							<option value="soldUnavailable">Articulo agotado</option>
							<option value="fraud">Fraude</option>
							<option value="duplicate">Articulo duplicado</option>
							<option value="spam">Spam</option>
							<option value="wrongCategory">Categoria equivocada</option>
							<option value="other">Other</option>
						</select>
					</div>
					<div class="form-group">
						<label for="message-text2" class="control-label" for="report-details">Mensaje <span class="text-count" id="contador"> 0/250 </span>:</label>
						<textarea class="form-control" id="message-text2"></textarea>
						<textarea class="form-control" name="report-details" id="report-details" style="resize: none;"rows="6" placeholder=""></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" data-artic="{{ $Detalle->ArtId }}" onclick="reportarArticulo(this)">Enviar reporte</button>
			</div>
		</div>
	</div>
</div>

{{--  [Despliegue del modal de Promocion] --}}
<div class="modal fade" id="Promocion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">¿Quieres que encuentren tu anuncio mas rapido?</h4>
			</div>
				<div class="row" id="StatusPago">
									<div class="col-lg-12">
										<div id="Alerta" role="alert">
										<h2 class="no-margin no-padding" id="Mensaje"></h2>
										<h4 id="Informacion"></h4>
										</div>
									</div>
				</div>  
				<form id="PagoTarjeta">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<h2 hidden id="idArticuloDetalle">{{$Detalle->ArtId}}</h2>
					</div>
						<div class="form-group">
							<label for="">Nombre del tarjetahabiente</label>
							<input type="text" class="form-control" id="" data-conekta="card[name]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">Numero de tarjeta de credito</label>
							<input type="text" class="form-control" id="" data-conekta="card[number]"placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">cvc</label>
							<input type="text" class="form-control" id=""data-conekta="card[cvc]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">fecha de expiracion (mm)</label>
							<input type="text" class="form-control" id="" data-conekta="card[exp_month]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">fecha de expiracion (aaaa)</label>
							<input type="text" class="form-control" id="" data-conekta="card[exp_year]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">Calle</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][street1]" placeholder="Input field">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="">Colonia</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][street2]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">Ciudad</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][city]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">Estado</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][state]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">CP</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][zip]" placeholder="Input field">
						</div>
						<div class="form-group">
							<label for="">País</label>
							<input type="text" class="form-control" id="" data-conekta="card[address][country]" placeholder="Input field">
						</div>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="PromocionarArticuloButton" class="btn btn-primary">Promocionar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgU0-oncUskSc8OpZQfDizws5Ot7_11Gc"></script>
{{HTML::script('OfertasTorreon/assets/js/gmaps.js')}}
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/star-rating.min.js')}}
{{HTML::script('js/star-rating.js')}}
{{HTML::script('OfertasTorreon/assets/bootstrap/js/bootstrap.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/owl.carousel.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/jquery.matchHeight-min.js')}}
{{HTML::script('OfertasTorreon/assets/js/hideMaxListItem.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}
{{HTML::script('OfertasTorreon/assets/js/script.js')}}
{{HTML::script('OfertasTorreon/jsOfertasTorreon/AgregarNuevoComentario.js')}}
{{HTML::script('OfertasTorreon/jsOfertasTorreon/FavoritosAbusos.js')}}
{{HTML::script('OfertasTorreon/jsOfertasTorreon/Promocionar.js')}}
{{HTML::script('OfertasTorreon/jsOfertasTorreon/Ubicacion.js')}}
<script type="text/javascript">
$(document).ready(function  () {
	$("[name=Calificacion]").rating();
	$("[name=Calificacion2]").rating();
	$("#Promocionar").click(function(){
		$("#Promocion").modal('toggle');
	});
})
</script>
@stop
