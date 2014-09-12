<?php

use Custom\Html\GridBuilder;

class UsuariosGruposController extends BaseController {
	
	/**
	 * 
	 */
	public function getIndex()
	{	
		//
		PermissionsController::check('usuarios.grupos.index');

		//
		$this->layout->content = View::make('usuarios.grupos.index', [
			'grid' => $this->grid()
		]);
	}

	/**
	 * 
	 */
	public function getNew($id = null)
	{	
		//
		PermissionsController::check('usuarios.grupos.new');

		//
		$this->layout->content = View::make('usuarios.grupos.new', [
			'grupos' => UsuariosGruposController::getAllGruposForSelect(),
		]);
	}

	/**
	 * 
	 */
	public function postCreate()
	{
		//
		PermissionsController::check('usuarios.grupos.new');

		//
		$rules = array(
			'nome' => 'required|min:5|unique:usuarios_grupos',
    		'status' => 'required|integer',
    	);
    	
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

		    $user = new UsuarioGrupo;
		    $user->nome = Input::get('nome');
		    $user->status = Input::get('status');
		    $user->save();
		 
		    return Redirect::to('usuarios/grupos/new')
		    	->with('message', 'Usuário foi cadastrado com sucesso!')
		    	->with('alert', 'success');

		} else {
		    return Redirect::to('usuarios/grupos/new')
		    	->withErrors($validator)
		    	->withInput();
		}

	}

	/**
	 * 
	 */
	public function getEdit($id)
	{	
		//
		PermissionsController::check('usuarios.grupos.edit');

		//
		$this->layout->content = View::make('usuarios.grupos.edit', [
			'grupo' => UsuarioGrupo::find($id)
		]);
	}

	/**
	 * 
	 */
	public function postUpdate()
	{
		//
		PermissionsController::check('usuarios.grupos.edit');
		
		//
		$rules = array(
			'nome' => 'required|min:5|unique:usuarios_grupos,nome,'. Input::get('id'),
    		'status' => 'required|integer',
    	);
    	
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

		    $db = UsuarioGrupo::find(Input::get('id'));
		    $db->nome = Input::get('nome');
		    $db->status = Input::get('status');
		    $db->save();
		 
		    return Redirect::to('usuarios/grupos/edit/' . $db->id)
		    	->with('message', 'Grupo atualizado com sucesso!')
		    	->with('alert', 'success');

		} else {
		    return Redirect::to('usuarios/grupos/edit/' . $db->id)
		    	->withErrors($validator)
		    	->withInput();
		}
	}

	/**
	 * 
	 */
	public function getDelete($id)
	{
		//
		PermissionsController::check('usuarios.grupos.delete');

		//
		$db = UsuarioGrupo::with('usuarios')->find($id);

		//
		if(!count($db->usuarios)){

			//
			$db->delete();

			//
		    return Redirect::to('usuarios/grupos')
		    	->with('message', 'Grupo removido com sucesso!')
		    	->with('alert', 'success');
		}

		//
	    return Redirect::to('usuarios/grupos')
	    	->with('message', 'Esse grupo não pode ser removido, pois contém registros relacionados!')
	    	->with('alert', 'danger');
	}

	/**
	 * 
	 */
	private function grid($sql = null)
	{
		if(is_null($sql)) {
			$sql = UsuarioGrupo::with('usuarios');
		}

		$grid = new GridBuilder();
		$grid->setQuery($sql);
		$grid->addColuna('ID', 'id');
		$grid->addColuna('Nome', function($i){
			return $i->nome . ' (' . count($i->usuarios) . ')';
		}, ['orderBy' => 'nome']);
		$grid->addColuna('Status', 'status');
		$grid->addTimestamps();
		$grid->addColuna('Opções', function($i){

			$out = '<a href="/usuarios/grupos/edit/%s">Editar</a> | ';
			$out .= '<a href="/usuarios/grupos/delete/%s">Remover</a>';

			return sprintf($out, $i->id, $i->id);
		});

		return $grid->make();
	}
	
	/**
	*
	*/
	public static function getAllGruposForSelect(){
		$grupos = [];
		foreach(UsuarioGrupo::all() as $g){
			$grupos[$g->id] = $g->nome;
		}

		return $grupos;
	}
}
