<?php 
class PublicacionController extends BaseController{
	
	public function VerPublicaciones()
	{
		$Comentarios= ComentarioVendedor::join('usuarios','usuarios.id','=','comentariosvendedor.idUsuarioComent')
										->where('idUsuarioVendedor','=',Auth::id())
										->orderBy('comentariosvendedor.id','desc')
										->select('*')
										->take(5)
										->get();
		return $Comentarios;
	}
	
	public function GuardarComentario()
	{
		
		extract($_POST);
		$hoy=date('Y-m-d');
		$Com= new ComentarioVendedor();
		$Com->Comentario=$Coment;
		$Com->FechaComentario=$hoy;
		$Com->Calificacion=Input::input('Calificacion');
		$Com->idUsuarioComent=Auth::id();
		$Com->idArticulo=$idPublicacion;
		$Com->save();
		return array("Mensaje"=>"Se ha enviado tu Comentario", "insercion"=>true);
	}
	public function CargarComentarios()
	{
		extract($_POST);
		$Comentarios=ComentarioVendedor::join('articulos','articulos.id','=','comentariosvendedor.idArticulo')
									   ->join('usuarios','usuarios.id','=','comentariosvendedor.idUsuarioComent')
									   ->where('articulos.id','=',$idPub)
									   ->orderBy('comentariosvendedor.id','desc')
									   ->select('comentariosvendedor.Comentario','usuarios.NombreImagen','comentariosvendedor.FechaComentario','usuarios.Nombre')
									   ->take(5)
									   ->get();
		return $Comentarios;
		
	}
	
	public function CargarFavoritos()
	{
		$Favoritos=PublicacionFavorita::join('articulos','articulos.id','=','publicacionesfavoritas.articulo_id')
									->join('usuarios','usuarios.id','=','publicacionesfavoritas.usuario_id')
									->where('publicacionesfavoritas.Usuario_id','=',Auth::id())
									->select('articulos.NombreImagen1','articulos.Nombre','articulos.Precio', 
											 'articulos.UbicacionArticulo','articulos.Descripcion','articulos.TipoVenta',
											 'publicacionesfavoritas.id','articulos.id as idArticulo')
									->get();
		return $Favoritos;
	}
	
}