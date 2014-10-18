@section ('menu')
    @include('usuarios.menu')
@stop

@section('content')

{{ Form::open(['url' => 'usuarios/grupos/create' ]) }}

    {{ Form::openGroup('nome', 'Nome no grupo') }}
        {{ Form::text('nome') }}
    {{ Form::closeGroup() }}

    {{ Form::btnSalvar() }}

{{ Form::close() }}
       
@stop
