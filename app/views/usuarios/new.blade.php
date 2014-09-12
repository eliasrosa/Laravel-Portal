@section ('menu')
    @include('usuarios.menu')
@stop

@section('content')

{{ Form::open(['url' => 'usuarios/create' ]) }}

    {{ Form::openGroup('nome', 'Nome completo') }}
        {{ Form::text('nome') }}
    {{ Form::closeGroup() }}

    {{ Form::openGroup('username', 'Usuário') }}
        {{ Form::text('username') }}
    {{ Form::closeGroup() }}

    {{ Form::openGroup('id_grupo', 'Grupo') }}
        {{ Form::select('id_grupo', $grupos) }}
    {{ Form::closeGroup() }}    

    {{ Form::openGroup('email', 'E-mail') }}
        {{ Form::email('email') }}
    {{ Form::closeGroup() }}

    {{ Form::openGroup('password', 'Senha') }}
        {{ Form::password('password', array('placeholder'=>'Digite uma senha')) }} <br />
        {{ Form::password('password_confirmation', array('placeholder'=>'Confirme a senha')) }}
    {{ Form::closeGroup() }}

    {{ Form::btnSalvar() }}

{{ Form::close() }}
       
@stop
