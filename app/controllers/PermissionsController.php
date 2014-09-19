<?php 

use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as Exception;

class PermissionsController
{

	/**
	 * 
	 */
	public static function check($acl){

		// captura e monta todos a acl permitidas
		// por níveis e subníveis
		$aclList = [$acl, '*'];
		$subGrupo = explode('.', $acl);
					
		while (count($subGrupo) != 1) {
			array_pop($subGrupo);
			$aclList[] = implode('.', $subGrupo) . '.*';
		} 


		// busca no banco de dados as permissions do grupo
		// ligadas ao usuários logado no sistema
		$user = Auth::user()
			->with('grupo')
			->remember(Config::get('database.remember', 10))
			->first();

		// 
		$permissions = explode(';', $user->grupo->permissions);


		// check as pemissions
		foreach ($aclList as $p){
			foreach ($permissions as $db) {
				if(trim($p) == trim($db)){
					return true;
				}
			}	
		}

		throw new Exception('Você não tem permissão!');
	
	}

}