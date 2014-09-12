<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	//
	protected $table = 'usuarios';

	//
	protected $primaryKey = 'id';

	//
	protected $hidden = array('password', 'password_confirmation');
	    
	//
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	//
	public function getAuthPassword()
	{
		return $this->password;
	}

	//
	public function getReminderEmail()
	{
		return $this->email;
	}

	//
    public function grupo()
    {
        return $this->hasOne('UsuarioGrupo', 'id', 'id_grupo');
    }
}