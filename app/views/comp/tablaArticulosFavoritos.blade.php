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
