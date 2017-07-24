<?php

class Subcategoria extends Eloquent {

	protected $table = 'subcategorias';
	public $timestamps = false;
	
	/*
	public function Categorias () {
		return $this->hasMany('Categorias','categoria_id','id');
	}
	*/
	public function Articulos()
	{
		return $this->belongsTo('Articulo','id');
	}

}
