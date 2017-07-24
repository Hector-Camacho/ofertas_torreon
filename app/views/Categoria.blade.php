@extends('base')
@section('contenido')

<div class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 page-content col-thin-left">
				<div class="category-list">
					<div class="tab-box ">
						<ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
							<li class="active">
								<a href="#allAds" role="tab" data-toggle="tab">Todos los anuncios <span class="badge">{{ Articulo::where('Status', '=', 0)->count() }}</span></a></li>
							<li>
								<a href="#ventaArts" role="tab" data-toggle="tab">Venta <span class="badge">{{ Articulo::where('TipoVenta', '=', 'Venta')->where('Status', '=', 0)->count() }}</span></a></li>
							<li>
								<a href="#cambioArts" role="tab" data-toggle="tab">Cambio <span class="badge">{{ Articulo::where('TipoVenta', '=', 'Cambio')->where('Status', '=', 0)->count() }}</span></a></li>
						</ul>
						<div class="tab-filter">
							<select class="selectpicker" data-style="btn-select" data-width="auto">
								<option>Ordernar</option>
								<option>Precio: Menor a Mayor</option>
								<option>Precio: Mayor a Menor</option>
							</select>
						</div>
					</div>

				
					<div class="listing-filter">
						<div class="pull-left col-xs-6"></div>
						<div style="clear:both"></div>
					</div>
					<div class="adds-wrapper">
						
				<div class="tab-content">
					<div id="allAds" class="tab-pane fade in active" >
					@foreach($Patrocinadas as $Patrocinada)
										<div class="item-list">
									<div class="cornerRibbons featuredAds">
										<a href="#">Patrocinada</a>
									</div>
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Patrocinada->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">{{ $Patrocinada->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Patrocinada->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Patrocinada->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Patrocinada->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
								@endforeach
							@foreach ($Articulos as $Articulo)
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
											<a href="{{URL::to('/ArticuloDetallado', array('art_id'=>$Articulo->id))}}" class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Detalles</span>
											</a>
										</div>
									</div>
								</div>
							@endforeach
					</div>
					<div id="ventaArts" class="tab-pane fade" >
					@foreach($Patrocinadas as $Patrocinada)
									@if($Patrocinada->TipoVenta=='Cambio')
										<div class="item-list">
									<div class="cornerRibbons featuredAds">
										<a href="#">Patrocinada</a>
									</div>
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Patrocinada->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">{{ $Patrocinada->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Patrocinada->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Patrocinada->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Patrocinada->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
									@endif
								@endforeach
						@foreach ($Articulos as $Articulo)
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
											<a href="{{URL::to('/ArticuloDetallado', array('art_id'=>$Articulo->id))}}"class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Detalles</span>
											</a>
										</div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
					<div id="cambioArts" class="tab-pane fade" >
							@foreach($Patrocinadas as $Patrocinada)
									@if($Patrocinada->TipoVenta=='Cambio')
										<div class="item-list">
									<div class="cornerRibbons featuredAds">
										<a href="#">Patrocinada</a>
									</div>
									<div class="col-sm-2 no-padding photobox">
										<div class="add-image">
											<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/{{ $Patrocinada->NombreImagen1 }}" alt="imagen">
											</a>
										</div>
									</div>
									<div class="col-sm-7 add-desc-box">
										<div class="add-details">
											<h3 class="add-title">
												<a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $Patrocinada->id)) }}">{{ $Patrocinada->Nombre }}</a>
											</h3>
											<span class="info-row">
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>
												Fecha de publicacion: {{$Patrocinada->FechaPublicacion}}</span>
												<span class="category"></span>
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>
												Lugar de entrega:{{$Patrocinada->UbicacionArticulo}}</span>
											</span>
										</div>
									</div>
									<div class="col-sm-3 text-right price-box">
										<div class="add-details">
											<h2 class="item-price">${{ $Patrocinada->Precio }}</h2>
											
											<a class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Ver detalles</span>
											</a>
										</div>
									</div>
								</div>
									@endif
								@endforeach
							@foreach ($Articulos as $Articulo)
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
											<a href="{{URL::to('/ArticuloDetallado', array('art_id'=>$Articulo->id))}}"class="btn btn-success btn-sm make-favorite">
												<i class="fa fa-eye"></i>
												<span>Detalles</span>
											</a>
										</div>
									</div>
								</div>
								@endif
							@endforeach
					</div>

					</div>
					</div>

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
								<li> <a href="/Categorias"> Torreon </a></li>
								<li> <a href="/Categorias"> Gomez </a></li>
								<li> <a href="/Categorias"> Lerdo </a></li>
								<li> <a href="/Categorias"> Parras </a></li>
							</ul>
						</div>

						<div style="clear:both"></div>
					</div>

				</aside>
			</div>
		</div>
	</div>

	<div class="modal fade" id="selectRegion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="exampleModalLabel"><i class=" icon-map"></i> Select your region </h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<p>Popular cities in <strong>New York</strong></p>
							<div style="clear:both"></div>
							<div class="col-sm-6 no-padding">
								<select class="form-control selecter  " id="region-state" name="region-state">
									<option value="">All States/Provinces</option>
									<option value="Alabama">Alabama</option>
									<option value="Alaska">Alaska</option>
									<option value="Arizona">Arizona</option>
									<option value="Arkansas">Arkansas</option>
									<option value="California">California</option>
									<option value="Colorado">Colorado</option>
									<option value="Connecticut">Connecticut</option>
									<option value="Delaware">Delaware</option>
									<option value="District of Columbia">District of Columbia</option>
									<option value="Florida">Florida</option>
									<option value="Georgia">Georgia</option>
									<option value="Hawaii">Hawaii</option>
									<option value="Idaho">Idaho</option>
									<option value="Illinois">Illinois</option>
									<option value="Indiana">Indiana</option>
									<option value="Iowa">Iowa</option>
									<option value="Kansas">Kansas</option>
									<option value="Kentucky">Kentucky</option>
									<option value="Louisiana">Louisiana</option>
									<option value="Maine">Maine</option>
									<option value="Maryland">Maryland</option>
									<option value="Massachusetts">Massachusetts</option>
									<option value="Michigan">Michigan</option>
									<option value="Minnesota">Minnesota</option>
									<option value="Mississippi">Mississippi</option>
									<option value="Missouri">Missouri</option>
									<option value="Montana">Montana</option>
									<option value="Nebraska">Nebraska</option>
									<option value="Nevada">Nevada</option>
									<option value="New Hampshire">New Hampshire</option>
									<option value="New Jersey">New Jersey</option>
									<option value="New Mexico">New Mexico</option>
									<option selected value="New York">New York</option>
									<option value="North Carolina">North Carolina</option>
									<option value="North Dakota">North Dakota</option>
									<option value="Ohio">Ohio</option>
									<option value="Oklahoma">Oklahoma</option>
									<option value="Oregon">Oregon</option>
									<option value="Pennsylvania">Pennsylvania</option>
									<option value="Rhode Island">Rhode Island</option>
									<option value="South Carolina">South Carolina</option>
									<option value="South Dakota">South Dakota</option>
									<option value="Tennessee">Tennessee</option>
									<option value="Texas">Texas</option>
									<option value="Utah">Utah</option>
									<option value="Vermont">Vermont</option>
									<option value="Virgin Islands">Virgin Islands</option>
									<option value="Virginia">Virginia</option>
									<option value="Washington">Washington</option>
									<option value="West Virginia">West Virginia</option>
									<option value="Wisconsin">Wisconsin</option>
									<option value="Wyoming">Wyoming</option>
								</select>
							</div>
							<div style="clear:both"></div>
							<hr class="hr-thin">
						</div>
						<div class="col-md-4">
							<ul class="list-link list-unstyled">
								<li> <a href="#" title="">All Cities</a> </li>
								<li> <a href="#" title="Albany">Albany</a> </li>
								<li> <a href="#" title="Altamont">Altamont</a> </li>
								<li> <a href="#" title="Amagansett">Amagansett</a> </li>
								<li> <a href="#" title="Amawalk">Amawalk</a> </li>
								<li> <a href="#" title="Bellport">Bellport</a> </li>
								<li> <a href="#" title="Centereach">Centereach</a> </li>
								<li> <a href="#" title="Chappaqua">Chappaqua</a> </li>
								<li> <a href="#" title="East Elmhurst">East Elmhurst</a> </li>
								<li> <a href="#" title="East Greenbush">East Greenbush</a> </li>
								<li> <a href="#" title="East Meadow">East Meadow</a> </li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="list-link list-unstyled">
								<li> <a href="#" title="Elmont">Elmont</a> </li>
								<li> <a href="#" title="Elmsford">Elmsford</a> </li>
								<li> <a href="#" title="Farmingville">Farmingville</a> </li>
								<li> <a href="#" title="Floral Park">Floral Park</a> </li>
								<li> <a href="#" title="Flushing">Flushing</a> </li>
								<li> <a href="#" title="Fonda">Fonda</a> </li>
								<li> <a href="#" title="Freeport">Freeport</a> </li>
								<li> <a href="#" title="Fresh Meadows">Fresh Meadows</a> </li>
								<li> <a href="#" title="Fultonville">Fultonville</a> </li>
								<li> <a href="#" title="Gansevoort">Gansevoort</a> </li>
								<li> <a href="#" title="Garden City">Garden City</a> </li>
							</ul>
						</div>
						<div class="col-md-4">
							<ul class="list-link list-unstyled">
								<li> <a href="#" title="Oceanside">Oceanside</a> </li>
								<li> <a href="#" title="Orangeburg">Orangeburg</a> </li>
								<li> <a href="#" title="Orient">Orient</a> </li>
								<li> <a href="#" title="Ozone Park">Ozone Park</a> </li>
								<li> <a href="#" title="Palatine Bridge">Palatine Bridge</a> </li>
								<li> <a href="#" title="Patterson">Patterson</a> </li>
								<li> <a href="#" title="Pearl River">Pearl River</a> </li>
								<li> <a href="#" title="Peekskill">Peekskill</a> </li>
								<li> <a href="#" title="Pelham">Pelham</a> </li>
								<li> <a href="#" title="Penn Yan">Penn Yan</a> </li>
								<li> <a href="#" title="Peru">Peru</a> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
@stop