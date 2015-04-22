<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ThaiBricks Adminstration Panel</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico" type="image/x-icon" />
<link rel="bookmark" href="{{URL::to('/')}}/favicon.ico" />

<!-- bootstrap 3.0.2 -->
{{ HTML::style('admin/css/bootstrap.css') }}

<!-- font Awesome -->
{{ HTML::style('admin/css/roboto.css') }}
{{ HTML::style('admin/css/font-awesome.css') }}
{{ HTML::style('admin/css/font-awesome-animation.css') }}
{{ HTML::style('admin/css/ionicons.css') }}

<!-- Theme style -->
{{ HTML::style('admin/css/customstyle.css') }}
<!-- HTML5  Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	{{ HTML::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
    {{ HTML::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
<![endif]-->
{{ HTML::script('admin/js/jquery.min.js') }}
</head>
<body>
<div class="innerpage">
  <!-- /Head Logo Notigication and User Account Details Start -->
  <header class="header">
    <div role="navigation" class="navbar navbar-default topmenuwrap">
      <div class="">
        <div class="navbar-header">
          <button data-target="#topnavdrpdwn" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="{{URL::to('/admins/dashboard')}}" class="logo">
          	{{ HTML::image('images/admin-logo.png', '', array('class' => 'productlogo')) }}
          </a>
        </div>
        <div id="topnavdrpdwn" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown user user-menu"> <a data-toggle="dropdown" class="dropdown-user" href="javascript:void(0)" style="padding-left:12px;"> <span class="glyphicon glyphicon-user"></span> &nbsp; Admin <span class="caret"></span></span> </a>
              <ul class="dropdown-menu dropdown-user">
                <!--<li><a href="javascript:void(0)"><span class="fa fa-user"></span> Profile </a> </li>
                <li class="divider"></li>-->
                <li class="logout"><a href="{{URl::to('admins/logout')}}"><span class="fa fa-sign-out"></span> Logout </a> </li>
              </ul>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
    </div>
  </header>
  <!-- /Head Logo Notigication and User Account Details End -->
  
  <!-- /Main Dashboard Area Start -->
  <div class="container-fluid">
    <div class="row">
      <!-- /Left Navigation Start -->
      <div id="" class="col-sm-3 col-md-2 sidebar">
        <nav id="" role="navigation" class="navbar navbar-secondary ">
          <div class="navbar-header">
            <button data-target="#submenu" data-toggle="collapse" class="navbar-toggle submenutoggle" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <div class="user-panel">
              
              <div class="pull-left info">
                <p><span class="fa fa-user"></span>  Hello Admin</p>
              </div>
            </div>
          </div>
          <div class="navbar-collapse collapse" id="submenu">
            <ul class="nav nav-tabs nav-stacked col-xs-12">
              <li class="dropdown fhmm nav <?php if(Request::is('admins/attribute/*') == 1) echo "open"; ?>"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-list"></span>Meta Data & Attributes <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div><a href="{{URL::to('/admins/relation')}}"><span class="fa fa-angle-right"></span>Relations Master</a></div>
                  </li>                  
                  <li>
                    <div><a href="{{URL::to('/admins/attribute/relation')}}"><span class="fa fa-angle-right"></span>Manage Relations</a></div>
                  </li>
                </ul>
              </li>
              <li class="dropdown fhmm nav <?php if(Request::is('admins/location/*') == 1) echo "open"; ?>"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-check"></span>Location & Transport <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div><a href="{{URL::to('/admins/location/location')}}"><span class="fa fa-angle-right"></span>Manage Locations</a></div>
                  </li>
                  <li>
                    <div><a href="{{URL::to('/admins/location/transport')}}"><span class="fa fa-angle-right"></span>Manage Transport</a></div>
                  </li>
                  <li>
                    <div><a href="{{URL::to('/admins/location/nearby')}}"><span class="fa fa-angle-right"></span>Manage Nearby</a></div>
                  </li>
                </ul>
              </li>
              
              <li class="fhmm nav">
                <a href="{{URL::to('/admins/property/list')}}"><span class="fa fa-map-marker"></span>Manage Properties</a>
              </li>
              <li>
                <a href="{{URL::to('/admins/users/list')}}"><span class="fa fa-user"></span>Manage Seller/Agents</a>
              </li>
              <li class="dropdown fhmm nav <?php if(Request::is('admins/advertise/*') == 1) echo "open"; ?>"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-list"></span>Manage Advertisement <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div><a href="{{URL::to('admins/advertise/adpackages/')}}"><span class="fa fa-angle-right"></span>Manage Packages</a></div>
                  </li>                  
                  <li>
                    <div><a href="{{URL::to('admins/advertise/')}}"><span class="fa fa-angle-right"></span>Manage Advertisement</a></div>
                  </li>
                  <li>
                    <div><a href="{{URL::to('admins/recommendation/')}}"><span class="fa fa-star"></span>Manage Recommendation</a></div>
                  </li>
                </ul>
              </li>
              <li>
                <a href="{{URL::to('/admins/newsletters')}}"><span class="fa fa-user"></span>Newsletter Subscribers</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- /Left Navigation End -->
      
      <!-- /Right Dashboard Start -->
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @yield('body')
        <!-- /Page Content End -->
      </div>
      <!-- /Right Dashboard End -->
    </div>
  </div>
  <!-- /Main Dashboard Area End -->
  
  <!-- /Footer Start -->
  <footer>
    <p class="text-center copywright"> COPYRIGHT &copy; <?php date("Y"); ?> ThaiBricks </p>
  </footer>
  <!-- /Footer End -->
</div>
<!-- jQuery 2.0.2 -->

 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!-- Bootstrap -->
{{ HTML::script('admin/js/bootstrap.js') }}
{{ HTML::script('admin/js/custom.js') }}

<link type="text/css" href="{{asset('libraries/bootstrap-treeview/src/css/bootstrap-treeview.css')}}" />
<script src="{{asset('libraries/bootstrap-treeview/src/js/bootstrap-treeview.js')}}"></script>

  


<script>
  $(function(){
   // $('#relations').treeview({data: '<?php echo $dataset["relations"]; ?>'});

    $('#frm').submit(function(e){
      $('#save_transport').trigger('click');
      e.preventDefault();
    });
  
});
</script>

@show
</body>
</html>