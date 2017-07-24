@extends('CuentaPrincipalUsuario')
@section('content')
<div class="inner-box">
	<h2 class="title-2"><i class="icon-docs"></i> Mis publicaciones</h2>
	<div id="tablon">
		<?php $usuario = Usuario::find(Auth::user()->id)?>
		@if ($usuario->Articulos->count() > 0)
		<div class="table-responsive">
			<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
				<thead>
					<tr>
						<th> Fotografía </th>
						<th data-sort-ignore="true"> Detalles </th>
						<th data-type="numeric"> Precio </th>
						<th> Opciones </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($usuario->Articulos as $articulo)
					<tr>
						<td style="width:14%" class="add-img-td"><a href="#">
							<img class="thumbnail no-margin" src="/Imagenes/ImagenesArticulos/{{ $articulo->NombreImagen1 }}"></a>
						</td>
						<td style="width:58%" class="ads-details-td">
							<div>
								@if (!$articulo->Status)
								<p><strong><a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $articulo->id)) }}" title="{{ $articulo->Nombre }}"> {{ $articulo->Nombre }}</a></strong></p>
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
								<p><a class="btn btn-primary btn-xs btn-block" href="#" data-artic="{{ $articulo->id }}" onclick="TraerDetallesArticulo(this)"><i class="fa fa-edit"></i> Editar </a></p>
								<p><a class="btn btn-default btn-xs btn-block" href="#" onclick="event.preventDefault(); $('#modalVenderPublicacion').modal('toggle'); document.getElementById('venderYa').setAttribute('data-artic', {{ $articulo->id }})"><i class="fa fa-shopping-cart"></i> Vender </a></p>
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
				</tbody>
			</table>
		</div>
		@else
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success alert-lg" role="alert">
					<h2 class="no-margin no-padding"><span class="fa fa-times"></span> Aún no ningún artículo en venta.</h2>
					<h4>Para poner a la venta un artículo, pasa por este enlace: <a href="/PosteaAnuncio" >ofertas.torreon.com/PosteaAnuncio</a></h4>
				</div>
			</div>
		</div>
		@endif
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
						<div class="col-md-9">
							<label class="radio-inline" for="radios-0"><input name="radios" id="radios-0" value="Venta" checked="checked" type="radio">Venta </label>
							<label class="radio-inline" for="radios-1"><input name="radios" id="radios-1" value="Cambio" type="radio">Cambio </label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Lugar de Entrega</label>
						<div class="col-md-9">
							<textarea class="form-control" id="entrega" name="entrega" style="resize:none;" rows="2" placeholder="Lugar donde se entregará el artículo."></textarea>
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
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de vender este articulo.</h3>
				<h4>¿Desea usar el envio a domicilio? (VoyExpress Torreon)</h4>
				<form class="form" name="FormVenderArticulo"> 
					<div class="radio">
						<label>
							<input type="radio" name="VoyExpress" id="inputsi" value="si" checked="checked">
							Si, deseo usar el servicio de VoyExpress.
						</label>
						<label>
							<input type="radio" name="VoyExpress" id="inputno" value="si">
							No, yo mismo quiero entregar el articulo en persona.
						</label>
					</div>
				</form>
				 <div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="venderYa" onclick="VenderArticulo(this)">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-danger btn-block" onclick="$('#modalVenderPublicacion').modal('toggle')">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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

{{HTML::script('OfertasTorreon/jsOfertasTorreon/VerComentarios.js')}}

@stop
