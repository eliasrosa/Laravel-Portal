<?php

class UsuarioAdminSeeder extends Seeder
{

	public function run()
	{
		//
		DB::table('usuarios')->delete();
		
		//
		Usuario::create(array(
			'nome'     => 'Administrador',
			'username' => 'admin',
			'email'    => 'admin@taurabrasil.com.br',
			'password' => Hash::make('admin'),
		));


	}

}
