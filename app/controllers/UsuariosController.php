<?php

use Custom\Html\GridBuilder;

class UsuariosController extends BaseController {
	
	/**
	 * 
	 */
	public function getIndex()
	{	
		//
		PermissionsController::check('usuarios.index');

		//
		$this->layout->content = View::make('usuarios.index', [
			'grid' => $this->grid()
		]);
	}

	/**
	 * 
	 */
	public function getNew($id = null)
	{	
		//
		PermissionsController::check('usuarios.new');

		//
		$this->layout->content = View::make('usuarios.new', [
			'grupos' => UsuariosGruposController::getAllGruposForSelect(),
		]);
	}

	/**
	 * 
	 */
	public function postCreate()
	{
		//
		PermissionsController::check('usuarios.new');

		//
		$rules = array(
			'nome' => 'required|min:5',
			'id_grupo' => 'required|integer',
	    	'email' => 'required|email|unique:usuarios|min:6',
		    'password' => 'required|alpha_num|between:5,20|confirmed',
		    'password_confirmation' => 'required|alpha_num|between:5,20',
    		'username' => 'required|unique:usuarios|min:5|max:100',
    	);
    	
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

		    $user = new Usuario;
		    $user->nome = Input::get('nome');
		    $user->email = Input::get('email');
		    $user->username = Input::get('username');
		    $user->id_grupo = Input::get('id_grupo');
		    $user->password = Hash::make(Input::get('password'));
		    $user->status = 1;
		    $user->save();
		 
		    return Redirect::to('usuarios/new')
		    	->with('message', 'Usuário foi cadastrado com sucesso!')
		    	->with('alert', 'success');

		} else {
		    return Redirect::to('usuarios/new')
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
		PermissionsController::check('usuarios.edit');

		//
		$this->layout->content = View::make('usuarios.edit', [
			'usuario' => Usuario::find($id),
			'grupos' => UsuariosGruposController::getAllGruposForSelect()
		]);
	}

	/**
	 * 
	 */
	public function postUpdate()
	{
		//
		PermissionsController::check('usuarios.edit');

		//
		$rules = array(
			'nome' => 'required|min:5',
			'id_grupo' => 'required|integer',
	    	'email' => 'required|email|min:6|unique:usuarios,email,'. Input::get('id'),
    	);

    	//
    	if(Input::get('password')) {
		    $rules['password'] = 'required|alpha_num|between:5,20|confirmed';
		    $rules['password_confirmation'] = 'required|alpha_num|between:5,20';
    	}

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {

		    $user = Usuario::find(Input::get('id'));
		    $user->id_grupo = Input::get('id_grupo');
		    $user->nome = Input::get('nome');
		    $user->email = Input::get('email');

		    if(Input::get('password')) {
		    	$user->password = Hash::make(Input::get('password'));
		    }
		    
		    $user->save();
		 
		    return Redirect::to('usuarios/edit/'. $user->id)
		    	->with('message', 'Usuário salvo com sucesso!')
		    	->with('alert', 'success');

		} else {
		    return Redirect::to('usuarios/edit/' . Input::get('id'))
		    	->withErrors($validator)
		    	->withInput();
		}

	}

	/**
	 * 
	 */
	public function getStatus($id)
	{
		//
		PermissionsController::check('usuarios.status');

		//
		$user = Usuario::find($id);

		//
		if($user->id == Auth::id()){

		    return Redirect::to('usuarios')
		    	->with('message', 'Você não pode alterar o status do seu próprio usuário!')
		    	->with('alert', 'danger');

	    }

	    //
		$user = Usuario::find($id);
		$user->status = ($user->status ? 0 : 1);
		$user->save();

		//
	    return Redirect::to('usuarios')
	    	->with('message', 'Status do usuário alterado com sucesso!')
	    	->with('alert', 'success');
	}

	/**
	 * 
	 */
	public function getDelete($id)
	{
		//
		PermissionsController::check('usuarios.delete');

		//
		$user = Usuario::find($id);

		//
		if($user->id == Auth::id()){
		    return Redirect::to('usuarios')
		    	->with('message', 'Você não pode remover seu próprio usuário')
		    	->with('alert', 'danger');
	    }

	    //
		$user->delete();

	    return Redirect::to('usuarios')
	    	->with('message', 'Usuário removido com sucesso!')
	    	->with('alert', 'success');
	}

	/**
	 * 
	 */
	private function grid($sql = null)
	{
		if(is_null($sql)) {
			$sql = Usuario::with('grupo');
		}

		$grid = new GridBuilder();
		$grid->setQuery($sql);
		$grid->addColuna('ID', 'id');
		$grid->addColuna('Nome', 'nome');
		$grid->addColuna('Usuário', 'username');
		$grid->addColuna('E-mail', 'email');
		$grid->addColuna('Grupo', function($i){
			return $i->grupo->nome;
		});
		$grid->addTimestamps();
		$grid->addColuna('Opções', function($i){

			$out = '<a href="/usuarios/edit/{id}">Editar</a> | ';
			$out .= '<a href="/usuarios/delete/{id}">Remover</a> | ';

			if($i->status){
				$out .= '<a href="/usuarios/status/{id}">Desativar</a>';
			}else{
				$out .= '<a href="/usuarios/status/{id}">Ativar</a>';
			}

			return str_replace('{id}', $i->id, $out);
		});

		return $grid->make();
	}

}
