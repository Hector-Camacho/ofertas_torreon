<?php

class ReportePublicacionController extends BaseController {

	public function Reportar () {
		$reporte = new ReportePublicacion();
		$reporte->articulo_id = $_POST['artic'];
		$reporte->usuario_id = Auth::user()->id;
		$reporte->Mensaje = $_POST['reason'];
		$reporte->RazonDenuncia = $_POST['details'];
		$reporte->save();
		echo json_encode (array('reportado' => true));
	
	}
	public function BorrarReporte () {
		$reporte = ReportePublicacion::find($_POST['id']);
		$reporte->delete();

		return View::make('Administrador.tablaReportes');
	}
}
