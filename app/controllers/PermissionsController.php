<?php 

use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as Exception;

class PermissionsController
{

	/**
	 * 
	 */
	public static function check($acl){

		$aclList = [$acl];
		$subGrupo = explode('.', $acl);
					
		while (count($subGrupo) != 1) {
			array_pop($subGrupo);
			$aclList[] = implode('.', $subGrupo) . '.*';
		} 


		//
		$user = Auth::user()->with('grupo')->first();
		$permissions = explode("\n", $user->grupo->permissions);

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