@section ('menu')
    @include('usuarios.menu')
@stop

@section('content')

{{ HTML::script('vendor/jstree/dist/jstree.min.js') }}
{{ HTML::style('vendor/jstree/dist/themes/default/style.min.css') }}

{{ Form::model($grupo, ['url' => 'usuarios/grupos/update' ]) }}
    {{ Form::hidden('id') }}
    {{ Form::hidden('permissions') }}

    {{ Form::openGroup('nome', 'Nome no grupo') }}
        {{ Form::text('nome') }}
    {{ Form::closeGroup() }}

    {{ Form::openGroup('permissions', 'Permissões') }}
    	| <a href="javascript:void();" id="clear">Desmarcar todos</a>
		<div id="tree"></div>
    {{ Form::closeGroup() }}

    {{ Form::btnSalvar() }}

{{ Form::close() }}

<script>

	$(function() {

	 	$('#tree').on('changed.jstree', function (e, data) {
    		$('form :hidden[name="permissions"]').val(data.selected.join(";"));
	 	}).jstree({
	        'plugins': ["wholerow", "checkbox"],
	        'themes': {'responsive': true, 'icons': false},
	        'checkbox' : {
			    'keep_selected_style' : false,
			    'three_state' : false
			 },
	        'core': {
	            'data': {
	            	'url': '/usuarios/grupos/permissions/{{ $grupo->id }}'
	            }
	        }
	    });

	 	$('#clear').on('click', function(){
	 		$('#tree').jstree("uncheck_all");
	 	});

	});
</script>
       
@stop

