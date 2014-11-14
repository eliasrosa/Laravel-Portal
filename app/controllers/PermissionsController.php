<?php 

use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as Exception;

class PermissionsController
{

	/**
	 * 
	 */
	public static function check($acl, $returnFalse = false){

		// captura e monta todos a acl permitidas
		// por níveis e subníveis
		$aclList = [$acl, '*'];
		$subGrupo = explode('.', $acl);
					
		while (count($subGrupo) != 1) {
			array_pop($subGrupo);
			$aclList[] = implode('.', $subGrupo) . '.*';
		} 

		//
		$grupoId = Auth::user()->id_grupo;
		$permissions = self::getPermissiosByGroup($grupoId);

		//
		if(!self::verifyByArray($aclList, $permissions)){
			if($returnFalse == true){
				return false;
			}

			throw new Exception('Você não tem permissão!');
		}

	}


	/**
	 * 
	 */
	public static function verify($key, $permissions){

		foreach ($permissions as $p) {
			if(trim($key) == trim($p)){
				return true;
			}
		}	

		return false;
	}


	/**
	 * 
	 */
	public static function verifyByArray($keys, $permissions){

		foreach ($keys as $key) {
			if(self::verify($key, $permissions)){
				return true;
			}
		}	

		return false;
	}


	/**
	 * 
	 */
	public static function loadAll()
	{
		//
		$permissions = include(app_path() . '/permissions.php');

		//
		$data = array(
			array(
				'text' => 'Super Administrador',
				'id' => '*',
				'state' =>  array(
					'opened' => true
				),
				'children' => $permissions,
			)
		);

		return $data;
	}


	/**
	 * 
	 */
	public static function getPermissiosByGroup($grupoId)
	{
		//
		$grupo = DB::table('usuarios_grupos')->find($grupoId);
		$permissions = explode(';', $grupo->permissions);

		//
		return $permissions;
	}

}