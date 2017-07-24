<?php
date_default_timezone_set('America/Monterrey');
include(app_path().'/config/includes/lib/Conekta.php');
class ArticuloDestacadoController extends BaseController {
	public function FechaLimite($DiasDuracion)
	{
		$fecha = date('Y-m-d');
		$Dias=$DiasDuracion; 
		$FechaLimite= date('Y-m-d', strtotime($fecha. '+ '.$Dias.' days'));
		return $FechaLimite;
	}
	public function GuardarArticulo(){
	Conekta::setApiKey("key__LmEbyCV8FGYoBFt");
	extract($_POST);
	$charge = Conekta_Charge::create(array(
	  'description'=> 'Monto por anuncio en ofertastorreon',
	  'reference_id'=> '9388-Voy',
	  'amount'=> '2000',
	  'currency'=>'MXN',
	  'card'=> $Token['id'],
		  'details'=> array(
		    'name'=> 'Ofertas Anuncio',
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
		      'street1'=>'',
		      'street2'=> '',
		      'street3'=> null,
		      'city'=> '',
		      'state'=>'' ,
		      'zip'=> '',
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
			try{
				$Dias=4;
				$ArticuloDestacado= new ArticuloDestacado();
				$ArticuloDestacado->idArticulos=$idArticulo;
				$ArticuloDestacado->FechaLimite=$this->FechaLimite($Dias);
				$Guarda=$ArticuloDestacado->save();
				if($Guarda){
					return json_encode(array("Mensaje"=>"Tu pago se ha hecho correctamente! Tu anuncio se publicara en la pagina principal durante 4 dias","Clase"=>"success"));
				}else{
					return json_encode(array("Mensaje"=>"Ocurrio un problema al guardar tu anuncio, para cualquier duda por favor de contactar al administrador del sistema", "Clase"=>"danger"));
				}
			}catch(Exception $e){
				return json_encode(array("Mensaje"=>$e->getMessage(), "Clase"=>"danger"));
			}
			
		}
		else
		{

		}
		
	}
	public function MostrarArticulos(){
		$Usuario=DB::table('articulosdestacados')->join('articulos','articulosdestacados.idArticulos','=','articulos.id')->select('articulos.Nombre','articulos.NombreImagen1','articulosdestacados.FechaLimite','articulosdestacados.id')->get();
		return $Usuario;
	}
	public function EliminarArticulo(){
		extract($_POST);
		$Articulo = new ArticuloDestacado();
		$ArtElim = $Articulo::find($id);
		$ArtElim->delete();
		$Articulo=DB::table('articulosdestacados')->join('articulos','articulosdestacados.idArticulos','=','articulos.id')->select('articulos.Nombre','articulos.NombreImagen1','articulosdestacados.FechaLimite','articulosdestacados.id')->get();
		return $Articulo;
	}
	public function ModificarArticulo(){
		extract($_POST);
		$Articulo = new ArticuloDestacado();
		$ModArticulo= $Articulo::find($id);
		$ModArticulo->FechaLimite=$this->FechaLimite($Dias);
		$ModArticulo->save();
		$Articulo=DB::table('articulosdestacados')->join('articulos','articulosdestacados.idArticulos','=','articulos.id')->select('articulos.Nombre','articulos.NombreImagen1','articulosdestacados.FechaLimite','articulosdestacados.id')->get();
		return $Articulo;
	}
}