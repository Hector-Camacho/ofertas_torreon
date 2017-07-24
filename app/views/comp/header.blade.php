<style type="text/css">
	.logo{
    position: relative;
    top: -16px;
    left: -19px;
}.navbar-header img {
    max-height: 72px !important;
}
</style>
<div class="header">
		<nav class="navbar navbar-site navbar-default" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">	
						<div class="navbar-header">
							<a href="/" class="navbar-brand logo logo-title "><span class="logo-icon"><img src="../../OfertasTorreon/images/ofertastorreonlogofinal-01.png" class="ofertaslogo"></span></a>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-5 col-xs-5 hidden-sm hidden-xs">
						<ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
							@if(Auth::id()!=null)
								<li>
									<a href="/Categorias/1"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> Ver ofertas</a>
								</li>
								<li>
									<a href="/OfertasCercanas"><i class="fa fa-eye" aria-hidden="true"></i></i>Ofertas cercanas</a>
								</li>
								<li>
									<a href="/Denuncias"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></i> Ver denuncias</a>
								</li>
								<li role="presentation">
									<a href="/Login"><i class="fa fa-key"></i> <?php echo Auth::user()->Nombre; ?></a>
								</li>
								<li role="presentation">
									<a href="/CerrarSesion"><i class="fa fa-power-off"></i> Cerrar sesión</a>
								</li>
								<li class="postadd">
									<a class="btn btn-block btn-border btn-post btn-primary" href="/PosteaAnuncio">Publica una oferta</a>
								</li>
							@else
								<li>
									<a href="/Categorias/1"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i> Ver ofertas</a>
								</li>
								<li>
									<a href="/OfertasCercanas"><i class="fa fa-shopping-cart" aria-hidden="true"></i></i>Ofertas cercanas</a>
								</li>
								<li>
									<a href="/Denuncias"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></i> Ver denuncias</a>
								</li>
								<li class="postadd">
									<a class="btn btn-block btn-border btn-post btn-success" href="/Login">Iniciar sesion</a>
								</li>
							@endif
						</ul>
					</div>
				</div>
				<div class="row hidden-lg hidden-md" id="slidemenu">
				<div class="row-menu">
					@if(Auth::id()!=null)
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #03876d;"></i>
								<a href="/Panel/EditarPerfil"><i class="fa fa-user fa-stack-1x fa-inverse"></i></a>
							</span>
							<p><?php echo Auth::user()->Nombre; ?></p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-danger"></i>
								<a href="/PosteaAnuncio"><i class="fa fa-ticket fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Publicar oferta</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-danger"></i>
								<a href="/Categorias/1"><i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Ver ofertas</p>
						</div>

						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-danger"></i>
								<a href="/Panel/Denunciar"><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Denunciar</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-inverse"></i>
								<a href="/Panel/Favoritos"><i class="fa fa-heart fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Publicaciones favoritas</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-inverse"></i>
								<a href="/Panel/MisMensajes"><i class="fa fa-commenting-o fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Mensajes</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-inverse"></i>
								<a href="/Panel/MisDenuncias"><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Mis denuncias</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #03876d;"></i>
								<a href="/CerrarSesion"><i class="fa fa-sign-out fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Cerrar sesión</p>
						</div>
					@else
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #03876d;"></i>
								<a href="/Login"><i class="fa fa-sign-in fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Iniciar Sesión</p>
						</div>
						
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-danger"></i>
								<a href="/Categorias/1"><i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Ver ofertas</p>
						</div>
						<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x text-danger"></i>
								<a href="/OfertasCercanas"><i class="fa fa-eye fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Ofertas cercanas</p>
						</div>
					@endif
					<div class="text-center item-menu">
							<span class="fa-stack fa-2x">
								<i class="fa fa-circle fa-stack-2x" style="color: #03876d;"></i>
								<a href="/Denuncias"><i class="fa fa-exclamation-triangle fa-stack-1x fa-inverse"></i></a>
							</span>
							<p>Denuncias</p>
						</div>

				</div>
			</div>
			</div>
		</nav>
		</div>
<!-- /Menu -->
