<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    
    <title>Portal</title>

    <!-- style -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/main.css')}}
    {{ HTML::script('js/jquery-1.11.1.min.js')}}
    {{ HTML::script('js/bootstrap.min.js')}}
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      {{ HTML::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}
      {{ HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->
  </head>
  <body>

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span cl ass="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Portal</a>
      </div>
      <div class="navbar-collapse navbar-responsive-collapse collapse in">
          @include('layouts.menu')
      </div>
    </div>

    <div class="container-fluid">
      <div id="container-main">
        @if(Session::has('message'))
            <div class="alert alert-dismissable alert-{{ Session::get('alert') ? Session::get('alert') : 'danger' }}">
                <p>{{ Session::get('message') }}</p>
            </div>
        @endif
        @yield ('content')
      </div>
    </div>
    
  </body>
</html>