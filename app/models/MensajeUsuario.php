<?php 

class MensajeUsuario extends Eloquent{
	protected $table="mensajesusuario";
	public $timestamps = false;
	
	
	public function Usuarios () {
		return $this->hasMany('Usuario','idUsuarioRemitente','id');
	}
	
	public function Usuarios2() {
		return $this->hasMany('Usuario','idUsuarioDestinatario','id');
	}
	
	
}