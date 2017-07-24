<?php
date_default_timezone_set('America/Monterrey');
setlocale(LC_TIME, "es_ES");
include(app_path().'/config/includes/lib/Conekta.php');
class ArticuloController extends BaseController {
	private $Carpeta = "Imagenes/ImagenesArticulos";
	public function index(){
		$files= File::files($this->folder);
		return View::make('BaseEncabezado')->with('images',$files);
	}
	public function PagarEnvio(){
		extract($_POST);
		extract($Correo);
		extract($Pago);
		Conekta::setApiKey("key__LmEbyCV8FGYoBFt");
		$charge = Conekta_Charge::create(array(
	  'description'=> 'Monto por servicio a domicilio de VoyExpress',
	  'reference_id'=> '9388-Voy',
	  'amount'=> $Pago[0]['CostEnv'],
	  'currency'=>'MXN',
	  'card'=> $Pago[0]['secret'],
		  'details'=> array(
		    'name'=> $Pago[0]['Nombre'],
		    'phone'=> '817-840-423',
		    'email'=> 'ofertastorreon@torreon.mx',
		    'customer'=> array(
		      'corporation_name'=> 'OfertasTorreon inc.',
		      'logged_in'=> true,
		      'successful_purchases'=> 0,
		      'created_at'=> 1379784950,
		      'updated_at'=> 1379784950,
		      'offline_payments'=> 0,
		      'score'=> 0
		    ),
		    'line_items'=> array(
		      array(
		        'name'=> 'Box of Cohiba S1s',
		        'description'=> 'Imported From Mex.',
		        'unit_price'=> 20000,
		        'quantity'=> 1,
		        'sku'=> 'cohb_s1',
		        'type'=> 'food'
		      )
		    ),
		    'billing_address'=> array(
		      'street1'=>$Pago[0]['Calle'],
		      'street2'=> $Pago[0]['Colonia'],
		      'street3'=> null,
		      'city'=> $Pago[0]['Ciudad'],
		      'state'=>$Pago[0]['Estado'] ,
		      'zip'=> $Pago[0]['CP'],
		      'country'=> 'Mexico',
		      'phone'=> '77-777-7777',
		      'email'=> 'purshasing@x-men.org'
		    ),
		    'shipment'=> array(
		      'carrier'=> 'estafeta',
		      'service'=> 'international',
		      'price'=> 20000,
		      'address'=> array(
		        'street1'=> '250 Alexis St',
		        'street2'=> null,
		        'street3'=> null,
		        'city'=> 'Red Deer',
		        'state'=> 'Alberta',
		        'zip'=> 'T4N 0B8',
		        'country'=> 'Canada'
		      )
	    )
		  )
	));
		if($charge->status=='paid'){
			$Fecha = strftime("%A, %d de %B del %Y");
				try{
				$to      = 'h.camacho@luxmarketing.mx, p.diaz@luxmarketing.mx';
				$subject = 'Ofertas torreon | Solicitud de envio';
				$message = '<html><body>';
				$message .= '<img src="https://www.ofertastorreon.mx/OfertasTorreon/images/ofertastorreonlogofinal-01.png" alt="Solicitud de envio" style="max-height:150px;" />';
				$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				$message .= "<tr style='background: #F3D529;'><td><strong>Articulo:</strong> </td><td>" . strip_tags($Correo[0]['Articulo']) . "</td></tr>";
				$message .= "<tr><td><strong>Direccion de recogida:</strong></td><td>" . strip_tags($Correo[0]['Entrega']) . "</td></tr>";
				$message .= "<tr><td><strong>Nombre del vendedor:</strong></td><td>" . $Correo[0]['Vendedor'] . "</td></tr>";
				$message .= "<tr><td><strong>Direccion de entrega:</strong></td><td>" . strip_tags($Correo[0]['Direccion']) . "</td></tr>";
				$message .= "<tr><td><strong>Nombre del comprador:</strong></td><td>" . strip_tags($Correo[0]['Comprador']) . "</td></tr>";
				$message .= "<tr><td><strong>Distancia entre los 2 puntos:</strong></td><td>" . $Correo[0]['Distancia'] . "</td></tr>";
				$message .= "<tr><td><strong>Cantidad del producto:</strong></td><td>" . $Correo[0]['Cantidad'] . "</td></tr>";
				$message .= "<tr><td><strong>Precio del producto:</strong></td><td>" . $Correo[0]['Precio'] . "</td></tr>";
				$message .= "<tr><td><strong>Fecha del pedido:</strong></td><td>" . $Fecha . "</td></tr>";
				$message .= "</table>";
				$headers = 'From: ofertaslaguna84@gmail.com'. "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				    $headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=utf-8\r\n";
				$estatus=mail($to, $subject, $message, $headers);	
					if ($estatus==true) {
						return json_encode(array('estatus'=>true));
					}
					else
					{
						return json_encode(array('estatus'=>false));
					}
				}
				catch(Exception $e){
					return json_encode(array('estatus'=>false, 'error'=>$e->getMessage()));
				}
		}
		else
		{
			return $charge->status;
		}
	}
	public function GuardarArticulo()
	{
		extract($_POST);
		$date = date('Y/m/d');
		if(Input::hasFile('Imagen1') || Input::hasFile('Imagen2') ||Input::hasFile('Imagen3') ||Input::hasFile('Imagen4') ||Input::hasFile('Imagen5'))
		{
			$Articulo = new Articulo();
			if (Input::file('Imagen1')!=null) {
				$imagen=Input::file('Imagen1');
				$Filename1 = Str::lower(
				    pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)
				    .'-'
				    .uniqid()
				    .'.'
				    .$imagen->getClientOriginalExtension()
				);
				$Articulo->NombreImagen1=$Filename1;
				$Upload=Input::file('Imagen1')->move($this->Carpeta.'/',$Filename1).'jpg';
			}
			if (Input::file('Imagen2')!=null) {
				$Filename2 = Str::lower(
				    pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)
				    .'-'
				    .uniqid()
				    .'.'
				    .$imagen->getClientOriginalExtension()
				);
				$Articulo->NombreImagen2=$Filename2;
				$Upload=Input::file('Imagen2')->move($this->Carpeta.'/',$Filename2);
			}
			if (Input::file('Imagen3')!=null) {
				$Filename3 = Str::lower(
				    pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)
				    .'-'
				    .uniqid()
				    .'.'
				    .$imagen->getClientOriginalExtension()
				);
				$Articulo->NombreImagen3=$Filename3;
				$Upload=Input::file('Imagen3')->move($this->Carpeta.'/',$Filename3);
			}
			if (Input::file('Imagen4')!=null) {
				$Filename4 = Str::lower(
				    pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)
				    .'-'
				    .uniqid()
				    .'.'
				    .$imagen->getClientOriginalExtension()
				);
				$Articulo->NombreImagen4=$Filename4;
				$Upload=Input::file('Imagen4')->move($this->Carpeta.'/',$Filename4);
			}
			if (Input::file('Imagen5')!=null) {
				$Filename5 = Str::lower(
				    pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)
				    .'-'
				    .uniqid()
				    .'.'
				    .$imagen->getClientOriginalExtension()
				);
				$Articulo->NombreImagen5=$Filename5;
				$Upload=Input::file('Imagen5')->move($this->Carpeta.'/',$Filename5);
			}
			if(Auth::user()){
				$Articulo->usuario_id=Auth::id();
			}
			else{
				$id=DB::table('usuarios')->where('hybridauth_provider_uid','=',$perfil->identifier)->get();
				$Articulo->usuario_id=$id[0]->id;
			}
				$Articulo->nombre=$Adtitle;
				$Articulo->latitud=$latitud;
				$Articulo->longitud=$longitud;
				$Articulo->descripcion=$textarea;
				$Articulo->precio=$Price;
				$Articulo->TipoVenta=$radios;
				$Articulo->subcategoria_id=$Categorias;
				$Articulo->FechaPublicacion=$date;
				$Articulo->Status=0;
				$Articulo->UbicacionArticulo = $entrega;
				$Articulo->save();
			if($Articulo->save()){
				Session::flash('message','La información se ha guardado correctamente');
				Session::flash('info','Ahora, espera a que sea conocido por toda la comunidad.');
				Session::flash('icono','&#10004;');
				Session::flash('class','success');
			}
			else
			{
				Session::flash('message','Error al guardar la informacion');
				Session::flash('info','Intenta realizar tu publicación más tarde.');
				Session::flash('class','danger');
			}
			return Redirect::to('PosteaAnuncio');
		}
		else
		{
			echo 'No entra';
		}
	}
	public function Detalle($art_id)
    {
    	$Articulo=DB::table('articulos')->select(DB::raw('articulos.id as ArtId,
    articulos.nombre as Articulo,
    articulos.precio as Precio,
    articulos.TipoVenta,
    articulos.Descripcion as Descripcion,
    articulos.NombreImagen1 as NombreImagen1,
    articulos.NombreImagen2 as NombreImagen2,
    articulos.NombreImagen3 as NombreImagen3,
    articulos.NombreImagen4 as NombreImagen4,
    articulos.UbicacionArticulo as UbicacionArticulo,
    publicacionesfavoritas.id as idPublicacionFav,
    articulos.FechaPublicacion as FechaPublicacion,
    subcategorias.nombre as Subcategoria,
    categorias.nombre as Categoria,
    categorias.id as idCategoria,
    articulos.usuario_id as UsuarioArticulo,
    articulos.latitud as latitud,
    articulos.longitud as longitud,
    usuarios.id,
    usuarios.Correo as Correo, 
    usuarios.Nombre as Usuario,
    usuarios.NombreImagen as ImagenUsuario,
    usuarios.id as IdUsuario,
    usuarios.facebook as Facebook,
    AVG(Calificacion) as Calificacion'
    ))	
    		->join('subcategorias','subcategorias.id','=','articulos.subcategoria_id')
    		->join('categorias','subcategorias.categoria_id','=','categorias.id')
    		->join('usuarios','usuarios.id','=','articulos.usuario_id')	
    		->join('comentariosvendedor','comentariosvendedor.idArticulo','=','articulos.id')
    		->join('publicacionesfavoritas','publicacionesfavoritas.articulo_id','=','articulos.id')
    	->where('articulos.id','=',$art_id)->get();

    	if(!empty($Articulo)){
    		if (!Articulo::find($art_id)->Status) {
    			$Calificacion =DB::table('comentariosvendedor')->select(DB::raw('AVG(Calificacion) as Calificacion'))
			    	->join('articulos','articulos.id','=','comentariosvendedor.idArticulo')
			    	->join('usuarios','articulos.usuario_id','=','usuarios.id')
		    	->where('comentariosvendedor.idArticulo','=',$art_id)->get();
				return View::make('Detalles')->with('Detalle',$Articulo[0])->with('Calificacion',$Calificacion);
			} else {
				return View::make('no-disponible');
			}
    	}
    	else
    	{
    	   return Redirect::to('/Categorias');
    	}
    }
	public function MostrarMisPublicaciones()
	{
		$MisPublicaciones= Articulo::where('usuario_id','=',Auth::id())
								   ->select('Nombre','Precio','Descripcion','TipoVenta','NombreImagen1','id','UbicacionArticulo')
								   ->get();
		return $MisPublicaciones;	
	}
	public function AgregarFavorito()
	{
		extract($_POST);
		$Favoritos= new PublicacionFavorita();
		$Favoritos->Usuario_id=Auth::id();
		$Favoritos->Articulo_id=$idPublicacionFavorita;
		$Favoritos->save();
		if($Favoritos->save()){
			return array('Mensaje'=>'Quitar favorito','Insertado'=>true);
		}
		else{
			return array('Mensaje'=>'No se añadió, ocurrió un problema','Insertado'=>false);	
		}
	}
	public function EliminarFavorito()
	{
		
		$idFav=PublicacionFavorita::max('id');
		extract($_POST);
		$QuitarFavorito=DB::table('publicacionesfavoritas')->where('id','=',$idFav)->select('id')->get();
		$Eliminar=PublicacionFavorita::find($QuitarFavorito[0]->id)->delete();
		$NuevoContar=PublicacionFavorita::where('Usuario_id','=',Auth::id())->count();
		if($Eliminar){
			// echo "Esot funciona";
			return array('Mensaje'=>'Guardar favorito','MensajePanel'=>'Favorito Eliminado','NumPub'=>$NuevoContar,'Eliminado'=>true);
		}
		else{
			// echo "Esto no funciona";
			return array('Mensaje'=>'Ocurrio un problema al eliminar','MensajePanel'=>'Ocurrió un error','Eliminado'=>false);
			
		}
	}

	public function MostrarArticuloDetalles () {
		$articulo = Articulo::select(DB::raw('articulos.Nombre, articulos.Precio, articulos.Descripcion, articulos.TipoVenta, articulos.id, articulos.subcategoria_id as subcat_id, articulos.UbicacionArticulo, subcategorias.nombre as subcategoria'))
			->join('subcategorias', 'subcategorias.id', '=', 'articulos.subcategoria_id')
			->where('usuario_id', '=', Auth::id())
			->where('articulos.id', '=', $_POST['id'])
			->get();
		return $articulo;
	}

	public function EditarArticuloDetalles () {
		$articulo = Articulo::find($_POST['id']);
		$articulo->Nombre = $_POST['nombre'];
		$articulo->Precio = $_POST['precio'];
		$articulo->Descripcion = $_POST['descripcion'];
		$articulo->subcategoria_id = $_POST['categoria'];
		$articulo->TipoVenta = $_POST['tipoventa'];
		$articulo->save();

		return View::make('comp.tablaArticulosDeUsuario');
	}

	public function VenderArticulo () {
		$articulo = Articulo::find($_POST['id']);
		$articulo->Status = 1;
		$articulo->save();

		return View::make('comp.tablaArticulosDeUsuario');
	}

	public function BorrarArticulo () {
		$articulo = Articulo::find($_POST['id']);
		$articulo->delete();

		return View::make('comp.tablaArticulosDeUsuario');
	}

	public function QuitarFavorito () {
		$favorito = PublicacionFavorita::find($_POST['id']);
		$favorito->delete();

		return View::make('comp.tablaArticulosFavoritos');
	}

	public function BorrarArticuloRep () {
		$articulo = Articulo::find($_POST['id']);
		$articulo->delete();

		return View::make('Administrador.tablaReportes');
	}
	public function BuscarArticulos($nombre_articulo){
		$Articulos = DB::table('articulos')->where('Nombre','like','%'.$nombre_articulo.'%')->where('status','=',0)->get();
		$Categoria = new Categoria();
		$Categorias = $Categoria::all();
		
		return View::make('Buscador')->with('Categorias',$Categorias)->with('Articulos',$Articulos)->with('Busqueda',$nombre_articulo);
	}
	public function Ofertascercanas(){
	extract($_POST);
	 $harvesine=DB::table('articulos')->select(DB::raw(' *, (6371 * ACOS(COS(RADIANS('.$lat.')) * 
    COS(RADIANS(latitud)) * COS(RADIANS(longitud) - RADIANS('.$lng.')) + SIN(RADIANS('.$lat.')) * SIN(RADIANS(latitud)))) AS distancia'))->groupBy('distancia')->having('distancia','<=',1)->get();
	 return json_encode($harvesine);
	}

}
