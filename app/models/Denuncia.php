<?php

class Denuncia extends Eloquent {

	protected $table = 'denuncias';
	public $timestamps = false;

	public function Comentarios () {
		return $this->hasMany('ComentarioDenuncia');
	}
}
