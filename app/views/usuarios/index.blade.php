@section ('menu')
    @include('usuarios.menu')
@stop

@section ('content')

	<h1 class="page-header">Controle de usuários</h1>
	{{ $grid }}

@stop
