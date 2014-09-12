<?php 

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
			if(in_array($p, $permissions)){
				return true;
			}
		}

		throw new HttpException(403, 'Acesso negado!');
	
	}

}