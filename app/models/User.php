<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';
	public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	
	public function Articulos()
	{
		return $this->belongsTo('Articulos','id');
	}
	
	public function PublicacionesFavoritas()
	{
		return $this->belongsTo('PublicacionesFavoritas','id');
	}
	
	public function PublicacionesFavoritas2()
	{
		return $this->belongsTo('PublicacionesFavoritas','id');
	}
	
	public function MensajesUsuario()
	{
		return $this->belongsTo('MensajeUsuario','id');
	}

}
