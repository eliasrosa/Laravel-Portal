@section ('menu')
    @include('usuarios.menu')
@stop

@section('content')

{{ Form::model($usuario, ['url' => 'usuarios/update' ]) }}
    {{ Form::hidden('id') }}

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

    <br />
    <h4>Definir nova senha</h4>
    {{ Form::openGroup('password', 'Senha') }}
        {{ Form::password('password', array('placeholder'=>'Digite uma senha')) }} <br />
        {{ Form::password('password_confirmation', array('placeholder'=>'Confirme a senha')) }}
    {{ Form::closeGroup() }}

    {{ Form::btnSalvar() }}

{{ Form::close() }}
       
@stop

