<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*-----## RECURSOS ##-------*/
Route::resource('/RegistroUsuario','UsuarioController');
Route::resource('/AgregarArticulo','ArticuloController');
Route::resource('/AgregarDenuncia','DenunciaController');
// Route::resource('/GuardarAnuncio','PublicacionAnunciadaController');

/*-----## RUTEO POR GET ##-------*/
Route::get('/', function()
{
	$lista2=DB::table('articulos')->join('articulosdestacados','articulos.id','=','articulosdestacados.idArticulos')->select('articulos.Nombre','articulos.Precio','articulos.NombreImagen1','articulos.id')->get();
	$lista1=DB::table('publicacionesanunciadas')->get();
	
	//Articulos sin patrocinio
	$lista= DB::table('articulos')->select('articulos.Nombre','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->whereNotIn('id', function($query){
		$query->select('idArticulos')->from('articulosdestacados');
	})->orderBy('id','desc')->get();
	
	//Todas las categorias
	$Lista = new Categoria();
	$Categoria=$Lista::all();

	//Categorias mas vendidas
	$CategoriasVendidas=DB::table('articulos')->join('subcategorias','articulos.subcategoria_id','=','subcategorias.id')->join('categorias','categorias.id','=','subcategorias.categoria_id')->select(DB::raw('count(*) as cantidad, categorias.nombre, categorias.id'))->groupBy('categorias.id')->orderBy('cantidad','desc')->get();
	
	//Articulos patrocinados
	$Patrocinadas = DB::table('articulosdestacados')->join('articulos','articulos.id','=','articulosdestacados.idArticulos')->select('articulos.Nombre','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->where('status','=',0)->get();
	return View::make('index')->with('Articulos', $lista)->with('Anuncios',$lista2)->with('Banner',$lista1)->with('Categorias',$Categoria)->with('CategoriasVendidas',$CategoriasVendidas)->with('Patrocinadas',$Patrocinadas);
});
Route::get('PosteaAnuncio',function(){
	$Lista = new Categoria();
	$Categoria=$Lista::all();
	return View::make('BaseEncabezado')->with('Categorias', $Categoria);
});
Route::get('Anunciate',function(){
	Session::flash('Permiso','Denegado');
	return View::make('Anunciate');
});
Route::get('/Categorias',function(){
	return Redirect::to('/Categorias/1');
});
Route::get('/Buscador',function(){
	return Redirect::to('/');
});

Route::get('/Panel/MisPublicaciones', function()
{
	return View::make('comp.PanelMisPublicaciones');
});
Route::get('/Panel/MisMensajes', function()
{
	return View::make('comp.PanelMensajes');
});
Route::get('/Panel/MisComentarios', function()
{
	return View::make('comp.PanelMisComentarios');
});
Route::get('/Panel/Favoritos', function()
{
	return View::make('comp.PanelFavoritos');
});
Route::get('/Privacidad',function(){
	return View::make('PoliticaPrivacidad');
});
Route::get('OfertasCercanas',function(){
	$Categorias = Categoria::all();
	return View::make('Geolocalizacion')->with('Categorias',$Categorias);
});
Route::get('/Panel/EditarPerfil', function(){
	$InfoUsuario=Usuario::find(Auth::id());
	return View::make('comp.EditarPerfil')->with('InfoUsuario',$InfoUsuario);
});
Route::get('/Panel/Denunciar', function () {
	return View::make('comp.PanelDenunciar');
});
Route::get('/Panel/MisDenuncias', function () {
	return View::make('comp.PanelMisDenuncias');
});
Route::get('/Denuncias', function(){
	$Denuncia = new Denuncia;
	$Denuncias = DB::table('denuncias')->join('usuarios','usuarios.id','=','denuncias.usuario_id')->select('denuncias.id','usuarios.nombre','usuarios.nombre','denuncias.Descripcion', 'denuncias.titulo', 'denuncias.NombreImagen', 'denuncias.Fecha')->orderBy('denuncias.id', 'desc')->get();

	$Top5=Denuncia::orderBy('id','desc')->take(5)->get();
	return View::make('Denuncias',compact('Denuncias','Top5'));
});
Route::get('/Denuncias/Detalles', function(){
	return View::make('DenunciasDetalles');
});
Route::get('/FinalizarRegistro',function(){
	 return View::make('RegistroFacebook');
});
Route::get('/Login', 'UsuarioController@MostrarLogin');

/*-----## RUTEO DE ERRORES HTTP ##-------*/
 App::missing(function($exception){
  	return Redirect::intended('PaginaNoEncontrada');
  });
 Route::get('PaginaNoEncontrada', function(){return View::make('404');});

/*-----------RUTEO DEL ADMINISTRADOR-----------------*/
Route::get('Panel/Administrador', function(){
	return View::make('CuentaPrincipalAdministrador');
});
Route::get('/Panel/Administrador/MisMensajes', function()
{
	return View::make('Administrador.PanelMensajes');
});
Route::get('/Panel/Administrador/Anuncios', function()
{
	return View::make('Administrador.Anuncios');
});
Route::get('/Panel/Administrador/PublicacionMarcada',function(){
	return View::make('Administrador.EditarAnuncio');
});
Route::get('/Panel/Administrador/MisComentarios', function()
{
	return View::make('Administrador.PanelMisComentarios');
});
Route::get('/Panel/Administrador/Favoritos', function()
{
	return View::make('Administrador.PanelFavoritos');
});
Route::get('/Panel/Administrador/MisPublicaciones', function()
{
	return View::make('Administrador.PanelMisPublicaciones');
});
Route::get('/Panel/Administrador/UsuariosRegistrados',function(){
	$Usuario = new Usuario();
	$Usuarios=$Usuario::all();
	return View::make('Administrador.UsuariosRegistrados',compact('Usuarios'));
});
Route::get('/Panel/Administrador/NuevoAnuncio',function(){
	return View::make('Administrador.PanelRegistroAnuncios');
});
Route::get('/Panel/Administrador/EditarAnuncios',function(){
	return View::make('Administrador.PanelEditarAnuncios');
});
Route::get('/Panel/Administrador/MisMensajes', function(){
	return View::make('Administrador.PanelMensajes');
});
Route::get('/Panel/Administrador/Reportes', function () {
	return View::make('Administrador.PanelMisComentarios');
});
/*------------TERMINA EL RUTEO DEL ADMINISTRADOR-------------*/

/*-----## RUTEO POR POST ##-------*/
Route::post('AddComentario', 'PublicacionController@GuardarComentario');
Route::post('CargarComentarios', 'PublicacionController@CargarComentarios');
Route::post('EnviarMensaje', 'MensajeUsuarioController@GuardarMensaje');
Route::post('EnviarRespuestaMensaje', 'MensajeUsuarioController@EnviarRespuestaMensaje');
Route::post('MostrarMisPublicaciones', 'ArticuloController@MostrarMisPublicaciones');
Route::post('/MisPublicaciones/MostrarArticuloDetalles', 'ArticuloController@MostrarArticuloDetalles');
Route::post('/MisPublicaciones/EditarArticuloDetalles', 'ArticuloController@EditarArticuloDetalles');
Route::post('/MisPublicaciones/VenderArticulo', 'ArticuloController@VenderArticulo');
Route::post('/MisPublicaciones/BorrarArticulo', 'ArticuloController@BorrarArticulo');
Route::post('ConsultaDeNombresDeUsuarios', 'UsuarioController@ConsultaDeNombresDeUsuarios');
Route::post('/BanearUsuario', 'UsuarioController@Banear');
Route::post('/DesbanearUsuario', 'UsuarioController@Desbanear');
Route::post('AgregarFavorito', 'ArticuloController@AgregarFavorito');
Route::post('EliminarFavorito', 'ArticuloController@EliminarFavorito');
Route::post('QuitarFavorito', 'ArticuloController@QuitarFavorito');
Route::post('/ReportarArticulo', 'ReportePublicacionController@Reportar');
Route::post('/BorrarArticuloRep', 'ArticuloController@BorrarArticuloRep');
Route::post('/BorrarReporte', 'ReportePublicacionController@BorrarReporte');
Route::post('MostrarPublicaciones', 'PublicacionAnunciadaController@MostrarPublicaciones');
Route::post('/MisDenuncias/MostrarDenuncia', 'DenunciaController@MostrarDenuncia');
Route::post('/MisDenuncias/EditarDenuncia', 'DenunciaController@EditarDenuncia');
Route::post('/MisDenuncias/BorrarDenuncia', 'DenunciaController@BorrarDenuncia');
Route::post('/harvesine','ArticuloController@OfertasCercanas');
Route::post('/EditarPerfilUsuario', 'UsuarioController@EditarPerfilUsuario');
Route::post('/RegistrarUsuario', 'UsuarioController@GuardarUsuario');
Route::post('/CambiarContrena', 'UsuarioController@CambiarContrena');
Route::post('/Login', 'UsuarioController@IniciarSesion'); //Numero 1
Route::post('MostrarComentarios', 'PublicacionController@VerPublicaciones');
Route::post('CargarFavoritos', 'PublicacionController@CargarFavoritos');
Route::post('GuardarComentario', 'PublicacionController@GuardarComentario');
Route::post('ConsultaDeNombresDeUsuarios', 'UsuarioController@ConsultaDeNombresDeUsuarios');
Route::post('RegistrarArticulo', 'ArticuloController@GuardarArticulo');
Route::post('Panel/RegistrarDenuncia', 'DenunciaController@GuardarDenuncia');
Route::post('/MostrarMensajes','MensajeUsuarioController@MostrarMensajes');
Route::post('/MostrarUsuarios','UsuarioController@ShowUser');
Route::post('RegistrarBanner', 'PublicacionAnunciada@GuardarArticulo');
Route::post('/GuardarAnuncio', 'PublicacionAnunciadaController@GuardarAnuncio');
Route::post('/GuardarPatrocinado','PublicacionAnunciadaController@GuardarAnuncioPatrocinadoCarrusel');
Route::post('/EditarAnuncio', 'PublicacionAnunciadaController@EditarAnuncio');
Route::post('/EliminarAnuncio', 'PublicacionAnunciadaController@EliminarAnuncio');
Route::post('/GuardarArticulo','ArticuloDestacadoController@GuardarArticulo');
Route::post('/MostrarPublicacionesMarcadas','ArticuloDestacadoController@MostrarArticulos');
Route::post('/EliminarPublicacionMarcada','ArticuloDestacadoController@EliminarArticulo');
Route::post('/ModificarPublicacionMarcada','ArticuloDestacadoController@ModificarArticulo');
Route::post('/CargarComentariosDenuncia', 'ComentarioDenunciaController@CargarComentarios');
Route::post('/GuardarComentariosDenuncia','ComentarioDenunciaController@InsertarComentarios');
Route::post('/GuardarOferta','ArticuloDestacadoController@GuardarArticulo');
Route::post('/GuardarEnvio','ArticuloController@PagarEnvio');
Route::get('/logout',array('as'=>'logout','uses'=>'AuthController@getLoggedOut'));
Route::get('/Categorias/{page_id}', ['as' => 'Categorias', 'uses' => 'CategoriaController@Categoria']);
Route::get('/Buscador/{articulo_nombre}', ['as' => 'Buscador', 'uses' => 'ArticuloController@BuscarArticulos']);
Route::get('/Categorias/{subcategoria_id}/{page_id}', ['as' => 'Categorias', 'uses' => 'CategoriaController@Subcategoria']);
Route::get('/Denuncias/Detalle/{denuncia_id}', ['as' => 'Denuncias', 'uses' => 'DenunciaController@MostrarDenuncia']);
Route::get('/ArticuloDetallado/{art_id}',['as' => 'ArticuloDetallado', 'uses' =>  'ArticuloController@Detalle']);
Route::get('fbauth/{auth?}', array('as'=>'facebookAuth','uses'=>'AuthController@getFacebookLogin'));

/*-----## DESVERGUE Y RUTEO DEL INICIO DE SESION ##-------*/
//Grupo de rutas a las que se accedera si el usuario se encuentra autentificado
Route::group(array('before' => 'auth'), function()
{
	Route::get('/Panel',function(){
		# return View::make('CuentaPrincipalUsuario');
		return Redirect::to('/');
	});
	Route::get('/CerrarSesion','UsuarioController@CerrarSesion');
});
//Grupo de rutas a las que se accedera si el usuario NO se encuentra autentificado
Route::group(array('after'=>'auth'),function()
{
	Route::get('/Panel',function(){
		# return Redirect::to('/');
		return View::make('CuentaPrincipalUsuario');
	});
	// Route::get('/CerrarSesion','UsuarioController@CerrarSesion');
});

