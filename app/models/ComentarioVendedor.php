<?php 

class ComentarioVendedor extends Eloquent {
	protected $table = 'comentariosvendedor';
	public $timestamps = false;
	
	
	public function Usuarios () {
		return $this->hasMany('Usuario','idUsuarioVendedor','id');
	}
	
	public function Usuarios2() {
		return $this->hasMany('Usuario','idUsuarioComent','id');
	}
}