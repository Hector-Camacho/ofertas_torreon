@extends('CuentaPrincipalUsuario')
@section('content')
<div class="inner-box">
	<h2 class="title-2"><i class="icon-heart-1"></i> Mis publicaciones favoritas</h2>
	<div id="tablon">
		<?php
		$usuario = PublicacionFavorita::select(DB::raw('articulos.id as articulo_id'), 'articulos.NombreImagen1', 'articulos.Nombre', 'articulos.Precio', 'articulos.UbicacionArticulo', 'articulos.Descripcion', 'articulos.TipoVenta', 'publicacionesfavoritas.id')
			->join('articulos','articulos.id', '=', 'publicacionesfavoritas.articulo_id')
			->join('usuarios','usuarios.id', '=', 'publicacionesfavoritas.usuario_id')
			->where('publicacionesfavoritas.usuario_id', '=', Auth::id())
			->get()
		?>
		@if (PublicacionFavorita::where('usuario_id', Auth::id())->count() > 0)
		<div class="table-responsive" name="TablaFavoritos">
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
					@foreach ($usuario as $articulo)
					<tr>
						<td style="width:14%" class="add-img-td"><a href="#"><img class="thumbnail no-margin" src="/Imagenes/ImagenesArticulos/{{ $articulo['NombreImagen1'] }}"></a></td>
						<td style="width:58%" class="ads-details-td">
							<div>
								<p><strong><a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $articulo['articulo_id'])) }}" title="{{ $articulo['Nombre'] }}">{{ $articulo['Nombre'] }}</a></strong></p>
								<p><strong>Detalles:</strong> {{ $articulo['Descripcion'] }}</p>
								<p><strong>Ubicación:</strong></p>
							</div>
						</td>
						<td style="width:16%" class="price-td"><div><strong> ${{ $articulo['Precio'] }}</strong></div></td>
						<td style="width:10%" class="action-td">
							<div>
								<p><a href="javascript:;" onclick="$('#ElimFav').modal('toggle'); document.getElementById('EliminarF').setAttribute('data-artic', {{ $articulo['id'] }})" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Eliminar Favorito </a></p>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="row" id="AlertaSinFavoritos">
			<div class="col-lg-12">
				<div class="alert alert-success  alert-lg" role="alert">
					<h2 class="no-margin no-padding"><span class="fa fa-heart-o"></span> Aún no haz agregado Favoritos</h2>
					<h4>Visita la página principal <a href="/" >ofertas.torreon.com</a></h4>
				</div>
			</div>
		</div>
		@endif
	</div>
	{{-- <div class="row">
		<div class="form-group">
			<h4>Se eliminó el favorito</h4>
		</div>
	</div> --}}
</div>


{{-- Modal --}}
<div class="modal fade" id="ElimFav" data-backdrop="static" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title"><i class="fa icon-info-circled-alt"></i> Eliminar Favorito </h4>
			</div>
			<div class="modal-body">
				<h4 class="control-label">¿Seguro que quieres quitar esta publicación de tus Favoritos?</h4>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button type="button" id="EliminarF" onclick="eliminarFavorito(this)" class="btn btn-success btn-block">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button type="button" class="btn btn-danger btn-block" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{HTML::script('OfertasTorreon/jsOfertasTorreon/FavoritosPanelUsuario.js')}}

@stop
