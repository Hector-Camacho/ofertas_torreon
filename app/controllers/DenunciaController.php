<?php

class DenunciaController extends BaseController {

	private $folder = 'Imagenes/ImagenesDenuncias';

	public function index () {
		$files = File::files($this->folder);
		return View::make('comp.PanelDenunciar')->with('images', $files);
	}

	public function GuardarDenuncia () {
		extract($_POST);

		if (Input::hasFile('Imagen1')) {
			$denuncia = new Denuncia();
			$file = Input::file('Imagen1');

			$denuncia->usuario_id = Auth::id();
			$denuncia->Titulo = $dentitle;
			$denuncia->Descripcion = $dendescript;
			$denuncia->Fecha = date('Y/m/d/h/i/s');
			$denuncia->NombreImagen = $file->getClientOriginalName();

			$file->move($this->folder.'/', $file->getClientOriginalName());

			if ($denuncia->save()) {
				Session::flash('message','Tu denuncia se ha realizado correctamente.');
				Session::flash('info','Ahora, espera a que sea conocido por toda la comunidad.');
				Session::flash('icono','&#10004;');
				Session::flash('class','success');
			} else {
				Session::flash('message','Error al realizar tu denuncia.');
				Session::flash('info','Intentalo más tarde.');
				Session::flash('class','danger');
			}

			return Redirect::to('/Panel/Denunciar');
		} else {
			echo 'No entra';
		}
	}

	public function MostrarDenuncia ($denuncia_id) {
		// return $denuncia_id;
			$Denuncia = DB::table('denuncias')->join('usuarios','usuarios.id','=','denuncias.usuario_id')->select('denuncias.id','usuarios.nombre','usuarios.nombre','denuncias.Descripcion', 'denuncias.titulo','denuncias.NombreImagen', 'denuncias.Fecha')->where('denuncias.id','=',$denuncia_id)->get();
			$Top5=Denuncia::orderBy('id','desc')->take(5)->get();
			
		return View::make('DenunciasDetalles')->with('Data',$Denuncia)->with('Top5',$Top5);
	}

	public function EditarDenuncia () {
		$denuncia = Denuncia::find($_POST['id']);

		$denuncia->Titulo = $_POST['denTitulo'];
		$denuncia->Descripcion = $_POST['denDetalles'];
		$denuncia->save();

		return View::make('comp.tablaDenuncias');
	}

	public function BorrarDenuncia () {
		$denuncia = Denuncia::find($_POST['id']);

		$denuncia->delete();

		return View::make('comp.tablaDenuncias');
	}
}
