<?php

use Illuminate\Support\MessageBag;
class AuthController extends BaseController{

	public function getFacebookLogin($auth=NULL){
			if($auth=='auth')
			{
				try {
					Hybrid_Endpoint::process();
				} 
				catch (Exception $e) {
					Redirect::to('fbauth');
				}		
			}
			$oauth= new Hybrid_Auth(app_path().'/config/fb_auth.php');
			$Facebook=$oauth->authenticate('Facebook');
			$perfil= $Facebook->getUserProfile();
			$datos=array(
				'Correo'=>$perfil->email,
				'password'=>$perfil->identifier,
			);
			if (Auth::attempt($datos))
			{
				if(Auth::user()->estatus=="En linea"){
					if(Auth::user()->TipoUsuario=='Normal'){
						return Redirect::to('/Categorias/1');
					}
				elseif (Auth::user()->TipoUsuario == 'Administrador') {
						return Redirect::to('/Categorias/1');
					}	
				}
				else{
				Auth::logout();
					$errors = new MessageBag(['status' => ['Al parecer no tienes acceso a la página.']]); 
			   		return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
				}
			}
			else
			{
				$identificador=$perfil->identifier;
				$nombre = $perfil->firstName;
				$apellido = $perfil->lastName;
				$correo = $perfil->email;
				$facebook= $perfil->displayName;
				$Estatus= "En linea";
				$TipoUsuario="Normal";
				$Imagen = $perfil->photoURL;
				$Usuario= new Usuario();
				$Usuario->password=Hash::make($identificador);
				$Usuario->Nombre=$nombre;
				$Usuario->Correo=$correo;
				$Usuario->Facebook=$facebook;
				$Usuario->Estatus=$Estatus;
				$Usuario->NombreImagen=$Imagen;
				$Usuario->TipoUsuario=$TipoUsuario;
				$Usuario->save();
				if (Auth::attempt($datos))
			{
				if(Auth::user()->estatus=="En linea"){
					if(Auth::user()->TipoUsuario=='Normal'){
						return Redirect::to('/Categorias/1');
					}
				elseif (Auth::user()->TipoUsuario == 'Administrador') {
					return Redirect::to('/Categorias/1');
					}	
				}
				else{
				Auth::logout();
					$errors = new MessageBag(['status' => ['Al parecer no tienes acceso a la página.']]); 
			   		return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
				}
			}
			}
	}
	public function getLoggedOut(){
		$fauth= new Hybrid_Auth(app_path().'/config/fb_auth.php');
		$fauth->logoutAllProviders();
		return Redirect::to('/');
	}
}