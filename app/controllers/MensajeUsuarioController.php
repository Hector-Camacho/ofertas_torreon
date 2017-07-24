<?php 

class MensajeUsuarioController extends BaseController{
	
	public function GuardarMensaje()
	{
		extract($_POST);
		$hoy=date('Y-m-d');
		$NuevoMensaje=new MensajeUsuario();
		$NuevoMensaje->Mensaje=$Mensaje;
		$NuevoMensaje->FechaMensaje=$hoy;
		$NuevoMensaje->idUsuarioRemitente=Auth::id();
		$NuevoMensaje->StatusMensaje="No respondido";
		$NuevoMensaje->idUsuarioDestinatario=$Destinatario;
		$NuevoMensaje->save();
		
		return array("Mensaje"=>"Se ha enviado tu mensaje", "insercion"=>true);

	}
	
	public function MostrarMensajes()
	{
		$Mensajes=MensajeUsuario::join('usuarios','usuarios.id','=','mensajesusuario.idUsuarioRemitente')
								->where('StatusMensaje','=','No respondido')
								->where('idUsuarioDestinatario','=',Auth::id())
								->select(DB::raw('usuarios.Nombre as NombreUsuario,mensajesusuario.Mensaje, mensajesusuario.FechaMensaje, mensajesusuario.id, mensajesusuario.idUsuarioRemitente'))
								->get();
		return $Mensajes;
	}
	public function EnviarRespuestaMensaje()
	{
		extract($_POST);
		$hoy=date('Y-m-d');
		$MensajeRespondido=MensajeUsuario::find($idMensaje);
		$MensajeRespondido->StatusMensaje="Respondido";
		$MensajeRespondido->save();
		if($MensajeRespondido->save()){
			$RespuestaDelMensaje= new MensajeUsuario();
			$RespuestaDelMensaje->StatusMensaje="No respondido";
			$RespuestaDelMensaje->idUsuarioRemitente=Auth::id();
			$RespuestaDelMensaje->idUsuarioDestinatario=$idRemitenteRespondido;
			$RespuestaDelMensaje->Mensaje=$Mensaje;
			$RespuestaDelMensaje->FechaMensaje=$hoy;
			$RespuestaDelMensaje->save();
			
			if($RespuestaDelMensaje->save()){
				return array("Mensaje"=>"Se envio tu respuesta", "insercion"=>true);
			}
			else{
				return array("Mensaje"=>"Ocurrio un error inesperado", "insercion"=>false);
			}
			
		}
		else{
			return array("Mensaje"=>"Ocurrio un error inesperado", "insercion"=>false);
		}
	}
	
}