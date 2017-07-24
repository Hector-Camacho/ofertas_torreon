<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 {{HTML::style('OfertasTorreon/assets/ico/apple-touch-icon-144-precomposed.png')}}
 {{HTML::style('OfertasTorreon/assets/ico/apple-touch-icon-114-precomposed.png')}}
 {{HTML::style('OfertasTorreon/assets/ico/apple-touch-icon-72-precomposed.png')}}
 <link rel="shortcut icon" href="/favicon.png">

<title>Página de Inicio - Ofertas Torreón</title>

{{HTML::style('OfertasTorreon/assets/bootstrap/css/bootstrap.min.css')}}
{{HTML::style('OfertasTorreon/assets/css/style.css')}}
{{HTML::style('OfertasTorreon/assets/css/fileinput.min.css')}}
{{HTML::style('OfertasTorreon/assets/css/owl.carousel.css')}}
{{HTML::style('OfertasTorreon/assets/css/owl.theme.css')}} 

{{HTML::style('css/star-rating.min.css')}}
{{HTML::style('css/star-rating.css')}}
<script>
    paceOptions = {
      elements: true
    };
</script>
{{HTML::script('OfertasTorreon/assets/js/pace.min.js')}}
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/star-rating.min.js')}}
{{HTML::script('js/star-rating.js')}}

{{HTML::script('OfertasTorreon/assets/plugins/autocomplete/jquery.mockjax.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/autocomplete/jquery.autocomplete.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/autocomplete/usastates.js')}}
{{-- {{HTML::script('OfertasTorreon/assets/plugins/autocomplete/autocomplete-demo.js')}} --}}


</head>
<body>
<style type="text/css">
	.logo{
    position: relative;
    top: -16px;
    left: -19px;
}.navbar-header img {
    max-height: 84px !important;
}
body::-webkit-scrollbar {
	width: 0;
	height: 0;
}
body::-webkit-scrollbar-thumb {
	background-color: transparent;
}
.header-search {
	padding: 20px 0 15px;
}
.group-search > a {
	position: absolute;
	padding: 12px 14px;
}
#headmenu {
	margin-bottom: 5px;
}
#slidemenu {
	overflow-x: auto;
	-webkit-overflow-scrolling: touch;
}
#slidemenu::-webkit-scrollbar {
	width: 8px;
	height: 8px;
}
#slidemenu::-webkit-scrollbar-thumb {
	background-color: #000;
	border-radius: 5px;
}
.row-menu {
	display: inline-flex;
	width: 100%;
}
.row-menu .item-menu {
	display: inline-block;
	padding: 0 20px;
}
</style>
<div id="wrapper">
<div class="header">
<nav class="navbar navbar-site navbar-default" role="navigation">
<div class="container">
<div class="container">
				<div class="col-lg-4 col-md-4 col-sm-7 col-xs-7">
					<div class="navbar-header">
						<div class="navbar-header">
						<a href="/" class="navbar-brand logo logo-title "><span class="logo-icon"><img src="../../OfertasTorreon/images/ofertastorreonlogofinal-01.png" class="ofertaslogo"></span></a>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-5 col-xs-5 hidden-sm hidden-xs">
					<ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
						
						@if(Auth::id()!=null)
							<li role="presentation">
								<a href="/Login"><i class="fa fa-key"></i> <?php echo Auth::user()->Nombre; ?></a>
							</li>
						<li role="presentation">
							<a href="/CerrarSesion"><i class="fa fa-power-off"></i> Cerrar sesión</a>
						</li>

						<li>
							<a href="/Denuncias"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></i> Ver denuncias</a>
						</li>
						<li class="postadd"><a class="btn btn-block btn-border btn-post btn-primary" href="/PosteaAnuncio">Publica una oferta</a></li>
						@else

						<li>
							<a href="/Denuncias"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></i> Ver denuncias</a>
						</li>
						<li>
							<a href="/Login"><i class="fa fa-key"></i> Inicia sesion</a>
						</li>
						@endif
					</ul>
				</div>
 
</div>
 
</nav>
</div>
 
<div class="main-container">
<div class="container">
<div class="row">
<div class="col-sm-3 page-sidebar">
<aside>
<div class="inner-box">
<div class="user-panel-sidebar">
<div class="collapse-box">
<h5 class="collapse-title no-border"> Publicaciones <a class="pull-right" data-toggle="collapse" href="#MyClassified"><i class="fa fa-angle-down"></i></a></h5>
<div id="MyClassified" class="panel-collapse collapse in">
<ul class="acc-list">

<li><a href="/Panel/Administrador/MisPublicaciones"><i class="icon-docs"></i> Mis publicaciones <span class="badge">{{ DB::table('articulos')->where('usuario_id', '=', Auth::user()->id)->count() }}</span> </a></li>
<li><a href="/Panel/Administrador/Favoritos"><i class="icon-heart"></i> Mis favoritas <span class="badge">{{ DB::table('publicacionesfavoritas')->where('usuario_id', '=', Auth::user()->id)->count()  }}</span> </a></li>
</ul>
</div>
</div>
 
<div class="collapse-box">
<h5 class="collapse-title">Acciones <a class="pull-right" data-toggle="collapse" href="#MyAcciones"><i class="fa fa-angle-down"></i></a></h5>
<div id="MyAds" class="panel-collapse collapse in">
<ul class="acc-list">
<li><a href="/Panel/Administrador/UsuariosRegistrados"><i class="fa fa-users"></i> Usuarios registrados <span class="badge">{{Usuario::find(Auth::id())->count()}}</span> </a></li>
<li><a href="/Panel/Administrador/Reportes"><i class="fa fa-bullhorn"></i> Reportes de publicaciones <span class="badge">{{ ReportePublicacion::all()->count() }}</span></a></li>

</ul>
</div>
</div> 
<div class="collapse-box">
<h5 class="collapse-title">Anuncios<a class="pull-right" data-toggle="collapse" href="#MyEconomy"><i class="fa fa-angle-down"></i></a></h5>
<div id="MyEconomy" class="panel-collapse collapse in">
<ul class="acc-list">
<li><a href="/Panel/Administrador/Anuncios"><i class="fa fa-money"></i> Ver anuncios</a></li>
<li><a href="/Panel/Administrador/PublicacionMarcada"><i class="fa fa-pencil-square-o"></i>Editar anuncios </a></li>

</ul>
</div>
</div>

<div class="collapse-box">
	<h5 class="collapse-title"> Referencias <a class="pull-right" data-toggle="collapse" href="#MyAds"><i class="fa fa-angle-down"></i></a></h5>
	<div id="MyAds" class="panel-collapse collapse in">
		<ul class="acc-list">
			<li><a href="/Panel/Administrador/MisMensajes"><i class="icon-folder-close"></i> Mensajes </a></li>
		</ul>
	</div>
</div>
 
</div>
</div>
 
</aside>
</div>
 
 
<div class="col-sm-9 page-content">
	@yield('content')
</div>


 
</div>
<div class="row">
	<div class="footer" id="footer">
<div class="container">
<ul class=" pull-left navbar-link footer-nav">
<li><a href="/"> Inicio
<a href="#ContactoFB"> Contacto Facebook </a>
</ul>
<ul class=" pull-right navbar-link footer-nav">
<li> &copy; <?php echo date('Y')?> Luxmarketing </li>
</ul>
</div>
</div>
</div>
 
</div>
 
</div>
 

 
</div>





{{HTML::script('OfertasTorreon/assets/bootstrap/js/bootstrap.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/fileinput.min.js')}}

<script>
$("#input-upload-img1").fileinput();


</script>

{{HTML::script('OfertasTorreon/assets/js/owl.carousel.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/jquery.matchHeight-min.js')}}
{{HTML::script('OfertasTorreon/assets/js/hideMaxListItem.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}
{{HTML::script('OfertasTorreon/assets/js/script.js')}}


</body>
</html>
