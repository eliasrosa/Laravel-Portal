<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuariosGrupos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//	
		Schema::create('usuarios_grupos', function($table){
			$table->increments('id');
			$table->string('nome')->unique();
			$table->longText('permissions');
			$table->boolean('status');
			$table->timestamps();
		});//

	    //
	    DB::table('usuarios_grupos')->insert(array(
			'nome' => 'Super Administrador',
			'permissions' => '',
			'status' => true,
			'created_at' => new DateTime,
			'updated_at' => new DateTime,
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('usuarios_grupos');
	}

}
