<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//	
		Schema::create('usuarios', function($table){
			$table->increments('id');
			$table->integer('id_grupo');
			$table->string('nome');
			$table->string('email')->unique();
			$table->string('username', 100)->unique();
			$table->string('password', 64);
			$table->string('remember_token', 64);
			$table->boolean('status');
			$table->timestamps();
		});

	    //
	    DB::table('usuarios')->insert(array(
			'id_grupo'   => 1,
			'nome'       => 'Elias da Rosa',
			'username'   => 'admin',
			'email'      => 'elias.rosa@taurabrasil.com.br',
			'password'   => Hash::make('admin'),
			'status'     => true,
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
		Schema::dropIfExists('usuarios');
	}

}
