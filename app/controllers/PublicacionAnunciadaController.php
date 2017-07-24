<?php
include(app_path().'\config\includes\lib\Conekta.php');
class PublicacionAnunciadaController extends BaseController{
	private $Carpeta = "Imagenes/ImagenesPublicaciones";
	public function FechaLimite($DiasDuracion)
	{
		$fecha = date('Y-m-d');
		$Dias=$DiasDuracion; 
		$FechaLimite= date('Y-m-d', strtotime($fecha. '+ '.$Dias.' days'));
		return $FechaLimite;
	}
	
	public function index(){
		$files= File::files($this->folder);
		return View::make('CuentaPrincipalAdministrador')->with('images',$files);
	}
	
	// public function GuardarAnuncio()
	// {
	// 	extract($_POST);
	// 	print_r($_POST);
	// 	if(Input::hasFile('Imagen1')) {
	// 			$file=Input::file('Imagen1');
	// 			$Nombre=$file->getClientOriginalName();
	// 			$upload=$file->move($this->Carpeta.'/',$Nombre);
	// 		}
	// 		else{
	// 			$Nombre="";
	// 		}
	// 	$Anuncio= new PublicacionAnunciada();
	// 	//$Anuncio->FechaLimite=$this->FechaLimite($DiasDuracion);
	// 	$Anuncio->NombrePublicacion=$NombrePublicacion;
	// 	$Anuncio->NombreImagenPublicacion=$Nombre;
	// 	$Anuncio->save();
	// 	if($Anuncio->save() )
	// 	{
	// 		// echo "Juardo";
	// 		Session::flash('message','El anuncio se guardo correctamente');
	// 		Session::flash('info','Ahora, es visible a toda la comunidad.');
	// 		Session::flash('icono','&#10004;');
	// 		Session::flash('class','success');
	// 	}
	// 	else{
	// 		// echo "no Juardo";
	// 		Session::flash('message','Error al guardar el anuncio');
	// 		Session::flash('info','Intenta realizar la publicación más tarde.');
	// 		Session::flash('class','danger');
	// 	}
	// 	return Redirect::to('/Panel/Administrador/NuevoAnuncio');
	// }
	
	public function MostrarPublicaciones()
	{
		$Publicaciones=PublicacionAnunciada::all();
		return $Publicaciones;
	}
	public function EditarAnuncio()
	{
		extract($_POST);
		$AnuncioAeditar=PublicacionAnunciada::find($idAnuncio);
		if(Input::hasFile('Imagen1')) {
				$file=Input::file('Imagen1');
				$Nombre=$file->getClientOriginalName();
				$upload=$file->move($this->Carpeta.'/',$Nombre);
			}
			else{
				$Nombre=$AnuncioAeditar->NombreImagenPublicacion;
			}
		
		$AnuncioAeditar->FechaLimite=$this->FechaLimite($DiasDuracion);
		$AnuncioAeditar->NombrePublicacion=$NombrePublicacion;
		$AnuncioAeditar->NombreImagenPublicacion=$Nombre;
		$AnuncioAeditar->save();
		if($AnuncioAeditar->save()){
			// echo "Modificaado";
			Session::flash('message','La información del anuncio se modificó correctamente');
			Session::flash('info','La información se ha actualizado.');
			Session::flash('icono','&#10004;');
			Session::flash('class','success');
		}
		else{
			// echo "No modificado";
			Session::flash('message','Error al modificar el anuncio');
			Session::flash('info','Intenta realizar la publicación más tarde.');
			Session::flash('class','danger');
		}
		return Redirect::to('/Panel/Administrador/EditarAnuncios');
	}
	
	public function EliminarAnuncio()
	{
		extract($_POST);
		$AnuncioAeliminar=PublicacionAnunciada::find($idAnuncioEliminar);
		$AnuncioAeliminar->delete();
		if($AnuncioAeliminar->delete()){
			// echo "Modificaado";
			Session::flash('message','La información del anuncio se eliminó correctamente');
			Session::flash('icono','&#10004;');
			Session::flash('class','success');
		}
		else{
			// echo "No modificado";
			Session::flash('message','Error al eliminar el anuncio');
			Session::flash('info','Intenta realizar la publicación más tarde.');
			Session::flash('class','danger');
		}
		return Redirect::to('/Panel/Administrador/EditarAnuncios');
	}
	// public function GuardarAnuncioPatrocinadoCarrusel()
	// {
	// 	extract($_POST);
	// 	//Nombre de la imagen
	// 	if(Input::hasFile('AnuncioImg')) {
	// 			$file=Input::file('AnuncioImg');
	// 			$Nombre=$file->getClientOriginalName();
	// 			$upload=$file->move($this->Carpeta.'/',$Nombre);
	// 		}
	// 		else{
	// 			$Nombre="";
	// 		}

	// 	//Juardar Anuncio
	// 	$Anuncio= new PublicacionAnunciada();
	// 	$Anuncio->FechaLimite=$this->FechaLimite($DiasDuracion);
	// 	$Anuncio->NombrePublicacion=$NombrePublicacion;
	// 	$Anuncio->NombreImagenPublicacion=$Nombre;
	// 	$Anuncio->save();
	// 	if($Anuncio->save())
	// 	{
	// 		// echo "Juardo";
	// 		Session::flash('message','El anuncio se guardo correctamente');
	// 		Session::flash('info','Ahora, es visible a toda la comunidad.');
	// 		Session::flash('icono','&#10004;');
	// 		Session::flash('class','success');
	// 	}
	// 	else{
	// 		// echo "no Juardo";
	// 		Session::flash('message','Error al guardar el anuncio');
	// 		Session::flash('info','Intenta realizar la publicación más tarde.');
	// 		Session::flash('class','danger');
	// 	}
	// 	return Redirect::to('Anunciate');
	// }
	public function PagarArticulo(){
		Conekta::setApiKey("key__LmEbyCV8FGYoBFt");
		$charge = Conekta_Charge::create(array(
	  'description'=> 'Pago por servicio a domicilio',
	  'reference_id'=> '9839-Anuncio',
	  'amount'=> 2000,
	  'currency'=>'MXN',
	  'card'=> $_POST['Conektaid'],
		  'details'=> array(
		    'name'=> $_POST['Cliente'],
		    'phone'=> $_POST['Telefono'],
		    'email'=> $_POST['Email'],
		    'line_items'=> array(
		      array(
		        'name'=> 'Box of Cohiba S1s',
		        'description'=> 'Imported From Mex.',
		        'unit_price'=> 2000,
		        'quantity'=> 1,
		        'sku'=> 'cohb_s1',
		        'type'=> 'food'
		      )
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
		return json_encode(array('estatus'=>$charge->status));
	}
}