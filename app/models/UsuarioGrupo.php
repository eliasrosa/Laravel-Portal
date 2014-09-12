<?php



class UsuarioGrupo extends Eloquent {

	//
	protected $table = 'usuarios_grupos';

	//
    public function usuarios()
    {
        return $this->hasMany('Usuario', 'id_grupo');
    }
}