<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Intranet Taura Brasil</title>

    <!-- style -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/login.css') }}
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      {{ HTML::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}
      {{ HTML::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->
  </head>
  <body>

            
      <div class="container-fluid">
          <div class="row-fluid">
              <div class="centering text-center xform">
                  @yield ('content')
                  @if(Session::has('message'))
                      <p class="alert alert-dismissable alert-danger">{{ Session::get('message') }}</p>
                  @endif
              </div>
          </div>
      </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('js/bootstrap.min.js') }}
  </body>
</html>