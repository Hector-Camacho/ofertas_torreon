<?php

class Categoria extends Eloquent {

	protected $table = 'categorias';
	public $timestamps = false;
	public function SubCategorias()
	{
		// return $this->belongsTo('SubCategorias','id');

		return $this->hasMany('Subcategoria');
	}
	
	

}