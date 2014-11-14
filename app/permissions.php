<?php

return [
	[ 'id' => 'usuarios.*', 'text' => 'Gerenciar usuários', 
		'children' => [
			[ 'id' => 'usuarios.index', 'text' => 'Listar' ],			
			[ 'id' => 'usuarios.new', 'text' => 'Adicionar' ],			
			[ 'id' => 'usuarios.edit', 'text' => 'Editar' ],			
			[ 'id' => 'usuarios.delete', 'text' => 'Deletar' ],			
			[ 'id' => 'usuarios.status', 'text' => 'Alterar status' ],		
			[ 'id' => 'usuarios.grupos.*', 'text' => 'Gerenciar grupos', 
				'children' => [
					[ 'id' => 'usuarios.grupos.index', 'text' => 'Listar' ],			
					[ 'id' => 'usuarios.grupos.new', 'text' => 'Adicionar' ],			
					[ 'id' => 'usuarios.grupos.edit', 'text' => 'Editar' ],			
					[ 'id' => 'usuarios.grupos.delete', 'text' => 'Deletar' ],			
					[ 'id' => 'usuarios.grupos.status', 'text' => 'Alterar status' ],
				] 
			],		
		]
	]
];
