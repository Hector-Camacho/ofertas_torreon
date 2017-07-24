<?php

class ComentarioDenunciaController extends BaseController {
	public function CargarComentarios(){
		$id=$_POST['idDenuncia'];
		$Com = new ComentarioDenuncia();
		$Comentarios= $Com::join('usuarios','usuarios.id','=','comentariodenuncia.usuario_id')
			->where('denuncia_id','=',$id)->get();
		return $Comentarios;
	}
	public function InsertarComentarios(){
		$Com = new ComentarioDenuncia;
		$Com->Comentario=$_POST['texto'];
		$Com->Fecha=$_POST['fecha'];
		$Com->usuario_id=Auth::id();
		$Com->denuncia_id=$_POST['Denuncia_id'];
		$Com->save();
		return json_encode(array("Mensaje"=>"Comentario realizado exitosamente"));
	}
}
