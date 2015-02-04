<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ThaiBricks Adminstration Panel</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
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
</head>
<body>
<div class="innerpage">
  <!-- /Head Logo Notigication and User Account Details Start -->
  <header class="header">
    <div role="navigation" class="navbar navbar-default topmenuwrap">
      <div class="">
        <div class="navbar-header">
          <button data-target="#topnavdrpdwn" data-toggle="collapse" class="navbar-toggle" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a href="javascript:void(0)" class="logo">
          	{{ HTML::image('images/logo.png', '', array('class' => 'productlogo')) }}
          </a>
        </div>
        <div id="topnavdrpdwn" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active dropdown"> <a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle"> <span class="fa fa-envelope"></span><span class="label label-success">4</span> </a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">You have 4 messages</li>
                <li class="divider"></li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><a href="javascript:void(0)">Subject:Lorem Ipsum <small><span class="fa fa-clock-o"></span> 5 mins</small></a> </li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Subject:Lorem Ipsum <small><span class="fa fa-clock-o"></span> 5 mins</small></a> </li>
                    <li class="divider"></li>
                  </ul>
                </li>
                <li class="footer"><a href="javascript:void(0)">See All Messages</a></li>
              </ul>
            </li>
            <li class="dropdown"> <a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle"> <span class="fa fa-warning"></span><span class="label label-warning">10</span> </a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">You have 10 notifications</li>
                <li class="divider"></li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><a href="javascript:void(0)">10 New Addmissions <small><span class="fa fa-calendar"></span> Yesterday</small></a> </li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">1 new exam added <small><span class="fa fa-calendar"></span> Today</small></a> </li>
                    <li class="divider"></li>
                  </ul>
                </li>
                <li class="footer"><a href="javascript:void(0)">See All Messages</a></li>
              </ul>
            </li>
            <li class="dropdown"> <a href="javascript:void(0)" data-toggle="dropdown" class="dropdown-toggle"> <span class="fa fa-tasks"></span><span class="label label-danger">9</span> </a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">You have 9 task assigned</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><a href="javascript:void(0)">Subject:Lorem Ipsum <small><span class="fa fa-clock-o"></span> 5 mins</small></a> </li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Subject:Lorem Ipsum <small><span class="fa fa-clock-o"></span> 5 mins</small></a> </li>
                    <li class="divider"></li>
                  </ul>
                </li>
                <li class="footer"><a href="javascript:void(0)">See All Messages</a></li>
              </ul>
            </li>
            <li class="dropdown user user-menu"> <a data-toggle="dropdown" class="dropdown-user" href="javascript:void(0)"> <span class="glyphicon glyphicon-user"></span> <span>Admin Profile<span class="caret"></span></span> </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="javascript:void(0)"><span class="fa fa-user"></span> User Profile </a> </li>
                <li><a href="{{URL::to('/')}}"><span class="fa fa-gears"></span> Back to home </a> </li>
                <li class="divider"></li>
                <li class="logout"><a href="javascript:void(0)"><span class="fa fa-sign-out"></span> Logout </a> </li>
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
              <div class="pull-left image">
                <div class="img-circle"><span class="fa fa-user"></span></div>
              </div>
              <div class="pull-left info">
                <p>Hello, Admin User</p>
              </div>
            </div>
          </div>
          <div class="navbar-collapse collapse" id="submenu">
            <ul class="nav nav-tabs nav-stacked col-xs-12">
              <li class="dropdown fhmm nav"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-check"></span>Location & Transport <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  
                  <li>
                    <div><a href="{{URL::to('/admin/location/location')}}"><span class="fa fa-angle-right"></span>Manage Locations</a></div>
                  </li>
                  <li>
                    <div><a href="{{URL::to('/admin/location/transport')}}"><span class="fa fa-angle-right"></span>Manage Transport</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Registration Details</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Admission Test - Score List</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Admission - Selected List</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Assessments - List</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Bus - Pickup/Drop Points</a></div>
                  </li>
                  
                </ul>
              </li>
              <li class="dropdown fhmm nav"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-group"></span>Student Management <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Students - List</a></div>
                  </li>
                  
                </ul>
              </li>
              
              <li class="dropdown fhmm nav"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-list-alt"></span>Examination <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  
                  <li>
                    <div><a href="javascript:void(0)">Assessments Period List</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)">Assessments Details</a></div>
                  </li>
                  
                </ul>
              </li>
              
              <li class="dropdown fhmm nav"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-money"></span>School Accounts <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Fee Collection Period</a></div>
                    	
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Fee Structure</a></div>
                    	
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Bus Service Fee</a></div>
                  </li>
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Fee Collection - List</a></div>
                  </li>
                  
                  <li>
                    <div><a href="javascript:void(0)"><span class="fa fa-angle-right"></span>Fee Late Fine - List</a></div>
                  </li>
                </ul>
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
<script src="js/jquery.min.js" type="text/javascript"></script>
{{ HTML::script('admin/js/jquery.min.js') }}
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
<!-- Bootstrap -->
{{ HTML::script('admin/js/bootstrap.js') }}
{{ HTML::script('admin/js/custom.js') }}

<link type="text/css" href="{{asset("libraries\bootstrap-treeview\src\css\bootstrap-treeview.css")}}" />
<script src="{{asset("libraries\bootstrap-treeview\src\js\bootstrap-treeview.js")}}"></script>
<script type="text/javascript">
	$('#locations').treeview({data: '<?php echo $dataset["locations"]; ?>'});
</script>

@show
</body>
</html>