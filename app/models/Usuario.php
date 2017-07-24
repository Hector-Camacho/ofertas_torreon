<?php

class Usuario extends Eloquent {

	protected $table = 'usuarios';
	public $timestamps = false;

	public function Articulos () {
		return $this->hasMany('Articulo');
	}

	public function Reportes () {
		return $this->hasMany('ReportePublicacion');
	}

	public function Favoritos () {
		return $this->hasMany('PublicacionFavorita');
	}

	public function Denuncias () {
		return $this->hasMany('Denuncia');
	}

	public function ComentariosDenuncias () {
		return $this->hasMany('ComentarioDenuncia');
	}

}
