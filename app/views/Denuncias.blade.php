@extends('base')
@section('head')
<title>Denuncias | Ofertas Torreón</title>
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/owl.carousel.css') }}
{{ HTML::style('css/owl.theme.css') }}
{{ HTML::style('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.css') }}

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
@endsection

@section('contenido')
<div class="main-container inner-page">
<div class="container">
<div class="section-content">
<div class="row ">
<div class="col-sm-8 blogLeft">
<div class="blog-post-wrapper">
@foreach($Denuncias as $Denuncia)
<article class="blog-post-item">
	<div class="inner-box">
		<div class="blog-post-img">
		<a href="{{URL::to('/Denuncias/Detalle', array('denuncia_id' => $Denuncia->id))}}">
		<figure>
		<img class="img-responsive" alt="blog-post image" src="/../../Imagenes/ImagenesDenuncias/{{$Denuncia->NombreImagen}}">
		</figure>
		</a>
		</div>
		 <?php $str=substr($Denuncia->Descripcion, 0, 200)?>
		<div class="blog-post-content-desc">
			<span class="info-row blog-post-meta"> <span class="date"><i class=" icon-clock"> </i>{{$Denuncia->Fecha}} </span> -
			<span class="author"> <i class="fa fa-user"></i> <a rel="author" title="Posts by Jhon Doe" href="#">{{$Denuncia->nombre}}</a></span> -
			<span class="item-location"><i class="fa fa-comments"></i> Comentarios <a href="#">0</a> </span> </span>
			<div class="blog-post-content">
				<h2><a href="{{URL::to('/Denuncias/Detalle', array('denuncia_id' => $Denuncia->id))}}">{{$Denuncia->titulo}}</a></h2>
				<p>{{$str.'...'}}</p>
				<div class="row">
					<div class="col-md-12 clearfix blog-post-bottom">
					<a class="btn btn-primary  pull-left" href="{{URL::to('/Denuncias/Detalle', array('denuncia_id' => $Denuncia->id))}}">Ver mas</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
@endforeach

</div>  
</div> 
<div class="col-sm-4 blogRight page-sidebar">
<aside>
<div class="inner-box">
 
<div class="categories-list  list-filter">
<h5 class="list-title uppercase"><strong><a href="#"> Populares</a></strong></h5>
<div class="blog-popular-content">
@foreach($Top5 as $Populares)
<div class="item-list">
<div class="col-sm-4 col-xs-4 no-padding photobox">
<div class="add-image"> 
	<a href="ads-details.html">
		<img class="no-margin" src="../Imagenes/ImagenesDenuncias/{{$Populares->NombreImagen}}" alt="img">
	</a>
</div>
</div>
<div class="col-sm-8 col-xs-8 add-desc-box">
	<div class="add-details">
		<h5 class="add-title"> <a href="ads-details.html">{{$Populares->titulo}}</a> </h5>
		<span class="info-row"> <span class="date"><i class=" icon-clock"> </i>{{$Populares->Fecha}}</span> </span>
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
 {{HTML::script('OfertasTorreon/assets/bootstrap/js/bootstrap.min.js')}}
 {{HTML::script('OfertasTorreon/assets/js/owl.carousel.min.js')}}
 {{HTML::script('OfertasTorreon/assets/js/form-validation.js')}}
 {{HTML::script('OfertasTorreon/assets/js/jquery.matchHeight-min.js')}}
 {{HTML::script('OfertasTorreon/assets/js/hideMaxListItem.js')}}
 {{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}
 {{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}
 {{HTML::script('OfertasTorreon/assets/js/script.js')}}
@endsection