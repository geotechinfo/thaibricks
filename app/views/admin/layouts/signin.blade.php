<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>ThaiBricks Administration Panel</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/roboto.css" rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/font-awesome-animation.css" rel="stylesheet">
<link href="css/customstyle.css" rel="stylesheet">
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="js/ie-emulation-modes-warning.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/font-awesome.min.css') }}
{{ HTML::style('libraries/slider/css/slider.css') }}
{{ HTML::style('libraries/select2/css/select2.css') }}
{{ HTML::style('libraries/slick/slick.css') }}
{{ HTML::style('libraries/startrating/jquery.rating.css') }}
{{ HTML::style('css/prettyPhoto.css') }}
{{ HTML::style('css/main.css') }}
{{ HTML::style('css/date.css') }}
<link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico" type="image/x-icon" />
<link rel="bookmark" href="{{URL::to('/')}}/favicon.ico" />
</head>
<body>
<div class="signInWrap">
  <!-- /Login container Start -->
  <div class="container">
    <div class="row loginWrap" style="background:#fff">
      <!-- /Login Theme Image Start -->
      <!-- /Login Theme Image End -->
       
      <!-- /Login Right Form Start -->
      <div class="col-sm-4 col-sm-offset-4">
        <div class="logo text-center"> <img src="{{asset('images/logo.png')}}" alt="Logo" class="productlogo"> </div>
        <h3 class="form-signin-heading text-center">Please sign in</h3>
        <div class="divider"></div>
         @if(Session::get('info'))
        <div class="margin-top-10 message">
        <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
        </div>
        {{{ Session::forget('info') }}}
        @endif
        <div class="divider"></div>
        <div class="login-form">
          {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('admin.login'), 'method' => 'post')) }} 
            <div class="input-group form-group">
              <div class="input-group-addon"><span class="fa fa-user"></span></div>
              <input type="text" placeholder="Enter your username" class="form-control" name="username" autofocus>
            </div>
            <div class="input-group form-group">
              <div class="input-group-addon"><span class="fa fa-lock"></span></div>
              <input type="password" placeholder="Enter your password" class="form-control"  required name="password">
            </div>
            <p></p>

            <div class="rem-forget form-group">
            <button class="btn btn-md btn-primary btn-block signInBtn orange" type="submit">Sign in</button>
            </div>
          {{ Form::close() }} 
        </div>
      </div>
      <!-- /Login Right Form Start -->
      
    </div>
    <!-- /Footer Start -->
    <footer>
      <p class="text-center copywright footer_text"> Copyright &copy; 2015 ThaiBricks </p>
    </footer>
    <!-- /Footer End -->
  </div>
  <!-- /container -->
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
