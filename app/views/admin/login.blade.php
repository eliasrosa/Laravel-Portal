@section ('content')

	<div class="page-header">
		<h1>Login</h1>
	</div>

	{{ Form::open([ 'url' => 'login', 'class' => 'well' ]) }}

	    {{ Form::openGroup('username', 'Usuário') }}
	        {{ Form::text('username') }}
	    {{ Form::closeGroup() }}

	    {{ Form::openGroup('password', 'Senha') }}
	        {{ Form::password('password') }} <br />
	    {{ Form::closeGroup() }}

	    {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary'))}}

	{{ Form::close() }}

@stop