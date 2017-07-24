@extends('base')
@section('contenido')

<div class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 page-content col-thin-left">
				<div class="category-list">
					@if (!empty($Articulos))
					<div class="tab-box ">

						<ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
							<li class="active"><a href="#allAds" role="tab" data-toggle="tab">Todos los anuncios <span class="badge">{{ Articulo::where('subcategoria_id', '=', $sub_id)->where('Status', '=', 0)->count() }}</span></a></li>
							<li><a href="#ventaArts" role="tab" data-toggle="tab">Venta <span class="badge">{{ Articulo::where('subcategoria_id', '=', $sub_id)->where('TipoVenta', '=', 'Venta')->where('Status', '=', 0)->count() }}</span></a></li>
							<li><a href="#cambioArts" role="tab" data-toggle="tab">Cambio <span class="badge">{{ Articulo::where('subcategoria_id', '=', $sub_id)->where('TipoVenta', '=', 'Cambio')->where('Status', '=', 0)->count() }}</span></a></li>
						</ul>
											</div>

					<div class="listing-filter">
						<div class="pull-left col-xs-6"></div>
						<div style="clear:both"></div>
					</div>
					<div class="tab-content">
							<div id="allAds" class="tab-pane fade in active" >
			@foreach ($Articulos as $Articulo)
									@if($Articulo->Status==0)
									<div class="item-list">
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Articulo->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">{{ $Articulo->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Articulo->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Articulo->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Articulo->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite" href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
								@endif
								@endforeach
							</div>
							<div id="ventaArts" class="tab-pane fade" >
				@foreach ($Articulos as $Articulo)
								@if($Articulo->Status==0)
								@if($Articulo->TipoVenta=='Venta')
									<div class="item-list">
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Articulo->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">{{ $Articulo->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Articulo->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Articulo->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Articulo->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite" href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
								@endif
								@endif
								@endforeach
							</div>
							<div id="cambioArts" class="tab-pane fade" >
						@foreach ($Articulos as $Articulo)
								@if($Articulo->Status==0)
								@if($Articulo->TipoVenta=='Cambio')
									<div class="item-list">
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Articulo->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">{{ $Articulo->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Articulo->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Articulo->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Articulo->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite" href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Articulo->id)) }}">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
								@endif
								@endif
								@endforeach
							</div>
					</div>
					@else
					<div class="col-lg-12">
						<div class="alert alert-success alert-lg" role="alert">
							<h2 class="no-margin no-padding"><span class="fa fa-times"></span> No hay artículos en esta categoria.</h2>
						</div>
					</div>
					@endif
				</div>
				<div class="post-promo text-center"></div>
 
			</div>
			<div class="col-sm-3 page-sidebar">
				<aside>
					<div class="inner-box">
						<div class="categories-list  list-filter">
							<h5 class="list-title"><strong><a href="#">Todas las categorias</a></strong></h5>
							<ul class=" list-unstyled">
								@foreach($Categorias as $Categoria)
								<li>
									<div class="collapse-box">
										<a data-toggle="collapse" href="#cat{{ str_replace(' ', '', $Categoria->nombre) }}"><span class="title"><strong>{{$Categoria->nombre}}</strong></span> <i class="fa fa-angle-down"></i></a>
										<div id="cat{{ str_replace(' ', '', $Categoria->nombre) }}" class="panel-collapse collapse">
											<ul class="list-unstyled">
												@foreach ($Categoria->SubCategorias as $Subcategoria)
												<li>
													<a href="/Categorias/{{ $Subcategoria->id }}/1"><span class="title"><strong>{{ $Subcategoria->nombre }}</strong></span><span class="count">&nbsp;{{ Articulo::where('subcategoria_id', '=', $Subcategoria->id)->where('Status', '=', 0)->count() }}</span></a>
												</li>
												@endforeach
											</ul>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
 
						<div class="locations-list  list-filter">
							<h5 class="list-title"><strong><a href="#">Ubicacion</a></strong></h5>
							<ul class="browse-list list-unstyled long-list">
								<li><a href="/Categorias"> Torreon </a></li>
								<li><a href="/Categorias"> Gomez </a></li>
								<li><a href="/Categorias"> Lerdo </a></li>
								<li><a href="/Categorias"> Parras </a></li>
							</ul>
						</div>

						<div style="clear:both"></div>
					</div>

				</aside>
			</div>
		</div>
	</div>
 
@stop