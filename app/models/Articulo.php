<?php

class Articulo extends Eloquent {

	protected $table = 'articulos';
	public $timestamps = false;

	/*
	public function Usuarios () {
		return $this->hasOne('Usuarios','usuario_id','id');
	}
	*/

	public function Reportes () {
		return $this->hasMany('ReportePublicacion');
	}

	/*
	public function SubCategorias() {
		return  $this->hasOne('Subcategorias','sucategoria_id','id');
	}
	public function PublicacionesFavoritas()
	{
		return $this->belongsTo('PublicacionesFavoritas','id');
	}

	public function Favoritos () {
		return $this->hasMany('PublicacionFavorita')
	}
	public function ArtiulosDestacados()
	{
		return $this->belongsTo('ArticulosDestacados','id');
	}
	*/
}
