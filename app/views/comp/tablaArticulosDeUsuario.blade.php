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
