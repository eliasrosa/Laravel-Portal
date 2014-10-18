@section ('menu')
    @include('usuarios.menu')
@stop

@section('content')

{{ Form::model($grupo, ['url' => 'usuarios/grupos/update' ]) }}
    {{ Form::hidden('id') }}

    {{ Form::openGroup('nome', 'Nome no grupo') }}
        {{ Form::text('nome') }}
    {{ Form::closeGroup() }}

    {{ Form::btnSalvar() }}

{{ Form::close() }}
       
@stop

