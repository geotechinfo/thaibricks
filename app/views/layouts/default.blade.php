<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>ThaiBricks | Home</title>

<!--<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="libraries/slider/css/slider.css" rel="stylesheet">
<link href="libraries/select2/css/select2.css" rel="stylesheet">
<link href="libraries/slick/slick.css" rel="stylesheet">
<link href="css/prettyPhoto.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
 -->
 
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/font-awesome.min.css') }}
{{ HTML::style('libraries/slider/css/slider.css') }}
{{ HTML::style('libraries/select2/css/select2.css') }}
{{ HTML::style('libraries/slick/slick.css') }}
{{ HTML::style('css/prettyPhoto.css') }}
{{ HTML::style('css/main.css') }}
<!--[if lt IE 9]>
    {{ HTML::script('js/html5shiv.js') }}
    {{ HTML::script('js/respond.min.js') }}
<![endif]-->
    
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">



</head>
<!--/head-->
<body>
<!--/header-->
<header class="navbar navbar-inverse navbar-fixed-top sun-flower" role="banner">
  <section id="topnav" class="pitch-black">
    <div class="container loginwrap">
      <div class="row">
        <div class="">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".socialnav-collapse"> <span class="sr-only">Toggle
            navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <div class="contactno fontsmall">
            	Contact us ( 66 ) 894503647
            </div> 
            
            	
            
            
          </div>
          <div class="collapse navbar-collapse topnav socialnav-collapse">
            <ul class="nav navbar-nav navbar-right social-network-menu">
              <li class="flagitem"><a href="javascript:void(0);">{{ HTML::image('images/flag/flag1.png', '', array('class' => 'flag')) }}</a></li>
              <!--<li class="active"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Vimeo"><span class="fa fa-vimeo-square"></span></a></li>-->
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Facebook"><span class="fa fa-facebook-square"></span></a></li>
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Twitter"><span class="fa fa-twitter"></span></a></li>
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><span class="fa fa-pinterest-square"></span></a></li>
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Skype"><span class="fa fa-skype"></span></a></li>
              <!--<li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="YouTube"><span class="fa fa-youtube-square"></span></a></li>
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Google Plus"><span class="fa fa-google-plus-square"></span></a></li>
              <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Linkedin"><span class="fa fa-linkedin-square"></span></a></li>
              -->           
              
              @if(Auth::check())
              <li><a href="javascript:void(0);" class="welcomeuser">
              	<span class="fa fa-user"></span> Welcome {{{ Auth::user()->first_name }}}</a>
              </li>
              <li><a href="{{URL::to('/property/mylist/me')}}" class="toplinks">My Properties</a></li>
              <li><a href="{{URL::to('/profile')}}" class="toplinks">Profile</a></li>
              <li><a href="{{URL::to('/logout')}}" class="toplinks">Logout</a></li>
              @else
              <li><a href="javascript:void(0);" class="toplinks login">Login</a></li>
              <li><a href="{{URL::to('/create')}}" class="toplinks">Register</a></li>
              @endif
            </ul>
            <div class="login_popupdiv white" style="display:none;">
                <div class="">
                {{ Form::open(array('class' => 'form-inline', 'route' => array('login'), 'method' => 'post')) }}
                  <div class="form-group">
                    {{Form::text('email', null,array('class' => 'form-control', 'placeholder' => 'Email'))}}
                  </div>
                  <div class="form-group">
                    {{Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                  </div>
                  {{Form::submit('Login', array('class' => 'btn btn-default orange login_btn'))}}
                {{ Form::close() }}
                </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="form-group margin-top quicklocationsearch">
                  <div class="arrow">
                    <div class="btn-group mutiselectbtn">
                    	{{Form::select('location', array('' => 'Select Location', 'Bangkok' => 'Bangkok', 'Phuket' => 'Phuket'), '', array('class' => 'form-control', 'id'=>"city"))}}
                    </div>
                  </div>
                </div>
    </div>
    
  </section>
  <section id="mainnav" class="concrete">
  <div class="fontsmall uppercase open-me"><a href="javascript:void(0)" class="close-social">Open
        Me</a></div>
    <div class="container">
      <div class="row">
        <div class="">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".mainnav"> <span class="sr-only">Toggle
            navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="{{URL::to('/')}}">{{ HTML::image('images/logo.png', '', array('class' => '')) }}</a> </div>
          <div class="collapse navbar-collapse mainnav">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="javascript:void(0)">Rent</a></li>
              <li><a href="javascript:void(0)">Sell</a></li>
              <li><a href="javascript:void(0)">Projects</a></li>
              <li><a href="javascript:void(0)">Lease</a></li>
              <li><a href="javascript:void(0)">Agents</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</header>
<!--/header-->
@yield('content')
<!--prefooter-->
<section class="grey" id="bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h4>Thaibricks</h4>
        <p>Tired of searching for condos / apartment / house in bangkok, dont
          worry we got your covered. We have great listings and if you have no
          time to search, contact our great Agents.</p>
        <address>
        <span class="fa fa-map-marker"></span>PhraKhanong, Sukhumvit, Bangkok<br/>
        <span class="fa fa-phone"></span>(66) 02 123 4567<br/>
        <span class="fa fa-envelope"></span>info@thaibricks.com<br/>
        </address>
      </div>
      <!--/.col-md-3-->
      <!--/.col-md-3-->
      <div class="col-md-4">
        <h4>Tweets</h4>
        <div>
          <div class="media clearfix">
            <div class="pull-left"> <span class="fa fa-twitter"></span> </div>
            <div class="media-body"> <small class="muted">Check this condo in
                Thonglor, #TBRecommendation, <a href="javascript:void(0)" title="" class="seagreentxt"> http//www.thaibricks.com </a></small> </div>
          </div>
          <div class="media clearfix">
            <div class="pull-left"> <span class="fa fa-twitter"></span> </div>
            <div class="media-body"> <small class="muted">Check this condo in
                Thonglor, #TBRecommendation, <a href="javascript:void(0)" title="" class="seagreentxt"> http//www.thaibricks.com </a></small> </div>
          </div>
          <div class="media clearfix">
            <div class="pull-left"> <span class="fa fa-twitter"></span> </div>
            <div class="media-body"> <small class="muted">Check this condo in
                Thonglor,Check this condo in Thonglor #TBRecommendation, <a href="javascript:void(0)" title="" class="seagreentxt"> http//www.thaibricks.com </a></small> </div>
          </div>
        </div>
      </div>
      <!--/.col-md-3-->
      <div class="col-md-4">
        <h4>newsletter sing up</h4>
        <div class="media newsletter-brief">
          <div class="pull-left"> <span class="fa fa-envelope"></span><span class="fa fa-mail-reply"></span> </div>
          <div class="media-body"> <small class="muted">Suscribe to our email list so you can keep pu to date with our latest properties.</small> </div>
        </div>
        <form role="form">
          <div class="form-group">
            <input type="text" placeholder="Name" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" placeholder="Email" class="form-control">
          </div>
          <div class="">
          
            <button type="submit" class="btn btn-grey pull-right subscribe"> Subscribe</button>
          </div>
        </form>
      </div>
      <!--/.col-md-3-->
    </div>
    </div>
</section>
<!--prefooter-->


<!--/#bottom-->
<footer class="concrete footer" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
      <ul class="pull-left">
          <li><a href="{{URL::to('/')}}">Home</a></li>
          <li><a href="javascript:void(0);">Buy</a></li>
          <li><a href="javascript:void(0);">Sell</a></li>
          <li><a href="javascript:void(0);">Rent</a></li>
          <li><a href="javascript:void(0);">Projects</a></li>
          <li><a href="{{URL::to('/about')}}">About Us</a></li>
          <li><a href="javascript:void(0);">Contact</a></li>
          <li><a href="javascript:void(0);" class="fb">Facebook</a></li>
          <li><a href="javascript:void(0);" class="twtr">Twitter</a></li>
        </ul>
      </div>
      <div class="col-sm-4">
      	<div class="copyright">
        Copyright - Privacy Policy -  <a target="_blank" href="javascript:void(0);" title="ThaiBricks">ThaiBricks</a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!--/#footer-->
<!--<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>-->
<!--<script src="js/jquery.isotope.min.js"></script>-->
<!--<script src="libraries/slider/js/bootstrap-slider.js"></script>
<script src="libraries/select2/js/select2.js"></script>
<script type="text/javascript" src="libraries/slimheader/classie.js"></script>
<script src="js/main.js"></script>-->

{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.prettyPhoto.js') }}
<!--{{ HTML::script('js/jquery.isotope.min.js') }}-->
{{ HTML::script('libraries/slider/js/bootstrap-slider.js') }}
{{ HTML::script('libraries/select2/js/select2.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}
{{ HTML::script('js/main.js') }}
<script>
    //tooltip
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(".propertyinfo .propertyformsteps").each(function(e) {
        if (e != 0)
            $(this).hide();
    });
	$("#prev").hide();

	var step_counter = 1;
    $("#next").click(function(){
		if(step_counter == 1){
			$(".text-danger").empty();
			var success = true;
			$("#step1 input, #step1 textarea, #step1 select").each(function() {
				if($(this).val() == ""){
					$(this).closest(".col-md-6").append('<small class="text-danger error_special">This field is required. </small>');
					$(this).focus();
					success = false;
					return false;
				}
			});
			
			if(success == true){
				step_counter++;
				$("html, body").animate({ scrollTop: 250 }, "slow");
				
				$("#prev").show();
				
				$(".step_1").removeClass("active").addClass("complete");
				$(".step_2").removeClass("disabled").addClass("active");
				
				$("#step1").hide();
				$("#step2").show();
			}
		}else if(step_counter == 2){
			$(".text-danger").empty();
			var success = true;
			$("#step2 input, #step1 select").each(function() {
				if($(this).val() == ""){
					$(this).closest(".col-md-6").append('<small class="text-danger">This field is required. </small>');
					$(this).focus();
					success = false;
					return false;
				}
			});
			
			if(success == true){
				step_counter++;
				$("html, body").animate({ scrollTop: 250 }, "slow");
				
				$("#next").hide();
				$("#sbmt").show();
				
				$(".step_2").removeClass("active").addClass("complete");
				$(".step_3").removeClass("disabled").addClass("active");
				
				$("#step2").hide();
				$("#step3").show();
			}
		}
		
        return false;
    });

    $("#prev").click(function(){		
		if(step_counter == 2){
			step_counter--;
			$("html, body").animate({ scrollTop: 250 }, "slow");
			
			$("#prev").hide();
			
			$(".step_1").removeClass("complete").addClass("active");
			$(".step_2").removeClass("active").addClass("disbaled");
			
			$("#step1").show();
			$("#step2").hide();
		}else if(step_counter == 3){
			step_counter--;
			$("html, body").animate({ scrollTop: 250 }, "slow");
			
			$("#next").show();
			$("#sbmt").hide();
			
			$(".step_2").removeClass("complete").addClass("active");
			$(".step_3").removeClass("active").addClass("disbaled");
			
			$("#step2").show();
			$("#step3").hide();
		}
        return false;
    });
});

$(document).ready(function(){
	$("#file_add").click( function(){
		var file_wrap = $("#file_wrap").clone();
		$("#file_wrap").after(file_wrap);			  
	});
});

$(document).ready(function(){
	function chnage_rule(){
		$("#location_sub").empty();
		if($("#location").val() == "Bangkok"){
			$("#location_sub").append($("<option />").val("").text("Sub Location"));
			$("#location_sub").append($("<option />").val("Asok").text("Asok"));
			$("#location_sub").append($("<option />").val("Nana").text("Nana"));
		}else if($("#location").val() == "Phuket"){
			$("#location_sub").append($("<option />").val("").text("Sub Location"));
			$("#location_sub").append($("<option />").val("Patong").text("Patong"));
			$("#location_sub").append($("<option />").val("Laguna").text("Laguna"));
		}
	}
	$("#location").change( function(){
		chnage_rule();
	});
	<?php if(isset($_GET["location"]) && $_GET["location"] != ""){ ?>
		$("#location").val('<?php echo $_GET["location"]; ?>');
	<?php } ?>
	<?php if(isset($_GET["location_sub"]) && $_GET["location_sub"] != ""){ ?>
		chnage_rule();
		$("#location_sub").val('<?php echo $_GET["location_sub"]; ?>');
	<?php } ?>
	
	<?php if(isset($dataset["property"]->location) && $dataset["property"]->location != ""){ ?>
		$("#location").val('<?php echo $dataset["property"]->location; ?>');
	<?php } ?>
	<?php if(isset($dataset["property"]->location_sub) && $dataset["property"]->location_sub != ""){ ?>
		chnage_rule();
		$("#location_sub").val('<?php echo $dataset["property"]->location_sub; ?>');
	<?php } ?>
	
	<?php if(Input::old('location') != ""){ ?>
		$("#location").val('<?php echo Input::old('location'); ?>');
	<?php } ?>
	<?php if(Input::old('location_sub') != ""){ ?>
		chnage_rule();
		$("#location_sub").val('<?php echo Input::old('location_sub'); ?>');
	<?php } ?>
});
</script>

<style type="text/css">
.portfolio-items .item-inner img{
	height:160px !important;
}
.portfolio-items .eventphototext {
	height: 120px; overflow: hidden;
}
.propertylistwrap .propertyimg img{
	height:207px !important;
}
</style>
</body>
</html>