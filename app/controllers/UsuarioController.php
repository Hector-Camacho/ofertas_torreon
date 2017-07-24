<?php
use Illuminate\Support\MessageBag; 
class UsuarioController extends BaseController{
	
	private $folder = 'Imagenes/AvatarUsuarios';
	public function index()
	{
		$files = File::files($this->folder);
		return View::make('RegistroUsuario')->with('images',$files);
	}
	public function IniciarSesion()
	{
		//Se guardan los datos del usuario dentro de un arreglo
		$datos=array(
			'Correo' => Input::get('Correo'),
			'password' => Input::get('password'),
		);
		//Validamos los datos y ademas mandamos como segundo parametro la opcion de recordar usuario
		if (Auth::attempt($datos, Input::get('remember', 0)))
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
		   $errors = new MessageBag(['password' => ['Usuario y/o contraseña incorrectos.']]); 
		   return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
		}
	}
	public function MostrarLogin()
	{	
		//Verificamos que el usuario no este aunteticado
		if(Auth::check())
		{
			if(Auth::user()->TipoUsuario!="Administrador"){
				return View::make('/CuentaPrincipalUsuario');
			}
			else
			{
				return View::make('/CuentaPrincipalAdministrador');
			}
		}
		 else
		 {
		 	return View::make('login');
		 		
		 }

	}
	public function CerrarSesion(){
			Auth::logout();
			$fauth= new Hybrid_Auth(app_path().'/config/fb_auth.php');
			$fauth->logoutAllProviders();
			return Redirect::to('/');
	}
	public function GuardarUsuario()
	{
		extract($_POST);
		if(Input::hasFile('Imagen'))
			{
				$file=Input::file('Imagen');
				$Nombre=$file->getClientOriginalName();
				$upload=$file->move($this->folder.'/',$Nombre);
			}
			else{
				$Nombre="avatarDefault.jpg";
			}
		$usuario= new User;
		$usuario->Facebook='No registrado';
		$usuario->password= Hash::make($password) ;
		$usuario->Correo=$Email;
		$usuario->TipoUsuario='Normal';
		$usuario->Nombre=$NombreUsuario;
		$usuario->NombreImagen=$Nombre;
		$usuario->estatus="En linea";
		$usuario->save();
		if($usuario->save()){
				Session::flash('message','Tu información se ha guardado correctamente');
				Session::flash('class','success');
			}
			else
			{
				Session::flash('message','Error al guardar la informacion');
				Session::flash('class','danger');
			
			}
		return Redirect::to('RegistroUsuario');
	}	
	public function ConsultaDeNombresDeUsuarios()
	{
		$NombreUsuario=User::select('id',DB::raw('CONCAT(Nombre," ",Apellidos) AS NombreUsuario'))->get();
		return $NombreUsuario;
	}
	public function Banear(){
		extract($_POST);
		$Usuario = new Usuario();
		$UsuarioBaneado=$Usuario::find($id);
		$UsuarioBaneado->estatus="Baneado";
		$UsuarioBaneado->save();
			Session::flash('message','Se ha expulsado al usuario de la comunidad de ofertas torreon');
			Session::flash('description','Lamentamos que haya tenido inconveniente con los usuarios');
			Session::flash('class','success');
			Session::flash('icono','&#10004;');
		return json_encode(array("Ruta"=>"/Panel/Administrador/UsuariosRegistrados"));
			
	}
	public function Desbanear(){
		extract($_POST);
		$Usuario = new Usuario();
		$UsuarioBaneado=$Usuario::find($id);
		$UsuarioBaneado->estatus="En linea";
		$UsuarioBaneado->save();
			Session::flash('message','El usuario ha sido reincorporado a la comunidad de ofertas torreon');
			Session::flash('description','El usuario podra comentar, publicar y reportar articulos dentro de la comunidad');
			Session::flash('class','success');
			Session::flash('icono','&#10004;');
		return json_encode(array("Ruta"=>"/Panel/Administrador/UsuariosRegistrados"));
	}
	
	public function EditarPerfilUsuario()
	{
		extract($_POST);
		$EditarInfoUsuario=Usuario::find(Auth::id());
		$EditarInfoUsuario->Nombre=$NombreUsuario;
		$EditarInfoUsuario->Correo=$Email;
		if(Input::hasFile('Imagen'))
		{
			$file=Input::file('Imagen');
			$Nombre=$file->getClientOriginalName();
			$upload=$file->move($this->folder.'/',$Nombre);
		}
		else{
			$Nombre=$EditarInfoUsuario->NombreImagen;
		}
		$EditarInfoUsuario->NombreImagen=$Nombre;
		$EditarInfoUsuario->save();
		if($EditarInfoUsuario->save()){
			Session::flash('message','Tu información se ha modificado correctamente');
			Session::flash('class','success');
		}
		else{
			Session::flash('message','Error al modificar la informacion');
			Session::flash('class','danger');
		}
		return Redirect::to('/Panel/EditarPerfil');	
	}
	public function CambiarContrena()
	{
		extract($_POST);
		$InfoUsuario=Usuario::find(Auth::id());
		if(Hash::check($Actual, $InfoUsuario->password)){
			$InfoUsuario->password=Hash::make($ConfirmarNueva);
			$InfoUsuario->save();
			Session::flash('message','Tu información se ha modificado correctamente');
			Session::flash('class','success');
			Session::flash('icono','&#10004;');
		}
		else{
			Session::flash('message','Verifica que tu contraseña actual sea la correcta para poder hacer el cambio de contraseña');
			Session::flash('class','danger');
			
		}
		return Redirect::to('/Panel/EditarPerfil');	
	}
}