@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
	<h2 class="title-2"><i class="icon-docs"></i> Mis publicaciones	 </h2>
	<div class="table-responsive" id="tablon">
		<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
			<thead>
				<tr>
					<th> Fotografía </th>
					<th data-sort-ignore="true"> Detalles </th>
					<th data-type="numeric"> Precio </th>
					<th> Opciones </th>
				</tr>
			</thead>
			<?php $usuario = Usuario::find(Auth::user()->id)?>
			<tbody>
				@if ($usuario->Articulos->count() == 0)
				<tr>
					<td colspan="4">NO TIENES ARTÍCULOS POR EL MOMENTO</td>
				</tr>
				@else
					@foreach ($usuario->Articulos as $articulo)
					<tr>
						<td style="width:14%" class="add-img-td"><a href="#">
							<img class="thumbnail no-margin" src="/Imagenes/ImagenesArticulos/{{ $articulo->NombreImagen1 }}"></a>
						</td>
						<td style="width:58%" class="ads-details-td">
							<div>
								@if (!$articulo->Status)
								<input type="text" name="Articuloid" value="{{$articulo->id}}" hidden>
								<p><strong><a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $articulo->id)) }}" title="{{ $articulo->Nombre }}" id="NombreArticulo"> {{ $articulo->Nombre }}</a></strong></p>
								@else
								<p><strong><a href="javascript:;" title="{{ $articulo->Nombre }}"> {{ $articulo->Nombre }}</a></strong></p>
								@endif
								<p><strong>Detalles:</strong> {{ $articulo->Descripcion }}</p>
								<p><strong>Ubicación:</strong> {{ $articulo->UbicacionArticulo }}</p>
								<p><strong>Tipo de publicación:</strong> {{ $articulo->TipoVenta }}</p>
							</div>
						</td>
						<td style="width:16%" class="price-td">
							<div>
								<strong>${{ $articulo->Precio }}</strong>
							</div>
						</td>
						<td style="width:10%" class="action-td">
							@if (!$articulo->Status)
							<div>
								<p><a class="btn btn-default btn-xs btn-block" href="#" data-artic="{{ $articulo->id }}" onclick="TraerDetallesArticulo(this)"><i class="fa fa-edit"></i> Editar </a></p>

								<p><a class="btn btn-primary btn-xs btn-block" href="#" onclick="event.preventDefault(); $('#modalVenderPublicacion').modal('toggle'); document.getElementById('venderYa').setAttribute('data-artic', {{ $articulo->id }}) "><i class="fa fa-shopping-cart"></i> Vender </a></p>

								<hr>
								<p><a class="btn btn-danger btn-xs btn-block" href="#" onclick="event.preventDefault(); $('#modalBorrarPublicacion').modal('toggle'); document.getElementById('borrarYa').setAttribute('data-artic', {{ $articulo->id }})"><i class="fa fa-times"></i> Eliminar </a></p>
							</div>
							@else
							<div>
								<p><span class="badge">VENDIDO</span></p>
							</div>
							@endif
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
{{-- Modal --}}
<div class="modal fade" id="modalEditarPublicacion" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Detalles de la publicación</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-bordered" name="FormEditarPublicacion">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="artNombre">Nombre del artículo</label>
						<div class="col-sm-9">
							<input type="text" id="artNombre" name="artNombre" class="form-control" placeholder="Nombre del artículo publicado">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="artPrecio">Precio</label>
						<div class="col-md-4">
							<div class="input-group"> <span class="input-group-addon">$</span>
								<input id="artPrecio" name="artPrecio" class="form-control" placeholder="Precio del artículo" required="" type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="artDescripcion">Descripción</label>
						<div class="col-sm-9">
							<textarea id="artDescripcion" name="artDescripcion" class="form-control" style="resize: none;" rows="3" resize></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="artCategoria">Categoría</label>
						<div class="col-sm-9">
							<select id="artCategoria" name="artCategoria" class="form-control">
								<option style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled">Seleccionado</option>
								<option data-getter="artCategoria">(POR DEFAUL DEBE ESTAR VACIO)</option>
								@foreach (Categoria::all() as $categoria)
								<option value="{{ $categoria->id }}" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled">{{ $categoria->nombre }}</option>
									@foreach ($categoria->SubCategorias as $subcategoria)
									<option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
									@endforeach
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Tipo de publicación</label>
						<div class="col-md-8">
							<label class="radio-inline" for="radios-0"><input name="radios" id="radios-0" value="Venta" checked="checked" type="radio">Venta </label>
							<label class="radio-inline" for="radios-1"><input name="radios" id="radios-1" value="Cambio" type="radio">Cambio </label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9"></div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<button id="editarDetalles" class="btn btn-success" onclick="EditarDetallesArticulo(this)"><span class="fa fa-check"></span> Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalVenderPublicacion" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> AVISO</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de vender este articulo ¿Esta seguro de continuar con esta accion?.</h3>
				<blockquote><font size="2">Pensando en tu comodidad, el equipo de ofertas torreon trae a ti la opcion de envio a domicilo
				¿En que consiste? Sencillo, cuando selecciones la opcion de envio a domicilio el equipo de ofertas torreon se comunicara inmediatamente con iVoy express &copy; y ellos se encargan del traslado del articulo hasta donde estes. Si no deseas usar este nuevo servicio ¡no te preocupes!, simplemente selecciona la casilla de "No, yo mismo quiero entregar el articulo en persona" y podras marcar directamente como vendido tu articulo.</font> </blockquote>
				<form id="FormRadios">
					<div class="radios">
						<label>
							<input type="radio" name="radio" id="inputsi" value="si" checked="checked">
							Si, deseo usar el servicio de VoyExpress.
						</label>
						<label>
							<input type="radio" name="radio" id="inputno" value="no">
							No, yo mismo quiero entregar el articulo en persona.
						</label>
					</div>
				</form>
				 <div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="venderYa">Si, quiero vender mi articulo</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--##||---------MODAL DE ELIMINAR ENVIO---------||##-->
<div class="modal fade" id="modalBorrarPublicacion" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de eliminar esta publicación.</h3>
				<h3>Una vez que esta publicación sea eliminada, no podrá revertir esta acción.</h3>
				<h3>¿Desea continuar?</h3>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="borrarYa" onclick="BorrarArticulo(this)">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-danger btn-block" onclick="$('#modalBorrarPublicacion').modal('toggle')">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--##||---------MODAL DE ELIMINAR ENVIO---------||##-->


<!--##||---------MODAL DE COBRO DE ENVIO---------||##-->
<div class="modal fade" id="Promocion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Termina el pago del envio...</h4>
			</div>
				<div class="modal-body">
					<form action="/GuardarPago" class="form" id="PagoTarjeta">
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="">Nombre del tarjetahabiente</label>
								<input type="text" class="form-control" id="" name="NombreCon" data-conekta="card[name]" placeholder="Nombre...">
							</div>
							<div class="form-group">
								<label for="">Numero de tarjeta de credito</label>
								<input type="text" class="form-control" id="" data-conekta="card[number]" placeholder="Numero de tarjeta...">
							</div>
							<div class="form-group">
								<label for="">cvc</label>
								<input type="text" class="form-control" id=""data-conekta="card[cvc]" placeholder="CVC">
							</div>
							<div class="form-group">
								<label for="">mes de expiracion(mm)</label>
								<input type="text" class="form-control" id="" data-conekta="card[exp_month]" placeholder="MM">
							</div>
							<div class="form-group">
								<label for="">año de expiracion (aaaa)</label>
								<input type="text" class="form-control" id="" data-conekta="card[exp_year]" placeholder="Año">
							</div>
							<div class="form-group">
								<label for="">Calle</label>
								<input type="text" class="form-control" id="" name="CalleCon"data-conekta="card[address][street1]" placeholder="Input field">
							</div>
						</div>
						<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
							<div class="form-group">
								<label for="">Colonia</label>
								<input type="text" class="form-control" id="" name="ColoniaCon"data-conekta="card[address][street2]" placeholder="Colonia">
							</div>
							<div class="form-group">
								<label for="">Ciudad</label>
								<input type="text" class="form-control" id="" name="CiudadCon" data-conekta="card[address][city]" placeholder="Ciudad">
							</div>
							<div class="form-group">
								<label for="">Estado</label>
								<input type="text" class="form-control" id="" name="EstadoCon" data-conekta="card[address][state]" placeholder="Estado">
							</div>
							<div class="form-group">
								<label for="">CP</label>
								<input type="text" class="form-control" id="" name="CodigoPostalCon" data-conekta="card[address][zip]" placeholder="Codigo postal">
							</div>
							<div class="form-group">
								<label for="">País</label>
								<input type="text" class="form-control" id="" name="PaisCon" data-conekta="card[address][country]" placeholder="Pais">
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" id="PagoTarjetaButton" class="btn btn-primary">¡Envia mi paquete!</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--##||---------MODAL DE COBRO DE ENVIO---------||##-->

<!--##||---------MODAL DE INFORMACION DEL ENVIO---------||##-->
<div class="modal fade" id="DatosEnvio">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">¡Calcula el costo del viaje!</h4>
			</div>
			<div class="modal-body">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<div id="map" style="height:400px; width:100%;">
                		</div>
                		<br>
                		<div class="col-xs-6">
                			<div class="panel panel-success">
	                			<div class="panel-heading">
	                				<h3 class="panel-title">Distancia</h3>
	                			</div>
	                			<div class="panel-body">
			                		<h3 id="Distancia">---</h3>
	                			</div>
	                		</div>
						</div>
						<div class="col-xs-6">
							<div class="panel panel-success">
								<div class="panel-heading">
									<h3 class="panel-title">Precio</h3>
								</div>
								<div class="panel-body">
			                		<h3 id="Precio">---</h3>
								</div>
							</div>
						</div>
            	</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<form class="form" id="PagoTarjeta">
									<div class="form-group">
										<label for="">Nombre del comprador</label>
										<input type="text" class="form-control" id="Comprador" placeholder="¿A quien tiene que entregar?">
									</div>
									<div class="form-group">
										<label for="">Tu nombre</label>
										<input type="text" class="form-control" id="Vendedor" placeholder="¿Quien manda el articulo?">
									</div>
									<div class="form-group">
										<label for="">Nombre del articulo</label>
										<input type="text" class="form-control" id="Articulo" placeholder="¿Que articulo vas a mandar?" placeholder="¿Que articulo mandaste?">
									</div>
									<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
												<div class="form-group">
										    	<label for=""  class="control-label col-sm-4">Cantidad</label>
												  <div class="col-sm-8">
										    		<input type="number" class="form-control" id="Cantidad" placeholder="¿Cuantos mandaras?" placeholder="¿Que articulo mandaste?">
												  </div>
										    </div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
												<div class="form-group">
													  <label for="" class="control-label col-sm-4">Precio</label>
														<div class="col-sm-8">
											      	<input type="text" class="form-control" id="Precio" placeholder="¿Cual fue el precio acordado?">
														</div>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label for="">Direccion</label>
										<input type="text" class="form-control" id="Direccion" placeholder="¿A donde lo vas a llevar?" readonly>
									</div>
									<div class="form-group">
										<label for="">Direccion de recogida</label>
										<input type="text" class="form-control" id="Entrega" placeholder="¿Donde lo van a recoger?">
									</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="button" id="DatosEnvioCompletado" class="btn btn-primary">Continuar</button>
							</div>
						</form>
						<small>*El precio en base a la distancia puede variar, esto se debe a que tambien se calculan los metros</small>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<button type="button" id="buton" class="btn btn-danger">buton mapa modal</button>
<!--##||---------MODAL DE INFORMACION DEL ENVIO---------||##-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgU0-oncUskSc8OpZQfDizws5Ot7_11Gc"></script>
	<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
	{{HTML::script('OfertasTorreon/assets/js/gmaps.js')}}
	{{HTML::script('OfertasTorreon/jsOfertasTorreon/PagoPedido.js')}}

@stop
