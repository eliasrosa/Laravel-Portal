<ul class="nav navbar-nav navbar-right navbar-sair">

    @yield('menu')

    <li class="divider-vertical">|</li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Aplicativos<span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
      		<li><a href="/usuarios">Gerenciar Usuários</a></li>
      </ul>
    </li>
    <li>{{ HTML::link('logoff', 'Sair') }}</li> 
</ul>
