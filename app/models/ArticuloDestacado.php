<?php 
class ArticuloDestacado extends Eloquent{
	
	protected $table="articulosdestacados";
	public $timestamps=false;
	
	
	public function Articulos()
	{
		return $this->hasMany('Articulo','idArticulos');
	}
}


