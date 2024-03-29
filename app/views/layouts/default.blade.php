<?php
$location = new Location;
$dataset['locations']=$location->get_location_with_sub();
$url_loc_name = Request::segment(1);
$url_loc_id ='';
$loc = array(''=>'Select Location');
$subloc[''] = array(''=>'Select Location');
$transport_group =  array('' => 'Select Transport Group' );
foreach ($dataset['locations'] as $k=>$v){
	$loc[$k]=$v['location_name'];
  if(strtolower($v['location_name'])==strtolower($url_loc_name)){
    $url_loc_id = $v['location_id'];
  }

	if($v['SubLocation']){
	   foreach ($v['SubLocation'] as $k1 => $v1) {
		  $subloc[$k][$v1['location_id']]=$v1['location_name'];
	   }
	}
	if($v['Transport']){
	   foreach ($v['Transport'] as $k1 => $v1) {
		  $transport_group[$k][$v1['transport_id']]=$v1['transport_name'];
	   }
	}
}
//print_r($dataset["property"]->location);die;


?> 

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>ThaiBricks | <?php echo (isset($dataset['page_title'])?$dataset['page_title']:'Home')?></title>
<link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico" type="image/x-icon" />
<link rel="bookmark" href="{{URL::to('/')}}/favicon.ico" />
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
{{ HTML::style('libraries/startrating/jquery.rating.css') }}
{{ HTML::style('css/prettyPhoto.css') }}
{{ HTML::style('css/main.css') }}
{{ HTML::style('css/date.css') }}

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/jquery-ui.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.prettyPhoto.js') }}
{{ HTML::script('js/moment.js') }}
{{ HTML::script('js/date.js') }}
{{ HTML::script('libraries/validator/validation.js') }}
    
<link rel="shortcut icon" href="{{URL::to('/')}}/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style type="text/css">
  .transport_checkbox{float: left;top: 7px;left: 20px;position: absolute;}
  .nearbygroup{height: 250px;overflow: auto;}
</style>


</head>
<!--/head-->
<body>
<!--/header-->
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
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
                      <li class="flagitem"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="English">{{ HTML::image('images/flag/flag1.png', '', array('class' => 'flag')) }}</a></li>
                      <li class="flagitem"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Thai">{{ HTML::image('images/flag/flag2.png', '', array('class' => 'flag')) }}</a></li>
                      <!--<li class="flagitem"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Russian">{{ HTML::image('images/flag/flag3.png', '', array('class' => 'flag')) }}</a></li>
                      <li class="active"><a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="Vimeo"><span class="fa fa-vimeo-square"></span></a></li>-->
                      <li><a href="https://www.facebook.com/thaibricks" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Facebook"><span class="fa fa-facebook-square"></span></a></li>
                      <li><a href="https://twitter.com/ThaiBricks" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Twitter"><span class="fa fa-twitter"></span></a></li>
                      <li><a href="https://www.pinterest.com/thaibricks/" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><span class="fa fa-pinterest-square"></span></a></li>
                              
                      
                      @if(Auth::check())
                     
                      <li><a href="{{URL::action('PropertiesController@myproperties')}}"  class="toplinks topdash">Dashboard</a></li>
                     
                      <li><a class="welcomeuser" href="{{URL::action('UsersController@logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                      @else
                      <li><a href="javascript:void(0);" class="toplinks login">Login</a></li>
                      <li><a href="{{URL::action('UsersController@create')}}" class="toplinks">Register</a></li>
                      @endif
            </ul>
            
            <?php
      				$property_types = CommonHelper::propertyTypes();
      				$deal_types = CommonHelper::dealTypes();
      			?>
            <div class="modal fade" id="addPrperty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    {{ Form::open(array('route' => array('property.create'), 'method' => 'get')) }}
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="color:#333333;">Add New Property</h4>
                  </div>
                  <div class="modal-body addPropertyModal" style="color:#333333;">
                    <div class="row">
                      <div class="col-sm-3 col-sm-offset-1">
                      <label>Property Type</label>
                      </div>
                      <div class="col-sm-7">
                         {{Form::select('type_id', $property_types, null, array('class' => 'form-control'))}}
                      </div>
                    </div>
                    <p></p>
                    <div class="row">
                      <div class="col-sm-3 col-sm-offset-1">
                      <label>Transaction Type</label>
                      </div>
                      <div class="col-sm-7">
                        {{Form::select('deal_id', $deal_types, null, array('class' => 'form-control'))}} 
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary orange modalBtn">Submit</button>
                  </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
            
            <div class="login_popupdiv white" style="display:none;">
                <div class="">
                {{ Form::open(array('class' => 'form-inline noMargin', 'route' => array('login'), 'method' => 'post')) }}
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
          	{{Form::select('home_location', $loc, LOCATION_ID, array('class' => 'form-control', 'id'=>"home_location",'style'=>''))}}
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
            <a class="navbar-brand" href="{{URL::action('PagesController@index')}}">{{ HTML::image('images/logo.png', '', array('class' => '')) }}</a> </div>
          <div class="collapse navbar-collapse mainnav">
            <ul class="nav navbar-nav navbar-right search_nav">
              <li><a href="{{URL::action('PropertiesController@search')}}" class="orange">Search</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                  <li class="<?php echo (isset($_GET['deal_id']) && $_GET['deal_id']==1 ? 'active':'')?>"><a href="{{URL::action('PropertiesController@search')}}?deal_id=1">Sale</a></li>
                  <li class="<?php echo (isset($_GET['deal_id']) && $_GET['deal_id']==2 ? 'active':'')?>"><a href="{{URL::action('PropertiesController@search')}}?deal_id=2">Rent</a></li>
                  <li class="<?php echo (isset($_GET['deal_id']) && $_GET['deal_id']==3 ? 'active':'')?>"><a href="{{URL::action('PropertiesController@search')}}?deal_id=3">Lease</a></li>
                  <!--<li><a href="{{URL::action('PropertiesController@search')}}">Projects</a></li>-->
                 
                  <li class="<?php echo  (Request::segment(1)=='agents' ? 'active':'')?>"><a href="{{URL::action('UsersController@agents',['all'])}}">Agents</a></li>
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
  <div class="container noPadding">
    <div class="row noMargin">
      <div class="col-md-4">
        <h4>Thaibricks</h4>
        <p>Tired of searching for condos / apartment / house in bangkok, dont
          worry we got your covered. We have great listings and if you have no
          time to search, contact our great Agents.</p>

          <div class="border">
          </div>

        <address>
        <span class="fa fa-map-marker"></span>PhraKhanong, Sukhumvit, Bangkok<br/>
        <span class="fa fa-phone"></span>(66) 02 123 4567<br/>
        <span class="fa fa-envelope"></span>info@thaibricks.com<br/>
        </address>
      </div>
      <!--/.col-md-3-->
      <!--/.col-md-3-->
      <div class="col-md-4">
        
        
        <h4>Twitter Feeds</h4>
        <div style="background:#FFFFFF;padding:10px;border-radius:4px;">
          <a class="twitter-timeline" height="200"  href="https://twitter.com/ThaiBricks" data-widget-id="580988869421768704">Tweets by @ThaiBricks</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
          
          
      </div>
      <!--/.col-md-3-->
      <div class="col-md-4">

        <h4>newsletter sign up</h4>
        <div class="media newsletter-brief">
          <div class="pull-left"> <span class="fa fa-envelope"></span><span class="fa fa-mail-reply"></span> </div>
          <div class="media-body"> <small class="muted">Subscribe to our email list so you can keep up to date with our latest properties.</small> </div>
        </div>
        {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('newsletter'), 'method' => 'post','id'=>'newsletter')) }} 
          <div class="form-group text-success" style="display:none" id="nw_msg">Your Email has been successfully registered</div>
          <div class="form-group">
            <input type="text" placeholder="Name" name="newsletter_user" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" placeholder="Email" name="newsletter_email" class="form-control">
          </div>
          <div class="text-right row">
          
            <button type="submit" class="btn btn-grey subscribe"> Subscribe</button>
          </div>
        {{ Form::close() }}
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
      <div class="col-sm-6">
      <ul class="pull-left">
          <li><a href="{{URL::action('PagesController@index')}}">Home</a></li>
          <li><a href="{{URL::action('PagesController@about')}}">About Us</a></li>
          <li><a href="{{URL::action('PropertiesController@search')}}?deal_id=1">Sale</a></li>
          <li><a href="{{URL::action('PropertiesController@search')}}?deal_id=2">Rent</a></li>
          <li><a href="{{URL::action('PropertiesController@search')}}?deal_id=3">Lease</a></li>
         
          <li><a href="https://www.facebook.com/thaibricks" target="_blank" class="fb">Facebook</a></li>
          <li><a href="https://twitter.com/ThaiBricks" target="_blank" class="twtr">Twitter</a></li>
        </ul>
      </div>
      <div class="col-sm-6 footerRight">
      	<div class="copyright">
        <a href="{{URL::action('PagesController@privacy_policy')}}" title="Privacy Policy">Privacy Policy</a>
        <a href="{{URL::action('PagesController@terms_n_conditions')}}" title="Terms and Conditions">Terms and Conditions</a>
        <span>Copyright {{date('Y')}} ThaiBricks</span>
        </div>
      </div>
    </div>
  </div>
  <div class="progress" style="display:none; position:fixed; z-index:9999999; bottom:10px; right:10px; width:250px; height:12px;">
    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
  </div>
</footer>
<!--/#footer-->

{{ HTML::script('libraries/slider/js/bootstrap-slider.js') }}
{{ HTML::script('libraries/select2/js/select2.js') }}
{{ HTML::script('libraries/slick/slick.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/slimheader/classie.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.ui.widget.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.fileupload.js') }}
{{ HTML::script('js/main.js') }}
<script>
    //tooltip
	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
	})
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#home_location').change(function(){
      //alert($(this).val())
        var url = ($(this).find('option:selected').text()).toLowerCase().replace(' ','_');  
        if($(this).val()!=''){
          window.location.href="{{URL::to('/')}}/"+url+"";
        }else{
          window.location.href="{{URL::to('/')}}/";
        }
    })

    $('#newsletter').validate({
      rules:{
          'newsletter_user':{required:true},
          'newsletter_email':{
              required:true,
              email:true,
              remote:{
                url:"{{URL::action('PagesController@newsletter_email_check')}}",
                type:'post'
              }
            }
      },
      messages:{
        'newsletter_email':{
          remote:'This email has been already registered'
        }
      },
      errorClass:'text-danger',
      errorElement:'small',
      submitHandler:function(form){
        $.post(
          $(form).attr('action'),
          $(form).serialize(),
          function(m){
              var row = $.parseJSON(m);
              //console.log(row);
              $(form).find('input:text').val('');              
              $('#nw_msg').fadeIn();
          }
        );
        return false;
      }
    });

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
			$("#step1 input, #step1 textarea, #step1 select").not('.cls_transport_select,.cls_transport_distance').each(function() {
				if($(this).val() == ""){
					$(this).after('<small class="text-danger error_special">This field is required. </small>');
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
			$("#step2 input, #step1 select").not('.cls_transport_select,.cls_transport_distance').each(function() {
				if($(this).val() == ""){
					$(this).after('<small class="text-danger">This field is required. </small>');
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
	var locationJson = $.parseJSON("{{ addslashes (json_encode($dataset['locations'])) }}");
	function chnage_rule(){
    	/*$("#location_sub").empty();
		if($("#location").val() == "Bangkok"){
			$("#location_sub").append($("<option />").val("").text("Sub Location"));
			$("#location_sub").append($("<option />").val("Asok").text("Asok"));
			$("#location_sub").append($("<option />").val("Nana").text("Nana"));
		}else if($("#location").val() == "Phuket"){
			$("#location_sub").append($("<option />").val("").text("Sub Location"));
			$("#location_sub").append($("<option />").val("Patong").text("Patong"));
			$("#location_sub").append($("<option />").val("Laguna").text("Laguna"));
		}*/
		var location = $("#location").val();
		$("#location_sub").empty();
		$("#transport_id").empty();

		$("#location_sub").append($("<option />").val("").text("Sub-Location"));
		if(locationJson[location] != undefined){
			if(locationJson[location].SubLocation){
				$.each(locationJson[location].SubLocation,function(i,obj){
				  $("#location_sub").append($("<option />").val(obj.location_id).text(obj.location_name));
				});
			}
		}
		$("#transport_id").append($("<option />").val('').text('Select Transport Group'));
		$("#transport_system").hide();
		$(".cls_transport").empty();	
		
		var selected_transports = [];
		<?php
		if($dataset["property"]->selected_transports){
			foreach($dataset["property"]->selected_transports as $transport_id=>$kilometer){
		?>
			selected_transports[<?php echo $transport_id; ?>] = <?php echo $kilometer; ?>;
		<?php
			}
		}
		?>
		
		if(locationJson[location] != undefined){
			if(locationJson[location].Transport){
				 $(".cls_transport,.cls_nearby").empty();
				$.each(locationJson[location].Transport, function(i, obj){
				  
          if(obj.type=='1'){
            var slct = $('<select/>')
            .addClass('form-control cls_transport_select ucontactright')
            .attr({'name':'transport_id[]'})
            .append($("<option />")
            .val('')
            .text('Select Transport')
            );
            
            var kilometer = null;
            
            if(obj.Child.length){
              $.each(obj.Child,function(i1,obj1){
                if(selected_transports[obj1.transport_id] != undefined){
                slct.append($("<option />").attr("selected", "selected").val(obj1.transport_id).text(obj1.transport_name));
                kilometer = selected_transports[obj1.transport_id];
              }else{
                slct.append($("<option />").val(obj1.transport_id).text(obj1.transport_name));
              }
              });
              var inpt = $('<input/>').addClass('form-control locationcode cls_transport_distance').attr({'name':'transport_dist[]', 'placeholder':'Km', 'value':kilometer});
              var rw = $('<div/>').addClass('').append(slct).append(inpt);
          
          
              var col = $('<div/>').addClass('col-sm-6 transportgroup');
              var html = $('<div/>').addClass('form-group');
              var lb = $('<label/>').addClass('control-label').text(obj.transport_name);
              var cn = $('<div/>').addClass('').append(rw);
              html.append(lb).append(cn)
              col.append(html);
              $(".cls_transport").append(col);
            }else{
              $('#transport_system').hide();
            }
              

          }
          if(obj.type=='2'){
             
            if(obj.Child.length){
            var kilometer = null;
            var col = $('<div/>').addClass('col-sm-6 nearbygroup');
            var html = $('<div/>').addClass('form-group row');
            var lb = $('<label/>').addClass('control-label col-sm-12').text(obj.transport_name);
            html.append(lb);
            //console.log(obj.Child)

            $.each(obj.Child,function(i1,obj1){
              var cn = $('<div/>').addClass('col-sm-12').css('margin-bottom','5px');
              var kilometer = selected_transports[obj1.transport_id];
  
              //alert(kilometer)
                var inpt_text = $('<input/>')
                .addClass('form-control ucontactright')
                .attr({'readonly':'readonly','type':'text'})
                .css({'padding-left':'25px'})
                .val(obj1.transport_name);
                
                var inpu_hdn = $('<input/>')
                .attr({'type':'checkbox','name':'transport_id[]'})
                .prop('checked',(kilometer==undefined?false:true))
                .addClass('transport_checkbox')           
                .val(obj1.transport_id);

                
                var inpt_dst = $('<input/>')
                .addClass('form-control locationcode cls_transport_distance')
                .attr({'name':'transport_dist[]', 'placeholder':'Km', 'value':kilometer});
                
                cn.append(inpu_hdn).append(inpt_text).append(inpt_dst);
                html.append(cn);
            });
            
            col.append(html);
            $(".cls_nearby").append(col);
          }


				}      

				});
			}
		}
    //console.log(obj);
    //$("#transport_system,#nearby_system").show();
		
    if($('.nearbygroup').length==0){
        $('#nearby_system').hide();
    }else{
      $('#nearby_system').show();
    }
    if($('.transportgroup').length==0){
      $("#transport_system").hide();
    }else{
      $("#transport_system").show();
    }
	}
	$("#location").change( function(){
		chnage_rule();
	});
  
	<?php if(isset($_GET["location"]) && $_GET["location"] != ""){ ?>
		$("#location").val('<?php echo $_GET["location"]; ?>');
		chnage_rule();
	<?php } ?>
	<?php if(isset($_GET["location_sub"]) && $_GET["location_sub"] != ""){ ?>
		$("#location_sub").val('<?php echo $_GET["location_sub"]; ?>');
	<?php } ?>
	
	<?php if(isset($dataset["property"]->location) && $dataset["property"]->location != ""){ ?>
		$("#location").val('<?php echo $dataset["property"]->location; ?>');
		chnage_rule();
	<?php } ?>
	<?php if(isset($dataset["property"]->location_sub) && $dataset["property"]->location_sub != ""){ ?>
		$("#location_sub").val('<?php echo $dataset["property"]->location_sub; ?>');
	<?php } ?>
	
	<?php if(Input::old('location') != ""){ ?>
		$("#location").val('<?php echo Input::old('location'); ?>');
		chnage_rule();
	<?php } ?>
	<?php if(Input::old('location_sub') != ""){ ?>
		$("#location_sub").val('<?php echo Input::old('location_sub'); ?>');
	<?php } ?>
});

$(document).ready(function(){  
  if(window.location.hash=='#changePass'){
    $('[aria-controls="changePass"]').trigger('click');
  }

  if(window.location.hash=='#profile_edit'){
    $('[data-target="#profile_edit"]').trigger('click');
  }

  

function readImage(file) {
    var reader = new FileReader();
    var image  = new Image();

    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            //$('#uploadPreview').append('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
            //alert(this.height)
            return this;
        };
        image.onerror= function() {
            alert('Invalid file type: '+ file.type);
        };      
    };

}
});
</script>

<style type="text/css">
.portfolio-items .item-inner img{
	/*height:160px !important;*/
}
.portfolio-items .eventphototext {
	height: 120px; overflow: hidden;
}
.propertylistwrap .propertyimg img{
	/*height:207px !important;*/
}
.portfolio-items .evPhotoHt {height:auto;}
</style>
<a href="javascript:;" class="goToTopBtn gototop ">
  <i class="fa fa-chevron-up"></i>
</a>
</body>
</html>